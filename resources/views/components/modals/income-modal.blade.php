<!-- Add Income Modal (Pure CSS) -->
<div id="addIncomeModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h5>Add Income</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <form method="POST">
            @csrf

            <div class="modal-body">
                <div class="mb-3">
                    <label>Income Source</label>
                    <input type="text" name="income_source" placeholder="e.g. Monthly Salary" required>
                </div>

                <div class="mb-3">
                    <label>Amount</label>
                    <input type="number" name="amount" step="0.01" placeholder="0.00" required>
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select name="category" required>
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