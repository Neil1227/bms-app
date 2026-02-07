<!-- Add Loan Modal -->
<div id="addLoanModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h5>Add Loan</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

    <form method="POST" action="{{ route('loans.store') }}">
        @csrf
            <div class="modal-body">
                <!-- Loan Name -->
                <div class="mb-3">
                    <label>Loan Name</label>
                    <input type="text" name="loan_name" placeholder="e.g. Motorcycle Loan" required>
                </div>

                <!-- Total + Remaining (row) -->
                <div class="form-row">
                    <div class="mb-3">
                        <label>Total Amount</label>
                        <input type="number" name="total_amount" step="0.01" placeholder="0.00" required>
                    </div>

                    <div class="mb-3">
                        <label>Remaining Balance</label>
                        <input type="number" name="remaining_amount" step="0.01" placeholder="0.00" required>
                    </div>
                </div>

                <!-- Monthly Payment -->
                <div class="mb-3">
                    <label>Monthly Payment</label>
                    <input type="number" name="monthly_payment" step="0.01" placeholder="0.00" required>
                </div>

                <!-- Due Date + Next Payment (row) -->
                <div class="form-row">
                    <div class="mb-3">
                        <label>Due Date</label>
                        <input type="date" name="due_date" required>
                    </div>

                    <div class="mb-3">
                        <label>Next Payment Date</label>
                        <input type="date" name="next_payment_date" max="{{ old('due_date') }}">
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn cancel">Cancel</a>
                <button type="submit" class="btn save">Save Loan</button>
            </div>
        </form>
    </div>
</div>