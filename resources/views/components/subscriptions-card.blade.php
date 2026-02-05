@props([
'subscriptions' => collect(),
'totalSubscriptions' => 0
])
@php
$categoryStyles = config('subscription-icons');
@endphp
<div class="card">
    <!-- Header -->
    <div class="section-header flex items-start justify-between mb-5">
        <div class="flex flex-col">
            <h2 class="section-title">Subscriptions</h2>
            <p class="text-sm text-gray-500">
                Total per month:
                <span class="font-semibold text-emerald-600">
                    ₱{{ number_format($totalSubscriptions, 2) }}
                </span>
            </p>
        </div>

        <a href="#addSubscriptionModal" class="add-btn btn-sm flex items-center gap-1" aria-label="Add Subscription">
            <i class="bi bi-plus"></i>
            <span>Add</span>
        </a>
    </div>

    <!-- List -->
    <ul class="list">
        @forelse ($subscriptions as $subscription)

        @php
        $categoryStyles = config('subscription-icons');

        $rawCategory = strtolower(trim($subscription->category ?? ''));

        $categoryKey = array_key_exists($rawCategory, $categoryStyles)
        ? $rawCategory
        : 'other';

        $style = $categoryStyles[$categoryKey];

        $billingDate = \Carbon\Carbon::parse($subscription->billing_date)->startOfDay();
        $today = now()->startOfDay();
        $dueIn = (int) $today->diffInDays($billingDate, false);
        $cutoff = $billingDate->day <= 15 ? '1st' : '2nd' ; 
        @endphp
         <li
            class="subscription-item flex items-center justify-between rounded-xl bg-gray-50 p-4">
            <div class="flex items-center gap-4">
                <div class="h-10 w-11 rounded-full flex items-center justify-center
                            {{ $style['bg'] }} {{ $style['text'] }}">
                    <i class="bi {{ $style['icon'] }}"></i>
                </div>

                <div>
                    <p class="font-medium">{{ ucfirst($subscription->name) }}</p>

                    <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500">
                        <span class="px-3 py-1 rounded-full">
                            {{ ucfirst($subscription->billing_cycle) }}
                        </span>

                        <span class="px-3 py-1 rounded-full">
                            {{ $cutoff }} Cut-off
                        </span>

                        <span class="px-3 py-1 rounded-full">
                            {{ $billingDate->format('M d, Y') }}
                        </span>
                    </div>

                    <p class="text-xs text-gray-400 px-2">
                        Due in:
                        <span class="font-medium {{ $dueIn <= 0 ? 'text-rose-500' : 'text-blue-500' }}">
                            {{ $dueIn === 0
                            ? 'Today'
                            : ($dueIn < 0 ? 'Overdue' : $dueIn . ' days' ) }} </span>
                    </p>
                </div>
            </div>

            <div class="flex flex-col items-end gap-2">
                <div class="flex items-center gap-4">
                    <span class="font-semibold text-emerald-600">
                        ₱{{ number_format($subscription->amount, 2) }}
                    </span>

                    <form method="POST" action="{{ route('subscriptions.destroy', $subscription) }}">
                        @csrf
                        @method('DELETE')
                        <button class="text-gray-400 hover:text-red-500">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>

                <!-- Active Toggle -->
                <form method="POST" action="{{ route('subscriptions.toggle', $subscription) }}">
                    @csrf
                    @method('PATCH')

                    <label class="toggle-switch">
                        <input type="checkbox" name="is_active" onchange="this.form.submit()" {{
                            $subscription->is_active ?
                        'checked' : '' }}>
                        <span class="toggle-slider"></span>
                    </label>
                </form>
            </div>
            </li>

            @empty
            <li class="text-sm text-gray-400 text-center py-6">
                No active subscriptions yet
            </li>
            @endforelse
    </ul>
</div>

{{-- Modal stays as include --}}
@include('components.modals.subscription-modal')