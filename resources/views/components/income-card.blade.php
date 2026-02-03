@props(['incomes'])

<div class="card">
    <div class="section-header flex items-center justify-between">
        <h2 class="section-title">Income Resources</h2>

        <a href="#addIncomeModal" class="add-btn btn-sm flex items-center gap-1">
            <i class="bi bi-plus mr-1"></i> Add Income
        </a>
    </div>

    <ul class="list">
        @forelse ($incomes as $income)
        <li
            class="flex items-center justify-between p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors animate-fade-in">

            <div class="flex items-center gap-4">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600">
                    <i class="bi
                        {{ $income->category === 'salary' ? 'bi-briefcase' : '' }}
                        {{ $income->category === 'freelance' ? 'bi-laptop' : '' }}
                        {{ $income->category === 'investment' ? 'bi-graph-up' : '' }}
                        {{ $income->category === 'others' ? 'bi-wallet2' : '' }}">
                    </i>
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

                <form method="POST" action="{{ route('income.destroy', $income->id) }}">
                    @csrf
                    @method('DELETE')
                    <button class="list-trash-btn">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>

        </li>
        @empty
        <li class="p-4 text-sm text-gray-500 text-center">
            No income records yet.
        </li>
        @endforelse
    </ul>
</div>

@include('components.modals.income-modal')