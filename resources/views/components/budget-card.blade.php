@php
$cutoffIncome = 15000;

/*
|--------------------------------------------------------------------------
| Budget Data (temporary – later from DB)
|--------------------------------------------------------------------------
*/
$budgets = [
[
'name' => 'Food',
'icon' => 'bi-basket',
'color' => 'yellow',
'frequency' => 'Monthly',
'date' => '2/01/2024',
'amount' => 4000,
'cutoff' => '1-15',
],
[
'name' => 'Transportation',
'icon' => 'bi-car-front',
'color' => 'gray',
'frequency' => 'Weekly',
'date' => '—',
'amount' => 1500,
'cutoff' => '1-15',
],
[
'name' => 'Emergency Fund',
'icon' => 'bi-shield-exclamation',
'color' => 'red',
'frequency' => 'One-time',
'date' => '—',
'amount' => 2000,
'cutoff' => '1-15',
],
[
'name' => 'Savings',
'icon' => 'bi-wallet2',
'color' => 'gray',
'frequency' => 'Auto-transfer',
'date' => '—',
'amount' => 3000,
'cutoff' => '16-30',
],
];

/*
|--------------------------------------------------------------------------
| Split by Cut-off
|--------------------------------------------------------------------------
*/
$firstCutoff = collect($budgets)->where('cutoff', '1-15');
$secondCutoff = collect($budgets)->where('cutoff', '16-30');

$firstTotal = $firstCutoff->sum('amount');
$secondTotal = $secondCutoff->sum('amount');
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-10">

    {{-- ================== 1ST CUT-OFF ================== --}}
    <div class="card">

        <div class="section-header flex items-center justify-between">
            <div>
                <h2 class="section-title">Budget Allocation</h2>
                <p class="text-xs text-gray-500">Cut-off: 1–15</p>
            </div>

            <a href="#addBudgetModal" class="add-btn btn-sm flex items-center gap-1">
                <i class="bi bi-plus"></i> Add Budget
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 m-4 text-sm">
            <div>
                <p class="text-gray-500">Total Allocated</p>
                <p class="font-semibold text-rose-500">
                    ₱{{ number_format($firstTotal) }}
                </p>
            </div>

        </div>

        <ul class="list">
            @forelse ($firstCutoff as $budget)
            <li class="flex items-center justify-between p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full
                            bg-{{ $budget['color'] }}-100 text-{{ $budget['color'] }}-600">
                        <i class="bi {{ $budget['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="font-medium">{{ $budget['name'] }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $budget['frequency'] }} • {{ $budget['date'] }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="font-semibold text-emerald-600">
                        ₱{{ number_format($budget['amount']) }}
                    </span>
                    <button class="list-trash-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </li>
            @empty
            <li class="p-4 text-center text-sm text-gray-500">
                No budgets set for this cut-off.
            </li>
            @endforelse
        </ul>
    </div>

    {{-- ================== 2ND CUT-OFF ================== --}}
    <div class="card">

        <div class="section-header flex items-center justify-between">
            <div>
                <h2 class="section-title">Budget Allocation</h2>
                <p class="text-xs text-gray-500">Cut-off: 16–30</p>
            </div>

            <a href="#addBudgetModal" class="add-btn btn-sm flex items-center gap-1">
                <i class="bi bi-plus"></i> Add Budget
            </a>
        </div>

        <div class="grid grid-cols-2 gap-4 m-4 text-sm">
            <div>
                <p class="text-gray-500">Total Allocated</p>
                <p class="font-semibold text-rose-500">
                    ₱{{ number_format($secondTotal) }}
                </p>
            </div>
        </div>

        <ul class="list">
            @forelse ($secondCutoff as $budget)
            <li class="flex items-center justify-between p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full
                            bg-{{ $budget['color'] }}-100 text-{{ $budget['color'] }}-600">
                        <i class="bi {{ $budget['icon'] }}"></i>
                    </div>
                    <div>
                        <p class="font-medium">{{ $budget['name'] }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $budget['frequency'] }} • {{ $budget['date'] }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <span class="font-semibold text-emerald-600">
                        ₱{{ number_format($budget['amount']) }}
                    </span>
                    <button class="list-trash-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </li>
            @empty
            <li class="p-4 text-center text-sm text-gray-500">
                No budgets set for this cut-off.
            </li>
            @endforelse
        </ul>
    </div>

</div>

@include('components.modals.budget-modal')