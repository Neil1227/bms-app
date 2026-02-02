<div class="card">
    <!-- Header -->
    <div class="section-header flex items-start justify-between mb-5">
        <div class="flex flex-col">
            <h2 class="section-title">Subscriptions</h2>
            <p class="text-sm text-gray-500">
                Total per month:
                <span class="font-semibold text-emerald-600">₱698</span>
            </p>
        </div>

        <a href="#addSubscriptionModal" class="add-btn btn-sm flex items-center gap-1" aria-label="Add Subscription">
            <i class="bi bi-plus"></i>
            <span>Add</span>
        </a>
    </div>
    <!-- List -->
    <ul class="list">
        <!-- Item -->
        <li
            class="subscription-item flex items-center justify-between rounded-xl bg-gray-50 p-4 transition hover:bg-gray-100">
            <div class="flex items-center gap-4">
                <div
                    class="icon-wrapper flex h-10 w-10 items-center justify-center rounded-full bg-gray-100 text-gray-600">
                    <i class="bi bi-play-btn"></i>
                </div>

                <div>
                    <p class="font-medium text-gray-800">Netflix</p>
                    <p class="text-xs text-gray-500">Monthly • 1st • 2/01/2024</p>
                    <p class="text-xs text-gray-400">
                        Due: <span class="font-medium text-rose-500">4 days</span>
                    </p>
                </div>
            </div>

            <!-- Right actions -->
            <div class="flex flex-col items-end gap-2">
                <div class="flex items-center gap-4">
                    <span class="font-semibold text-emerald-600">₱549</span>

                    <button class="list-trash-btn text-gray-400 hover:text-red-500 transition">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>

                <label class="toggle-switch">
                    <input type="checkbox" name="is_recurring" id="recurringIncome">
                    <span class="toggle-slider"></span>
                </label>
            </div>
        </li>
    </ul>
</div>
@include('components.modals.subscription-modal')