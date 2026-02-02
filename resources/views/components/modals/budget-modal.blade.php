<!-- Add Budget Modal (Pure CSS) -->
<div id="addBudgetModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h5>Add Budget</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <form method="POST">
            @csrf

            <div class="modal-body">
                <!-- Budget Name -->
                <div class="mb-3">
                    <label>Budget Name</label>
                    <input type="text" name="name" placeholder="e.g. Food, Transportation" required>
                </div>

                <!-- Amount -->
                <div class="mb-3">
                    <label>Amount</label>
                    <input type="number" name="amount" step="0.01" placeholder="0.00" required>
                </div>

                <!-- Cut-off -->
                <div class="mb-3">
                    <label>Cut-off</label>
                    <select name="cutoff" required>
                        <option value="" disabled selected>Select cut-off</option>
                        <option value="1-15">1st Cut-off</option>
                        <option value="16-30">2nd Cut-off</option>
                    </select>
                </div>

                <!-- Icon -->
                <div class="mb-3">
                    <label>Type</label>
                    <select name="icon" required>
                        <option value="" disabled selected>Select type of budget</option>

                        <!-- Essentials -->
                        <option value="bi-basket">Food</option>
                        <option value="bi-car-front">Transportation</option>
                        <option value="bi-house-door">Rent / Housing</option>
                        <option value="bi-lightning-charge">Utilities</option>
                        <option value="bi-wifi">Internet</option>
                        <option value="bi-phone">Mobile / Phone</option>

                        <!-- Family -->
                        <option value="bi-house-heart">Parents Contribution</option>
                        <option value="bi-people">Family Support</option>

                        <!-- Lifestyle -->
                        <option value="bi-cup-hot">Dining / Coffee</option>
                        <option value="bi-film">Entertainment</option>

                        <!-- Financial -->
                        <option value="bi-wallet2">Savings</option>
                        <option value="bi-piggy-bank">Emergency Fund</option>

                        <!-- Misc -->
                        <option value="bi-three-dots">Others</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn cancel">Cancel</a>
                <button type="submit" class="btn save">Save Budget</button>
            </div>
        </form>
    </div>
</div>