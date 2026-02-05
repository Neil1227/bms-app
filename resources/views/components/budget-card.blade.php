<div class="grid grid-cols-1 md:grid-cols-2 gap-10">

    @foreach ($cutoffs as $cutoff)
    <div class="card">

        {{-- Header --}}
        <div class="section-header flex items-center justify-between">
            <div>
                <h2 class="section-title">Budget Allocation</h2>
                <p class="text-xs text-gray-500">{{ $cutoff['label'] }}</p>
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

            <li class="flex items-center justify-between p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition animate-fade-in">

                <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-full flex items-center justify-center 
                    bg-{{ $budget->color }}-100 text-{{ $budget->color }}-600" data-category="{{ $budget->category }}">
                    <i class="bi {{ $budget->icon }}"></i>
                </div>


                    <div>
                        <p class="font-medium">{{ ucfirst($budget->name) }}</p>
                        <p class="text-xs text-gray-500">
                            {{ ucfirst($budget->source_cycle ?? $budget->frequency) }}
                            @if($budget->date)
                            | {{ \Carbon\Carbon::parse($budget->date)->format('M j') }}
                            @endif
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <span class="font-semibold text-emerald-600">
                        ₱{{ number_format($budget->amount) }}
                    </span>
                        <button class="list-trash-btn" data-id="{{ $budget->id }}" data-action="budgets" data-title="Delete Budget">
                            <i class="bi bi-trash"></i>
                        </button>
                </div>

            </li>
            @empty

            <p class="text-center text-sm text-gray-500 p-6">
                        No budgets set for this cut-off.
                    </p>
            @endforelse
        </ul>

    </div>
    @endforeach

</div>
<script>
    const categoryMap = {
    entertainment: {
        icon: 'bi-film',
        bg: 'bg-purple-100',
        text: 'text-purple-600',
    },
    music: {
        icon: 'bi-music-note-beamed',
        bg: 'bg-pink-100',
        text: 'text-pink-600',
    },
    internet: {
        icon: 'bi-wifi',
        bg: 'bg-blue-100',
        text: 'text-blue-600',
    },
    utilities: {
        icon: 'bi-lightning-charge',
        bg: 'bg-yellow-100',
        text: 'text-yellow-600',
    },
    phone: {
        icon: 'bi-phone',
        bg: 'bg-emerald-100',
        text: 'text-emerald-600',
    },
    other: {
        icon: 'bi-three-dots',
        bg: 'bg-gray-100',
        text: 'text-gray-600',
    }
};

document.querySelectorAll('.budget-card').forEach(card => {
    const category = card.dataset.category;
    const config = categoryMap[category] ?? categoryMap.other;

    const iconWrapper = card.querySelector('.budget-icon');
    const icon = iconWrapper.querySelector('i');

    icon.className = `bi ${config.icon} ${config.text}`;
    iconWrapper.classList.add(config.bg);
});
</script>
@include('components.modals.budget-modal')