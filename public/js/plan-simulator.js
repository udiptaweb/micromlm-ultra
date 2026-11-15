/*
 * MLM Plan Profit Simulator
 * A client-side scenario planner for Binary, Unilevel, Matrix, Monoline and Board plans.
 * The engine (simulate / assess / advise / bestConfig) is pure and also runs under Node for testing.
 * Monetary values are INR. Package and repurchase prices exclude GST.
 */
(function () {
    'use strict';

    /* ───────────────────────── helpers ───────────────────────── */
    const clamp = (v, a, b) => Math.min(b, Math.max(a, v));
    const sum = (a) => a.reduce((x, y) => x + y, 0);
    const round = (v, step) => Math.round(v / step) * step;
    const nf0 = new Intl.NumberFormat('en-IN', { maximumFractionDigits: 0 });
    const nf2 = new Intl.NumberFormat('en-IN', { maximumFractionDigits: 2 });
    const inr = (v) => (v < 0 ? '−₹' : '₹') + nf0.format(Math.abs(Math.round(v)));
    const inrc = (v) => {
        const a = Math.abs(v), sg = v < 0 ? '−' : '';
        if (a >= 1e7) return sg + '₹' + (a / 1e7).toFixed(a >= 1e9 ? 0 : 2).replace(/\.00$/, '') + ' Cr';
        if (a >= 1e5) return sg + '₹' + (a / 1e5).toFixed(a >= 1e7 ? 0 : 1).replace(/\.0$/, '') + ' L';
        if (a >= 1e3) return sg + '₹' + (a / 1e3).toFixed(a >= 1e4 ? 0 : 1).replace(/\.0$/, '') + 'K';
        return sg + '₹' + Math.round(a);
    };
    const pct = (v, d = 1) => (Number.isFinite(v) ? v.toFixed(d).replace(/^-/, '−') : '—') + '%';
    const num = (v) => nf0.format(Math.round(v));
    const esc = (s) => String(s).replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));

    /** Sum of the first `up` levels, the last one counted fractionally (tree depth grows smoothly). */
    function sumFrac(list, up) {
        let s = 0;
        const f = Math.floor(up);
        for (let i = 0; i < list.length && i < f; i++) s += list[i];
        if (f < list.length && up > f) s += list[f] * (up - f);
        return s;
    }

    /** Average number of uplines above a newly placed member in a tree of N members where each has w children. */
    function uplines(N, w) {
        if (N <= 1) return 0;
        return Math.max(0, Math.log(N * (w - 1) + 1) / Math.log(w) - 1);
    }

    /* ───────────────────────── plan catalogue ───────────────────────── */
    const PLANS = {
        binary: { label: 'Binary', blurb: 'Two legs, pair matching with daily capping' },
        unilevel: { label: 'Unilevel / Level', blurb: 'Unlimited width, income on fixed levels' },
        matrix: { label: 'Forced matrix', blurb: 'Fixed width × depth, spill-over placement' },
        monoline: { label: 'Monoline', blurb: 'Single leg, everyone in one line' },
        board: { label: 'Board / Auto-pool', blurb: 'Global board that cycles and pays out', risk: true },
    };

    const SCENARIOS = {
        steady: { label: 'Steady growth (+10% a month)', g: () => 1.10 },
        fast: { label: 'Fast launch (+30% for 6 months, then +8%)', g: (t) => (t <= 6 ? 1.30 : 1.08) },
        slow: { label: 'Slow & realistic (+4% a month)', g: () => 1.04 },
        plateau: { label: 'Grow, then plateau (+20% to month 6, then flat)', g: (t) => (t <= 6 ? 1.20 : 1.0) },
        boom: { label: 'Boom, then slowdown (+35% for 5 months, then −15%)', g: (t) => (t <= 5 ? 1.35 : 0.85) },
        decline: { label: 'Falling joinings (−5% a month)', g: () => 0.95 },
        custom: { label: 'Custom growth rate', g: (t, s) => 1 + s.growthPct / 100 },
    };

    /** Common settings for a small-to-medium Indian direct-selling company. */
    const BASE = {
        plan: 'binary', scenario: 'steady', months: 24,
        price: 1000, bv: 800, gst: 18, costPct: 30,
        directPct: 10, repIncomePct: 20, rewardPct: 3, royaltyPct: 2,
        startJoins: 100, growthPct: 10, activePct: 60, repPct: 30, repPrice: 500, repBv: 400,
        adminPct: 5, tdsPct: 2, varPct: 5, opex: 150000,
        pairIncome: 160, capPairs: 10, ratio: '1:1', balancePct: 50,
        levels: [5, 3, 2, 1, 1, 1, 1, 0.5, 0.5, 0.5], width: 4,
        mWidth: 3, mAmounts: [80, 40, 30, 20, 20, 20, 20], mBonus: 0,
        monoPer: 1, monoLimit: 300,
        bWidth: 2, bDepth: 2, bPayout: 2500, bReentry: 'yes',
    };

    /** Industry-standard starting points seen in the Indian market. */
    const PRESETS = {
        binary: [
            { id: 'b1', name: 'Classic 1:1 binary · ₹1,000 kit', v: {} },
            { id: 'b2', name: 'Wellness binary · ₹2,500 kit, low capping', v: { price: 2500, bv: 2000, pairIncome: 300, capPairs: 5, directPct: 8, repPct: 35, repPrice: 800, repBv: 600, repIncomePct: 22, costPct: 28 } },
            { id: 'b3', name: 'Repurchase binary (FMCG) · ₹599 kit', v: { price: 599, bv: 500, gst: 12, pairIncome: 80, capPairs: 20, directPct: 10, repPct: 50, repPrice: 1000, repBv: 700, repIncomePct: 25, costPct: 40 } },
            { id: 'b4', name: 'Hybrid binary + level · ₹1,500 kit', v: { price: 1500, bv: 1200, pairIncome: 200, capPairs: 8, directPct: 8, repIncomePct: 28, repPct: 35, repPrice: 700, repBv: 500 } },
        ],
        unilevel: [
            { id: 'u1', name: '10-level income · ₹999 kit', v: { price: 999, bv: 800 } },
            { id: 'u2', name: 'Generation repurchase plan (FMCG)', v: { price: 599, bv: 500, gst: 12, levels: [4, 3, 2, 2, 1, 1], width: 5, repPct: 50, repPrice: 1200, repBv: 900, repIncomePct: 30, costPct: 40 } },
            { id: 'u3', name: 'Ayurveda / health · 15 levels', v: { price: 1500, bv: 1200, levels: [6, 4, 3, 2, 2, 1, 1, 1, 1, 1, 0.5, 0.5, 0.5, 0.5, 0.5], width: 3 } },
        ],
        matrix: [
            { id: 'm1', name: '3×7 forced matrix · ₹1,000 kit', v: { mWidth: 3, mAmounts: [80, 40, 30, 20, 20, 20, 20] } },
            { id: 'm2', name: '2×10 matrix · ₹1,000 kit', v: { mWidth: 2, mAmounts: [60, 40, 30, 20, 15, 15, 10, 10, 10, 10] } },
            { id: 'm3', name: '4×5 matrix with completion bonus · ₹1,500 kit', v: { price: 1500, bv: 1200, mWidth: 4, mAmounts: [60, 40, 30, 20, 20], mBonus: 25000 } },
        ],
        monoline: [
            { id: 'o1', name: 'Single leg · ₹1 per member, up to 300', v: {} },
            { id: 'o2', name: 'Single leg · ₹2 per member, up to 200 (₹1,500 kit)', v: { price: 1500, bv: 1200, monoPer: 2, monoLimit: 200 } },
        ],
        board: [
            { id: 'x1', name: '2×2 auto-pool · ₹1,000 entry', v: {} },
            { id: 'x2', name: '3×1 board, no re-entry', v: { bWidth: 3, bDepth: 1, bPayout: 1500, bReentry: 'no' } },
        ],
    };

    /* ───────────────────────── fields ───────────────────────── */
    const GROUPS = [
        { id: 'package', title: 'Package & product', open: true },
        { id: 'plan', title: 'Plan income', open: true },
        { id: 'growth', title: 'Growth & repurchase', open: true },
        { id: 'common', title: 'Other incomes', open: true },
        { id: 'costs', title: 'Costs & deductions', open: false },
    ];
    const F = (key, label, o) => Object.assign({ key, label, type: 'number', step: 1, min: 0, max: 1e9 }, o);
    const FIELDS = [
        F('price', 'Joining package price (₹, excl. GST)', { group: 'package', min: 50, max: 1e6, step: 50 }),
        F('bv', 'BV per package', { group: 'package', max: 1e6, step: 10, hint: 'Commissions are calculated on business volume.' }),
        F('gst', 'GST on products (%)', { group: 'package', max: 28 }),
        F('costPct', 'Product cost (% of sale price)', { group: 'package', max: 95, hint: 'Landed cost of the goods you ship.' }),

        F('pairIncome', 'Pair income (₹ per matched pair)', { group: 'plan', plans: ['binary'], step: 10, max: 1e5 }),
        F('capPairs', 'Daily capping (pairs per ID)', { group: 'plan', plans: ['binary'], min: 1, max: 500 }),
        F('ratio', 'Pair ratio', { group: 'plan', plans: ['binary'], type: 'select', options: [['1:1', '1:1'], ['2:1', '2:1 or 1:2 for the first pair']] }),
        F('balancePct', 'Leg balance (matching efficiency %)', { group: 'plan', plans: ['binary'], min: 5, max: 100, hint: 'How evenly teams grow on both legs. 40–60% is typical.' }),
        F('levels', 'Level income % (level 1, 2, 3 …)', { group: 'plan', plans: ['unilevel'], type: 'list', hint: 'Comma separated, % of joining BV.' }),
        F('width', 'Average direct recruits per member', { group: 'plan', plans: ['unilevel'], min: 2, max: 50 }),
        F('mWidth', 'Matrix width', { group: 'plan', plans: ['matrix'], type: 'select', options: [[2, '2 wide'], [3, '3 wide'], [4, '4 wide'], [5, '5 wide']] }),
        F('mAmounts', 'Level income ₹ per member (level 1, 2, 3 …)', { group: 'plan', plans: ['matrix'], type: 'list', hint: 'The number of values is the matrix depth.' }),
        F('mBonus', 'Matrix completion bonus (₹)', { group: 'plan', plans: ['matrix'], step: 500 }),
        F('monoPer', 'Income per member joining below (₹)', { group: 'plan', plans: ['monoline'], step: 0.5, max: 1e4 }),
        F('monoLimit', 'Paid for up to … members below', { group: 'plan', plans: ['monoline'], min: 1, step: 10, max: 1e6 }),
        F('bWidth', 'Board width', { group: 'plan', plans: ['board'], type: 'select', options: [[2, '2'], [3, '3'], [4, '4']] }),
        F('bDepth', 'Board levels below the top', { group: 'plan', plans: ['board'], type: 'select', options: [[1, '1'], [2, '2'], [3, '3']] }),
        F('bPayout', 'Payout per board completion (₹)', { group: 'plan', plans: ['board'], step: 100 }),
        F('bReentry', 'Auto re-entry from the payout', { group: 'plan', plans: ['board'], type: 'select', options: [['yes', 'Yes'], ['no', 'No']] }),

        F('startJoins', 'New joinings in month 1', { group: 'growth', min: 1, max: 1e7, step: 10 }),
        F('growthPct', 'Monthly growth (%)', { group: 'growth', min: -50, max: 200, show: (s) => s.scenario === 'custom' }),
        F('activePct', 'Active / qualified IDs (%)', { group: 'growth', min: 1, max: 100, hint: 'Inactive IDs earn no pair or level income; their share lapses.' }),
        F('repPct', 'Members repurchasing each month (%)', { group: 'growth', max: 100 }),
        F('repPrice', 'Monthly repurchase per member (₹, excl. GST)', { group: 'growth', step: 50 }),
        F('repBv', 'BV on that repurchase', { group: 'growth', step: 10 }),

        F('directPct', 'Direct / sponsor income (% of joining BV)', { group: 'common', max: 100, step: 0.5 }),
        F('repIncomePct', 'Repurchase income (% of repurchase BV)', { group: 'common', max: 100, step: 0.5, hint: 'All repurchase levels combined.' }),
        F('rewardPct', 'Rank & rewards fund (% of total BV)', { group: 'common', max: 50, step: 0.5 }),
        F('royaltyPct', 'Royalty / leadership pool (% of total BV)', { group: 'common', max: 50, step: 0.5 }),

        F('adminPct', 'Admin charge on payouts (%)', { group: 'costs', max: 30, step: 0.5, hint: 'Deducted from member earnings and kept by the company.' }),
        F('tdsPct', 'TDS on commission (%)', { group: 'costs', max: 30, step: 0.5, hint: 'Withheld under section 194H and deposited with the government. Confirm the current rate with your CA.' }),
        F('varPct', 'Logistics, gateway & packing (% of sales)', { group: 'costs', max: 50, step: 0.5 }),
        F('opex', 'Fixed operating cost per month (₹)', { group: 'costs', step: 5000, hint: 'Staff, office, software and compliance.' }),
    ];
    const PLAN_KEYS = (plan) => FIELDS.filter((f) => f.plans && f.plans.includes(plan)).map((f) => f.key);

    /** A fresh state for a plan preset. Keeps the situation and period. */
    function fromPreset(plan, presetId, keep) {
        const p = (PRESETS[plan] || []).find((x) => x.id === presetId) || PRESETS[plan][0];
        return Object.assign(clone(BASE), clone(p.v), { plan, preset: p.id }, keep || {});
    }
    /** Switch plan but keep the user's common settings: only the plan's own fields come from its first preset. */
    function withPlan(s, plan, presetId) {
        const p = (PRESETS[plan] || []).find((x) => x.id === presetId) || PRESETS[plan][0];
        const src = Object.assign(clone(BASE), clone(p.v));
        const out = Object.assign(clone(s), { plan, preset: p.id });
        PLAN_KEYS(plan).forEach((k) => { out[k] = src[k]; });
        return out;
    }
    function clone(o) { return JSON.parse(JSON.stringify(o)); }

    /* ───────────────────────── engine ───────────────────────── */
    /** Income the plan itself pays for one month of joinings. */
    function planIncome(s, J, N, Nprev, act) {
        const out = { income: 0, bonus: 0, pairs: 0, flushed: 0, cycles: 0 };
        if (J <= 0) return out;
        switch (s.plan) {
            case 'binary': {
                if (N < 3) return out;
                // Every node at height h has 2^h members below it and receives that share of daily joinings,
                // half on each leg; matched pairs = weaker leg × balance, capped per node per day.
                const L = Math.floor(Math.log2(N + 1));
                const d = J / 30;
                const e = (s.balancePct / 100) * (s.ratio === '2:1' ? 0.92 : 1);
                let raw = 0, paid = 0;
                for (let h = 1; h <= L; h++) {
                    const nodes = N / 2 ** h;
                    const perNode = (e * d * 2 ** h) / (2 * N);
                    raw += nodes * perNode;
                    paid += nodes * Math.min(perNode, s.capPairs);
                }
                out.pairs = paid * 30 * act;
                out.flushed = (raw - paid) * 30 * act;
                out.income = out.pairs * s.pairIncome;
                return out;
            }
            case 'unilevel': {
                const up = uplines(N, Math.max(2, s.width));
                out.income = (J * s.bv * sumFrac(s.levels, up) / 100) * act;
                return out;
            }
            case 'matrix': {
                const W = Math.max(2, +s.mWidth), D = s.mAmounts.length;
                const up = uplines(N, W);
                out.income = J * sumFrac(s.mAmounts, up) * act;
                if (s.mBonus > 0 && up >= D) {
                    let size = 0;
                    for (let i = 1; i <= D; i++) size += W ** i;
                    out.bonus = J * (D / size) * s.mBonus * act;
                }
                return out;
            }
            case 'monoline': {
                const above = Nprev + J / 2;
                out.income = J * s.monoPer * Math.min(s.monoLimit, above) * act;
                return out;
            }
            case 'board': {
                // A global board filled breadth first completes one top position every width^levels entries;
                // with re-entry the cycled member takes a new position too.
                const k = (+s.bWidth) ** (+s.bDepth);
                const reentry = s.bReentry === 'yes';
                out.cycles = reentry ? J / Math.max(1, k - 1) : J / k;
                out.income = out.cycles * Math.max(0, s.bPayout - (reentry ? s.price : 0));
                return out;
            }
        }
        return out;
    }

    function simulate(s) {
        const M = clamp(Math.round(s.months) || 24, 1, 120);
        const sc = SCENARIOS[s.scenario] || SCENARIOS.steady;
        const act = clamp(s.activePct, 0, 100) / 100;
        const rows = [];
        const T = { joins: 0, collection: 0, gstAmt: 0, sales: 0, joinBV: 0, repBV: 0, bv: 0, direct: 0, plan: 0, bonus: 0, rep: 0, reward: 0, royalty: 0, gross: 0, admin: 0, tds: 0, net: 0, product: 0, variable: 0, opex: 0, payout: 0, profit: 0, pairs: 0, flushed: 0, cycles: 0 };
        let J = Math.max(0, s.startJoins), N = 0, cum = 0, breakEven = null;

        for (let t = 1; t <= M; t++) {
            if (t > 1) J = J * sc.g(t, s);
            const Jr = Math.max(0, Math.round(J));
            const Nprev = N;
            N += Jr;
            const R = Math.round(Nprev * clamp(s.repPct, 0, 100) / 100);
            const sales = Jr * s.price + R * s.repPrice;
            const gstAmt = sales * s.gst / 100;
            const joinBV = Jr * s.bv, repBV = R * s.repBv, bv = joinBV + repBV;
            const direct = joinBV * s.directPct / 100;
            const p = planIncome(s, Jr, N, Nprev, act);
            const rep = repBV * s.repIncomePct / 100 * act;
            const reward = bv * s.rewardPct / 100, royalty = bv * s.royaltyPct / 100;
            const gross = direct + p.income + p.bonus + rep + reward + royalty;
            const admin = gross * s.adminPct / 100;
            const tds = (gross - admin) * s.tdsPct / 100;
            const payout = gross - admin;
            const product = sales * s.costPct / 100, variable = sales * s.varPct / 100, opex = s.opex;
            const profit = sales - product - variable - opex - payout;
            cum += profit;
            if (breakEven === null && cum >= 0) breakEven = t;
            if (breakEven !== null && cum < 0) breakEven = null;

            const row = { m: t, joins: Jr, members: N, repurchasers: R, sales, collection: sales + gstAmt, gstAmt, joinBV, repBV, bv, direct, plan: p.income, bonus: p.bonus, rep, reward, royalty, gross, admin, tds, net: gross - admin - tds, payout, product, variable, opex, profit, cum, pairs: p.pairs, flushed: p.flushed, cycles: p.cycles, payoutPct: bv ? gross / bv * 100 : 0 };
            rows.push(row);
            Object.keys(T).forEach((k) => { if (k in row) T[k] += row[k]; });
        }

        const last3 = rows.slice(-3);
        const l3bv = sum(last3.map((r) => r.bv));
        const lossFrom = (() => { // first month of a losing streak that lasts to the end
            let i = rows.length - 1;
            if (i < 0 || rows[i].profit >= 0) return null;
            while (i > 0 && rows[i - 1].profit < 0) i--;
            return i > 0 ? rows[i].m : null;
        })();
        const kpi = {
            sales: T.sales, collection: T.collection, bv: T.bv, gross: T.gross, payout: T.payout, profit: T.profit,
            payoutPct: T.bv ? T.gross / T.bv * 100 : 0,
            payoutSalesPct: T.sales ? T.payout / T.sales * 100 : 0,
            margin: T.sales ? T.profit / T.sales * 100 : 0,
            breakEven, members: N, months: M, lossFrom,
            repShare: l3bv ? sum(last3.map((r) => r.repBV)) / l3bv * 100 : 0,
            maxDaily: s.plan === 'binary' ? s.capPairs * s.pairIncome : null,
            flushedShare: T.pairs + T.flushed ? T.flushed / (T.pairs + T.flushed) * 100 : 0,
        };
        return { rows, T, kpi };
    }

    /** Verdict and notes for a simulated plan against the owner's targets. */
    function assess(s, k, tg) {
        const notes = [];
        const meets = k.payoutPct <= tg.payout && k.margin >= tg.margin;
        if (k.payoutPct > tg.payout) notes.push(['warning', `Total payout is ${pct(k.payoutPct)} of BV, above your ${tg.payout}% target. Plans that last usually keep total payout around 30–45% of BV.`]);
        if (k.margin < tg.margin) notes.push([k.margin < 0 ? 'critical' : 'warning', `Company margin is ${pct(k.margin)} of net sales, below your ${tg.margin}% target.`]);
        if (k.breakEven === null) notes.push(['critical', `The company does not recover its costs within ${k.months} months.`]);
        else notes.push(['good', k.breakEven === 1 ? 'Profitable from the first month.' : `Cumulative break-even in month ${k.breakEven}.`]);
        if (k.lossFrom) notes.push(['critical', `Monthly profit turns negative from month ${k.lossFrom} in this situation and stays negative.`]);
        if (k.repShare < 25) notes.push(['warning', `Only ${pct(k.repShare)} of BV in the last 3 months comes from repurchase. Earnings that depend mainly on new joinings are a sustainability and legal risk: the Consumer Protection (Direct Selling) Rules, 2021 expect income to come from genuine product sales.`]);
        if (s.plan === 'board') notes.push(['critical', 'Board / auto-pool plans that pay out of new entries can be treated as money circulation under the Prize Chits and Money Circulation Schemes (Banning) Act, 1978. Use one only with real products and legal advice.']);
        if (k.maxDaily && k.maxDaily > 5 * s.price) notes.push(['warning', `Capping lets one ID earn up to ${inr(k.maxDaily)} a day (${inrc(k.maxDaily * 30)} a month). Consider a lower daily capping.`]);
        if (s.plan === 'binary' && k.flushedShare > 1) notes.push(['good', `${pct(k.flushedShare)} of pairs are flushed by capping.`]);
        if (s.bv > s.price) notes.push(['warning', 'BV is higher than the package price, so commissions can exceed what the product earns.']);
        if (s.costPct < 15) notes.push(['warning', 'Product cost below 15% of the price can look like an inflated MRP. Price products fairly against the market.']);

        let level, title;
        if (k.profit < 0) { level = 'critical'; title = 'This setup loses money'; }
        else if (meets && k.repShare >= 25 && k.breakEven !== null && !k.lossFrom && s.plan !== 'board') { level = 'good'; title = 'Profitable and sustainable'; }
        else if (meets) { level = 'warning'; title = 'Meets your targets, with risks'; }
        else { level = 'warning'; title = 'Profitable, but needs tuning'; }
        return { level, title, notes, meets };
    }

    /* ───────────────────────── advisor ───────────────────────── */
    const scaleList = (list, total, step) => {
        const cur = sum(list);
        if (cur <= 0) return list.slice();
        return list.map((x) => Math.max(0, round(x * total / cur, step)));
    };
    /**
     * dir: +1 if raising the value raises company profit, -1 if lowering it does. `generous` marks distributor incomes.
     * min/max are industry-typical ranges (some relative to the package), so suggestions stay realistic.
     */
    const LEVERS = [
        { id: 'pairIncome', plans: ['binary'], label: 'Pair income', fmt: inr, min: 10, max: (s) => Math.max(10, round(0.4 * s.bv, 10)), step: 10, dir: -1, generous: true },
        { id: 'capPairs', plans: ['binary'], label: 'Daily capping', fmt: (v) => v + ' pairs/day', min: 1, max: 25, step: 1, dir: -1, generous: true },
        { id: 'levelsTotal', plans: ['unilevel'], label: 'Total level income', fmt: (v) => nf2.format(v) + '% of BV', min: 1, max: 35, step: 0.5, dir: -1, generous: true,
            get: (s) => sum(s.levels), set: (s, v) => { s.levels = scaleList(s.levels, v, 0.25); } },
        { id: 'mTotal', plans: ['matrix'], label: 'Matrix level income (all levels)', fmt: (v) => inr(v) + ' per joining', min: 10, max: (s) => Math.max(10, round(0.45 * s.bv, 5)), step: 5, dir: -1, generous: true,
            get: (s) => sum(s.mAmounts), set: (s, v) => { s.mAmounts = scaleList(s.mAmounts, v, 5); } },
        { id: 'monoPer', plans: ['monoline'], label: 'Income per member below', fmt: (v) => '₹' + nf2.format(v), min: 0.25, max: 5, step: 0.25, dir: -1, generous: true },
        { id: 'monoLimit', plans: ['monoline'], label: 'Members paid for', fmt: num, min: 10, max: 1000, step: 10, dir: -1, generous: true },
        { id: 'bPayout', plans: ['board'], label: 'Board payout', fmt: inr, min: 100, max: (s) => s.price * (+s.bWidth) ** (+s.bDepth), step: 100, dir: -1, generous: true },
        { id: 'directPct', label: 'Direct / sponsor income', fmt: (v) => nf2.format(v) + '%', min: 3, max: 20, step: 0.5, dir: -1, generous: true },
        { id: 'repIncomePct', label: 'Repurchase income', fmt: (v) => nf2.format(v) + '%', min: 5, max: 35, step: 0.5, dir: -1, generous: true },
        { id: 'costPct', label: 'Product cost', fmt: (v) => v + '% of price', min: (s) => Math.max(15, s.costPct - 15), max: 80, step: 1, dir: -1 },
        { id: 'price', label: 'Package price (same BV)', fmt: inr, min: 100, max: (s) => round(s.price * 1.5, 50), step: 50, dir: 1 },
        { id: 'bv', label: 'BV per package', fmt: num, min: (s) => round(s.bv * 0.6, 10), max: 1e6, step: 10, dir: -1 },
        { id: 'repPct', label: 'Members repurchasing monthly', fmt: (v) => v + '%', min: 0, max: (s) => Math.min(70, s.repPct + 25), step: 1, dir: 1 },
        { id: 'rewardPct', label: 'Rewards fund', fmt: (v) => nf2.format(v) + '%', min: 0, max: 10, step: 0.5, dir: -1 },
        { id: 'adminPct', label: 'Admin charge', fmt: (v) => nf2.format(v) + '%', min: 0, max: 10, step: 0.5, dir: 1 },
    ];
    const lmin = (l, s) => (typeof l.min === 'function' ? l.min(s) : l.min);
    const lmax = (l, s) => (typeof l.max === 'function' ? l.max(s) : l.max);
    const lget = (l, s) => (l.get ? l.get(s) : s[l.id]);
    const lset = (s, l, v) => { if (l.set) l.set(s, v); else s[l.id] = v; return s; };
    const meetsT = (r, tg) => r.kpi.payoutPct <= tg.payout && r.kpi.margin >= tg.margin;

    /**
     * One-lever changes. If the plan misses the targets: the smallest change of each lever that fixes it.
     * If it already meets them: how far each distributor income could rise and still meet them.
     */
    function advise(s, tg) {
        const base = simulate(s);
        const ok = meetsT(base, tg);
        const out = [];
        const blocked = [];
        LEVERS.filter((l) => !l.plans || l.plans.includes(s.plan)).forEach((l) => {
            if (ok && !l.generous) return;
            const cur = lget(l, s);
            const toward = ok ? -l.dir : l.dir; // direction to move
            const ext = toward > 0 ? lmax(l, s) : lmin(l, s);
            if ((toward > 0 && cur >= ext) || (toward < 0 && cur <= ext)) return;
            const test = (v) => meetsT(simulate(lset(clone(s), l, v)), tg);
            let good;
            if (ok) {
                // Move away from the current value until the targets break; keep the last value that meets them.
                if (test(ext)) good = ext;
                else {
                    let a = cur, b = ext; // a meets, b fails
                    for (let i = 0; i < 24; i++) { const mid = (a + b) / 2; if (test(mid)) a = mid; else b = mid; }
                    good = a;
                }
            } else {
                if (!test(ext)) { blocked.push(l.label); return; }
                let a = cur, b = ext; // a fails, b meets
                for (let i = 0; i < 24; i++) { const mid = (a + b) / 2; if (test(mid)) b = mid; else a = mid; }
                good = b;
            }
            // Snap to the lever step on the side that still meets the targets
            // (further along `toward` when fixing, back toward the current value when adding headroom).
            const safeDir = ok ? -toward : toward;
            const q = good / l.step;
            let v = clamp((safeDir > 0 ? Math.ceil(q - 1e-9) : Math.floor(q + 1e-9)) * l.step, lmin(l, s), lmax(l, s));
            v = +v.toFixed(4);
            if (Math.abs(v - cur) < l.step / 2) return;
            let next = lset(clone(s), l, v);
            let r = simulate(next);
            if (!meetsT(r, tg)) { // a scaled list can round the wrong way: one more step
                v = +clamp(v + safeDir * l.step, lmin(l, s), lmax(l, s)).toFixed(4);
                next = lset(clone(s), l, v);
                r = simulate(next);
                if (!meetsT(r, tg) || Math.abs(v - cur) < l.step / 2) return;
            }
            if (ok && Math.abs(r.kpi.payoutPct - base.kpi.payoutPct) < 0.2) return; // e.g. capping that never binds
            out.push({ lever: l.id, label: l.label, from: l.fmt(cur), to: l.fmt(lget(l, next)), change: Math.abs(v - cur) / Math.max(Math.abs(cur), l.step), state: next, kpi: r.kpi });
        });
        out.sort((a, b) => a.change - b.change);
        return { ok, items: out.slice(0, 6), blocked };
    }

    /** Grid search over the plan's own levers plus direct and repurchase income: the most generous setup that still meets the targets. */
    function bestConfig(s, tg) {
        const mult = [0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1, 1.1, 1.25];
        const axes = [];
        const byId = (id) => LEVERS.find((l) => l.id === id);
        const around = (l, cur, ms) => [...new Set(ms.map((m) => clamp(+round(cur * m, l.step).toFixed(4), lmin(l, s), lmax(l, s))))];
        switch (s.plan) {
            case 'binary':
                axes.push([byId('pairIncome'), around(byId('pairIncome'), s.pairIncome, mult)]);
                axes.push([byId('capPairs'), [...new Set([3, 5, 8, 10, 15, 20, s.capPairs])]]);
                break;
            case 'unilevel': axes.push([byId('levelsTotal'), around(byId('levelsTotal'), sum(s.levels), mult)]); break;
            case 'matrix': axes.push([byId('mTotal'), around(byId('mTotal'), sum(s.mAmounts), mult)]); break;
            case 'monoline':
                axes.push([byId('monoPer'), around(byId('monoPer'), s.monoPer, [0.25, 0.5, 0.75, 1, 1.25])]);
                axes.push([byId('monoLimit'), [...new Set([100, 200, 300, 500, s.monoLimit])]]);
                break;
            case 'board': axes.push([byId('bPayout'), around(byId('bPayout'), s.bPayout, [0.4, 0.5, 0.6, 0.7, 0.8, 0.9, 1])]); break;
        }
        axes.push([byId('directPct'), [...new Set([5, 6, 8, 10, 12, 15, s.directPct])]]);
        axes.push([byId('repIncomePct'), [...new Set([10, 15, 20, 25, 30, s.repIncomePct])]]);

        let best = null, fallback = null;
        const walk = (i, st) => {
            if (i === axes.length) {
                const r = simulate(st);
                const k = r.kpi;
                if (meetsT(r, tg)) {
                    if (!best || k.payoutPct > best.kpi.payoutPct + 1e-9 || (Math.abs(k.payoutPct - best.kpi.payoutPct) < 1e-9 && k.margin > best.kpi.margin)) best = { state: clone(st), kpi: k };
                } else if (!fallback || k.margin > fallback.kpi.margin) fallback = { state: clone(st), kpi: k };
                return;
            }
            const [l, vals] = axes[i];
            vals.forEach((v) => walk(i + 1, lset(clone(st), l, v)));
        };
        walk(0, clone(s));
        const pick = best || fallback;
        const changes = axes.map(([l]) => ({ label: l.label, from: lget(l, s), to: lget(l, pick.state), fmt: l.fmt }))
            .filter((c) => Math.abs(c.from - c.to) > 1e-9)
            .map((c) => ({ label: c.label, from: c.fmt(c.from), to: c.fmt(c.to) }));
        return { found: !!best, state: pick.state, kpi: pick.kpi, changes };
    }

    /* ───────────────────────── exports for tests ───────────────────────── */
    const API = { simulate, assess, advise, bestConfig, fromPreset, withPlan, BASE, PRESETS, SCENARIOS, PLANS, FIELDS, LEVERS, uplines, sumFrac };
    if (typeof module === 'object' && module.exports) module.exports = API;
    if (typeof document === 'undefined') return;

    /* ───────────────────────── UI ───────────────────────── */
    const STORE = 'mlmPlanSimulator.v1';
    const ICON = {
        good: '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 12.5l4.5 4.5L19 7.5"/></svg>',
        warning: '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M12 3l10 18H2L12 3z"/><path d="M12 10v5M12 18v.5"/></svg>',
        critical: '<svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><circle cx="12" cy="12" r="9.5"/><path d="M8.5 8.5l7 7M15.5 8.5l-7 7"/></svg>',
    };
    const STATUS_LABEL = { good: 'Good', warning: 'Watch', critical: 'Risk' };
    const statusOf = (r, tg, s) => assess(s, r.kpi, tg).level;
    const chip = (level, text) => `<span class="ps-status ps-${level}">${ICON[level]}<span>${esc(text || STATUS_LABEL[level])}</span></span>`;

    function boot() {
        const root = document.getElementById('plan-simulator');
        if (!root) return;
        const $ = (k) => root.querySelector(`[data-ps="${k}"]`);
        let s = fromPreset('binary', 'b1');
        let tg = { payout: 40, margin: 10 };
        try {
            const saved = JSON.parse(localStorage.getItem(STORE) || 'null');
            if (saved && saved.s && PLANS[saved.s.plan]) { s = Object.assign(fromPreset(saved.s.plan, saved.s.preset), saved.s); tg = Object.assign(tg, saved.tg || {}); }
        } catch (e) { /* storage unavailable: start from defaults */ }
        let lastRun = null, advice = null, best = null, cmp = [];

        const save = () => { try { localStorage.setItem(STORE, JSON.stringify({ s, tg })); } catch (e) { /* ignore */ } };

        /* top controls */
        function renderTabs() {
            $('tabs').innerHTML = Object.entries(PLANS).map(([id, p]) => `<button type="button" role="tab" class="ps-tab" aria-selected="${id === s.plan}" data-plan="${id}"><span>${esc(p.label)}</span><small>${esc(p.blurb)}</small></button>`).join('');
            $('preset').innerHTML = PRESETS[s.plan].map((p) => `<option value="${p.id}"${p.id === s.preset ? ' selected' : ''}>${esc(p.name)}</option>`).join('');
            $('scenario').innerHTML = Object.entries(SCENARIOS).map(([id, x]) => `<option value="${id}"${id === s.scenario ? ' selected' : ''}>${esc(x.label)}</option>`).join('');
            $('months').value = String(s.months);
        }

        function fieldHtml(f) {
            const id = 'ps-f-' + f.key;
            const v = s[f.key];
            let input;
            if (f.type === 'select') input = `<select id="${id}" data-key="${f.key}">${f.options.map(([ov, ol]) => `<option value="${ov}"${String(ov) === String(v) ? ' selected' : ''}>${esc(ol)}</option>`).join('')}</select>`;
            else if (f.type === 'list') input = `<input id="${id}" data-key="${f.key}" type="text" inputmode="decimal" value="${esc(v.join(', '))}">`;
            else input = `<input id="${id}" data-key="${f.key}" type="number" inputmode="decimal" min="${f.min}" max="${f.max}" step="${f.step}" value="${esc(v)}">`;
            return `<div class="ps-field"><label for="${id}">${esc(f.label)}</label>${input}${f.hint ? `<small>${esc(f.hint)}</small>` : ''}<em class="ps-err" hidden></em></div>`;
        }
        function renderFields() {
            const open = {};
            root.querySelectorAll('[data-ps="fields"] details').forEach((d) => { open[d.dataset.group] = d.open; });
            $('fields').innerHTML = GROUPS.map((g) => {
                const fs = FIELDS.filter((f) => f.group === g.id && (!f.plans || f.plans.includes(s.plan)) && (!f.show || f.show(s)));
                if (!fs.length) return '';
                const isOpen = g.id in open ? open[g.id] : g.open;
                const title = g.id === 'plan' ? `${PLANS[s.plan].label} plan income` : g.title;
                return `<details data-group="${g.id}"${isOpen ? ' open' : ''}><summary>${esc(title)}</summary><div class="ps-fields">${fs.map(fieldHtml).join('')}</div></details>`;
            }).join('');
        }

        /* results */
        function renderResults() {
            const r = simulate(s);
            lastRun = r;
            const k = r.kpi;
            const a = assess(s, k, tg);

            $('verdict').className = `ps-panel ps-verdict ps-v-${a.level}`;
            $('verdict').innerHTML = `<div class="ps-verdict-head">${chip(a.level, a.title)}<span class="ps-verdict-sub">${esc(PLANS[s.plan].label)} · ${esc(SCENARIOS[s.scenario].label)} · ${k.months} months</span></div>`
                + `<ul>${a.notes.map(([lv, t]) => `<li class="ps-note-${lv}">${ICON[lv]}<span>${esc(t)}</span></li>`).join('')}</ul>`;

            const tiles = [
                ['Net sales (excl. GST)', inrc(k.sales), `${num(k.members)} members · GST collected ${inrc(r.T.gstAmt)}`],
                ['Total payout', inrc(k.gross), `${pct(k.payoutPct)} of BV · ${pct(k.payoutSalesPct)} of sales`],
                ['Company profit', inrc(k.profit), `${pct(k.margin)} margin`],
                ['Break-even', k.breakEven ? `Month ${k.breakEven}` : 'Not reached', k.maxDaily ? `Max per ID ${inr(k.maxDaily)}/day` : `Members net of TDS & admin ${inrc(r.T.net)}`],
            ];
            $('kpis').innerHTML = tiles.map(([l, v, sub]) => `<div class="ps-kpi"><span>${esc(l)}</span><strong>${esc(v)}</strong><small>${esc(sub)}</small></div>`).join('');

            drawChart($('chart'), r.rows);
            renderBreakdown(r);
            renderTable(r.rows);
        }

        function renderBreakdown(r) {
            const T = r.T;
            const items = [
                ['Direct / sponsor income', T.direct],
                [{ binary: 'Pair (binary) income', unilevel: 'Level income', matrix: 'Matrix level income', monoline: 'Monoline income', board: 'Board payouts' }[s.plan], T.plan],
                ['Matrix completion bonus', T.bonus],
                ['Repurchase income', T.rep],
                ['Rank & rewards fund', T.reward],
                ['Royalty / leadership pool', T.royalty],
            ].filter(([, v]) => v > 0.5);
            const max = Math.max(1, ...items.map(([, v]) => v));
            const bv = T.bv || 1;
            $('breakdown').innerHTML = items.map(([l, v]) => `<div class="ps-bar-row"><span class="ps-bar-label">${esc(l)}</span><span class="ps-bar-track"><span class="ps-bar-fill" style="width:${(v / max * 100).toFixed(1)}%"></span></span><span class="ps-bar-val">${inrc(v)} <small>${pct(v / bv * 100)} of BV</small></span></div>`).join('')
                + `<p class="ps-small">Admin charge kept: ${inrc(T.admin)} · TDS deposited: ${inrc(T.tds)} · Product cost: ${inrc(T.product)} · Logistics: ${inrc(T.variable)} · Fixed costs: ${inrc(T.opex)}</p>`;
        }

        function renderTable(rows) {
            const head = ['Month', 'Joinings', 'Members', 'Repurchasers', 'Net sales', 'BV', 'Payout', 'Payout % BV', 'Profit', 'Cumulative'];
            $('table').innerHTML = `<div class="ps-table-wrap"><table class="ps-table"><thead><tr>${head.map((h) => `<th scope="col">${h}</th>`).join('')}</tr></thead><tbody>`
                + rows.map((r) => `<tr><td>${r.m}</td><td>${num(r.joins)}</td><td>${num(r.members)}</td><td>${num(r.repurchasers)}</td><td>${inr(r.sales)}</td><td>${num(r.bv)}</td><td>${inr(r.gross)}</td><td>${pct(r.payoutPct)}</td><td class="${r.profit < 0 ? 'ps-neg' : ''}">${inr(r.profit)}</td><td class="${r.cum < 0 ? 'ps-neg' : ''}">${inr(r.cum)}</td></tr>`).join('')
                + '</tbody></table></div>';
        }

        /* chart: one ₹ axis, three series, crosshair tooltip */
        const SERIES = [
            { k: 'sales', name: 'Net sales', c: 'var(--ps-s1)' },
            { k: 'payout', name: 'Payout cost', c: 'var(--ps-s2)' },
            { k: 'profit', name: 'Profit', c: 'var(--ps-s3)' },
        ];
        function niceTicks(lo, hi, n) {
            if (hi - lo < 1) hi = lo + 1;
            const raw = (hi - lo) / n, mag = 10 ** Math.floor(Math.log10(raw));
            const step = [1, 2, 2.5, 5, 10].map((m) => m * mag).find((x) => x >= raw);
            const out = [];
            for (let v = Math.floor(lo / step) * step; v <= Math.ceil(hi / step) * step + step / 2; v += step) out.push(+v.toFixed(6));
            return out;
        }
        function drawChart(host, rows) {
            const W = Math.max(280, host.clientWidth || 600), H = 280;
            const wide = W >= 520;
            const m = { l: 56, r: wide ? 96 : 14, t: 14, b: 28 };
            const vals = rows.flatMap((r) => SERIES.map((x) => r[x.k]));
            const ticks = niceTicks(Math.min(0, ...vals), Math.max(0, ...vals), 4);
            const lo = ticks[0], hi = ticks[ticks.length - 1];
            const iw = W - m.l - m.r, ih = H - m.t - m.b;
            const x = (i) => m.l + (rows.length === 1 ? iw / 2 : (i * iw) / (rows.length - 1));
            const y = (v) => m.t + ((hi - v) * ih) / (hi - lo || 1);
            const every = Math.max(1, Math.ceil(rows.length / Math.max(2, Math.floor(iw / 46))));
            let g = '';
            ticks.forEach((t) => {
                g += `<line x1="${m.l}" x2="${W - m.r}" y1="${y(t).toFixed(1)}" y2="${y(t).toFixed(1)}" stroke="${t === 0 ? 'var(--textFaint)' : 'var(--borderSoft)'}" stroke-width="1"/>`;
                g += `<text x="${m.l - 8}" y="${(y(t) + 4).toFixed(1)}" text-anchor="end" class="ps-axis">${inrc(t)}</text>`;
            });
            rows.forEach((r, i) => { if ((i + 1) % every === 0 || (i === 0 && every >= 3)) g += `<text x="${x(i).toFixed(1)}" y="${H - 8}" text-anchor="middle" class="ps-axis">M${r.m}</text>`; });
            SERIES.forEach((sr) => {
                const d = rows.map((r, i) => `${i ? 'L' : 'M'}${x(i).toFixed(1)},${y(r[sr.k]).toFixed(1)}`).join('');
                g += `<path d="${d}" fill="none" style="stroke:${sr.c}" stroke-width="2" stroke-linejoin="round" stroke-linecap="round"/>`;
            });
            if (wide && rows.length) {
                const li = rows.length - 1;
                const labels = SERIES.map((sr) => ({ sr, y: y(rows[li][sr.k]) })).sort((a, b) => a.y - b.y);
                for (let i = 1; i < labels.length; i++) if (labels[i].y - labels[i - 1].y < 15) labels[i].y = labels[i - 1].y + 15;
                labels.forEach(({ sr, y: ly }) => {
                    g += `<circle cx="${x(li).toFixed(1)}" cy="${y(rows[li][sr.k]).toFixed(1)}" r="4" style="fill:${sr.c}" stroke="var(--bg2)" stroke-width="2"/>`;
                    g += `<text x="${(x(li) + 10).toFixed(1)}" y="${(ly + 4).toFixed(1)}" class="ps-dlabel">${esc(sr.name)}</text>`;
                });
            }
            g += `<g class="ps-cross" style="display:none"><line y1="${m.t}" y2="${H - m.b}" stroke="var(--textMuted)" stroke-width="1" stroke-dasharray="3 3"/>${SERIES.map((sr) => `<circle r="4" style="fill:${sr.c}" stroke="var(--bg2)" stroke-width="2"/>`).join('')}</g>`;
            g += `<rect class="ps-hit" x="${m.l}" y="${m.t}" width="${iw}" height="${ih}" fill="transparent"/>`;
            host.innerHTML = `<svg width="${W}" height="${H}" viewBox="0 0 ${W} ${H}" role="img" aria-label="Monthly net sales, payout cost and profit over ${rows.length} months">${g}</svg><div class="ps-tip" hidden></div>`;

            const svg = host.querySelector('svg'), cross = host.querySelector('.ps-cross'), tip = host.querySelector('.ps-tip');
            const move = (ev) => {
                const box = svg.getBoundingClientRect();
                const px = ev.clientX - box.left;
                const i = clamp(Math.round(((px - m.l) / (iw || 1)) * (rows.length - 1)), 0, rows.length - 1);
                const r = rows[i];
                cross.style.display = '';
                cross.querySelector('line').setAttribute('x1', x(i)); cross.querySelector('line').setAttribute('x2', x(i));
                cross.querySelectorAll('circle').forEach((c, j) => { c.setAttribute('cx', x(i)); c.setAttribute('cy', y(r[SERIES[j].k])); });
                tip.hidden = false;
                tip.innerHTML = `<strong>Month ${r.m}</strong><span class="ps-tip-sub">${num(r.joins)} joinings · ${num(r.members)} members</span>`
                    + SERIES.map((sr) => `<span class="ps-tip-row"><i style="background:${sr.c}"></i>${sr.name}<b>${inr(r[sr.k])}</b></span>`).join('')
                    + `<span class="ps-tip-row"><i class="ps-tip-none"></i>Payout % of BV<b>${pct(r.payoutPct)}</b></span>`;
                const tw = tip.offsetWidth;
                let left = x(i) + 14;
                if (left + tw > W - 4) left = x(i) - tw - 14;
                tip.style.left = Math.max(4, left) + 'px';
                tip.style.top = m.t + 'px';
            };
            const leave = () => { cross.style.display = 'none'; tip.hidden = true; };
            const hit = host.querySelector('.ps-hit');
            hit.addEventListener('pointermove', move);
            hit.addEventListener('pointerdown', move);
            hit.addEventListener('pointerleave', leave);
        }

        /* advisor, stress test and plan comparison run after the main render */
        function renderAdvisor() {
            $('tPayout').value = tg.payout;
            $('tMargin').value = tg.margin;
            advice = advise(s, tg);
            best = bestConfig(s, tg);
            const k = lastRun.kpi;

            const bestHead = best.found
                ? (best.changes.length ? 'The most generous plan for distributors that still meets your targets' : 'Your plan settings are already the best fit for these targets')
                : 'No mix of plan incomes reaches your targets on its own. This is the closest setup. Also change product cost, price or repurchase (below).';
            $('best').innerHTML = `<div class="ps-best ${best.found ? '' : 'ps-best-miss'}"><div><h4>${chip(best.found ? 'good' : 'warning', best.found ? 'Recommended configuration' : 'Closest configuration')}</h4><p>${esc(bestHead)}</p>`
                + (best.changes.length ? `<ul class="ps-changes">${best.changes.map((c) => `<li><span>${esc(c.label)}</span><span class="ps-from">${esc(c.from)}</span><span aria-hidden="true">→</span><b>${esc(c.to)}</b></li>`).join('')}</ul>` : '')
                + `</div><div class="ps-best-res"><span>Payout <b>${pct(best.kpi.payoutPct)}</b> of BV <small>now ${pct(k.payoutPct)}</small></span><span>Margin <b>${pct(best.kpi.margin)}</b> <small>now ${pct(k.margin)}</small></span><span>Profit <b>${inrc(best.kpi.profit)}</b> <small>now ${inrc(k.profit)}</small></span>`
                + (best.changes.length ? '<button type="button" class="ps-apply" data-apply-best>Apply this configuration</button>' : '') + '</div></div>';

            const intro = advice.ok
                ? 'Your plan meets the targets. Each change below makes it more attractive to distributors and still stays within them:'
                : 'Any one of these changes on its own brings the plan within your targets:';
            $('suggest').innerHTML = `<p class="ps-small">${esc(intro)}</p>`
                + (advice.items.length ? `<div class="ps-sugg">${advice.items.map((it, i) => `<div class="ps-sugg-row"><div><b>${esc(it.label)}</b><span class="ps-from">${esc(it.from)}</span> → <b>${esc(it.to)}</b></div><div class="ps-small">Payout ${pct(it.kpi.payoutPct)} of BV · margin ${pct(it.kpi.margin)} · profit ${inrc(it.kpi.profit)}</div><button type="button" class="ps-apply ps-apply-sm" data-apply="${i}">Apply</button></div>`).join('')}</div>`
                    : '<p class="ps-small">No single change is enough. Combine the recommended configuration with a lower product cost or more repurchase.</p>')
                + (!advice.ok && advice.blocked.length ? `<p class="ps-small">Not enough on their own: ${esc(advice.blocked.join(', '))}.</p>` : '');

            // How the current setup holds up in every situation.
            $('stress').innerHTML = `<div class="ps-table-wrap"><table class="ps-table"><thead><tr><th scope="col">Situation</th><th scope="col">Profit</th><th scope="col">Margin</th><th scope="col">Payout % BV</th><th scope="col">Break-even</th><th scope="col">Status</th></tr></thead><tbody>`
                + Object.entries(SCENARIOS).filter(([id]) => id !== 'custom' || s.scenario === 'custom').map(([id, sc]) => {
                    const st = Object.assign(clone(s), { scenario: id });
                    const r = simulate(st), kk = r.kpi;
                    return `<tr class="${id === s.scenario ? 'ps-current' : ''}"><td><button type="button" class="ps-link" data-scenario="${id}">${esc(sc.label)}</button></td><td class="${kk.profit < 0 ? 'ps-neg' : ''}">${inrc(kk.profit)}</td><td>${pct(kk.margin)}</td><td>${pct(kk.payoutPct)}</td><td>${kk.breakEven ? 'Month ' + kk.breakEven : 'Not reached'}</td><td>${chip(statusOf(r, tg, st))}</td></tr>`;
                }).join('') + '</tbody></table></div>';

            // Every plan type with its standard setup, on the same package, growth and costs.
            cmp = Object.keys(PLANS).map((plan) => {
                const st = withPlan(s, plan, plan === s.plan ? s.preset : undefined);
                if (plan === s.plan) PLAN_KEYS(plan).forEach((kk) => { st[kk] = clone(s[kk]); });
                const r = simulate(st);
                return { plan, st, r };
            });
            $('compare').innerHTML = `<div class="ps-table-wrap"><table class="ps-table"><thead><tr><th scope="col">Plan</th><th scope="col">Payout % BV</th><th scope="col">Margin</th><th scope="col">Profit</th><th scope="col">Status</th><th scope="col"><span class="ps-sr">Action</span></th></tr></thead><tbody>`
                + cmp.map(({ plan, st, r }, i) => `<tr class="${plan === s.plan ? 'ps-current' : ''}"><td><b>${esc(PLANS[plan].label)}</b><br><small>${plan === s.plan ? 'Your current settings' : esc(PRESETS[plan][0].name)}</small></td><td>${pct(r.kpi.payoutPct)}</td><td>${pct(r.kpi.margin)}</td><td class="${r.kpi.profit < 0 ? 'ps-neg' : ''}">${inrc(r.kpi.profit)}</td><td>${chip(statusOf(r, tg, st))}</td><td>${plan === s.plan ? '' : `<button type="button" class="ps-link" data-compare="${i}">Open</button>`}</td></tr>`).join('')
                + '</tbody></table></div>';
        }

        /* scheduling */
        let t1 = null, t2 = null;
        const update = (full) => {
            clearTimeout(t1); clearTimeout(t2);
            if (full) { renderTabs(); renderFields(); }
            t1 = setTimeout(() => { renderResults(); save(); t2 = setTimeout(renderAdvisor, 60); }, full ? 0 : 120);
        };
        const setState = (next) => { s = next; update(true); };

        /* events */
        root.addEventListener('click', (e) => {
            const el = e.target.closest('button');
            if (!el || !root.contains(el)) return;
            if (el.dataset.plan && el.dataset.plan !== s.plan) setState(withPlan(s, el.dataset.plan));
            else if (el.dataset.ps === 'reset') setState(fromPreset(s.plan, s.preset, { scenario: s.scenario, months: s.months }));
            else if ('applyBest' in el.dataset && best) setState(Object.assign(clone(best.state), { preset: s.preset }));
            else if (el.dataset.apply !== undefined && advice) setState(clone(advice.items[+el.dataset.apply].state));
            else if (el.dataset.scenario) setState(Object.assign(clone(s), { scenario: el.dataset.scenario }));
            else if (el.dataset.compare !== undefined) setState(clone(cmp[+el.dataset.compare].st));
        });
        $('preset').addEventListener('change', (e) => setState(fromPreset(s.plan, e.target.value, { scenario: s.scenario, months: s.months })));
        $('scenario').addEventListener('change', (e) => setState(Object.assign(clone(s), { scenario: e.target.value })));
        $('months').addEventListener('change', (e) => { s.months = +e.target.value; update(false); });
        const onTarget = () => {
            const p = parseFloat($('tPayout').value), m = parseFloat($('tMargin').value);
            if (Number.isFinite(p) && p > 0 && p <= 100) tg.payout = p;
            if (Number.isFinite(m) && m >= -50 && m < 100) tg.margin = m;
            update(false);
        };
        $('tPayout').addEventListener('input', onTarget);
        $('tMargin').addEventListener('input', onTarget);

        $('fields').addEventListener('input', onField);
        $('fields').addEventListener('change', onField);
        function onField(e) {
            const el = e.target, key = el.dataset && el.dataset.key;
            if (!key) return;
            const f = FIELDS.find((x) => x.key === key);
            const err = el.parentElement.querySelector('.ps-err');
            let v, msg = '';
            if (f.type === 'select') v = f.options.some(([ov]) => typeof ov === 'number') ? +el.value : el.value;
            else if (f.type === 'list') {
                v = el.value.split(/[,\s;]+/).filter(Boolean).map(Number);
                if (!v.length || v.length > 30 || v.some((x) => !Number.isFinite(x) || x < 0)) msg = 'Enter 1–30 numbers separated by commas.';
            } else {
                v = parseFloat(el.value);
                if (!Number.isFinite(v)) msg = 'Enter a number.';
                else if (v < f.min || v > f.max) msg = `Use a value from ${nf2.format(f.min)} to ${nf2.format(f.max)}.`;
            }
            el.classList.toggle('ps-invalid', !!msg);
            el.setAttribute('aria-invalid', msg ? 'true' : 'false');
            err.hidden = !msg; err.textContent = msg;
            if (msg) return;
            s[key] = v;
            update(false);
        }

        let rz = null;
        window.addEventListener('resize', () => { clearTimeout(rz); rz = setTimeout(() => lastRun && drawChart($('chart'), lastRun.rows), 150); });

        update(true);
    }

    if (document.readyState === 'loading') document.addEventListener('DOMContentLoaded', boot);
    else boot();
})();
