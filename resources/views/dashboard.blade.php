<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Wallet Balance -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500">Wallet Balance</p>
                                <p class="text-2xl font-bold text-gray-900">
                                    ${{ number_format(auth()->user()->mainWallet?->balance ?? 0, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Commissions -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500">Total Commissions</p>
                                <p class="text-2xl font-bold text-green-600">
                                    ${{ number_format(auth()->user()->commissions()->sum('amount'), 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Direct Referrals -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500">Direct Referrals</p>
                                <p class="text-2xl font-bold text-blue-600">
                                    {{ auth()->user()->downlines()->count() }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Current Rank -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-gray-500">Current Rank</p>
                                <p class="text-2xl font-bold" style="color: {{ auth()->user()->rank?->badge_color ?? '#000' }}">
                                    {{ auth()->user()->rank?->name ?? 'Member' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Referral Link -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Your Referral Link</h3>
                    <div class="flex items-center gap-4">
                        <input 
                            type="text" 
                            readonly 
                            value="{{ url('/register?ref=' . auth()->user()->referral_code) }}"
                            class="flex-1 px-4 py-2 border border-gray-300 rounded-lg bg-gray-50"
                            id="referralLink"
                        >
                        <button 
                            onclick="copyReferralLink()"
                            class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                        >
                            Copy
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Commissions -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Commissions</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">From</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse(auth()->user()->commissions()->latest()->take(10)->get() as $commission)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $commission->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ ucfirst($commission->type) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $commission->fromUser->name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                                            ${{ number_format($commission->amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 py-1 text-xs rounded-full 
                                                @if($commission->status === 'paid') bg-green-100 text-green-800
                                                @elseif($commission->status === 'approved') bg-blue-100 text-blue-800
                                                @else bg-yellow-100 text-yellow-800
                                                @endif">
                                                {{ ucfirst($commission->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                            No commissions yet
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyReferralLink() {
            const input = document.getElementById('referralLink');
            input.select();
            document.execCommand('copy');
            alert('Referral link copied to clipboard!');
        }
    </script>
</x-app-layout>
