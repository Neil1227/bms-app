@props(['incomes'])

<div class="card">
    <div class="section-header flex items-center justify-between">
        <h2 class="section-title">Income Resources</h2>

        <a href="#addIncomeModal" class="add-btn btn-sm flex items-center gap-1">
            <i class="bi bi-plus mr-1"></i> Add Income
        </a>
    </div>

    <ul class="list">
        @php
        $incomeMeta = [
        'salary' => [
        'icon' => 'bi-wallet2',
        'color' => 'bg-emerald-100 text-emerald-600',
        ],
        'freelance' => [
        'icon' => 'bi-laptop',
        'color' => 'bg-blue-100 text-blue-600',
        ],
        'investment' => [
        'icon' => 'bi-graph-up-arrow',
        'color' => 'bg-purple-100 text-purple-600',
        ],
        'others' => [
        'icon' => 'bi-cash',
        'color' => 'bg-gray-200 text-gray-600',
        ],
        ];
        @endphp
        @forelse ($incomes as $income)
        <li
            class="flex items-center justify-between p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors animate-fade-in">

            <div class="flex items-center gap-4">
                @php
                $meta = $incomeMeta[$income->category] ?? $incomeMeta['others'];
                @endphp
                
                <div class="w-10 h-10 flex items-center justify-center rounded-full {{ $meta['color'] }}">
                    <i class="bi {{ $meta['icon'] }}"></i>
                </div>

                <div>
                    <div class="font-medium">
                        {{ ucfirst($income->income_source) }}
                    </div>
                    <div class="text-sm text-gray-500">
                        {{ $income->is_recurring ? 'Recurring' : 'One-time' }}
                        • {{ \Carbon\Carbon::parse($income->date)->format('M d, Y') }}
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <div class="text-emerald-600 font-semibold">
                    ₱{{ number_format($income->amount, 2) }}
                </div>
                    <button class="list-trash-btn" data-id="{{ $income->id }}" data-action="income" data-title="Delete Income">
                        <i class="bi bi-trash"></i>
                    </button>
            </div>

        </li>
        @empty
  
        <p class="text-center text-sm text-gray-500 p-6">
            No income records yet.
        </p>
        @endforelse
    </ul>
</div>

@include('components.modals.income-modal')