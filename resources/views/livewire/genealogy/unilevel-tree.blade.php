@if (!$node || empty($node['user']))
    {{-- Safety: render nothing for empty nodes --}}
@else
    @php
        $levelStyles = [
            1 => 'background: var(--accent);      border-color: var(--accent);      color: var(--bg);',
            2 => 'background: var(--accent-dim);  border-color: var(--border);      color: var(--accent-text);',
            3 => 'background: var(--bg-3);        border-color: var(--border);      color: var(--text-muted);',
            4 => 'background: var(--bg-3);        border-color: var(--border-soft); color: var(--text-faint);',
            5 => 'background: var(--bg-2);        border-color: var(--border-soft); color: var(--text-faint);',
        ];
        $nodeStyle =
            $levelStyles[$node['level']] ??
            'background: var(--bg-2); border-color: var(--border-soft); color: var(--text-faint);';
        $hasChildren = !empty($node['children']);
        $indent = ($node['level'] - 1) * 28;
    @endphp
    <a href="{{ route('member.profile', $node['user']->id) }}" class="action-link action-view" wire:navigate>
        <div style="position: relative; margin-left: {{ min($indent, 112) }}px;">

            {{-- Vertical connector line running down the left side through children --}}
            @if ($hasChildren)
                <div
                    style="
                position: absolute;
                left: -16px;
                top: 28px;
                width: 1px;
                height: calc(100% - 28px);
                background: var(--border-soft);
            ">
                </div>
            @endif

            {{-- ── NODE ROW ── --}}
            <div
                style="display: flex; align-items: center; gap: 0; margin-bottom: {{ $hasChildren ? '0.75rem' : '0' }};">

                {{-- Horizontal tick from vertical line to node --}}
                @if ($node['level'] > 1)
                    <div style="width: 16px; height: 1px; background: var(--border-soft); flex-shrink: 0;"></div>
                @endif

                {{-- Node --}}
                <div wire:click="selectUser({{ $node['user']->id }})"
                    style="
                    {{ $nodeStyle }}
                    border: 1px solid;
                    border-radius: 10px;
                    padding: 0.4rem 0.85rem;
                    min-width: 120px;
                    font-size: 0.75rem;
                    font-family: var(--font-body);
                    cursor: pointer;
                    transition: border-color 0.2s, transform 0.15s, box-shadow 0.2s;
                    position: relative;
                    z-index: 1;
                "
                    onmouseover="
                    this.style.transform='translateX(3px)';
                    this.style.boxShadow='0 2px 12px rgba(0,0,0,0.15)';
                "
                    onmouseout="
                    this.style.transform='';
                    this.style.boxShadow='';
                ">
                    <div
                        style="font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 120px;">
                        {{ $node['user']->username }}
                    </div>
                    <div style="font-size: 0.62rem; opacity: 0.7; margin-top: 0.1rem;">
                        Level {{ $node['level'] }}
                    </div>
                </div>

            </div>

            {{-- ── CHILDREN ── --}}
            @if ($hasChildren)
                <div style="display: flex; flex-direction: column; gap: 0.6rem; margin-left: 16px;">
                    @foreach ($node['children'] as $child)
                        @include('livewire.genealogy.unilevel-tree', ['node' => $child])
                    @endforeach
                </div>
            @endif

        </div>
    </a>
@endif
