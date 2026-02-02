<div class="card">
    <div class="section-header flex items-center justify-between">
        <h2 class="section-title">Income Resources</h2>
        <a href="#addIncomeModal" class="add-btn btn-sm flex items-center gap-1" aria-label="Add Income">
            <i class="bi bi-plus mr-1"></i> Add Income
        </a>
    </div>

    <ul class="list">
        <li class="flex items-center justify-between p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors animate-fade-in">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-100 text-gray-600">
                    <i class="bi bi-briefcase"></i>
                </div>
                <div>
                    <div class="font-medium">Salary</div>
                    <div class="text-sm text-gray-500">Recurring • 15th • 1/15/2024</div>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-emerald-600 font-semibold">₱12,000</div>
                <button class="list-trash-btn" aria-label="Delete"><i class="bi bi-trash"></i></button>
            </div>
        </li>
    </ul>
   
</div>
@include('components.modals.income-modal')