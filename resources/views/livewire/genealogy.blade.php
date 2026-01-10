<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Genealogy Tree</h2>
                    <div class="text-sm text-gray-600">
                        Total Network: <span class="font-semibold text-indigo-600">{{ $totalNetwork }}</span>
                    </div>
                </div>

                <!-- Root User -->
                <div class="mb-8">
                    <div class="inline-flex items-center px-6 py-4 bg-indigo-100 rounded-lg border-2 border-indigo-500">
                        <div>
                            <div class="font-bold text-lg text-indigo-900">{{ auth()->user()->name }}</div>
                            <div class="text-sm text-indigo-700">{{ auth()->user()->username }}</div>
                            <div class="text-xs text-indigo-600 mt-1">{{ auth()->user()->rank?->name ?? 'Member' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Downlines -->
                @if($downlines->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($downlines as $downline)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                                <div class="flex items-start justify-between mb-3">
                                    <div>
                                        <h3 class="font-bold text-gray-900">{{ $downline->name }}</h3>
                                        <p class="text-sm text-gray-600">{{ $downline->username }}</p>
                                    </div>
                                    @if($downline->position)
                                        <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800">
                                            {{ ucfirst($downline->position) }}
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="space-y-1 text-sm text-gray-600">
                                    <div class="flex justify-between">
                                        <span>Rank:</span>
                                        <span class="font-medium" style="color: {{ $downline->rank?->badge_color ?? '#000' }}">
                                            {{ $downline->rank?->name ?? 'Member' }}
                                        </span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Direct Referrals:</span>
                                        <span class="font-medium text-gray-900">{{ $downline->downlines->count() }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Joined:</span>
                                        <span class="font-medium text-gray-900">{{ $downline->created_at->format('M d, Y') }}</span>
                                    </div>
                                </div>

                                @if($downline->downlines->count() > 0)
                                    <div class="mt-3 pt-3 border-t border-gray-200">
                                        <p class="text-xs text-gray-500">
                                            Has {{ $downline->downlines->count() }} direct referral(s)
                                        </p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-gray-900">No downlines yet</h3>
                        <p class="mt-1 text-sm text-gray-500">Start by sharing your referral link to build your network.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
