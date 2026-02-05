<!-- Add Subscription Modal -->
<div id="addSubscriptionModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h5>Add Subscription</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <form method="POST" action="{{ route('subscriptions.store') }}">
            @csrf

            <div class="modal-body">
                <!-- Name -->
                <!-- Subscription Name + Icon Preview -->
                <div class="grid grid-cols-[1fr_auto] gap-4 items-end">
                    <div class="mb-3">
                        <label>Subscription Name</label>
                        <input type="text" name="name" id="subscription-name" placeholder="e.g. Netflix, Spotify"
                            class="w-full" required>
                    </div>

                    <div class="mb-3">
                        <div id="subscription-preview"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-100 text-gray-600">
                            <i class="bi bi-three-dots"></i>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="icon" id="subscription-icon" value="bi-three-dots">
                <input type="hidden" name="color" id="subscription-color">
                <!-- Category -->
                <div class="mb-3">
                    <label>Category</label>
                    <select name="category" id="subscription-category" class="w-full">
                        <option value="">Select category</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="music">Music</option>
                        <option value="internet">Internet</option>
                        <option value="utilities">Utilities</option>
                        <option value="phone">Phone</option>
                        <option value="other">Other</option>
                    </select>
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
<script>
    const categoryStyles = @json(config('subscription-icons'));

    const categorySelect = document.getElementById('subscription-category');
    const preview = document.getElementById('subscription-preview');
    const iconInput = document.getElementById('subscription-icon');
    const colorInput = document.getElementById('subscription-color');

    categorySelect.addEventListener('change', function () {
        const style = categoryStyles[this.value] || categoryStyles.other;

        // reset preview
        preview.className =
            'w-12 h-12 flex items-center justify-center rounded-full';

        // apply preview styles
        preview.classList.add(style.bg, style.text);
        preview.innerHTML = `<i class="bi ${style.icon}"></i>`;

        // ✅ store values for backend
        iconInput.value = style.icon;
        colorInput.value = `${style.bg} ${style.text}`;
    });
</script>