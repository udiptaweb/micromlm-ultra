@if ($node)
    <a href="{{ route('member.profile', $node['user']->id) }}" class="action-link action-view" wire:navigate>
        <div class="binary-node level-{{ $node['level'] }}">

            {{-- NODE --}}
            <div class="node-box">
                <x-genealogy.node :user="$node['user']" :level="$node['level']" />
            </div>

            {{-- CONNECTORS — only render if at least one child exists --}}
            @if ($node['left'] || $node['right'])
                @if ($node['left'] && $node['right'])
                    {{-- Both children: full T-connector --}}
                    <div class="connector">
                        <div class="down"></div>
                        <div class="left"></div>
                        <div class="right"></div>
                    </div>
                @elseif ($node['left'])
                    {{-- Left only: straight down + half-left branch --}}
                    <div class="connector">
                        <div class="down"></div>
                        <div class="left"></div>
                    </div>
                @else
                    {{-- Right only: straight down + half-right branch --}}
                    <div class="connector">
                        <div class="down"></div>
                        <div class="right"></div>
                    </div>
                @endif
            @endif

            {{-- CHILDREN --}}
            @if ($node['left'] || $node['right'])
                <div class="children">
                    <div class="child">
                        @if ($node['left'])
                            @include('livewire.genealogy.binary-tree', ['node' => $node['left']])
                        @else
                            <x-genealogy.empty-node position="Left" />
                        @endif
                    </div>

                    <div class="child">
                        @if ($node['right'])
                            @include('livewire.genealogy.binary-tree', ['node' => $node['right']])
                        @else
                            <x-genealogy.empty-node position="Right" />
                        @endif
                    </div>
                </div>
            @endif

        </div>
    </a>
@endif
