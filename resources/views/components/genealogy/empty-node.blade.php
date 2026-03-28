<div style="
    border: 1.5px dashed var(--border-soft);
    border-radius: 10px;
    padding: 0.55rem 0.85rem;
    min-width: 130px;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.35rem;
    opacity: 0.5;
    font-size: 0.68rem;
    color: var(--text-faint);
    font-family: var(--font-body);
    transition: opacity 0.2s, border-color 0.2s;
">
    <svg viewBox="0 0 24 24" style="width:11px;height:11px;stroke:currentColor;fill:none;stroke-width:2;flex-shrink:0;">
        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="16"/><line x1="8" y1="12" x2="16" y2="12"/>
    </svg>
    {{ ucfirst($position) }} Empty
</div>