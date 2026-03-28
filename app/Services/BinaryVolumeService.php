<?php

namespace App\Services;

use App\Models\User;
use App\Models\BinaryVolume;

class BinaryVolumeService
{
    public function addRegistrationBV(User $newUser, float $bv): void
    {
        $parent = $newUser->binaryParent;

        while ($parent) {
            BinaryVolume::create([
                'user_id'     => $parent->id,
                'side'        => $this->resolveSide($parent, $newUser),
                'volume'      => $bv,
                'source_type' => 'registration',
                'source_id'   => $newUser->id,
                'is_processed'=> false,
            ]);

            $newUser = $parent;
            $parent = $parent->binaryParent;
        }
    }

    protected function resolveSide(User $parent, User $child): string
    {
        return $child->binary_position === 'left'
            ? 'left'
            : 'right';
    }
}
