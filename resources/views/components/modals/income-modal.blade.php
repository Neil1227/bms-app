<!-- Add Income Modal (Pure CSS) -->
<div id="addIncomeModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h5>Add Income</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <form method="POST" action="{{ route('income.store') }}">
            @csrf

            <div class="modal-body">
                <!-- Income Source + Icon Preview -->
                <div class="grid grid-cols-[1fr_auto] gap-4 items-end">
                    <div class="mb-3">
                        <label>Income Source</label>
                        <input type="text" name="income_source" placeholder="e.g. Monthly Salary" class="w-full" required>
                    </div>

                    <div class="mb-3">
                        <div id="income-preview"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-100 text-gray-600">
                            <i class="bi bi-three-dots"></i>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Amount</label>
                    <input type="number" name="amount" step="0.01" placeholder="0.00" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category" id="income-category" required>
                        <option value="" disabled selected>Select category</option>
                        <option value="salary">Salary</option>
                        <option value="freelance">Freelance</option>
                        <option value="investment">Investment</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Date</label>
                    <input type="date" name="date" required>
                </div>

                <div class="toggle-row">
                    <span class="toggle-label">Recurring Income</span>

                    <label class="toggle-switch">
                        <input type="checkbox" name="is_recurring" id="recurringIncome">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn cancel">Cancel</a>
                <button type="submit" class="btn save">Save Income</button>
            </div>
        </form>
    </div>
</div>
<script>
    const incomeIcons = {
        salary: {
            icon: 'bi-wallet2',
            color: 'bg-emerald-100 text-emerald-600'
        },
        freelance: {
            icon: 'bi-laptop',
            color: 'bg-blue-100 text-blue-600'
        },
        investment: {
            icon: 'bi-graph-up-arrow',
            color: 'bg-purple-100 text-purple-600'
        },
        others: {
            icon: 'bi-cash',
            color: 'bg-gray-200 text-gray-600'
        }
    };

    const incomeCategory = document.getElementById('income-category');
    const incomePreview = document.getElementById('income-preview');

    incomeCategory.addEventListener('change', function () {
        const config = incomeIcons[this.value];

        if (!config) return;

        incomePreview.className =
            `w-12 h-12 flex items-center justify-center rounded-full ${config.color}`;

        incomePreview.innerHTML = `<i class="bi ${config.icon}"></i>`;
    });
</script>