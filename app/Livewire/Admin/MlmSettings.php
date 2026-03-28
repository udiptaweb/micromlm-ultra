<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class MlmSettings extends Component
{
    // ── Active tab ──────────────────────────────────────────────────
    public string $activeTab = 'genealogy';

    // ── Genealogy ───────────────────────────────────────────────────
    public string $genealogy_type        = 'binary';
    public bool   $genealogy_spillover   = true;
    public int    $genealogy_max_levels  = 5;

    // ── Direct Referral Commission ──────────────────────────────────
    public bool   $direct_enabled = true;
    public int    $direct_rate    = 10;
    public string $direct_type    = 'percentage';

    // ── Binary Commission ───────────────────────────────────────────
    public bool   $binary_enabled              = true;
    public int    $binary_pair_amount          = 100;
    public bool   $binary_auto_placement       = true;
    public string $binary_placement_preference = 'left';
    public bool   $binary_capping_enabled       = true;
    public int    $binary_capping_daily_limit   = 1000;
    public int    $binary_capping_weekly_limit  = 5000;
    public int    $binary_capping_monthly_limit = 20000;
    public bool   $binary_matching_enabled      = true;
    public array  $binary_matching_levels       = [1 => 10, 2 => 5, 3 => 3];

    // ── Matrix Commission ───────────────────────────────────────────
    public bool  $matrix_enabled = false;
    public int   $matrix_width   = 3;
    public int   $matrix_depth   = 5;
    public array $matrix_levels  = [1 => 10, 2 => 8, 3 => 6, 4 => 4, 5 => 2];

    // ── Unilevel Commission ─────────────────────────────────────────
    public bool  $unilevel_enabled = false;
    public array $unilevel_levels  = [1 => 8, 2 => 5, 3 => 3, 4 => 2, 5 => 2, 6 => 1, 7 => 1];

    // ── Wallet ──────────────────────────────────────────────────────
    // public int   $wallet_minimum_withdrawal        = 50;
    // public int   $wallet_withdrawal_fee            = 2;
    // public int   $wallet_withdrawal_processing_days = 7;

    // ── Registration ────────────────────────────────────────────────
    public bool   $reg_require_sponsor         = true;
    public string $reg_default_sponsor         = 'admin';
    public bool   $reg_email_verification      = true;

    // ── Security ────────────────────────────────────────────────────
    public int  $sec_max_login_attempts = 5;
    public int  $sec_lockout_duration   = 30;
    public int  $sec_session_timeout    = 60;
    public bool $sec_require_2fa        = false;

    // ── Payout ──────────────────────────────────────────────────────
    public int    $payout_min_amount        = 10;
    public int    $payout_max_amount        = 100000;
    public int    $payout_charges_percent   = 5;
    public int    $payout_processing_days   = 3;
    public array  $payout_allowed_days      = ['Monday', 'Thursday'];

    // ── Ranks ───────────────────────────────────────────────────────
    public bool   $ranks_auto_upgrade    = true;
    public string $ranks_check_interval  = 'daily';

    // ────────────────────────────────────────────────────────────────

    public function mount(): void
    {
        $cfg = config('mlm');

        // Genealogy
        $this->genealogy_type       = $cfg['genealogy']['type'];
        $this->genealogy_spillover  = $cfg['genealogy']['spillover'];
        $this->genealogy_max_levels = $cfg['genealogy']['max_levels'];

        // Direct
        $this->direct_enabled = $cfg['commission']['direct_referral']['enabled'];
        $this->direct_rate    = $cfg['commission']['direct_referral']['rate'];
        $this->direct_type    = $cfg['commission']['direct_referral']['type'];

        // Binary
        $b = $cfg['commission']['binary'];
        $this->binary_enabled               = $b['enabled'];
        $this->binary_pair_amount           = $b['pair_amount'];
        $this->binary_auto_placement        = $b['auto_placement'] ?? true;
        $this->binary_placement_preference  = $b['placement_preference'] ?? 'left';
        $this->binary_capping_enabled         = $b['capping']['enabled'];
        $this->binary_capping_daily_limit     = $b['capping']['daily_limit'];
        $this->binary_capping_weekly_limit    = $b['capping']['weekly_limit'];
        $this->binary_capping_monthly_limit   = $b['capping']['monthly_limit'];
        $this->binary_matching_enabled        = $b['matching_bonus']['enabled'];
        $this->binary_matching_levels         = $b['matching_bonus']['levels'];

        // Matrix
        $this->matrix_enabled = $cfg['commission']['matrix']['enabled'];
        $this->matrix_width   = $cfg['commission']['matrix']['width'];
        $this->matrix_depth   = $cfg['commission']['matrix']['depth'];
        $this->matrix_levels  = $cfg['commission']['matrix']['levels'];

        // Unilevel
        $this->unilevel_enabled = $cfg['commission']['unilevel']['enabled'];
        $this->unilevel_levels  = $cfg['commission']['unilevel']['levels'];

        // Wallet
        // $this->wallet_minimum_withdrawal         = $cfg['wallet']['minimum_withdrawal'];
        // $this->wallet_withdrawal_fee             = $cfg['wallet']['withdrawal_fee'];
        // $this->wallet_withdrawal_processing_days = $cfg['wallet']['withdrawal_processing_days'];

        // Registration
        $this->reg_require_sponsor    = $cfg['registration']['require_sponsor'];
        $this->reg_default_sponsor    = $cfg['registration']['default_sponsor_username'];
        $this->reg_email_verification = $cfg['registration']['email_verification_required'];

        // Security
        $this->sec_max_login_attempts = $cfg['security']['max_login_attempts'];
        $this->sec_lockout_duration   = $cfg['security']['lockout_duration'];
        $this->sec_session_timeout    = $cfg['security']['session_timeout'];
        $this->sec_require_2fa        = $cfg['security']['require_2fa'];

        // Payout
        $this->payout_min_amount      = $cfg['payout']['min_amount'];
        $this->payout_max_amount      = $cfg['payout']['max_amount'];
        $this->payout_charges_percent = $cfg['payout']['charges_percent'];
        $this->payout_processing_days = $cfg['payout']['processing_days'];
        $this->payout_allowed_days    = $cfg['payout']['allowed_days'];

        // Ranks
        $this->ranks_auto_upgrade   = $cfg['ranks']['auto_rank_upgrade'];
        $this->ranks_check_interval = $cfg['ranks']['check_interval'];
    }

    public function saveSettings(): void
    {
        $this->validate([
            'genealogy_type'                    => 'required|in:binary,unilevel,matrix',
            'genealogy_max_levels'              => 'required|integer|min:1|max:20',
            'direct_rate'                       => 'required|numeric|min:0|max:100',
            'direct_type'                       => 'required|in:percentage,fixed',
            'binary_pair_amount'                => 'required|integer|min:0',
            'binary_placement_preference'       => 'required_if:binary_enabled,true|in:left,right,balanced',
            'binary_capping_daily_limit'        => 'required|integer|min:0',
            'binary_capping_weekly_limit'       => 'required|integer|min:0',
            'binary_capping_monthly_limit'      => 'required|integer|min:0',
            'matrix_width'                      => 'required|integer|min:1|max:10',
            'matrix_depth'                      => 'required|integer|min:1|max:10',
            // 'wallet_minimum_withdrawal'         => 'required|integer|min:1',
            // 'wallet_withdrawal_fee'             => 'required|numeric|min:0|max:100',
            // 'wallet_withdrawal_processing_days' => 'required|integer|min:1',
            'reg_default_sponsor'               => 'required|string',

            'sec_max_login_attempts'            => 'required|integer|min:1',
            'sec_lockout_duration'              => 'required|integer|min:1',
            'sec_session_timeout'               => 'required|integer|min:1',
            'payout_min_amount'                 => 'required|integer|min:1',
            'payout_max_amount'                 => 'required|integer|min:1',
            'payout_charges_percent'            => 'required|numeric|min:0|max:100',
            'payout_processing_days'            => 'required|integer|min:1',
            'ranks_check_interval'              => 'required|in:daily,weekly,monthly',
        ]);

        $config = [
            'user_roles' => config('mlm.user_roles'),

            'genealogy' => [
                'type'       => $this->genealogy_type,
                'spillover'  => $this->genealogy_spillover,
                'max_levels' => $this->genealogy_max_levels,
            ],

            'commission' => [
                'direct_referral' => [
                    'enabled' => $this->direct_enabled,
                    'rate'    => $this->direct_rate,
                    'type'    => $this->direct_type,
                ],
                'binary' => [
                    'enabled'              => $this->binary_enabled,
                    'pair_amount'          => $this->binary_pair_amount,
                    'auto_placement'       => $this->binary_auto_placement,
                    'placement_preference' => $this->binary_placement_preference,
                    'capping'              => [
                        'enabled'       => $this->binary_capping_enabled,
                        'daily_limit'   => $this->binary_capping_daily_limit,
                        'weekly_limit'  => $this->binary_capping_weekly_limit,
                        'monthly_limit' => $this->binary_capping_monthly_limit,
                    ],
                    'matching_bonus' => [
                        'enabled' => $this->binary_matching_enabled,
                        'levels'  => $this->binary_matching_levels,
                    ],
                ],
                'matrix' => [
                    'enabled' => $this->matrix_enabled,
                    'width'   => $this->matrix_width,
                    'depth'   => $this->matrix_depth,
                    'levels'  => $this->matrix_levels,
                ],
                'unilevel' => [
                    'enabled' => $this->unilevel_enabled,
                    'levels'  => $this->unilevel_levels,
                ],
                'generation' => config('mlm.commission.generation'),
            ],

            'ranks' => array_merge(config('mlm.ranks'), [
                'auto_rank_upgrade' => $this->ranks_auto_upgrade,
                'check_interval'    => $this->ranks_check_interval,
            ]),

            // 'wallet' => [
            //     'default_types'              => config('mlm.wallet.default_types'),
            //     'minimum_withdrawal'         => $this->wallet_minimum_withdrawal,
            //     'withdrawal_fee'             => $this->wallet_withdrawal_fee,
            //     'withdrawal_processing_days' => $this->wallet_withdrawal_processing_days,
            // ],

            'registration' => [
                'require_sponsor'              => $this->reg_require_sponsor,
                'default_sponsor_username'     => $this->reg_default_sponsor,
                'email_verification_required'  => $this->reg_email_verification,
            ],

            'security' => [
                'max_login_attempts' => $this->sec_max_login_attempts,
                'lockout_duration'   => $this->sec_lockout_duration,
                'session_timeout'    => $this->sec_session_timeout,
                'require_2fa'        => $this->sec_require_2fa,
            ],

            'payout' => [
                'min_amount'        => $this->payout_min_amount,
                'max_amount'        => $this->payout_max_amount,
                'charges_percent'   => $this->payout_charges_percent,
                'processing_days'   => $this->payout_processing_days,
                'allowed_days'      => $this->payout_allowed_days,
            ],
        ];

        // Write back to config/mlm.php
        $configPath = config_path('mlm.php');
        $export     = "<?php\n\nreturn " . $this->varExport($config, true) . ";\n";
        File::put($configPath, $export);

        // Refresh in-memory config
        config(['mlm' => $config]);

        session()->flash('settings_saved', 'MLM settings saved successfully.');
    }

    /**
     * Pretty var_export with short array syntax.
     */
    private function varExport(mixed $var, bool $indent = false, int $depth = 0): string
    {
        $pad = str_repeat('    ', $depth);
        $pad1 = str_repeat('    ', $depth + 1);

        if (is_array($var)) {
            $indexed = array_keys($var) === range(0, count($var) - 1);
            $items = [];
            foreach ($var as $k => $v) {
                $key = $indexed ? '' : var_export($k, true) . ' => ';
                $items[] = $pad1 . $key . $this->varExport($v, $indent, $depth + 1);
            }
            return "[\n" . implode(",\n", $items) . ",\n{$pad}]";
        }

        if (is_bool($var)) return $var ? 'true' : 'false';
        if (is_null($var)) return 'null';
        return var_export($var, true);
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.admin.mlm-settings')
            ->layout('layouts.app');
    }
}