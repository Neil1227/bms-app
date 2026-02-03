<div class="grid grid-cols-1 md:grid-cols-2 gap-10">

    @foreach ($cutoffs as $cutoff)
    <div class="card">

        {{-- Header --}}
        <div class="section-header flex items-center justify-between">
            <div>
                <h2 class="section-title">Budget Allocation</h2>
                <p class="text-xs text-gray-500">Cut-off: {{ $cutoff['label'] }}</p>
            </div>

            <a href="#addBudgetModal" class="add-btn btn-sm flex items-center gap-1">
                <i class="bi bi-plus"></i> Add Budget
            </a>
        </div>

        {{-- Total --}}
        <div class="grid grid-cols-2 gap-4 m-4 text-sm">
            <div>
                <p class="text-gray-500">Total Allocated</p>
                <p class="font-semibold text-rose-500">
                    ₱{{ number_format($cutoff['total']) }}
                </p>
            </div>
        </div>

        {{-- List --}}
        <ul class="list">
            @forelse ($cutoff['items'] as $budget)
            <li class="flex items-center justify-between p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition">

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 flex items-center justify-center rounded-full {{ $budget->colorClasses }}">
                        <i class="bi {{ $budget->icon }}"></i>
                    </div>

                    <div>
                        <p class="font-medium">{{ $budget->name }}</p>
                        <p class="text-sm text-gray-500">
                            {{ $budget->frequency }} |
                            {{ $budget->date ? \Carbon\Carbon::parse($budget->date)->format('M j') : '' }}
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span class="font-semibold text-emerald-600">
                        ₱{{ number_format($budget->amount) }}
                    </span>

                    <form action="{{ route('budgets.destroy', $budget->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="list-trash-btn">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </div>

            </li>
            @empty
            <li class="p-4 text-center text-sm text-gray-500">
                No budgets set for this cut-off.
            </li>
            @endforelse
        </ul>

    </div>
    @endforeach

</div>

@include('components.modals.budget-modal')