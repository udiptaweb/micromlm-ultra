{{-- Dedicated SEO page: free MLM plan calculator / profit simulator --}}
@extends('layouts.website')

@section('title', 'Free MLM Plan Calculator & Profit Simulator (India)')

@section('meta_description', 'Free MLM plan calculator: simulate Binary, Unilevel, Matrix, Monoline and Board plans, check payout % of BV, profit and break-even, and get profitable settings.')

@section('meta_keywords', 'MLM plan calculator, MLM compensation plan calculator, binary plan calculator, binary MLM calculator, unilevel plan calculator, matrix plan calculator, MLM payout calculator, MLM profit calculator, MLM business plan India, MLM income calculator, pair income calculator, MLM capping calculator')

@section('og_title', 'Free MLM Plan Calculator & Profit Simulator for Indian Companies')

@section('og_description', 'Test Binary, Unilevel, Matrix, Monoline and Board plans before launch. See payouts, company profit and break-even month by month, then get a profitable configuration.')

@section('twitter_title', 'Free MLM Plan Calculator & Profit Simulator')

@section('twitter_description', 'Simulate any MLM compensation plan, stress-test it in every market situation and get profitable settings. Free, no sign-up.')

@php
    $theme = session('mlm_theme') ?? (request()->cookie('mlm_theme') ?? 'obsidian');
    $isLight = $theme === 'arctic';

    $faqs = [
        ['What is an MLM plan calculator?',
         'An MLM plan calculator estimates how much a compensation plan pays distributors and how much the company keeps. You enter the package price, BV, plan incomes such as pair, level or matrix income, and expected growth. It shows total payout, payout as a percentage of BV, company profit and the break-even month.'],
        ['How much payout is safe in an MLM plan?',
         'Plans that last usually keep total payout to distributors at around 30–45% of business volume (BV), with the rest covering product cost, logistics, GST-exclusive margins and operating costs. A payout above 50–55% of BV is a common warning sign. Use the advisor in the calculator to find the most generous payout that still meets your margin target.'],
        ['How is binary pair income calculated?',
         'In a binary plan a pair is formed when one member joins on the left leg and one on the right leg below you. Each matched pair pays a fixed amount, for example ₹160 on an ₹800 BV package. Income is paid on the weaker leg, and daily capping limits how many pairs one ID can be paid for. Unmatched or capped pairs are flushed.'],
        ['What is capping in a binary MLM plan?',
         'Capping is the maximum number of pairs, or rupees, one ID can earn per day or week. It protects the company when a few leaders build very large teams. Lower capping reduces payout, but if it is too low it discourages leaders, so the calculator shows how much each capping level changes your payout.'],
        ['Which MLM plan is most profitable for a new company in India?',
         'No single plan is always best. Binary plans grow fast but pay out more as the tree deepens. Unilevel and generation plans are easier to control and suit repurchase-based products. Matrix plans limit width and depth. Board and auto-pool plans carry legal risk. Use the plan comparison table in the calculator to compare all five on your own price, growth and costs.'],
        ['Is MLM legal in India?',
         'Direct selling is legal in India when income comes from genuine sale of products, as set out in the Consumer Protection (Direct Selling) Rules, 2021. Schemes that mainly pay for recruiting, or that pay out of new joining money, can be treated as money circulation under the Prize Chits and Money Circulation Schemes (Banning) Act, 1978. Take advice from a lawyer and a chartered accountant before launch.'],
        ['Does the calculator include GST and TDS?',
         'Yes. Prices are entered excluding GST, and GST is shown separately because it is collected for the government. TDS on commission is deducted from member earnings and deposited, so it is not a saving for the company. The admin charge is deducted from payouts and kept by the company. Confirm current GST and TDS rates with your CA.'],
        ['Is this MLM calculator free?',
         'Yes. The calculator is free to use, needs no sign-up, and runs entirely in your browser. Nothing you enter is sent to our servers.'],
    ];

    $schemas = [
        [
            '@context' => 'https://schema.org',
            '@type' => 'WebApplication',
            'name' => 'MLM Plan Calculator & Profit Simulator',
            'url' => route('website.plan-calculator'),
            'applicationCategory' => 'BusinessApplication',
            'operatingSystem' => 'Any (web browser)',
            'browserRequirements' => 'Requires JavaScript',
            'isAccessibleForFree' => true,
            'inLanguage' => 'en-IN',
            'description' => 'Free calculator to simulate Binary, Unilevel, Matrix, Monoline and Board MLM compensation plans, estimate payouts, company profit and break-even, and find profitable settings.',
            'featureList' => [
                'Binary, Unilevel, Matrix, Monoline and Board / Auto-pool plans',
                'Industry-standard presets for Indian direct-selling companies',
                'Payout % of BV, company margin and break-even month',
                'Market situations: steady, fast launch, slow, plateau, boom and slowdown, decline',
                'Profitability advisor with recommended configuration',
                'Plan type comparison',
            ],
            'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'INR'],
            'provider' => ['@type' => 'Organization', 'name' => config('app.name', 'MICRO MLM'), 'url' => url('/')],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'BreadcrumbList',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'MLM Plan Calculator', 'item' => route('website.plan-calculator')],
            ],
        ],
        [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(fn ($f) => [
                '@type' => 'Question',
                'name' => $f[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => $f[1]],
            ], $faqs),
        ],
    ];
@endphp

@push('schema')
@foreach($schemas as $schema)
<script type="application/ld+json">
{!! json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
@endforeach
@endpush

@push('styles')
<style>
    .calc-hero { position: relative; z-index: 1; padding: 7.5rem 1rem 0; text-align: center; }
    .calc-crumbs { font-size: 0.78rem; color: var(--textMuted); margin-bottom: 1.25rem; }
    .calc-crumbs a { color: var(--textMuted); text-decoration: none; }
    .calc-crumbs a:hover { color: var(--accentLight); }
    .calc-hero h1 {
        font-family: var(--heroFont); font-weight: var(--heroWeight);
        font-size: clamp(2rem, 6vw, 3.8rem); line-height: 1.1; letter-spacing: -0.02em;
        max-width: 900px; margin: 0 auto 1rem;
    }
    .calc-hero h1 em { font-style: italic; color: var(--accent); }
    .calc-hero .calc-sub { color: var(--textMuted); max-width: 760px; margin: 0 auto; line-height: 1.75; }
    .calc-points { display: flex; flex-wrap: wrap; justify-content: center; gap: 0.5rem 1.25rem; margin: 1.25rem auto 0; font-size: 0.82rem; color: var(--textMuted); list-style: none; }
    .calc-points li::before { content: '✓'; color: var(--accent); margin-right: 0.4rem; }
    .calc-tool { position: relative; z-index: 1; padding: 0 1rem; }
    .calc-tool .ps { margin-top: 2.5rem; }

    .calc-content { position: relative; z-index: 1; max-width: 960px; margin: 0 auto; padding: 4rem 1.25rem 2rem; line-height: 1.8; }
    .calc-content h2 { font-family: var(--heroFont); font-weight: var(--heroWeight); font-size: clamp(1.5rem, 4vw, 2.1rem); line-height: 1.2; margin: 3rem 0 1rem; }
    .calc-content h2:first-child { margin-top: 0; }
    .calc-content h3 { font-size: 1.1rem; font-weight: 600; margin: 1.5rem 0 0.4rem; }
    .calc-content p, .calc-content li { color: var(--textMuted); font-size: 0.95rem; }
    .calc-content p { margin-bottom: 0.9rem; }
    .calc-content a { color: var(--accentLight); }
    .calc-content ol, .calc-content ul { margin: 0 0 1rem 1.25rem; display: grid; gap: 0.35rem; }
    .calc-content strong { color: var(--text); font-weight: 600; }
    .calc-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1rem; margin-top: 1rem; }
    .calc-card { background: var(--bg2); border: 1px solid var(--borderSoft); border-radius: 12px; padding: 1.25rem; }
    .calc-card h3 { margin-top: 0; }
    .calc-card p { font-size: 0.88rem; margin-bottom: 0.5rem; }
    .calc-table-wrap { overflow-x: auto; margin: 1rem 0; border: 1px solid var(--borderSoft); border-radius: 12px; }
    .calc-table { width: 100%; border-collapse: collapse; font-size: 0.88rem; }
    .calc-table th, .calc-table td { padding: 0.7rem 0.9rem; text-align: left; border-bottom: 1px solid var(--borderSoft); vertical-align: top; }
    .calc-table th { background: var(--bg2); color: var(--text); font-weight: 600; white-space: nowrap; }
    .calc-table td { color: var(--textMuted); }
    .calc-table tr:last-child td { border-bottom: 0; }
    .calc-faq details { background: var(--bg2); border: 1px solid var(--borderSoft); border-radius: 10px; padding: 0 1.1rem; margin-bottom: 0.6rem; }
    .calc-faq summary { cursor: pointer; padding: 1rem 0; font-weight: 600; color: var(--text); font-size: 0.97rem; }
    .calc-faq details p { padding-bottom: 1rem; margin: 0; }
    .calc-cta { text-align: center; background: var(--bg2); border: 1px solid var(--border); border-radius: 16px; padding: 2.5rem 1.25rem; margin-top: 3rem; }
    .calc-cta p { max-width: 620px; margin: 0 auto 1.5rem; }
    .calc-cta-actions { display: flex; flex-wrap: wrap; gap: 0.75rem; justify-content: center; }
</style>
@endpush

@section('content')
    <header class="calc-hero">
        <nav class="calc-crumbs" aria-label="Breadcrumb">
            <a href="{{ url('/') }}">Home</a> <span aria-hidden="true">›</span> <span aria-current="page">MLM Plan Calculator</span>
        </nav>
        <h1>MLM Plan Calculator &amp; <em>Profit Simulator</em></h1>
        <p class="calc-sub">Plan your Binary, Unilevel, Matrix, Monoline or Board compensation plan before you launch. See distributor payouts, company profit and break-even month by month, test every market situation, and let the advisor suggest a profitable configuration for your Indian direct-selling business.</p>
        <ul class="calc-points">
            <li>Free, no sign-up</li>
            <li>5 plan types</li>
            <li>Indian industry presets</li>
            <li>GST, TDS &amp; admin charge</li>
            <li>Runs in your browser</li>
        </ul>
    </header>

    <div class="calc-tool">
        @include('partials.plan-simulator', ['isLight' => $isLight, 'withHead' => false])
    </div>

    <article class="calc-content">
        <h2>How to use the MLM plan calculator</h2>
        <ol>
            <li><strong>Choose a plan type</strong>: Binary, Unilevel / Level, Forced matrix, Monoline or Board / Auto-pool.</li>
            <li><strong>Load an industry-standard setup</strong>, such as a classic 1:1 binary on a ₹1,000 kit or a 10-level income plan, then change the package price, BV and product cost to match your products.</li>
            <li><strong>Set the plan incomes</strong>: pair income and daily capping, level percentages, matrix level income, direct (sponsor) income, repurchase income, rewards and royalty funds.</li>
            <li><strong>Pick a market situation</strong> and a period of 12 to 60 months to see how joinings, repurchase and payouts change over time.</li>
            <li><strong>Set your limits</strong> for maximum payout (% of BV) and minimum company margin. The profitability advisor recommends the most rewarding plan that still meets them, and lists one-step fixes you can apply with a click.</li>
        </ol>

        <h2>What the calculator tells you</h2>
        <div class="calc-cards">
            <div class="calc-card"><h3>Payout as % of BV</h3><p>The total of every income you pay distributors (direct, pair, level, matrix, repurchase, rewards and royalty) as a share of business volume. This is the first number investors, auditors and experienced leaders look at.</p></div>
            <div class="calc-card"><h3>Company profit and margin</h3><p>Net sales minus product cost, logistics and payment charges, fixed operating costs and payouts after the admin charge. GST is kept separate because it belongs to the government.</p></div>
            <div class="calc-card"><h3>Break-even month</h3><p>The month in which cumulative profit turns positive, so you know how much working capital you need before the plan pays for itself.</p></div>
            <div class="calc-card"><h3>Stress test</h3><p>The same plan under steady growth, a fast launch, slow growth, a plateau, a boom followed by a slowdown, and falling joinings, because every MLM company goes through more than one of these.</p></div>
        </div>

        <h2>MLM compensation plans explained</h2>
        <h3>Binary plan calculator</h3>
        <p>Every member has two legs, left and right. Income comes from matching volume on both legs (pair income), usually 1:1, sometimes 2:1 or 1:2 for the first pair. Daily capping limits pairs per ID, and unmatched volume is flushed or carried forward. Binary plans grow quickly, but the number of uplines paid on each joining increases as the tree gets deeper, so payout rises with growth. Read more about the <a href="{{ route('website.binary-plan') }}">binary MLM plan</a>.</p>
        <h3>Unilevel and level income plan calculator</h3>
        <p>Members can sponsor without limit on their first level, and commissions are paid on a fixed number of levels, for example 10 levels at 5%, 3%, 2% and 1%. Payout is capped by the sum of the level percentages, which makes unilevel and generation plans easy to control and popular for repurchase-based FMCG, wellness and Ayurveda products. Read more about the <a href="{{ route('website.unilevel-plan') }}">unilevel MLM plan</a>.</p>
        <h3>Matrix plan calculator</h3>
        <p>A forced matrix such as 3×7 or 2×10 fixes the width and depth of every team. Extra members spill over to the downline, and income is paid per member on each level, sometimes with a completion bonus when the whole matrix fills. Read more about the <a href="{{ route('website.matrix-plan') }}">matrix MLM plan</a>.</p>
        <h3>Monoline (single leg) plan</h3>
        <p>Everyone joins in one line in order of joining. Each new member pays a small fixed amount to a set number of members above. It is simple to explain, but payout per joining grows until the member limit is reached.</p>
        <h3>Board and auto-pool plans</h3>
        <p>Members enter a global board that completes and pays the top position once enough entries arrive, often with an automatic re-entry. Because these plans pay out of new entries, they carry the highest legal risk in India. The calculator shows the numbers, but use such a plan only with real products and legal advice.</p>

        <h2>Typical settings in the Indian market</h2>
        <p>These ranges are common starting points for small and medium direct-selling companies. They are not rules, so run your own numbers in the calculator above.</p>
        <div class="calc-table-wrap">
            <table class="calc-table">
                <thead><tr><th scope="col">Setting</th><th scope="col">Typical range</th><th scope="col">Why it matters</th></tr></thead>
                <tbody>
                    <tr><td>Total payout</td><td>30–45% of BV</td><td>Above 50–55% leaves little for product, logistics and operations.</td></tr>
                    <tr><td>Direct / sponsor income</td><td>5–15% of joining BV</td><td>Rewards personal selling; too high turns the plan into a recruiting scheme.</td></tr>
                    <tr><td>Binary pair income</td><td>8–12% of the pair's BV</td><td>The main cost driver in a binary plan, together with capping.</td></tr>
                    <tr><td>Binary daily capping</td><td>3–20 pairs per ID</td><td>Protects the company from very large legs.</td></tr>
                    <tr><td>Level income (all levels)</td><td>10–30% of BV</td><td>Spread across 5–15 levels, with more on the first levels.</td></tr>
                    <tr><td>Repurchase income</td><td>15–30% of repurchase BV</td><td>Builds monthly residual income from real product use.</td></tr>
                    <tr><td>Rewards and royalty funds</td><td>2–6% of BV</td><td>Cars, trips and leadership pools for top ranks.</td></tr>
                    <tr><td>Admin charge</td><td>5–10% of earnings</td><td>Kept by the company to cover processing costs.</td></tr>
                    <tr><td>Product cost</td><td>20–40% of selling price</td><td>Products must be fairly priced against the market.</td></tr>
                </tbody>
            </table>
        </div>

        <h2>Key terms</h2>
        <ul>
            <li><strong>BV (business volume)</strong>: the commissionable value assigned to a product. It is often lower than the price.</li>
            <li><strong>Pair / matching</strong>: one unit of volume from the left leg matched with one from the right leg in a binary plan.</li>
            <li><strong>Capping and flush</strong>: the maximum an ID can be paid per day; volume above it is flushed.</li>
            <li><strong>Active / qualified ID</strong>: a member who meets the purchase rule for the month. Income for inactive IDs lapses to the company.</li>
            <li><strong>Repurchase</strong>: monthly product orders by existing members, the base of a sustainable business.</li>
            <li><strong>Break-even</strong>: the month in which cumulative profit becomes positive.</li>
        </ul>

        <h2>Frequently asked questions</h2>
        <div class="calc-faq">
            @foreach($faqs as [$q, $a])
                <details @if($loop->first) open @endif>
                    <summary>{{ $q }}</summary>
                    <p>{{ $a }}</p>
                </details>
            @endforeach
        </div>
        <p style="margin-top:1rem">Also read <a href="{{ route('website.blog.legality-of-mlm-in-india') }}">Is MLM legal in India?</a> and <a href="{{ route('website.blog.how-to-select-best-mlm-software') }}">How to select the best MLM software</a>.</p>

        <div class="calc-cta">
            <h2 style="margin-top:0">Turn your plan into working MLM software</h2>
            <p>We build Binary, Unilevel, Matrix and custom MLM software with your exact compensation plan, e-pins, wallets, payouts, GST and TDS reports.</p>
            <div class="calc-cta-actions">
                <a href="{{ route('website.contact') }}" class="btn-primary">Get a free consultation</a>
                <a href="{{ route('website.pricing') }}" class="btn-ghost">See pricing</a>
                <a href="tel:9101177123" class="btn-ghost">Call 9101177123</a>
            </div>
        </div>
    </article>
@endsection
