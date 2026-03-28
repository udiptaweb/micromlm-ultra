<div>
    <style>
        /* ── Page header ── */
        .genealogy-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }
        .genealogy-title {
            font-family: var(--font-display);
            font-size: 1.6rem;
            font-weight: 500;
            color: var(--text);
            letter-spacing: 0.01em;
            margin-bottom: 0.35rem;
        }
        .genealogy-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            flex-wrap: wrap;
        }
        .meta-pill {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.28rem 0.75rem;
            border-radius: 4px;
            font-size: 0.72rem;
            font-weight: 500;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            background: var(--accent-dim);
            color: var(--accent-text);
            border: 1px solid var(--border);
        }
        .meta-pill svg { width: 12px; height: 12px; stroke: currentColor; fill: none; stroke-width: 2; }

        .meta-divider {
            width: 1px; height: 14px;
            background: var(--border-soft);
        }

        /* ── Tree container ── */
        .tree-container {
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 12px;
            overflow-x: auto;
            overflow-y: auto;
            padding: 2.5rem 2rem;
            min-height: 300px;
        }

        /* ── Node ── */
        .binary-node {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .node {
            background: var(--accent-dim);
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 0.55rem 0.85rem;
            text-align: center;
            min-width: 130px;
            position: relative;
            transition: border-color 0.2s, transform 0.15s;
            cursor: default;
        }
        .node:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
        }

        /* Root node is more prominent */
        .node.is-root {
            background: var(--accent);
            border-color: var(--accent);
        }
        .node.is-root .node-username { color: var(--bg); }
        .node.is-root .node-rank     { color: var(--bg); opacity: 0.8; }
        .node.is-root .node-meta     { color: var(--bg); opacity: 0.75; }

        .node-username {
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--accent-text);
            margin-bottom: 0.2rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 110px;
        }

        .node-rank {
            font-size: 0.65rem;
            color: var(--text-faint);
            margin-bottom: 0.25rem;
            white-space: nowrap;
        }

        .node-meta {
            display: flex;
            justify-content: space-between;
            gap: 0.5rem;
            font-size: 0.62rem;
            color: var(--text-faint);
        }
        .node-meta span {
            display: inline-flex;
            align-items: center;
            gap: 0.2rem;
        }

        /* ── Connectors ── */
        .connector {
            width: 160px;
            height: 24px;
            position: relative;
            flex-shrink: 0;
        }

        .connector .down {
            position: absolute;
            left: 50%;
            top: 0;
            height: 24px;
            width: 2px;
            margin-left: -1px;
            background: linear-gradient(to bottom, var(--accent), var(--accentLight, var(--accent)));
            opacity: 0.6;
            border-radius: 0 0 2px 2px;
        }

        .connector .left,
        .connector .right {
            position: absolute;
            top: 24px;
            width: 80px;
            height: 2px;
            opacity: 0.5;
        }

        .connector .left {
            left: 0;
            background: linear-gradient(to right, transparent, var(--accent));
        }

        .connector .right {
            right: 0;
            background: linear-gradient(to left, transparent, var(--accent));
        }

        /* Single child connector */
        .connector.single .down {
            left: 50%;
        }

        /* ── Children row ── */
        .children {
            display: flex;
            gap: 60px;
            margin-top: 4px;
        }

        .child {
            display: flex;
            justify-content: center;
        }

        /* ── Empty slot ── */
        .empty-node {
            border: 1px dashed var(--border-soft);
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-size: 0.65rem;
            color: var(--text-faint);
            min-width: 130px;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            opacity: 0.6;
        }
        .empty-node svg { width: 11px; height: 11px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Unilevel / Matrix overrides ── */
        .unilevel-node {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .unilevel-children {
            display: flex;
            gap: 32px;
            margin-top: 4px;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* ── Scroll hint ── */
        .scroll-hint {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.72rem;
            color: var(--text-faint);
            margin-bottom: 0.75rem;
        }
        .scroll-hint svg { width: 13px; height: 13px; stroke: currentColor; fill: none; stroke-width: 2; }

        /* ── Zoom controls ── */
        .tree-controls {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .zoom-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 30px; height: 30px;
            background: var(--bg-2);
            border: 1px solid var(--border-soft);
            border-radius: 6px;
            color: var(--text-muted);
            font-size: 1rem;
            cursor: pointer;
            transition: border-color 0.2s, color 0.2s;
            line-height: 1;
        }
        .zoom-btn:hover { border-color: var(--border); color: var(--text); }
        .zoom-label {
            font-size: 0.75rem;
            color: var(--text-faint);
            min-width: 32px;
            text-align: center;
        }

        .tree-inner {
            transform-origin: top center;
            transition: transform 0.2s ease;
            display: inline-block;
            min-width: 100%;
        }
    </style>

    {{-- ═══ PAGE HEADER ═══ --}}
    <div class="genealogy-header">
        <div>
            <div class="genealogy-title">Genealogy Tree</div>
            <div class="genealogy-meta">
                <div class="meta-pill">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="5" cy="19" r="2"/><circle cx="19" cy="19" r="2"/><line x1="12" y1="7" x2="12" y2="12"/><line x1="12" y1="12" x2="5" y2="17"/><line x1="12" y1="12" x2="19" y2="17"/></svg>
                    {{ ucfirst($planType) }} Plan
                </div>
                <div class="meta-divider"></div>
                <div class="meta-pill" style="background: rgba(74,222,128,0.08); color: var(--success); border-color: rgba(74,222,128,0.2);">
                    <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    {{ $totalNetwork }} Members
                </div>
            </div>
        </div>

        {{-- Zoom controls --}}
        <div class="tree-controls">
            <button class="zoom-btn" onclick="zoomTree(-0.1)" title="Zoom out">−</button>
            <span class="zoom-label" id="zoomLabel">100%</span>
            <button class="zoom-btn" onclick="zoomTree(0.1)" title="Zoom in">+</button>
            <button class="zoom-btn" onclick="resetZoom()" title="Reset" style="font-size:0.7rem; padding: 0 4px; width: auto; min-width:30px;">Reset</button>
        </div>
    </div>

    {{-- Scroll hint on mobile --}}
    <div class="scroll-hint" style="display:none;" id="scrollHint">
        <svg viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
        Scroll horizontally to see the full tree
    </div>

    {{-- ═══ TREE CONTAINER ═══ --}}
    <div class="tree-container" id="treeContainer">
        <div class="tree-inner" id="treeInner">
            @if($planType === 'binary')
                @include('livewire.genealogy.binary-tree', ['node' => $tree])
            @elseif($planType === 'matrix')
                @include('livewire.genealogy.matrix-tree', ['node' => $tree])
            @else
                @include('livewire.genealogy.unilevel-tree', ['node' => $tree])
            @endif
        </div>
    </div>

    <script>
        let scale = 1;

        function zoomTree(delta) {
            scale = Math.min(1.5, Math.max(0.3, scale + delta));
            document.getElementById('treeInner').style.transform = `scale(${scale})`;
            document.getElementById('zoomLabel').textContent = Math.round(scale * 100) + '%';
        }

        function resetZoom() {
            scale = 1;
            document.getElementById('treeInner').style.transform = 'scale(1)';
            document.getElementById('zoomLabel').textContent = '100%';
        }

        // Show scroll hint on narrow screens
        if (window.innerWidth < 768) {
            document.getElementById('scrollHint').style.display = 'flex';
        }
    </script>
</div>