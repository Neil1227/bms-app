<div class="card">

    <!-- Header -->
    <div class="section-header flex items-center justify-between mb-5">
        <div>
            <h2 class="section-title">Loan Management</h2>
            <p class="mt-1 text-xs text-gray-500">
                Total Debt:
                <span class="font-semibold text-gray-800">₱390,000</span>
            </p>
        </div>

        <a href="#addLoanModal" class="add-btn btn-sm flex items-center gap-1" aria-label="Add Loan">
            <i class="bi bi-plus"></i>
            <span>Add Loan</span>
        </a>
    </div>

    <!-- Loan Item -->
    <div class="loan-item rounded-lg bg-gray-50 p-4 animate-fade-in">

        <!-- Top -->
        <div class="flex justify-between items-start">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 flex items-center justify-center rounded-md bg-teal-100 text-teal-600">
                    <i class="bi bi-wallet2"></i>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-800">Car Loan</p>
                    <p class="text-xs text-gray-500">₱350,000 remaining</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button class="list-trash-btn" aria-label="Remove Loan">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>

        <!-- Progress -->
        <div class="mt-4">
            <div class="h-2 w-full rounded-full bg-gray-200 overflow-hidden">
                <div class="h-full bg-teal-600 rounded-full" style="width: 30%"></div>
            </div>

            <div class="mt-2 flex justify-between text-xs text-gray-500">
                <span>Progress</span>
                <span class="font-medium text-gray-700">30.0% paid</span>
            </div>
        </div>

        <!-- Meta -->
        <div class="mt-4 grid grid-cols-3 items-center gap-2 text-sm text-gray-600">

            <!-- Monthly -->
            <div class="flex items-center gap-2">
                <i class="bi bi-currency-dollar text-gray-400 text-sm"></i>
                <div>
                    <p class="text-xs text-gray-500">Monthly</p>
                    <p class="text-sm font-medium text-emerald-800">₱15,000</p>
                </div>
            </div>

            <!-- Next Due -->
            <div class="flex items-center gap-2">
                <i class="bi bi-calendar text-gray-400 text-sm"></i>
                <div>
                    <p class="text-xs text-gray-500">Next Due</p>
                    <p class="text-sm font-medium text-red-500">Due today</p>
                </div>
            </div>

            <!-- Action -->
            <div class="flex justify-center">
                <button class="make-payment-btn text-xs px-3 py-2 flex gap-2 flex justify-center">
                    <i class="bi bi-credit-card text-white-500"></i>
                    <span class="text-left">Pay</span>
                </button>
            </div>

        </div>

    </div>
</div>
@include('components.modals.loan-modal')