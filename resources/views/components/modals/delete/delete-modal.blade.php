<!-- Reusable Delete Confirmation Modal -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-box">

        <!-- Header -->
        <div class="modal-header">
            <h5 id="deleteModalTitle">Delete Item</h5>
            <a href="#" class="modal-close">&times;</a>
        </div>

        <!-- Body -->
        <div class="modal-body">
            <p class="text-sm text-gray-600" id="deleteModalMessage">
                Are you sure you want to delete this item?
            </p>
            <p class="text-sm text-red-500 mt-2">
                This action cannot be undone.
            </p>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
            <a href="#" class="btn cancel">Cancel</a>

            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn save bg-red-600 hover:bg-red-700">
                    Delete
                </button>
            </form>
        </div>

    </div>
</div>
