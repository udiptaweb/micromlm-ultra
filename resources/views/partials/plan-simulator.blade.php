{{--
    MLM Plan Profit Simulator (client-side; logic in public/js/plan-simulator.js).
    Options: $isLight (chart colours for light themes), $withHead (show the built-in heading;
    turn off when the page has its own H1), $atTop (spacing when placed first), $fullPageLink (link to the dedicated page).
--}}
@php
    $isLight = $isLight ?? false;
    $withHead = $withHead ?? true;
    $atTop = $atTop ?? false;
    $fullPageLink = $fullPageLink ?? false;
    $simJs = public_path('js/plan-simulator.js');
@endphp

@push('styles')
<style>
    .ps {
        --ps-s1: {{ $isLight ? '#2a78d6' : '#3987e5' }};
        --ps-s2: {{ $isLight ? '#eb6834' : '#d95926' }};
        --ps-s3: {{ $isLight ? '#1baf7a' : '#199e70' }};
        --ps-good: #0ca30c;
        --ps-warning: {{ $isLight ? '#b87700' : '#fab219' }};
        --ps-critical: {{ $isLight ? '#d03b3b' : '#e66767' }};
        width: 100%;
        max-width: 1200px;
        margin: 4.5rem auto 0;
        text-align: left;
        color: var(--text);
        font-size: 0.9rem;
        line-height: 1.5;
        scroll-margin-top: 80px;
    }
    .ps.ps-at-top { margin: 0 auto 4.5rem; }
    .ps *, .ps *::before, .ps *::after { box-sizing: border-box; }
    .ps-head { text-align: center; margin-bottom: 1.75rem; }
    .ps-eyebrow {
        display: inline-flex; align-items: center; gap: 0.5rem;
        padding: 0.3rem 0.9rem; border: 1px solid var(--border); border-radius: 100px;
        background: var(--accentDim); color: var(--accentLight);
        font-size: 0.7rem; letter-spacing: 0.16em; text-transform: uppercase; margin-bottom: 1rem;
    }
    .ps-title {
        font-family: var(--heroFont); font-weight: var(--heroWeight);
        font-size: clamp(1.6rem, 4.5vw, 2.6rem); line-height: 1.15; margin-bottom: 0.75rem;
    }
    .ps-title em { font-style: italic; color: var(--accent); }
    .ps-lead { color: var(--textMuted); max-width: 720px; margin: 0 auto; }

    .ps-tabs { display: grid; grid-template-columns: repeat(5, minmax(0, 1fr)); gap: 0.5rem; margin-bottom: 0.9rem; }
    .ps-tab {
        display: flex; flex-direction: column; gap: 0.15rem; text-align: left;
        padding: 0.7rem 0.85rem; border-radius: 10px; cursor: pointer;
        background: var(--bg2); border: 1px solid var(--borderSoft); color: var(--text);
        font: inherit; transition: border-color .2s, background .2s;
    }
    .ps-tab span { font-weight: 600; font-size: 0.88rem; }
    .ps-tab small { color: var(--textMuted); font-size: 0.72rem; line-height: 1.3; }
    .ps-tab:hover { border-color: var(--border); }
    .ps-tab[aria-selected="true"] { border-color: var(--accent); background: var(--accentDim); }
    @media (max-width: 900px) {
        .ps-tabs { grid-template-columns: none; grid-auto-flow: column; grid-auto-columns: minmax(150px, 1fr); overflow-x: auto; padding-bottom: 4px; }
    }

    .ps-bar {
        display: flex; flex-wrap: wrap; gap: 0.75rem; align-items: flex-end;
        padding: 0.9rem; margin-bottom: 1rem; border-radius: 12px;
        background: var(--bg2); border: 1px solid var(--borderSoft);
    }
    .ps-bar label { display: flex; flex-direction: column; gap: 0.3rem; font-size: 0.75rem; color: var(--textMuted); flex: 1 1 220px; }
    .ps-bar label.ps-narrow { flex: 0 1 140px; }

    .ps select, .ps input {
        width: 100%; font: inherit; font-size: 0.86rem; color: var(--text);
        background: var(--bg); border: 1px solid var(--border); border-radius: 7px;
        padding: 0.45rem 0.6rem; min-height: 38px;
    }
    .ps select option { background: var(--bg2); color: var(--text); }
    .ps input:focus, .ps select:focus, .ps button:focus-visible, .ps summary:focus-visible { outline: 2px solid var(--accent); outline-offset: 1px; }
    .ps input.ps-invalid { border-color: var(--ps-critical); }
    .ps-btn {
        font: inherit; font-size: 0.82rem; cursor: pointer; padding: 0.5rem 0.95rem; min-height: 38px;
        border-radius: 7px; border: 1px solid var(--border); background: transparent; color: var(--textMuted);
    }
    .ps-btn:hover { color: var(--text); border-color: var(--accentLight); }

    .ps-grid { display: grid; grid-template-columns: minmax(260px, 340px) minmax(0, 1fr); gap: 1rem; align-items: start; }
    @media (max-width: 900px) { .ps-grid { grid-template-columns: minmax(0, 1fr); } }
    .ps-panel { background: var(--bg2); border: 1px solid var(--borderSoft); border-radius: 12px; padding: 1.1rem; min-width: 0; }
    .ps-panel h3 { font-size: 1rem; font-weight: 600; margin-bottom: 0.2rem; }
    .ps-panel > .ps-small:first-of-type { margin-bottom: 0.8rem; }
    .ps-small { font-size: 0.78rem; color: var(--textMuted); }
    .ps-results { display: flex; flex-direction: column; gap: 1rem; min-width: 0; }

    .ps-settings { padding: 0.4rem 1.1rem; }
    @media (min-width: 901px) { .ps-settings { position: sticky; top: 84px; max-height: calc(100vh - 100px); overflow-y: auto; } }
    .ps-settings details { border-bottom: 1px solid var(--borderSoft); }
    .ps-settings details:last-child { border-bottom: 0; }
    .ps-settings summary { cursor: pointer; padding: 0.8rem 0; font-weight: 600; font-size: 0.88rem; list-style: none; display: flex; justify-content: space-between; }
    .ps-settings summary::-webkit-details-marker { display: none; }
    .ps-settings summary::after { content: '+'; color: var(--textMuted); }
    .ps-settings details[open] summary::after { content: '−'; }
    .ps-fields { display: grid; gap: 0.8rem; padding-bottom: 1rem; }
    .ps-field label { display: block; font-size: 0.78rem; color: var(--textMuted); margin-bottom: 0.25rem; }
    .ps-field small { display: block; font-size: 0.72rem; color: var(--textMuted); opacity: .85; margin-top: 0.25rem; }
    .ps-err { display: block; font-style: normal; font-size: 0.74rem; color: var(--ps-critical); margin-top: 0.25rem; }

    .ps-verdict { border-left: 4px solid var(--ps-warning); }
    .ps-v-good { border-left-color: var(--ps-good); }
    .ps-v-critical { border-left-color: var(--ps-critical); }
    .ps-verdict-head { display: flex; flex-wrap: wrap; gap: 0.5rem 1rem; align-items: center; margin-bottom: 0.6rem; }
    .ps-verdict-sub { font-size: 0.76rem; color: var(--textMuted); }
    .ps-verdict ul { list-style: none; display: grid; gap: 0.4rem; }
    .ps-verdict li { display: flex; gap: 0.5rem; align-items: flex-start; font-size: 0.82rem; color: var(--textMuted); }
    .ps-verdict li svg { flex: none; margin-top: 2px; }
    .ps-note-good svg { color: var(--ps-good); }
    .ps-note-warning svg { color: var(--ps-warning); }
    .ps-note-critical svg { color: var(--ps-critical); }
    .ps-status { display: inline-flex; align-items: center; gap: 0.35rem; font-weight: 600; font-size: 0.82rem; color: var(--text); white-space: nowrap; }
    .ps-status.ps-good svg { color: var(--ps-good); }
    .ps-status.ps-warning svg { color: var(--ps-warning); }
    .ps-status.ps-critical svg { color: var(--ps-critical); }
    .ps-verdict-head .ps-status { font-size: 0.98rem; }

    .ps-kpis { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 0.75rem; }
    .ps-kpi { background: var(--bg2); border: 1px solid var(--borderSoft); border-radius: 12px; padding: 0.9rem 1rem; display: flex; flex-direction: column; gap: 0.2rem; min-width: 0; }
    .ps-kpi span { font-size: 0.72rem; color: var(--textMuted); text-transform: uppercase; letter-spacing: 0.06em; }
    .ps-kpi strong { font-family: var(--heroFont); font-weight: var(--heroWeight); font-size: 1.45rem; line-height: 1.15; color: var(--text); }
    .ps-kpi small { font-size: 0.74rem; color: var(--textMuted); }

    .ps-legend { display: flex; flex-wrap: wrap; gap: 0.4rem 1rem; margin: 0.5rem 0; font-size: 0.78rem; color: var(--textMuted); }
    .ps-legend span { display: inline-flex; align-items: center; gap: 0.4rem; }
    .ps-legend i { width: 14px; height: 2px; border-radius: 2px; display: inline-block; }
    .ps-chart { position: relative; width: 100%; min-height: 280px; touch-action: pan-y; }
    .ps-chart svg { display: block; overflow: visible; }
    .ps-axis { font-size: 11px; fill: var(--textMuted); font-family: var(--bodyFont); }
    .ps-dlabel { font-size: 11.5px; fill: var(--text); font-family: var(--bodyFont); }
    .ps-tip {
        position: absolute; z-index: 3; pointer-events: none; min-width: 190px;
        background: var(--bg); border: 1px solid var(--border); border-radius: 8px; padding: 0.55rem 0.7rem;
        box-shadow: 0 10px 30px rgba(0,0,0,.25); font-size: 0.76rem; display: flex; flex-direction: column; gap: 0.2rem;
    }
    .ps-tip[hidden] { display: none; }
    .ps-tip-sub { color: var(--textMuted); margin-bottom: 0.2rem; }
    .ps-tip-row { display: flex; align-items: center; gap: 0.45rem; color: var(--textMuted); }
    .ps-tip-row i { width: 10px; height: 10px; border-radius: 3px; flex: none; }
    .ps-tip-row i.ps-tip-none { background: transparent; }
    .ps-tip-row b { margin-left: auto; padding-left: 0.75rem; color: var(--text); font-weight: 600; }

    .ps-panel details > summary { cursor: pointer; font-size: 0.8rem; color: var(--accentLight); margin-top: 0.6rem; }
    .ps-table-wrap { position: relative; overflow-x: auto; margin-top: 0.6rem; }
    .ps-table { width: 100%; border-collapse: collapse; font-size: 0.78rem; font-variant-numeric: tabular-nums; }
    .ps-table th { text-align: left; font-weight: 600; color: var(--textMuted); padding: 0.45rem 0.6rem; border-bottom: 1px solid var(--border); white-space: nowrap; }
    .ps-table td { padding: 0.45rem 0.6rem; border-bottom: 1px solid var(--borderSoft); white-space: nowrap; }
    .ps-table td small { color: var(--textMuted); }
    .ps-table td:first-child { white-space: normal; min-width: 150px; }
    .ps-table tr.ps-current td { background: var(--accentDim); }
    .ps-neg { color: var(--ps-critical); }
    .ps-link { font: inherit; background: none; border: 0; padding: 0; color: var(--accentLight); cursor: pointer; text-align: left; text-decoration: underline; text-underline-offset: 3px; }
    .ps-sr { position: absolute; width: 1px; height: 1px; overflow: hidden; clip: rect(0 0 0 0); }

    .ps-bar-row { display: grid; grid-template-columns: minmax(120px, 190px) minmax(0, 1fr) auto; gap: 0.75rem; align-items: center; padding: 0.35rem 0; }
    .ps-bar-label { font-size: 0.8rem; color: var(--textMuted); }
    .ps-bar-track { height: 14px; }
    .ps-bar-fill { display: block; height: 100%; min-width: 2px; background: var(--ps-s2); border-radius: 0 4px 4px 0; }
    .ps-bar-val { font-size: 0.8rem; font-variant-numeric: tabular-nums; text-align: right; }
    .ps-bar-val small { color: var(--textMuted); display: block; font-size: 0.7rem; }
    .ps-breakdown-note { margin-top: 0.6rem; }
    @media (max-width: 560px) { .ps-bar-row { grid-template-columns: minmax(0, 1fr) auto; } .ps-bar-track { grid-column: 1 / -1; order: 3; } }

    .ps-advisor { margin-top: 1rem; }
    .ps-adv-head { display: flex; flex-wrap: wrap; gap: 0.75rem 1.5rem; justify-content: space-between; align-items: flex-end; margin-bottom: 0.9rem; }
    .ps-targets { display: flex; gap: 0.75rem; flex-wrap: wrap; }
    .ps-targets label { display: flex; flex-direction: column; gap: 0.25rem; font-size: 0.74rem; color: var(--textMuted); width: 170px; }
    .ps-best { display: grid; grid-template-columns: minmax(0, 1fr) minmax(200px, 260px); gap: 1rem; padding: 1rem; border-radius: 10px; background: var(--accentDim); border: 1px solid var(--border); }
    @media (max-width: 760px) { .ps-best { grid-template-columns: minmax(0, 1fr); } }
    .ps-best h4 { margin-bottom: 0.35rem; }
    .ps-best p { font-size: 0.82rem; color: var(--textMuted); }
    .ps-changes { list-style: none; margin-top: 0.6rem; display: grid; gap: 0.3rem; }
    .ps-changes li { display: flex; flex-wrap: wrap; gap: 0.4rem; font-size: 0.82rem; align-items: baseline; }
    .ps-changes li > span:first-child { color: var(--textMuted); min-width: 190px; }
    .ps-from { color: var(--textMuted); text-decoration: line-through; text-decoration-thickness: 1px; margin: 0 0.15rem 0 0.4rem; }
    .ps-best-res { display: flex; flex-direction: column; gap: 0.35rem; font-size: 0.82rem; }
    .ps-best-res small { color: var(--textMuted); margin-left: 0.3rem; }
    .ps-apply {
        font: inherit; font-size: 0.82rem; font-weight: 500; cursor: pointer; margin-top: 0.4rem;
        padding: 0.55rem 1rem; min-height: 38px; border-radius: 7px; border: 0; background: var(--accent); color: var(--bg);
    }
    .ps-apply:hover { opacity: .9; }
    .ps-apply-sm { margin-top: 0; padding: 0.4rem 0.85rem; min-height: 34px; }
    .ps-h4 { font-size: 0.9rem; font-weight: 600; margin: 1.1rem 0 0.25rem; }
    .ps-sugg { display: grid; gap: 0.5rem; margin-top: 0.6rem; }
    .ps-sugg-row { display: grid; grid-template-columns: minmax(0, 1.2fr) minmax(0, 1fr) auto; gap: 0.75rem; align-items: center; padding: 0.6rem 0.75rem; border: 1px solid var(--borderSoft); border-radius: 8px; font-size: 0.84rem; }
    .ps-sugg-row b:first-child { margin-right: 0.2rem; }
    @media (max-width: 700px) { .ps-sugg-row { grid-template-columns: minmax(0, 1fr) auto; } .ps-sugg-row .ps-small { grid-column: 1; } }

    .ps-two { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1rem; margin-top: 1rem; }
    @media (max-width: 1100px) { .ps-two { grid-template-columns: minmax(0, 1fr); } }
    .ps-foot { margin-top: 1.25rem; display: flex; flex-wrap: wrap; gap: 1rem; justify-content: space-between; align-items: center; }
    .ps-foot p { font-size: 0.75rem; color: var(--textMuted); max-width: 760px; }
    .ps-howto { margin-top: 1rem; }
    .ps-howto ul { margin: 0.6rem 0 0 1.1rem; display: grid; gap: 0.35rem; font-size: 0.8rem; color: var(--textMuted); }
</style>
@endpush

<section class="ps{{ $atTop ? ' ps-at-top' : '' }}" id="plan-simulator" @if($withHead) aria-labelledby="ps-title" @else aria-label="MLM plan calculator" @endif>
    @if($withHead)
    <div class="ps-head">
        <span class="ps-eyebrow">Free tool · MLM plan profit simulator</span>
        <h2 class="ps-title" id="ps-title">Test your compensation plan <em>before you launch</em></h2>
        <p class="ps-lead">Pick a plan type, load an industry-standard setup used by Indian direct-selling companies, change any setting, and see joinings, payouts and company profit month by month. The advisor then finds a configuration that stays profitable in every market situation.</p>
        @if($fullPageLink)
            <p class="ps-lead" style="margin-top:.6rem"><a href="{{ route('website.plan-calculator') }}" class="ps-link">Open the full-page MLM plan calculator and guide</a></p>
        @endif
    </div>
    @endif

    <div class="ps-tabs" role="tablist" aria-label="Plan type" data-ps="tabs"></div>

    <div class="ps-bar">
        <label>Industry-standard setup <select data-ps="preset"></select></label>
        <label>Market situation <select data-ps="scenario"></select></label>
        <label class="ps-narrow">Period
            <select data-ps="months">
                <option value="12">12 months</option>
                <option value="24">24 months</option>
                <option value="36">36 months</option>
                <option value="60">60 months</option>
            </select>
        </label>
        <button type="button" class="ps-btn" data-ps="reset">Reset setup</button>
    </div>

    <noscript><p class="ps-panel">Turn on JavaScript to use the plan simulator.</p></noscript>

    <div class="ps-grid">
        <form class="ps-panel ps-settings" data-ps="fields" onsubmit="return false" aria-label="Plan settings"></form>

        <div class="ps-results" aria-live="polite">
            <div class="ps-panel ps-verdict" data-ps="verdict"></div>
            <div class="ps-kpis" data-ps="kpis"></div>
            <div class="ps-panel">
                <h3>Month by month</h3>
                <p class="ps-small">Net sales exclude GST. Payout cost is what the company pays after the admin charge.</p>
                <div class="ps-legend" aria-hidden="true">
                    <span><i style="background:var(--ps-s1)"></i>Net sales</span>
                    <span><i style="background:var(--ps-s2)"></i>Payout cost</span>
                    <span><i style="background:var(--ps-s3)"></i>Profit</span>
                </div>
                <div class="ps-chart" data-ps="chart"></div>
                <details><summary>Show the monthly table</summary><div data-ps="table"></div></details>
            </div>
            <div class="ps-panel">
                <h3>Where the payout goes</h3>
                <p class="ps-small">Total over the period, and as a share of all BV.</p>
                <div data-ps="breakdown"></div>
            </div>
        </div>
    </div>

    <div class="ps-panel ps-advisor">
        <div class="ps-adv-head">
            <div>
                <h3>Profitability advisor</h3>
                <p class="ps-small">Set your limits. The advisor searches plan incomes, capping and levels for the most rewarding plan that still meets them.</p>
            </div>
            <div class="ps-targets">
                <label>Max total payout (% of BV) <input type="number" min="1" max="100" step="1" data-ps="tPayout"></label>
                <label>Min company margin (% of sales) <input type="number" min="-50" max="99" step="1" data-ps="tMargin"></label>
            </div>
        </div>
        <div data-ps="best"></div>
        <h4 class="ps-h4">One-step changes</h4>
        <div data-ps="suggest"></div>
    </div>

    <div class="ps-two">
        <div class="ps-panel">
            <h3>Every market situation</h3>
            <p class="ps-small">Your current setup under each growth pattern. Select one to view it.</p>
            <div data-ps="stress"></div>
        </div>
        <div class="ps-panel">
            <h3>Compare plan types</h3>
            <p class="ps-small">Each plan's standard setup on your package, growth and costs.</p>
            <div data-ps="compare"></div>
        </div>
    </div>

    <details class="ps-panel ps-howto">
        <summary>How the numbers are calculated</summary>
        <ul>
            <li>Prices exclude GST. GST is collected from buyers and passed to the government, so it is not company income.</li>
            <li>Joinings follow the market situation. Members who joined earlier repurchase from the following month.</li>
            <li>Profit = net sales − product cost − logistics − fixed costs − payouts. The admin charge is deducted from payouts and kept by the company. TDS is withheld from members and deposited, so it saves the company nothing.</li>
            <li>Binary: new members spread across the tree and every upline earns on the weaker leg. Pairs per ID are capped per day. Leg balance accounts for uneven teams and carry-forward that never matches.</li>
            <li>Unilevel and matrix: the tree deepens as members recruit (average directs, or the matrix width). A level pays only once the tree is that deep, and only to active IDs.</li>
            <li>Monoline: each new member pays the set amount to the members above, up to the limit.</li>
            <li>Board / auto-pool: a global board completes one top position every width<sup>levels</sup> entries (one fewer with re-entry). The re-entry fee is taken from the payout.</li>
            <li>Rewards and royalty pools are assumed to be paid in full. This is a planning model, not a guarantee, and not legal or tax advice.</li>
        </ul>
    </details>

    <div class="ps-foot">
        <p>Figures are estimates from a simplified model of network growth. Check your final plan with a chartered accountant and a lawyer familiar with the Consumer Protection (Direct Selling) Rules, 2021.</p>
        <a href="{{ route('website.contact') }}" class="btn-primary">Build this plan with us</a>
    </div>
</section>

@push('scripts')
<script src="{{ asset('js/plan-simulator.js') }}?v={{ file_exists($simJs) ? filemtime($simJs) : '1' }}" defer></script>
@endpush
