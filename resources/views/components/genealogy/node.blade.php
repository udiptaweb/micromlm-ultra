@props(['user', 'level'])

@php
$levelStyles = [
    1 => 'background: var(--accent);      border-color: var(--accent);      color: var(--bg);',
    2 => 'background: var(--accent-dim);  border-color: var(--border);      color: var(--accent-text);',
    3 => 'background: var(--bg-3);        border-color: var(--border);      color: var(--text-muted);',
    4 => 'background: var(--bg-3);        border-color: var(--border-soft); color: var(--text-faint);',
    5 => 'background: var(--bg-2);        border-color: var(--border-soft); color: var(--text-faint);',
];
$nodeStyle = $levelStyles[$level] ?? 'background: var(--bg-2); border-color: var(--border-soft); color: var(--text-faint);';
@endphp

<div class="node"
     style="{{ $nodeStyle }} border: 1px solid; border-radius: 10px; padding: 0.45rem 0.85rem; min-width: 130px; text-align: center; transition: transform 0.15s, box-shadow 0.2s;"
     onmouseover="this.style.transform='translateY(-2px)';this.style.boxShadow='0 4px 16px rgba(0,0,0,0.2)';"
     onmouseout="this.style.transform='';this.style.boxShadow='';">

    <div class="username" style="font-weight: 600; font-size: 0.78rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 110px; margin: 0 auto;">
        {{ $user->username ?? $user->name }}
    </div>

    <div class="meta" style="display: flex; justify-content: space-between; font-size: 0.62rem; opacity: 0.75; margin-top: 0.2rem;">
        <span>L{{ $level }}</span>
        <span>{{ strtoupper($user->binary_position ?? '-') }}</span>
    </div>

    <div class="rank" style="font-size: 0.62rem; opacity: 0.7; margin-top: 0.15rem;">
        {{ $user->rank?->name ?? 'Member' }}
    </div>

</div>