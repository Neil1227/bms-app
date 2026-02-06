@php
$totalDebt = $loans->sum('remaining_amount');
@endphp

<div class="card">

    <!-- Header -->
    <div class="section-header flex items-center justify-between mb-6">
        <div>
            <h2 class="section-title">Loan Management</h2>
            <p class="text-sm text-gray-500">
                Total Debt:
                <span class="font-semibold text-emerald-600">
                    ₱{{ number_format($totalDebt, 2) }}
                </span>
            </p>
        </div>

        <a href="#addLoanModal" class="add-btn btn-sm flex items-center gap-1">
            <i class="bi bi-plus"></i>
            <span>Add Loan</span>
        </a>
    </div>

    {{-- Loan List --}}
    <div class="flex flex-col gap-4">

        @forelse ($loans as $loan)

        @php
        $paid = $loan->total_amount - $loan->remaining_amount;
        $progress = $loan->total_amount > 0
        ? ($paid / $loan->total_amount) * 100
        : 0;

        $daysLeft = (int) now()->startOfDay()
        ->diffInDays($loan->next_payment_date->startOfDay(), false);
        @endphp

        <!-- Loan Item -->
        <div class="loan-item rounded-lg bg-gray-50 p-4 animate-fade-in">

            <!-- Top -->
            <div class="flex justify-between items-start">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 flex items-center justify-center rounded-full bg-teal-100 text-teal-600">
                        <i class="bi bi-wallet2"></i>
                    </div>

                    <div>
                        <p class="text-sm font-medium text-gray-500">
                            {{ ucfirst($loan->loan_name) }}
                        </p>
                        <p class="text-xs text-gray-500">
                            ₱{{ number_format($loan->remaining_amount, 2) }} remaining
                        </p>
                    </div>
                </div>

                <!-- DELETE -->
            <button class="list-trash-btn" data-id="{{ $loan->id }}" data-action="loans" data-title="Delete Loan">
                <i class="bi bi-trash"></i>
            </button>
            </div>

            <!-- Progress -->
            <div class="mt-4">
                <div class="h-2 w-full rounded-full bg-gray-200 overflow-hidden">
                    <div class="h-full bg-teal-600 rounded-full" style="width: {{ $progress }}%"></div>
                </div>

                <div class="mt-2 flex justify-between text-xs text-gray-500">
                    <span>Progress</span>
                    <span class="font-medium text-gray-500">
                        {{ number_format($progress, 1) }}% paid
                    </span>
                </div>
            </div>

            <!-- Meta -->
            <div class="mt-4 grid grid-cols-3 gap-2 text-sm text-gray-600">

                <!-- Monthly -->
                <div class="flex items-center gap-2">
                    <i class="bi bi-currency-dollar text-gray-400"></i>
                    <div>
                        <p class="text-xs text-gray-500">Monthly</p>
                        <p class="text-xs font-medium text-emerald-600">
                            ₱{{ number_format($loan->monthly_payment, 2) }}
                        </p>
                    </div>
                </div>

                <!-- Next Due -->
                <div class="flex items-center gap-2">
                    <i class="bi bi-calendar text-gray-400"></i>
                    <div>
                        <p class="text-xs text-gray-500">Next Due</p>
                        <p class="text-xs font-medium
                            {{ $daysLeft < 0 ? 'text-red-500' : 'text-gray-500' }}">
                            @if ($daysLeft < 0) Overdue @elseif ($daysLeft===0) Due today @elseif ($daysLeft===1) Due
                                tomorrow @else Due in {{ $daysLeft }} days @endif </p>
                    </div>
                </div>

                <!-- Action -->
                <div class="flex justify-center">
                    <button class="make-payment-btn text-xs gap-2" data-id="{{ $loan->id }}" data-remaining="{{ $loan->remaining_amount }}">
                        <i class="bi bi-credit-card"></i>
                        <span>Pay</span>
                    </button>
                </div>

            </div>
        </div>

        @empty
        <p class="text-center text-sm text-gray-500 py-6">
            No loans added yet.
        </p>
        @endforelse
    </div>
</div>
<!-- Pay Loan Modal -->
<div id="payLoanModal" class="modal-overlay">
    <div class="modal-box">

        <div class="modal-header">
            <h5>Pay Loan</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <form id="payLoanForm" method="POST">
            @csrf

            <div class="modal-body">
                <label class="text-sm">Payment Amount</label>
                <input type="number" name="amount" step="0.01" min="1" class="w-full mt-2" required>

                <p class="text-xs text-gray-500 mt-2">
                    This will reduce the remaining loan balance.
                </p>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn cancel">Cancel</a>
                <button type="submit" class="btn save">Apply Payment</button>
            </div>
        </form>

    </div>
</div>
@include('components.modals.loan-modal')
<script>
    document.querySelectorAll('.make-payment-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;

        const form = document.getElementById('payLoanForm');
        form.action = `/loans/${id}/pay`;

        window.location.hash = 'payLoanModal';
    });
});
</script>
