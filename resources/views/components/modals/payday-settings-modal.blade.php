<div id="paydaySettingsModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-header">
            <h5>Payday Settings</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <form method="POST" action="{{ route('payday.store') }}">
            @csrf

<div class="modal-body">

    <div class="mb-3">
        <label>Pay Frequency</label>
        <select name="frequency" id="payFrequency">
            <option value="monthly">Monthly</option>
            <option value="semi_monthly">Semi-monthly</option>
            <option value="bi_weekly">Bi-weekly (Every 2 weeks)</option>
        </select>
    </div>

    <!-- PAYDAY ROW -->
    <div class="payday-row">

        <!-- Monthly -->
        <div class="mb-3" id="monthlyPayday">
            <label>Payday</label>
            <input type="number" name="payday_1" min="1" max="31">
        </div>

        <!-- Semi-monthly -->
        <div class="mb-3 hidden" id="semiMonthlyPayday">
            <label>Second Payday</label>
            <input type="number" name="payday_2" min="1" max="31">
        </div>

        <!-- Bi-weekly (FULL ROW) -->
        <div class="mb-3 hidden full-row" id="startDateField">
            <label>First Payday Date</label>
            <input type="date" name="start_date">
        </div>

    </div>
</div>

            <div class="modal-footer">
                <a href="#" class="btn cancel">Cancel</a>
                <button class="btn save">Save</button>
            </div>
        </form>
    </div>
</div>
<script>
    const freq = document.getElementById('payFrequency');
    const monthly = document.getElementById('monthlyPayday');
    const semi = document.getElementById('semiMonthlyPayday');
    const biWeekly = document.getElementById('startDateField');

    function updatePaydayFields() {
        monthly.classList.add('hidden');
        semi.classList.add('hidden');
        biWeekly.classList.add('hidden');

        if (freq.value === 'monthly') {
            monthly.classList.remove('hidden');
        }

        if (freq.value === 'semi_monthly') {
            monthly.classList.remove('hidden');
            semi.classList.remove('hidden');
        }

        if (freq.value === 'bi_weekly') {
            biWeekly.classList.remove('hidden');
        }
    }

    updatePaydayFields();
    freq.addEventListener('change', updatePaydayFields);
</script>