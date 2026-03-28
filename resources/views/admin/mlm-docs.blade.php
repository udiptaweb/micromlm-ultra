<x-app-layout>
    <x-slot name="header">MLM Configuration Guide</x-slot>

    <style>
        .docs-wrap {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 1.75rem;
            align-items: start;
        }
        @media (max-width: 900px) {
            .docs-wrap { grid-template-columns: 1fr; }
            .docs-sidebar { display: none; }
        }
        .docs-sidebar {
            position: sticky;
            top: 4.5rem;
            max-height: calc(100vh - 5.5rem);
            overflow-y: auto;
            scrollbar-width: none;
        }
        .docs-sidebar::-webkit-scrollbar { display: none; }
        .sidebar-heading {
            font-size: 0.62rem;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.6rem;
            padding-left: 0.65rem;
        }
        .sidebar-search-wrap { position: relative; margin-bottom: 0.85rem; }
        .sidebar-search-wrap svg {
            position: absolute; left: 0.65rem; top: 50%;
            transform: translateY(-50%);
            width: 13px; height: 13px;
            stroke: var(--text-faint); fill: none; stroke-width: 2;
            pointer-events: none;
        }
        .sidebar-search {
            width: 100%;
            background: var(--bg-3);
            border: 1px solid var(--border-soft);
            border-radius: 7px;
            padding: 0.48rem 0.75rem 0.48rem 2rem;
            font-size: 0.78rem;
            color: var(--text);
            font-family: var(--font-body);
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .sidebar-search::placeholder { color: var(--text-faint); }
        .sidebar-search:focus { border-color: var(--border); box-shadow: 0 0 0 2px var(--accent-dim); }
        #docTocNav ul { list-style: none; padding: 0; margin: 0; }
        #docTocNav li { margin: 0; }
        #docTocNav a {
            display: block;
            padding: 0.3rem 0.65rem;
            font-size: 0.78rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 5px;
            border-left: 2px solid transparent;
            transition: color 0.15s, background 0.15s, border-color 0.15s;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        #docTocNav a:hover { color: var(--text); background: var(--accent-dim); border-left-color: var(--border); }
        #docTocNav li.toc-active > a { color: var(--accent-text); border-left-color: var(--accent); background: var(--accent-dim); }
        #docTocNav ul ul { padding-left: 0.85rem; }
        #docTocNav ul ul a { font-size: 0.73rem; font-weight: 400; color: var(--text-faint); }
        #docTocNav ul ul a:hover { color: var(--text-muted); }
        .toc-no-results { font-size: 0.75rem; color: var(--text-faint); padding: 0.5rem 0.65rem; display: none; }

        .docs-topbar {
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; margin-bottom: 1.25rem; flex-wrap: wrap;
        }
        .docs-breadcrumb { display: flex; align-items: center; gap: 0.4rem; font-size: 0.78rem; color: var(--text-faint); }
        .docs-breadcrumb a { color: var(--accent-text); text-decoration: none; }
        .docs-breadcrumb a:hover { color: var(--accent); }
        .docs-breadcrumb svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }
        .docs-actions { display: flex; align-items: center; gap: 0.6rem; }
        .btn-doc {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.42rem 0.85rem;
            background: var(--bg-2); border: 1px solid var(--border-soft); border-radius: 7px;
            font-size: 0.76rem; color: var(--text-faint); text-decoration: none; cursor: pointer;
            font-family: var(--font-body); transition: color 0.15s, border-color 0.15s;
        }
        .btn-doc:hover { color: var(--text); border-color: var(--border); }
        .btn-doc svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }
        .reading-badge { font-size: 0.72rem; color: var(--text-faint); display: flex; align-items: center; gap: 0.3rem; }
        .reading-badge svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2; }

        .docs-content {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            padding: 2.5rem 3rem;
            min-width: 0;
            overflow-x: hidden;
        }
        @media (max-width: 640px) { .docs-content { padding: 1.25rem 1rem; } }

        .docs-content h1 {
            font-family: var(--font-display); font-size: 1.9rem; font-weight: 500;
            color: var(--text); letter-spacing: -0.01em; margin: 0 0 0.5rem;
            padding-bottom: 0.75rem; border-bottom: 1px solid var(--border-soft);
            line-height: 1.2; scroll-margin-top: 5rem;
        }
        .docs-content h2 {
            font-family: var(--font-display); font-size: 1.35rem; font-weight: 500;
            color: var(--text); margin: 2.25rem 0 0.65rem;
            padding-bottom: 0.35rem; border-bottom: 1px solid var(--border-soft);
            scroll-margin-top: 5rem;
        }
        .docs-content h3 {
            font-family: var(--font-display); font-size: 1.05rem; font-weight: 500;
            color: var(--text); margin: 1.5rem 0 0.45rem; scroll-margin-top: 5rem;
        }
        .docs-content h4 {
            font-size: 0.875rem; font-weight: 500; color: var(--text-muted);
            margin: 1.1rem 0 0.35rem; letter-spacing: 0.03em;
        }
        .docs-content p { font-size: 0.9rem; line-height: 1.85; color: var(--text-muted); margin: 0.6rem 0; }
        .docs-content blockquote {
            background: var(--accent-dim); border-left: 3px solid var(--accent);
            border-radius: 0 8px 8px 0; margin: 1rem 0; padding: 0.85rem 1.1rem;
        }
        .docs-content blockquote p { margin: 0; color: var(--accent-text); font-size: 0.85rem; }
        .docs-content blockquote strong { color: var(--accent-text); }
        .docs-content ul, .docs-content ol { margin: 0.6rem 0 0.6rem 1.25rem; display: flex; flex-direction: column; gap: 0.28rem; }
        .docs-content li { font-size: 0.875rem; line-height: 1.75; color: var(--text-muted); }
        .docs-content ul li::marker { color: var(--accent); }
        .docs-content ol li::marker { color: var(--accent-text); font-weight: 500; }
        .docs-content table { width: 100%; border-collapse: collapse; font-size: 0.84rem; margin: 1rem 0; border: 1px solid var(--border-soft); border-radius: 8px; overflow: hidden; }
        .docs-content thead th { background: var(--bg-3); padding: 0.55rem 0.9rem; text-align: left; font-size: 0.65rem; font-weight: 500; letter-spacing: 0.12em; text-transform: uppercase; color: var(--text-faint); border-bottom: 1px solid var(--border-soft); }
        .docs-content tbody td { padding: 0.65rem 0.9rem; color: var(--text-muted); border-bottom: 1px solid var(--border-soft); line-height: 1.5; }
        .docs-content tbody tr:last-child td { border-bottom: none; }
        .docs-content tbody tr:hover td { background: var(--accent-dim); color: var(--text); }
        .docs-content code { font-family: var(--font-mono, monospace); font-size: 0.82em; background: var(--bg-3); color: var(--accent-text); padding: 0.15em 0.45em; border-radius: 4px; border: 1px solid var(--border-soft); }
        .docs-content pre { background: var(--bg-3); border: 1px solid var(--border-soft); border-radius: 10px; padding: 1.1rem 1.35rem; overflow-x: auto; margin: 0.85rem 0; position: relative; }
        .docs-content pre code { background: none; border: none; padding: 0; font-size: 0.81rem; color: var(--text-muted); line-height: 1.7; }
        .docs-content hr { border: none; border-top: 1px solid var(--border-soft); margin: 1.75rem 0; }
        .docs-content strong { color: var(--text); font-weight: 500; }
        .docs-content a { color: var(--accent-text); text-decoration: underline; text-underline-offset: 3px; }
        .docs-content a:hover { color: var(--accent); }
        .docs-content mark { background: rgba(251,191,36,0.3); color: var(--text); border-radius: 2px; padding: 0 2px; }
        .code-copy-btn {
            position: absolute; top: 0.6rem; right: 0.6rem;
            display: inline-flex; align-items: center; gap: 0.3rem;
            padding: 0.22rem 0.55rem; background: var(--bg-2);
            border: 1px solid var(--border-soft); border-radius: 5px;
            font-size: 0.66rem; color: var(--text-faint); cursor: pointer;
            font-family: var(--font-body); transition: color 0.15s, border-color 0.15s;
        }
        .code-copy-btn:hover { color: var(--accent-text); border-color: var(--border); }
        .code-copy-btn svg { width: 11px; height: 11px; stroke: currentColor; fill: none; stroke-width: 2; }

        @media print {
            .docs-sidebar, .docs-topbar, .app-sidebar, .app-topbar, .code-copy-btn { display: none !important; }
            .app-main { margin-left: 0 !important; }
            .docs-wrap { grid-template-columns: 1fr !important; }
            .docs-content { border: none !important; padding: 0 !important; background: white !important; color: #111 !important; }
            .docs-content h1, .docs-content h2, .docs-content h3 { color: #111 !important; }
            .docs-content p, .docs-content li, .docs-content td { color: #333 !important; }
            .docs-content pre, .docs-content code { background: #f4f4f4 !important; color: #333 !important; border: 1px solid #ddd !important; }
            .docs-content blockquote { background: #f9f9f9 !important; border-left-color: #999 !important; }
        }
    </style>

    <div class="docs-topbar">
        <div class="docs-breadcrumb">
            <a href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
            <svg viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            <span>MLM Config Guide</span>
        </div>
        <div class="docs-actions">
            <span class="reading-badge" id="readingBadge">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                …
            </span>
            <a href="{{ route('admin.mlm-settings') }}" wire:navigate class="btn-doc">
                <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 0 1 0 14.14M4.93 4.93a10 10 0 0 0 0 14.14"/></svg>
                Open Settings
            </a>
            <button onclick="window.print()" class="btn-doc">
                <svg viewBox="0 0 24 24"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect x="6" y="14" width="12" height="8"/></svg>
                PDF
            </button>
        </div>
    </div>

    <div class="docs-wrap">
        <aside class="docs-sidebar">
            <div class="sidebar-heading">On this page</div>
            <div class="sidebar-search-wrap">
                <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                <input type="text" id="docSearch" placeholder="Search…" class="sidebar-search">
            </div>
            <div class="toc-no-results" id="tocNoResults">No matches</div>
            <nav id="docTocNav"></nav>
        </aside>

        <main class="docs-content" id="docContent">
            {!! $html !!}
        </main>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const content = document.getElementById('docContent');
        const nav = document.getElementById('docTocNav');

        // 1. Assign IDs to headings
        content.querySelectorAll('h1,h2,h3').forEach(h => {
            if (!h.id) {
                h.id = h.textContent.trim().toLowerCase()
                    .replace(/[^\w\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-');
            }
        });

        // 2. Build TOC
        const headings = Array.from(content.querySelectorAll('h1,h2,h3'));
        const root = document.createElement('ul');
        let h1Li = null, h2Li = null;
        headings.forEach(h => {
            const li = document.createElement('li');
            const a = document.createElement('a');
            a.href = '#' + h.id;
            a.textContent = h.textContent.replace(/^#+\s*/,'').trim();
            a.addEventListener('click', e => {
                e.preventDefault();
                document.getElementById(h.id)?.scrollIntoView({behavior:'smooth',block:'start'});
                history.pushState(null,'','#'+h.id);
            });
            li.appendChild(a);
            if (h.tagName === 'H1') {
                root.appendChild(li); h1Li = li; h2Li = null;
            } else if (h.tagName === 'H2') {
                const p = h1Li || root;
                let sub = p.querySelector(':scope > ul');
                if (!sub) { sub = document.createElement('ul'); p.appendChild(sub); }
                sub.appendChild(li); h2Li = li;
            } else {
                const p = h2Li || h1Li;
                if (p) {
                    let sub = p.querySelector(':scope > ul');
                    if (!sub) { sub = document.createElement('ul'); p.appendChild(sub); }
                    sub.appendChild(li);
                } else root.appendChild(li);
            }
        });
        nav.appendChild(root);

        // 3. Scroll spy
        new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    nav.querySelectorAll('li').forEach(l => l.classList.remove('toc-active'));
                    nav.querySelector(`a[href="#${e.target.id}"]`)?.closest('li').classList.add('toc-active');
                }
            });
        }, {rootMargin:'-8% 0px -78% 0px'}).observe || headings.forEach(h =>
            new IntersectionObserver(entries => {
                if (entries[0].isIntersecting) {
                    nav.querySelectorAll('li').forEach(l => l.classList.remove('toc-active'));
                    nav.querySelector(`a[href="#${h.id}"]`)?.closest('li').classList.add('toc-active');
                }
            }, {rootMargin:'-8% 0px -78% 0px'}).observe(h)
        );
        // Fix: proper observer
        const spy = new IntersectionObserver(entries => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    nav.querySelectorAll('li').forEach(l => l.classList.remove('toc-active'));
                    nav.querySelector('a[href="#'+e.target.id+'"]')?.closest('li').classList.add('toc-active');
                }
            });
        }, {rootMargin:'-8% 0px -78% 0px'});
        headings.forEach(h => spy.observe(h));

        // 4. Reading time
        const words = content.textContent.trim().split(/\s+/).length;
        const mins = Math.max(1, Math.round(words / 200));
        document.getElementById('readingBadge').innerHTML =
            '<svg viewBox="0 0 24 24" style="width:12px;height:12px;stroke:currentColor;fill:none;stroke-width:2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg> '+mins+' min read';

        // 5. Copy buttons
        function addCopyBtns() {
            content.querySelectorAll('pre').forEach(pre => {
                if (pre.querySelector('.code-copy-btn')) return;
                const btn = document.createElement('button');
                btn.className = 'code-copy-btn';
                btn.innerHTML = '<svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Copy';
                btn.onclick = () => {
                    navigator.clipboard.writeText(pre.querySelector('code')?.textContent || '').then(() => {
                        btn.innerHTML = '<svg viewBox="0 0 24 24" style="stroke:var(--success)"><polyline points="20 6 9 17 4 12"/></svg> Copied';
                        setTimeout(() => btn.innerHTML = '<svg viewBox="0 0 24 24"><rect x="9" y="9" width="13" height="13" rx="2"/><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/></svg> Copy', 2000);
                    });
                };
                pre.appendChild(btn);
            });
        }
        addCopyBtns();

        // 6. Syntax highlight
        content.querySelectorAll('pre code').forEach(b => {
            let h = b.innerHTML;
            h = h.replace(/(\/\/[^\n<]*)/g,'<em style="color:var(--text-faint);font-style:italic">$1</em>');
            h = h.replace(/\b(true|false|null|return|function|class|new|use|namespace|public|private|protected|static|if|else|foreach|array|string|int|bool|void)\b/g,'<span style="color:var(--accent-text);font-weight:500">$1</span>');
            h = h.replace(/(&#039;)([^<]*?)(&#039;)/g,'<span style="color:var(--success)">$1$2$3</span>');
            h = h.replace(/(?<![a-zA-Z#-])\b(\d+)\b(?![a-zA-Z])/g,'<span style="color:var(--warning)">$1</span>');
            b.innerHTML = h;
        });

        // 7. In-page search
        const searchInput = document.getElementById('docSearch');
        const noRes = document.getElementById('tocNoResults');
        const origHTML = content.innerHTML;
        searchInput.addEventListener('input', () => {
            const q = searchInput.value.trim();
            content.innerHTML = origHTML;
            addCopyBtns();
            if (!q) { noRes.style.display='none'; nav.querySelectorAll('li').forEach(l=>l.style.display=''); return; }
            const rx = new RegExp('('+q.replace(/[.*+?^${}()|[\]\\]/g,'\\$&')+')','gi');
            let cnt = 0;
            (function walk(n) {
                if (n.nodeType===3) {
                    if (rx.test(n.textContent)) {
                        cnt += (n.textContent.match(rx)||[]).length;
                        const s = document.createElement('span');
                        s.innerHTML = n.textContent.replace(rx,'<mark>$1</mark>');
                        n.parentNode.replaceChild(s,n);
                    }
                } else if (n.nodeType===1 && !['SCRIPT','STYLE','PRE','CODE'].includes(n.tagName)) {
                    Array.from(n.childNodes).forEach(walk);
                }
            })(content);
            noRes.style.display = cnt===0?'block':'none';
            nav.querySelectorAll('li').forEach(li => {
                li.style.display = li.querySelector('a')?.textContent.toLowerCase().includes(q.toLowerCase()) ? '' : 'none';
            });
            content.querySelector('mark')?.scrollIntoView({behavior:'smooth',block:'center'});
        });

        // 8. Hash jump on load
        if (window.location.hash) {
            setTimeout(() => document.querySelector(window.location.hash)?.scrollIntoView({behavior:'smooth',block:'start'}), 200);
        }
    });
    </script>
</x-app-layout>