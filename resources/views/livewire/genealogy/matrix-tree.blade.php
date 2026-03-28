@if (!$node || empty($node['user']))
    {{-- Safety: render nothing for empty nodes --}}
@else
    @php
        // Map levels to theme-relative accent shades using CSS custom properties
        // Level 1 uses the primary accent, deeper levels fade toward muted tones
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
    @endphp
    <a href="{{ route('member.profile', $node['user']->id) }}" class="action-link action-view" wire:navigate>
        <div style="display:flex; flex-direction:column; align-items:center; position:relative;">

            {{-- ── NODE ── --}}
            <div wire:click="selectUser({{ $node['user']->id }})"
                style="
                {{ $nodeStyle }}
                border: 1px solid;
                border-radius: 10px;
                padding: 0.45rem 0.85rem;
                min-width: 120px;
                text-align: center;
                cursor: pointer;
                font-size: 0.75rem;
                font-family: var(--font-body);
                margin-bottom: {{ $hasChildren ? '0' : '0' }};
                transition: border-color 0.2s, transform 0.15s, box-shadow 0.2s;
                position: relative;
                z-index: 1;
            "
                onmouseover="
                this.style.transform='translateY(-2px)';
                this.style.boxShadow='0 4px 16px var(--accentGlow, rgba(0,0,0,0.2))';
            "
                onmouseout="
                this.style.transform='';
                this.style.boxShadow='';
            ">
                <div
                    style="font-weight: 600; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 100px;">
                    {{ $node['user']->username }}
                </div>
                <div style="font-size: 0.62rem; opacity: 0.7; margin-top: 0.15rem;">
                    Level {{ $node['level'] }}
                </div>
            </div>

            {{-- ── VERTICAL CONNECTOR down from node ── --}}
            @if ($hasChildren)
                <div style="width: 1px; height: 16px; background: var(--border); flex-shrink: 0;"></div>
            @endif

            {{-- ── CHILDREN ── --}}
            @if ($hasChildren)
                <div style="position: relative;">

                    {{-- Horizontal bridge line across all children --}}
                    @if (count($node['children']) > 1)
                        <div
                            style="
                        position: absolute;
                        top: 0; left: 0; right: 0;
                        height: 1px;
                        background: var(--border);
                    ">
                        </div>
                    @endif

                    {{-- Children row --}}
                    <div style="display: flex; justify-content: center; gap: 24px; padding-top: 16px;">
                        @foreach ($node['children'] as $child)
                            <div
                                style="position: relative; display: flex; flex-direction: column; align-items: center;">

                                {{-- Vertical drop from horizontal bridge to child --}}
                                <div
                                    style="
                                position: absolute;
                                top: -16px; left: 50%;
                                width: 1px; height: 16px;
                                background: var(--border);
                            ">
                                </div>

                                @include('livewire.genealogy.matrix-tree', ['node' => $child])
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>
    </a>
@endif
