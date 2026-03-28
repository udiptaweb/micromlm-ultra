# MLM System Configuration Guide

> **File:** `config/mlm.php`  
> This document explains every configuration parameter in the MLM system — what it does, how it works, and why you would change it. Intended for both admins using the settings panel and developers working on the codebase.

---

## Table of Contents

1. [Genealogy](#1-genealogy)
2. [Commission Plans](#2-commission-plans)
   - [Direct Referral](#21-direct-referral)
   - [Binary](#22-binary)
   - [Matrix](#23-matrix)
   - [Unilevel](#24-unilevel)
   - [Generation](#25-generation)
3. [Ranks](#3-ranks)
4. [Wallet](#4-wallet)
5. [Registration](#5-registration)
6. [Security](#6-security)
7. [Payout](#7-payout)
8. [Quick Reference](#8-quick-reference)

---

## 1. Genealogy

Controls how your MLM network tree is **structured and displayed**.

```php
'genealogy' => [
    'type'       => 'binary',
    'spillover'  => true,
    'max_levels' => 5,
],
```

### `type`
**What:** The network plan type that defines how members are placed in the downline tree.

| Value | Description |
|---|---|
| `binary` | Each member can have a maximum of **2 direct positions** (left leg and right leg). Everyone else spills over deeper into the tree. Best for balanced network growth. |
| `unilevel` | Each member can have **unlimited direct referrals** on level 1. Commissions are paid on a fixed number of levels deep. Simple and transparent. |
| `matrix` | Each member has a **fixed width and depth** (e.g. 3×5 = 3 wide, 5 deep). Once a level fills up, new members spill to the next available spot. |

> **Why choose binary?** Binary plans create urgency — members need both legs to earn, so they actively recruit and help their weaker leg grow.  
> **Why choose unilevel?** Simpler to understand and explain. Great for product-focused MLMs where retail sales matter more than recruitment.  
> **Why choose matrix?** Creates a forced-matrix where the company or upline can "gift" positions, filling the matrix faster.

---

### `spillover`
**What:** When `true`, new members who cannot be placed directly under their sponsor (because positions are full in binary/matrix) are automatically placed in the **next available open position** further down in the sponsor's downline.

**Why it matters:**  
- Spillover can benefit lower-level members who receive "free" placements from their upline's overflow.
- Disabling it (`false`) means new members can only be manually placed, requiring more admin intervention.

---

### `max_levels`
**What:** The maximum number of levels displayed in the genealogy tree UI. Does **not** affect how many levels commissions are paid — only the visual depth shown in the tree viewer.

**Why:** Deep trees with thousands of nodes are slow to render. Limiting display to 5 levels keeps the UI fast. Developers can increase this if they implement lazy-loading or paginated tree views.

---

## 2. Commission Plans

The system supports multiple commission plan types. You can enable/disable each independently. In most deployments only **one plan type is active** at a time (matching your `genealogy.type`), but the system supports hybrid configurations.

---

### 2.1 Direct Referral

**What:** A one-time commission paid to a member when someone they personally referred makes a purchase.

```php
'direct_referral' => [
    'enabled' => true,
    'rate'    => 10,
    'type'    => 'percentage',
],
```

| Param | Description |
|---|---|
| `enabled` | Turn direct referral commissions on or off globally. |
| `rate` | The commission amount — either a percentage of the product price or a fixed rupee amount. |
| `type` | `percentage` calculates `rate`% of the sale value. `fixed` pays exactly `rate` rupees regardless of product price. |

**Example:**  
- Product price: ₹1,000  
- Rate: `10`, Type: `percentage` → Commission = ₹100  
- Rate: `50`, Type: `fixed` → Commission = ₹50

**Why use percentage vs fixed?**  
Use `percentage` when your products vary widely in price — it scales fairly. Use `fixed` for standardised membership plans where every join pays the same referral fee.

---

### 2.2 Binary

The binary plan pays commissions when sales are matched between a member's **left leg** and **right leg**. It is the most popular MLM commission structure in India.

```php
'binary' => [
    'enabled'              => true,
    'pair_amount'          => 100,
    'auto_placement'       => true,   // binary-only
    'placement_preference' => 'left', // binary-only
    'capping'              => [...],
    'matching_bonus'       => [...],
],
```

#### `pair_amount`
**What:** The rupee amount earned for every **matched pair** of sales between the left and right leg.

**How pairing works:**  
- Left leg total sales: ₹5,000 → 5 pairs  
- Right leg total sales: ₹8,000 → 8 pairs  
- Matched pairs: **5** (the weaker leg determines the match count)  
- Commission: 5 × ₹100 = **₹500**  
- The remaining 3 pairs in the right leg carry over to the next cycle.

**Why:** Binary creates interdependence — you earn more by helping your weaker leg grow, which incentivises team support rather than pure personal recruitment.

---

#### `auto_placement` *(binary only)*
**What:** When `true`, the system automatically places newly registered members into the next available position in the sponsor's binary tree based on `placement_preference`. When `false`, the sponsor or admin must manually assign a position.

**Why disable it?**  
Some premium MLM setups allow sponsors to strategically hand-place members to balance legs manually. Disable auto-placement if your business gives sponsors placement control.

---

#### `placement_preference` *(binary only)*
**What:** Tells the system which leg to fill first when auto-placing a new member.

| Value | Behaviour |
|---|---|
| `left` | Always fills the left leg first, then right. Simple and predictable. |
| `right` | Always fills the right leg first, then left. |
| `balanced` | Places in whichever leg currently has fewer members, keeping the tree balanced automatically. |

> **This setting has no effect on unilevel or matrix plans.** Unilevel has unlimited direct placements at level 1 so there is no leg to choose. Matrix fills breadth-first deterministically.

**Developer note:** Your placement logic in `BinaryPlacementService` should read:
```php
$preference = config('mlm.commission.binary.placement_preference'); // 'left'|'right'|'balanced'
$autoPlace  = config('mlm.commission.binary.auto_placement');        // true|false
```

---

#### `capping`
**What:** Maximum limits on binary commission payouts to control the company's liability.

```php
'capping' => [
    'enabled'       => true,
    'daily_limit'   => 1000,
    'weekly_limit'  => 5000,
    'monthly_limit' => 20000,
],
```

| Param | Description |
|---|---|
| `enabled` | Whether capping is enforced. Disable only if you have no payout constraints. |
| `daily_limit` | Maximum binary commission (₹) a single member can earn in one day. |
| `weekly_limit` | Maximum per week. |
| `monthly_limit` | Maximum per month. |

**Why capping exists:**  
Without limits, a single highly productive member could earn disproportionately large amounts, creating cash flow problems. Capping ensures the company can always meet its payout obligations.

**Developer note:** Implement capping checks in your `BinaryCommissionService` before crediting the wallet. Unpaid excess is typically forfeited (not carried over), unless your business rules differ.

---

#### `matching_bonus`
**What:** An additional commission paid to an upline member based on a percentage of their **direct downline's binary commission earnings**. It rewards leaders for building productive teams.

```php
'matching_bonus' => [
    'enabled' => true,
    'levels'  => [
        1 => 10, // 10% of Level 1 downline's binary earnings
        2 => 5,  // 5% of Level 2 downline's binary earnings
        3 => 3,
    ],
],
```

**Example:**  
- Your Level 1 downline earned ₹1,000 binary today → You earn 10% = **₹100**  
- Your Level 2 downline earned ₹500 binary → You earn 5% = **₹25**

**Why:** Matching bonus rewards team builders — members who focus on training and developing their downlines rather than just personal recruitment.

---

### 2.3 Matrix

A forced-matrix pays commissions across a fixed grid of width × depth. Once a member's direct positions are full, new members spill automatically.

```php
'matrix' => [
    'enabled' => false,
    'width'   => 3,
    'depth'   => 5,
    'levels'  => [
        1 => 10,
        2 => 8,
        3 => 6,
        4 => 4,
        5 => 2,
    ],
],
```

| Param | Description |
|---|---|
| `enabled` | Enable/disable the matrix plan. |
| `width` | How many direct members each position can hold (e.g. `3` = 3×N matrix). |
| `depth` | How many levels deep commissions are paid. |
| `levels` | Commission percentage paid at each level depth. |

**Total positions in a 3×5 matrix:**  
3¹ + 3² + 3³ + 3⁴ + 3⁵ = 3 + 9 + 27 + 81 + 243 = **363 positions**

**Why matrix?**  
Matrix plans are self-limiting — once full, you must buy a new position. This creates predictable recurring revenue cycles. Popular for subscription or membership-based MLMs.

---

### 2.4 Unilevel

Every member can have unlimited direct referrals on level 1, and commissions are paid a fixed percentage across each level downward.

```php
'unilevel' => [
    'enabled' => false,
    'levels'  => [
        1 => 8, // 8% on sales from level 1 (your direct referrals)
        2 => 5,
        3 => 3,
        4 => 2,
        5 => 2,
        6 => 1,
        7 => 1,
    ],
],
```

**Example with ₹1,000 product sale:**

| Level | Rate | Commission |
|---|---|---|
| 1 (direct referral's purchase) | 8% | ₹80 |
| 2 | 5% | ₹50 |
| 3 | 3% | ₹30 |
| ... | ... | ... |

**Why unilevel?**  
The simplest plan to explain to new members. There is no binary matching complexity — you earn from everyone below you up to a fixed depth. Excellent for retail-product-focused companies.

---

### 2.5 Generation

Generation commissions pay across **rank-based groupings** of your downline rather than simple depth levels.

```php
'generation' => [
    'enabled'     => false,
    'generations' => 5,
    'rate'        => 5,
],
```

| Param | Description |
|---|---|
| `enabled` | Currently disabled by default — requires custom implementation. |
| `generations` | How many generations deep commissions are paid. |
| `rate` | Percentage of sales paid per generation. |

**How generations work (different from levels):**  
A "generation" boundary is defined by where a **qualified/ranked member** appears in your downline. Everyone between two qualified leaders belongs to the same generation.

```
You (Gold rank)
  ├── A (regular)  ─┐
  ├── B (regular)   │ Generation 1 (down to first qualified leader)
  ├── C (regular)  ─┘
  └── D (Silver ← rank boundary)
        ├── E (regular) ─┐
        └── F (regular)  │ Generation 2
        └── G (Bronze ← next boundary)
              └── H      │ Generation 3
```

**Why generation commissions?**  
They reward building **deep, qualified leaders** in your downline rather than just raw headcount. The deeper your qualified leaders go, the more generations you earn from. Used by companies like Forever Living, Vestige, and Modicare.

**Developer note:** Generation commission is currently `enabled: false` and has no implementation. To enable it, you must build a `GenerationCommissionService` that traverses the genealogy tree, identifies rank boundaries, and groups members into generations before calculating payouts.

---

## 3. Ranks

Ranks define career progression milestones within the MLM. Members advance through ranks by hitting sales and team targets, unlocking higher commissions and bonuses.

```php
'ranks' => [
    'auto_rank_upgrade' => true,
    'check_interval'    => 'daily',
    'rank_levels'       => [...],
],
```

### `auto_rank_upgrade`
**What:** When `true`, the system automatically checks all members against rank criteria and upgrades them without manual admin action.

**When to disable:** If your business rules require manual rank approval (e.g. the admin verifies documents before upgrading to higher ranks), set this to `false` and implement an admin approval workflow.

---

### `check_interval`
**What:** How frequently the automated rank check job runs.

| Value | Use Case |
|---|---|
| `daily` | Standard — most MLM companies check ranks daily |
| `weekly` | Lower server load; suitable for smaller networks |
| `monthly` | For plans where ranks are evaluated per month cycle |

**Developer note:** This value should be consumed by a scheduled command in `app/Console/Kernel.php`:
```php
$schedule->command('mlm:check-ranks')
    ->when(fn() => config('mlm.ranks.check_interval') === 'daily')
    ->daily();
```

---

### `rank_levels`
Each rank level defines the **criteria a member must meet** to achieve it, and the **one-time bonus** they receive upon achieving it.

```php
[
    'name'                 => 'Gold',
    'slug'                 => 'gold',
    'level'                => 3,
    'minimum_sales'        => 10000,  // Member's own sales (₹)
    'minimum_team_sales'   => 100000, // Total downline sales (₹)
    'minimum_directs'      => 10,     // Minimum personally recruited members
    'bonus_amount'         => 2000,   // One-time rank achievement bonus (₹)
]
```

| Param | Description |
|---|---|
| `name` | Display name shown on the dashboard |
| `slug` | Machine-readable identifier used in code |
| `level` | Numeric rank order (higher = more senior) |
| `minimum_sales` | The member's own product purchase/sales value required |
| `minimum_team_sales` | Total sales across their entire downline |
| `minimum_directs` | Number of personally referred active members required |
| `bonus_amount` | One-time credit to the bonus wallet when rank is achieved |

**Developer note:** Rank criteria are stored in config but should ideally be seeded to a `ranks` database table for runtime flexibility. Storing in config means a code deploy is required to change thresholds.

---

## 4. Wallet

Members hold three wallet types: **Main** (withdrawable), **Commission** (MLM earnings), and **Bonus** (locked incentives). The wallet config controls withdrawal behaviour.

```php
'wallet' => [
    'default_types'              => ['main', 'commission', 'bonus'],
    'minimum_withdrawal'         => 50,
    'withdrawal_fee'             => 2,
    'withdrawal_processing_days' => 7,
],
```

| Param | Description |
|---|---|
| `default_types` | The three wallet types created for every new member on registration. Do not remove types without a migration. |
| `minimum_withdrawal` | Members cannot request a withdrawal below this amount (₹). Prevents micro-withdrawal spam and processing overhead. |
| `withdrawal_fee` | Percentage deducted from the withdrawal amount as a processing fee. E.g. `2` means a ₹1,000 withdrawal pays ₹980. |
| `withdrawal_processing_days` | Estimated working days displayed to the member after they submit a request. Does not enforce any system delays — purely informational. |

**Why a withdrawal fee?**  
It covers payment gateway charges, bank transfer fees, and administrative processing costs. Typical range is 1–5%.

---

## 5. Registration

Controls how new members join the platform.

```php
'registration' => [
    'require_sponsor'             => true,
    'default_sponsor_username'    => 'admin',
    'email_verification_required' => true,
],
```

> **Note:** `auto_placement` and `placement_preference` have been moved to `commission.binary` because they are concepts that only apply to the binary plan. See [Binary Placement](#auto_placement-binary-only) above.

| Param | Description |
|---|---|
| `require_sponsor` | If `true`, a valid referral code must be entered during registration. If `false`, anyone can register without a sponsor. |
| `default_sponsor_username` | When `require_sponsor` is `false` (or the referral code is invalid/omitted), this username is used as the fallback sponsor. Typically set to `admin` or a designated root account. |
| `email_verification_required` | If `true`, members must verify their email before accessing any dashboard features. Strongly recommended to prevent fake/throwaway accounts. |

**Why require a sponsor?**  
In most MLM businesses, the referral code is how new members are attributed to the correct sponsor's downline. Without it, the genealogy tree breaks and commissions cannot be correctly calculated.

**Which plans need a sponsor?**  
All three plans (binary, matrix, unilevel) require a sponsor to determine *who* referred the new member. The distinction is that binary additionally needs to know *where* in the sponsor's tree to place them (left or right leg), which is what `auto_placement` and `placement_preference` control.

---

## 6. Security

Controls account protection and session behaviour.

```php
'security' => [
    'max_login_attempts' => 5,
    'lockout_duration'   => 30,
    'session_timeout'    => 60,
    'require_2fa'        => false,
],
```

| Param | Description |
|---|---|
| `max_login_attempts` | Number of failed login attempts before the account is temporarily locked. Laravel's built-in throttle middleware should be configured to match this value. |
| `lockout_duration` | Minutes the account remains locked after hitting `max_login_attempts`. |
| `session_timeout` | Minutes of inactivity before the user's session expires and they are logged out. |
| `require_2fa` | When `true`, all users must set up two-factor authentication. Requires a 2FA package (e.g. `laravel-fortify` with TOTP) to be installed and configured. |

**Developer note:** These values are informational unless you wire them into Laravel's auth configuration. In `config/auth.php` and your login controller/Livewire component, read from `config('mlm.security.max_login_attempts')` to keep everything in sync.

---

## 7. Payout

Governs member withdrawal requests — amounts, fees, timing, and processing days.

```php
'payout' => [
    'min_amount'      => 10,
    'max_amount'      => 100000,
    'charges_percent' => 5,
    'processing_days' => 3,
    'allowed_days'    => ['Monday', 'Thursday'],
],
```

| Param | Description |
|---|---|
| `min_amount` | Minimum rupee value of a single payout request. Prevents trivially small withdrawals. |
| `max_amount` | Maximum rupee value per request. Members with larger balances must submit multiple requests. Useful for cash flow management. |
| `charges_percent` | Percentage of the payout amount deducted as a processing/service charge. E.g. `5` on ₹10,000 means the member receives ₹9,500. |
| `processing_days` | Estimated working days for the payout to be processed and transferred. Displayed to the member but not system-enforced. |
| `allowed_days` | Days of the week on which payout requests can be submitted or processed. Outside these days, requests can be blocked or queued. |

**Why limit allowed days?**  
Batch processing payouts on fixed days (e.g. Monday and Thursday) reduces banking overhead, simplifies reconciliation, and gives admins predictable windows to review and approve requests before transfer.

**Developer note:** Enforce `allowed_days` in your `RequestWithdraw` Livewire component:
```php
$today = now()->format('l'); // e.g. "Tuesday"
if (!in_array($today, config('mlm.payout.allowed_days'))) {
    $this->addError('payout', 'Payouts are only processed on ' .
        implode(' and ', config('mlm.payout.allowed_days')));
    return;
}
```

---

## 8. Quick Reference

### Which plan type should I use?

| Business Model | Recommended Plan |
|---|---|
| Recruitment-heavy, team-building focus | Binary |
| Product retail focus, simple compensation | Unilevel |
| Subscription/membership cycles | Matrix |
| Rank-based leadership development | Generation (+ Unilevel) |

---

### Commission plan comparison

| Feature | Binary | Unilevel | Matrix | Generation |
|---|---|---|---|---|
| Max direct referrals | 2 | Unlimited | Fixed (width) | Unlimited |
| Commission basis | Paired leg sales | Personal + downline sales | Position in grid | Rank-grouped downlines |
| Complexity | Medium | Low | Medium | High |
| Best for | Team builders | Retailers | Recurring cycles | Senior leaders |
| Currently enabled | ✓ | ✗ | ✗ | ✗ |

---

### Saving config changes

Changes made through the **Admin → MLM Settings** panel are written directly back to `config/mlm.php`. After saving:

1. The in-memory config is refreshed immediately via `config(['mlm' => ...])`.
2. If you use Laravel's config caching in production, run `php artisan config:clear` after changes to ensure the new values are picked up.
3. For rank level thresholds, edit `config/mlm.php` directly and re-seed the `ranks` table if applicable.

---

### Wallet flow diagram

```
Product Purchase
      │
      ▼
Commission Calculated
      │
      ├──► Direct Referral Commission
      │         └──► Credited to Sponsor's Commission Wallet
      │
      ├──► Binary / Unilevel / Matrix Commission
      │         └──► Credited to Earner's Commission Wallet
      │
      └──► Rank Bonus (on upgrade)
                └──► Credited to Earner's Bonus Wallet

Commission Wallet ──► (Admin transfer / auto-transfer) ──► Main Wallet
Main Wallet       ──► (Withdrawal Request) ──► Bank Account
```

---

*Last updated: {{ date('d M Y') }}*  
*Config file location: `config/mlm.php`*  
*Settings panel: Admin → MLM Settings*