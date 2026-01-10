# MicroMLM Ultra - MLM Software Setup

## Overview
A complete Multi-Level Marketing (MLM) system built with Laravel 12, Livewire 3, and Laravel Volt. This system includes genealogy tracking, commission management, rank advancement, and wallet functionality.

## Features Implemented

### 1. **Database Schema**
- ✅ Users table with MLM fields (sponsor, referral code, rank, position)
- ✅ User profiles table for additional user information
- ✅ Ranks table with configurable rank levels
- ✅ Commissions table for tracking all commission types
- ✅ Wallets table (main, commission, bonus)
- ✅ Wallet transactions table for complete transaction history

### 2. **Models & Relationships**
- **User Model**
  - Sponsor/Downline relationships (self-referencing)
  - Rank relationship
  - Multiple wallet types
  - Commission tracking
  - Profile information

- **Rank Model**
  - Configurable rank levels (Member, Bronze, Silver, Gold, Platinum, Diamond)
  - Minimum requirements (sales, team sales, direct referrals)
  - Rank bonus amounts

- **Commission Model**
  - Multiple commission types (direct, binary, unilevel, matching, rank_bonus)
  - Status tracking (pending, approved, paid, cancelled)
  - Level-based commissions

- **Wallet Model**
  - Credit/Debit operations
  - Balance tracking
  - Transaction history

### 3. **MLM Configuration** (`config/mlm.php`)
Configure all MLM business rules:
- Genealogy structure (binary, unilevel, matrix)
- Commission rates and types
- Rank requirements and bonuses
- Wallet settings
- Registration rules
- Payout schedules

### 4. **User Interface**

#### Dashboard (`/dashboard`)
- Wallet balance overview
- Total commissions earned
- Direct referrals count
- Current rank display
- Referral link with copy function
- Recent commissions table

#### Genealogy Tree (`/genealogy`)
- Visual representation of your network
- Direct referrals display
- Network statistics
- Position tracking (left/right for binary)

#### Commissions Report (`/commissions`)
- Complete commission history
- Filter by status (all, pending, approved, paid)
- Commission type breakdown
- Earnings summary cards
- Paginated results

### 5. **Registration System**
- Username and referral code fields
- Automatic sponsor detection from URL parameter
- Auto-generation of unique referral code
- Default rank assignment
- Profile and wallet auto-creation via Observer

### 6. **Automated Features**
- **User Observer**: Automatically creates:
  - User profile record
  - Main wallet
  - Commission wallet
  - Bonus wallet
  
## Default Login Credentials

```
Email: admin@micromlm.com
Password: password
Username: admin
Referral Code: ADMIN001
```

## Quick Start

### 1. Database Setup
The database has been migrated and seeded with:
- All necessary tables
- Default rank levels (Member to Diamond)
- Admin user account

### 2. Start Development Server
```bash
composer run dev
```
This will start:
- Laravel development server (http://localhost:8000)
- Queue worker for background jobs
- Vite dev server for hot reload

### 3. Register New Users
- Direct registration: http://localhost:8000/register
- With referral: http://localhost:8000/register?ref=ADMIN001

## Key Configuration Options

### Commission Settings (`config/mlm.php`)

#### Direct Referral Commission
```php
'direct_referral' => [
    'enabled' => true,
    'rate' => 10, // 10% or fixed amount
    'type' => 'percentage',
],
```

#### Binary Commission
```php
'binary' => [
    'enabled' => true,
    'pair_amount' => 100, // $100 per pair
    'capping' => [
        'daily_limit' => 1000,
        'weekly_limit' => 5000,
        'monthly_limit' => 20000,
    ],
],
```

#### Unilevel Commission
```php
'unilevel' => [
    'enabled' => false,
    'levels' => [
        1 => 8,  // 8% on level 1
        2 => 5,  // 5% on level 2
        // ... up to 7 levels
    ],
],
```

### Rank Configuration
Edit ranks in `config/mlm.php`:
```php
[
    'name' => 'Gold',
    'slug' => 'gold',
    'level' => 3,
    'minimum_sales' => 10000,
    'minimum_team_sales' => 100000,
    'minimum_directs' => 10,
    'bonus_amount' => 2000,
]
```

## API / Helper Methods

### User Methods
```php
$user->sponsor; // Get sponsor
$user->downlines; // Get direct referrals
$user->rank; // Get current rank
$user->mainWallet(); // Get main wallet
$user->commissions; // Get all commissions
```

### Wallet Methods
```php
$wallet->credit(100, 'commission', 'Direct referral commission');
$wallet->debit(50, 'withdrawal', 'Withdrawal request');
$wallet->balance; // Current balance
```

### Commission Queries
```php
Commission::pending()->get(); // Get pending commissions
Commission::paid()->get(); // Get paid commissions
$user->commissions()->where('type', 'direct')->sum('amount');
```

## Database Structure

### Users Table Fields
- `username` - Unique username
- `referral_code` - Unique 8-character code
- `sponsor_id` - Foreign key to sponsor user
- `rank_id` - Current rank
- `position` - Binary tree position (left/right)
- `status` - active, inactive, suspended

### Commissions Table Fields
- `user_id` - Commission recipient
- `from_user_id` - Commission source
- `type` - direct, binary, unilevel, matching, rank_bonus
- `amount` - Commission amount
- `level` - Commission level
- `status` - pending, approved, paid, cancelled

### Wallets Table Fields
- `type` - main, commission, bonus
- `balance` - Current balance
- `pending_balance` - Pending/locked balance

## Next Steps / Enhancements

### Recommended Additions:
1. **Admin Panel**: Create admin dashboard for:
   - User management
   - Commission approval
   - Payout processing
   - System reports

2. **Commission Calculation**: Implement automated commission calculation:
   - Create Commission service class
   - Add event listeners for purchase/sale events
   - Implement capping logic

3. **Withdrawal System**: Add withdrawal requests:
   - Withdrawal request form
   - Admin approval workflow
   - Payout processing

4. **E-Pin System**: Optional digital pin system:
   - Pin generation
   - Pin transfer
   - Pin usage tracking

5. **Reports**: Additional reporting:
   - Sales reports
   - Team performance
   - Rank achievement reports
   - Payout history

6. **Notifications**: Email/SMS notifications for:
   - New downline registration
   - Commission earnings
   - Rank advancement
   - Withdrawal approvals

7. **KYC Verification**: User verification system:
   - Document upload
   - Admin verification
   - Approval workflow

## File Structure

```
app/
├── Models/
│   ├── User.php (with MLM relationships)
│   ├── UserProfile.php
│   ├── Rank.php
│   ├── Commission.php
│   ├── Wallet.php
│   └── WalletTransaction.php
├── Observers/
│   └── UserObserver.php (auto-creates wallets & profile)
└── Providers/
    └── AppServiceProvider.php (registers observer)

config/
└── mlm.php (complete MLM configuration)

database/
├── migrations/
│   ├── *_create_user_profiles_table.php
│   ├── *_create_ranks_table.php
│   ├── *_create_commissions_table.php
│   ├── *_create_wallets_table.php
│   ├── *_create_wallet_transactions_table.php
│   └── *_add_mlm_fields_to_users_table.php
└── seeders/
    ├── RankSeeder.php
    └── AdminUserSeeder.php

resources/views/
├── dashboard.blade.php (MLM dashboard)
└── livewire/pages/
    ├── genealogy.blade.php (network tree)
    ├── commissions.blade.php (commission reports)
    └── auth/register.blade.php (registration with referral)
```

## Support & Customization

This MLM system is fully customizable. All business logic can be adjusted via:
- Configuration file (`config/mlm.php`)
- Model relationships
- Commission calculation logic
- UI components

For custom commission plans or specific business rules, modify the respective configuration sections or create custom services.

## Security Considerations

1. **Input Validation**: All user inputs are validated
2. **SQL Injection**: Using Eloquent ORM prevents SQL injection
3. **XSS Protection**: Blade templates auto-escape output
4. **CSRF Protection**: Laravel's CSRF middleware enabled
5. **Password Hashing**: Using bcrypt for password storage

## Performance Tips

1. **Eager Loading**: Use `with()` for relationships
2. **Caching**: Implement cache for genealogy calculations
3. **Queue Jobs**: Use queues for commission calculations
4. **Database Indexing**: Already indexed foreign keys and status fields

---

**Version**: 1.0.0
**Laravel**: 12.x
**Livewire**: 3.x
**PHP**: 8.2+


---
## Terminology
1.**BV**: Business Volume



## Matrix Plan Implementation Guide

### 1️⃣ How Matrix Fits Into Your Current System

You already have:
- `sponsor_id` in users table
- Commission table with `level` field
- Config-driven commission rules in `config/mlm.php`
- Wallet system for payouts

👉 **Matrix only needs two additions:**
- Width control (max direct referrals per user)
- Spillover logic (automatic placement when sponsor is full)

Everything else stays the same.

---

### 2️⃣ Matrix Configuration

Add this to `config/mlm.php`:

```php
'matrix' => [
  'enabled' => true,
  'width' => 3,   // Max direct referrals per user
  'depth' => 5,   // Commission levels to pay
  'levels' => [
    1 => 10,  // 10% commission on level 1
    2 => 8,   // 8% commission on level 2
    3 => 6,   // 6% commission on level 3
    4 => 4,   // 4% commission on level 4
    5 => 2,   // 2% commission on level 5
  ],
],
```

---

### 3️⃣ Width Rule (Most Important Difference)

**Example: Width = 3**

```
A
├── B
├── C
├── D   ← Matrix FULL (3 direct referrals)
```

If user **E** joins under **A**:
- **E** is automatically spilled to **B** (or next available node)
- ➡ This is the **core matrix logic**

---

### 4️⃣ Spillover Logic (How Placement Works)

**Spillover Algorithm (Breadth-First Search):**

1. Check sponsor's direct count
2. If sponsor has < width directs → place here
3. Else:
   - Go level by level
   - Find first user with available slot
   - Place user there

This ensures **balanced matrix growth**.

**Where to Implement Spillover:**
- ✅ Inside: `Registration` → `MatrixPlacementService`
- ❌ Not inside commission logic

---

### 5️⃣ WHEN Matrix Commission Is Paid

Matrix commission is triggered on:
- ✅ Paid registration
- ✅ Package purchase
- ✅ Product sale

**Never triggered on:**
- ❌ Free join
- ❌ BV pairing

---

### 6️⃣ HOW Matrix Commission Is Calculated

**Example Scenario:**
- Matrix: 3×5
- User **X** purchases ₹1,000

**Upline Traversal:**
- Level 1 → Sponsor
- Level 2 → Sponsor's sponsor
- Level 3 → Level 2's sponsor
- Level 4 → Level 3's sponsor
- Level 5 → Level 4's sponsor

**Commission Payout:**

| Level | Rate | Amount |
|-------|------|--------|
| 1     | 10%  | ₹100   |
| 2     | 8%   | ₹80    |
| 3     | 6%   | ₹60    |
| 4     | 4%   | ₹40    |
| 5     | 2%   | ₹20    |

Each commission is saved as:
```php
[
  'type' => 'matrix',
  'level' => X,
  'status' => 'pending',
  'from_user_id' => purchaser_id,
  'user_id' => upline_id,
]
```

---

### 7️⃣ How This Fits Your Database (Minimal Change)

**Commissions Table**
- ✔ Already supports:
  - `type = 'matrix'`
  - `level` field
  - `from_user_id`
- ✔ **No change needed**

**Users Table (Optional Enhancement)**

Add optional field for visualization:
```php
Schema::table('users', function (Blueprint $table) {
  $table->string('matrix_position')->nullable(); // e.g., "1-2-3"
});
```

---

### 8️⃣ Key Business Rules (Very Important)

✔ **Width must be enforced** (hard limit)
✔ **Spillover must be deterministic** (breadth-first)
✔ **Stop payout at configured depth** (respect depth limit)
✔ **Upline must be active** (check user status)
✔ **Prevent duplicate payouts** (check existing commissions)
✔ **Rank-based eligibility** (optional — some ranks may not qualify)

---

### 9️⃣ Recommended Services to Create

#### 1️⃣ `MatrixPlacementService`

**Responsible for:**
- Finding correct placement position
- Handling spillover when sponsor is full
- Assigning `sponsor_id` correctly
- Updating `matrix_position` (optional)

**Location:** `app/Services/MatrixPlacementService.php`

#### 2️⃣ `MatrixCommissionService`

**Responsible for:**
- Traversing upline chain (up to depth levels)
- Applying commission percentages from config
- Creating commission records in database
- Checking upline eligibility (active status, rank)

**Location:** `app/Services/MatrixCommissionService.php`

---

### Matrix vs Binary vs Unilevel Comparison

| Feature | Matrix | Binary | Unilevel |
|---------|--------|--------|----------|
| **Width Limit** | Fixed (e.g., 3) | Always 2 | Unlimited |
| **Spillover** | Yes (automatic) | Yes (left/right) | No |
| **Commission Levels** | Fixed depth | Pairing-based | Multiple levels |
| **Best For** | Forced teamwork | Volume matching | Direct sales focus |

---

### Implementation Checklist

- [ ] Add matrix config to `config/mlm.php`
- [ ] Create `MatrixPlacementService`
- [ ] Create `MatrixCommissionService`
- [ ] Update registration flow to use placement service
- [ ] Add commission calculation on purchase events
- [ ] Test spillover logic with multiple users
- [ ] Create matrix genealogy visualization page
- [ ] Add matrix-specific reports to dashboard

---


## Binary Plan Implementation Guide

### 1️⃣ How Binary MLM Fits Into Your Application

Your system already has:
- Users with `sponsor_id` and `position` (left/right)
- Commission table
- Wallet system
- Config-driven MLM rules

So Binary MLM is **NOT a new feature** — it is a **calculation layer** on top of your existing data.

Binary MLM answers only ONE question:
> "How much commission should a user earn based on left vs right team growth?"

---

### 2️⃣ BV (Business Volume) — What It Means in Your App

You already defined:
> **BV = Business Volume**

In your system, BV should come from one of these actions (choose one or combine):

#### Common BV Sources
| Action | BV Trigger |
|--------|------------|
| User registration | Fixed BV (e.g. 100 BV) |
| Package purchase | Package amount |
| Subscription renewal | Renewal value |
| Product sale | Product BV |

💡 **Important**: Binary MLM NEVER pays on users — it pays on BV.

#### Where BV Should Be Stored (Recommended)

Add a table (or extend existing one):

```
binary_volumes
----------------
user_id
left_bv
right_bv
left_carry
right_carry
```

This table represents **network strength, not money**.

---

### 3️⃣ Your Binary Config — Explained in Business Terms

```php
'binary' => [
  'enabled' => true,
  'pair_amount' => 100,
```

#### Meaning
- 1 Left BV + 1 Right BV = **1 Pair**
- 1 Pair = **₹100 commission**
- If Left = 5 BV and Right = 3 BV → **3 pairs** → **₹300**

#### Capping (Very Important for Sustainability)
```php
'capping' => [
  'enabled' => true,
  'daily_limit' => 1000,
  'weekly_limit' => 5000,
  'monthly_limit' => 20000,
],
```

**Why Capping Exists:**
- Without capping, a top leader could earn unlimited money
- Company cash flow becomes unstable

**How Capping Works:**

If a user earns ₹1,400 today, but daily cap is ₹1,000:
- ➡ Pay only ₹1,000
- ➡ Remaining pairs are carried forward

#### Matching Bonus (Upline Motivation)
```php
'matching_bonus' => [
  'enabled' => true,
  'levels' => [
    1 => 10,
    2 => 5,
    3 => 3,
  ],
],
```

This is **commission on commission**.

**Meaning:**
If A earns binary commission, then:
- Sponsor (Level 1) earns **10%**
- Sponsor's sponsor earns **5%**
- Level 3 earns **3%**

This encourages leaders to support their teams.

---

### 4️⃣ WHEN Binary Commission Should Be Given (Critical)

❌ **Never** give binary commission immediately  
❌ **Never** give on user registration

✔ Binary commission is **calculated periodically**

#### Industry-Standard Timing
| Type | Recommended |
|------|-------------|
| Binary Commission | Daily |
| Matching Bonus | Same time as binary |
| Direct Referral | Instant or daily |
| Rank Bonus | On rank achievement |

#### How This Fits Your App

You should create:
```bash
php artisan binary:calculate
```

Run via Laravel Scheduler:
```php
$schedule->command('binary:calculate')->dailyAt('00:00');
```

---

### 5️⃣ COMPLETE Binary Lifecycle (Real Example)

#### Scenario
- User A is sponsor
- Two downlines join:
  - Left leg → 4 BV
  - Right leg → 2 BV

#### Step 1: BV Accumulation
```
left_bv = 4
right_bv = 2
```

#### Step 2: Pair Calculation
```
pairs = min(4, 2) = 2
```

#### Step 3: Gross Income
```
2 × 100 = ₹200
```

#### Step 4: Apply Capping
If daily cap = ₹1,000 → full ₹200 allowed

#### Step 5: Save Commission
Create record:
```php
commissions
------------
user_id = A
type = binary
amount = 200
status = pending
```

#### Step 6: Deduct Used BV
```
left_bv = 4 - 2 = 2
right_bv = 2 - 2 = 0
```
Remaining BV carries forward.

#### Step 7: Matching Bonus

If A earned ₹200:

| Level | User | % | Amount |
|-------|------|---|--------|
| 1 | Sponsor | 10% | ₹20 |
| 2 | Next upline | 5% | ₹10 |
| 3 | Next | 3% | ₹6 |

Each saved as:
```php
type = matching
status = pending
```

---

### 6️⃣ HOW This Fits Your Existing Tables

#### Commissions Table
You already have:
```php
type = binary
type = matching
```
Perfect ✔

#### Wallet Flow
Binary & matching commissions should:
1. Go to **commission wallet**
2. Stay **pending**
3. Admin approves → move to **main wallet**

---

### 7️⃣ What You Should Implement NEXT (Very Concrete)

#### 1️⃣ `BinaryVolumeService`
**Responsible for:**
- Adding BV to upline
- Tracking left/right volumes

#### 2️⃣ `BinaryCommissionService`
**Responsible for:**
- Pair calculation
- Capping logic
- Commission creation
- Matching bonus

#### 3️⃣ Scheduled Command
```bash
php artisan make:command CalculateBinaryCommission
```

#### 4️⃣ Admin Approval Flow
- Pending → Approved → Paid
- Wallet credit on approval

---

### 8️⃣ Key Rules to Enforce (Important)

✔ Binary only if user is **active**  
✔ No commission if one leg is **zero**  
✔ BV must **carry forward**  
✔ Capping must be **enforced**  
✔ Duplicate daily payouts must be **prevented**

---

### Binary vs Matrix vs Unilevel Comparison

| Feature | Binary | Matrix | Unilevel |
|---------|--------|--------|----------|
| **Width Limit** | Always 2 | Fixed (e.g., 3) | Unlimited |
| **Spillover** | Yes (left/right) | Yes (automatic) | No |
| **Commission Trigger** | BV pairing | Direct purchase | Direct purchase |
| **Calculation** | Daily (scheduled) | Instant/daily | Instant/daily |
| **Best For** | Volume matching | Forced teamwork | Direct sales focus |

---

### Binary Implementation Checklist

- [ ] Add `binary_volumes` table for BV tracking
- [ ] Create `BinaryVolumeService` for BV accumulation
- [ ] Create `BinaryCommissionService` for pair calculation
- [ ] Implement capping logic (daily/weekly/monthly)
- [ ] Create scheduled command for daily calculation
- [ ] Add matching bonus calculation
- [ ] Implement admin approval workflow
- [ ] Create binary genealogy visualization
- [ ] Add binary-specific reports to dashboard
- [ ] Test carry-forward logic

---


## Unilevel Plan Implementation Guide

### 🔷 What is Unilevel MLM (In Simple Terms)

In Unilevel MLM:
- Each user can have **unlimited direct referrals**
- There is **NO left/right**
- Commissions flow upward **level by level**

👉 Income is based on **depth, not pairing**.

---

### 🧠 Binary vs Unilevel (Quick Comparison)

| Feature | Binary | Unilevel |
|---------|--------|----------|
| **Structure** | Left / Right | Unlimited width |
| **Pairing** | Required | ❌ No |
| **Carry Forward** | Yes | ❌ No |
| **Complexity** | High | Low |
| **Payout Timing** | Daily / Weekly | Instant or Daily |
| **Best For** | Network balancing | Product sales |

---

### 1️⃣ How Unilevel Fits Your Current System

You already have:
- `sponsor_id` (parent)
- `commissions` table with `level`
- Config-driven commission rules
- Wallet system

✅ **So Unilevel needs NO new tables** ❗  
It is purely **logic + traversal**.

---

### 2️⃣ Your Unilevel Config Explained

```php
'unilevel' => [
  'enabled' => false,
  'levels' => [
    1 => 8,  // 8% commission on level 1
    2 => 5,  // 5% commission on level 2
    3 => 3,  // 3% commission on level 3
    4 => 2,  // 2% commission on level 4
    5 => 2,  // 2% commission on level 5
    6 => 1,  // 1% commission on level 6
    7 => 1,  // 1% commission on level 7
  ],
],
```

**Meaning:**

| Level | Who gets paid | % |
|-------|--------------|---|
| 1 | Direct sponsor | 8% |
| 2 | Sponsor's sponsor | 5% |
| 3 | Level 3 upline | 3% |
| ... | ... | ... |

👉 **Level = distance from the source user**

---

### 3️⃣ WHAT Unilevel Pays On (BV Source)

Unilevel commission is paid on:
- ✔ Product purchase
- ✔ Package upgrade
- ✔ Subscription renewal
- ✔ Registration fee (optional)

⚠️ It is **not** paid on joining alone unless money enters the system.

---

### 4️⃣ WHEN Unilevel Commission Should Be Given

Two industry-standard options:

#### ✅ Option 1: Instant (Most Common)
As soon as a purchase happens:
1. Calculate upline
2. Create commission records
3. Mark as pending

**Used by:**
- Product-based MLMs
- Subscription-based systems

#### ✅ Option 2: Daily Batch
- Accumulate BV for the day
- Run nightly commission calculation

**Used when:**
- High transaction volume
- Need auditing

💡 **For MicroMLM Ultra, I recommend:**  
**Instant creation + admin approval later**

---

### 5️⃣ HOW Unilevel Commission is Calculated (Step-by-Step)

#### Example Scenario
- User **D** makes a purchase of **₹1,000**
- Unilevel enabled up to **3 levels**

#### Step 1: Identify Upline Chain
```
Level 1 → C (sponsor)
Level 2 → B
Level 3 → A
```

#### Step 2: Calculate Commission

| Level | % | Amount |
|-------|---|--------|
| 1 | 8% | ₹80 |
| 2 | 5% | ₹50 |
| 3 | 3% | ₹30 |

#### Step 3: Save in Commissions Table
```php
[
  'user_id' => C,
  'from_user_id' => D,
  'type' => 'unilevel',
  'level' => 1,
  'amount' => 80,
  'status' => 'pending',
]
```
Repeat for each level.

#### Step 4: Wallet Credit (After Approval)
- Credit commission wallet
- Move to main wallet on payout

---

### 6️⃣ How This Maps to Your Tables (Perfect Match)

#### Commissions Table
You already have:
- ✔ `type = 'unilevel'`
- ✔ `level`
- ✔ `from_user_id`
- ✔ `status`

✅ **No schema change needed**

#### Wallets
Use:
```php
$wallet->credit($amount, 'unilevel', 'Level '.$level.' commission');
```

---

### 7️⃣ IMPORTANT Business Rules You Should Enforce

- ✔ Upline must be **active**
- ✔ Stop at configured **max level**
- ✔ No sponsor → **stop traversal**
- ✔ **Prevent duplicate commissions**
- ✔ Apply **rank-based eligibility** (optional)

---

### 8️⃣ Recommended Implementation in Your App

#### Create a Service
```bash
php artisan make:service UnilevelCommissionService
```

**Responsibilities:**
- Traverse sponsor chain
- Apply percentages
- Create commission records

#### Trigger Point
Call Unilevel when:
- ✅ Order is paid
- ✅ Package is activated
- ✅ Subscription is renewed
- ❌ Not on registration (unless paid)

---

### 9️⃣ Binary + Unilevel Together (Very Common)

Your system supports this perfectly:

| Action | Binary | Unilevel |
|--------|--------|----------|
| Registration | BV only | ❌ |
| Purchase | BV | ✔ |
| Daily cron | ✔ | ❌ |
| Matching bonus | ✔ | ❌ |

This makes your plan:
- **Balanced**
- **Sales-driven**
- **Scalable**

---

### 🔚 FINAL SUMMARY

✅ Unilevel is **depth-based**, not pair-based  
✅ Pays on **actual business** (BV)  
✅ Can be **instant or batched**  
✅ Fits **100% into your current architecture**  
✅ **No extra tables required**  
✅ **Easier than binary**, powerful for sales

---

### Unilevel Implementation Checklist

- [ ] Enable unilevel in `config/mlm.php`
- [ ] Create `UnilevelCommissionService`
- [ ] Add commission calculation on purchase events
- [ ] Implement upline traversal logic
- [ ] Add level depth limiting
- [ ] Test with multiple upline levels
- [ ] Create unilevel-specific reports
- [ ] Add unilevel genealogy visualization
- [ ] Implement rank-based eligibility (optional)
- [ ] Add commission approval workflow

---