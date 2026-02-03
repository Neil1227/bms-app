<!-- Add Budget Modal (Pure CSS) -->
<div id="addBudgetModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h5>Add Budget</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <form action="{{ route('budgets.store') }}" method="POST">
            @csrf

            <div class="modal-body">
                <!-- Budget Name -->
                <div class="grid grid-cols-[1fr_auto] gap-4 items-end">
                    <div class="mb-3">
                        <label>Budget Name</label>
                        <input type="text" name="name" placeholder="e.g. Food, Transportation" class="w-full" required>
                    </div>

                    <div class="mb-3">
                        <div id="budget-preview"
                            class="w-12 h-12 flex items-center justify-center rounded-full bg-gray-100 text-gray-600">
                            <i class="bi bi-three-dots"></i>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4">
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

                    <!-- Frequency -->
                    <div class="mb-3">
                        <label>Frequency</label>
                        <select name="frequency" required>
                            <option value="" disabled selected>Select frequency</option>
                            <option value="Monthly">Monthly</option>
                            <option value="Weekly">Weekly</option>
                            <option value="One-time">One-time</option>
                        </select>
                    </div>

                    <!-- Hidden Color Input (set by JS based on icon mapping) -->
                    <input type="hidden" name="color" id="budget-color">

                    <!-- Icon / Type -->
                    <div class="mb-3">
                        <label>Type</label>
                        <select name="icon" id="budget-icon" required>
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


                <!-- Preview -->

            </div>

            <div class="modal-footer">
                <a href="#" class="btn cancel">Cancel</a>
                <button type="submit" class="btn save">Save Budget</button>
            </div>
        </form>
    </div>
</div>

<script>
    (function() {
  const iconEl = document.getElementById('budget-icon');
  const colorEl = document.getElementById('budget-color');
  const preview = document.getElementById('budget-preview');

  const mapping = {
    'bi-basket':'rose',
    'bi-car-front':'blue',
    'bi-house-door':'indigo',
    'bi-lightning-charge':'amber',
    'bi-wifi':'teal',
    'bi-phone':'gray',
    'bi-house-heart':'pink',
    'bi-people':'emerald',
    'bi-cup-hot':'amber',
    'bi-film':'violet',
    'bi-wallet2':'emerald',
    'bi-piggy-bank':'rose',
    'bi-three-dots':'gray'
  };

  function updatePreview() {
    const icon = (iconEl && iconEl.value) || 'bi-three-dots';
    const suggested = mapping[icon];
    // prefer explicit color selection, otherwise use suggested mapping
    const color = (colorEl && (colorEl.value || suggested)) || suggested || 'gray';
    if (colorEl && !colorEl.value && suggested) {
      colorEl.value = suggested;
    }
    if (!preview) return;
    preview.className = `w-12 h-12 flex items-center justify-center rounded-full bg-${color}-100 text-${color}-600`;
    preview.innerHTML = `<i class="bi ${icon}"></i>`;
  }

  if (iconEl) {
    iconEl.addEventListener('change', () => {
      const suggested = mapping[iconEl.value];
      // always set the color suggestion (user can override after)
      if (suggested && colorEl) {
        colorEl.value = suggested;
      }
      updatePreview();
    });
  }

  if (colorEl) colorEl.addEventListener('change', updatePreview);

  // initialize on load
  document.addEventListener('DOMContentLoaded', updatePreview);
  // also call immediately in case DOMContentLoaded already fired
  updatePreview();
})();
</script>