<?php

namespace App\Services;

use App\Models\User;
use RuntimeException;

class MatrixService
{
    protected CommissionService $commissionService;

    public function __construct(CommissionService $commissionService)
    {
        $this->commissionService = $commissionService;
    }

    public static function placeInMatrixTree(User $newUser): void
    {
        if (!config('mlm.commission.matrix.enabled')) {
            return;
        }

        $width     = config('mlm.commission.matrix.width');
        $maxDepth  = config('mlm.commission.matrix.depth');
        $spillover = config('mlm.genealogy.spillover');
        $sponsor = $newUser->sponsor;

        if (!$sponsor) {
            throw new RuntimeException('Matrix placement failed: Sponsor missing.');
        }

        // 🔍 Find available parent
        $parent = self::findAvailableMatrixParent(
            $sponsor,
            $width,
            $maxDepth,
            $spillover
        );

        if (!$parent) {
            throw new RuntimeException('Matrix is full. No position available.');
        }

        // 📍 Determine matrix position
        $position = self::getNextMatrixPosition($parent, $width);

        if (!$position) {
            throw new RuntimeException('Matrix width exceeded.');
        }

        // ✅ Assign placement
        $newUser->update([
            'matrix_parent_id' => $parent->id,
            'matrix_position'  => $position,
            'matrix_level'     => ($parent->matrix_level ?? 0) + 1,
        ]);
    }

    /**
     * BFS search to find available parent (spillover logic)
     */
    protected static function findAvailableMatrixParent(
        User $startUser,
        int $width,
        int $maxDepth,
        bool $spillover
    ): ?User {
        $queue = collect([$startUser]);

        while ($queue->isNotEmpty()) {
            $user = $queue->shift();

            if (($user->matrix_level ?? 0) >= $maxDepth) {
                continue;
            }

            if ($user->matrixChildren()->count() < $width) {
                return $user;
            }

            if ($spillover) {
                foreach ($user->matrixChildren as $child) {
                    $queue->push($child);
                }
            }
        }

        return null;
    }

    /**
     * Determine next available matrix position
     */
    protected static function getNextMatrixPosition(User $parent, int $width): ?int
    {
        $usedPositions = $parent->matrixChildren()
            ->pluck('matrix_position')
            ->toArray();

        for ($i = 1; $i <= $width; $i++) {
            if (!in_array($i, $usedPositions)) {
                return $i;
            }
        }

        return null;
    }

    public function payMatrixCommission(
        User $buyer,
        float $amount,
        string $sourceType = 'purchase',
        ?int $sourceId = null
    ): void {
        $config = config('mlm.commission.matrix');

        if (!$config['enabled']) {
            return;
        }

        $maxDepth = $config['depth'];
        $rates    = $config['levels'];

        $currentParent = $buyer->matrixParent;
        $level = 1;

        while ($currentParent && $level <= $maxDepth) {

            if (!isset($rates[$level])) {
                break;
            }

            $commissionAmount = ($amount * $rates[$level]) / 100;

            if ($commissionAmount > 0) {
                $this->commissionService->createCommission(
                    $currentParent,
                    $buyer,
                    $commissionAmount,
                    $level,
                    $sourceType,
                    $sourceId
                );
            }

            $currentParent = $currentParent->matrixParent;
            $level++;
        }
    }
}
