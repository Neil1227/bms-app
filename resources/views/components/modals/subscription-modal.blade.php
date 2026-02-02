<!-- Add Subscription Modal -->
<div id="addSubscriptionModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h5>Add Subscription</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <form method="POST">
            @csrf

            <div class="modal-body">
                <!-- Name -->
                <div class="mb-3">
                    <label>Subscription Name</label>
                    <input type="text" name="name" placeholder="e.g. Netflix" required>
                </div>

                <!-- Amount -->
                <div class="mb-3">
                    <label>Monthly Cost</label>
                    <input type="number" name="amount" step="0.01" placeholder="0.00" required>
                </div>

                <!-- Billing Cycle -->
                <div class="mb-3">
                    <label>Billing Cycle</label>
                    <select name="billing_cycle" required>
                        <option value="" disabled selected>Select cycle</option>
                        <option value="monthly">Monthly</option>
                        <option value="yearly">Yearly</option>
                    </select>
                </div>

                <!-- Billing Date -->
                <div class="mb-3">
                    <label>Billing Date</label>
                    <input type="date" name="billing_date" required>
                </div>

                <!-- Auto-renew -->
                <div class="toggle-row">
                    <span class="toggle-label">Auto Renew</span>
                    <label class="toggle-switch">
                        <input type="checkbox" name="is_active" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>

            <div class="modal-footer">
                <a href="#" class="btn cancel">Cancel</a>
                <button type="submit" class="btn save">Save Subscription</button>
            </div>
        </form>
    </div>
</div>