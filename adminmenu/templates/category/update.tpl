<button type="button" hidden class="btn btn-info btn-lg open-update-category-model" data-toggle="modal"
    data-target=".category-update-modal"></button>

<!--  Edit modal -->

<div class="modal fade category-update-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-xmark close category" data-dismiss="modal">X</i>
                <h4>Edit</h4>
            </div>

            <div class="modal-body">
                <form class="tecSee-form update-category-form" method="POST"
                    autocomplete="off" enctype="multipart/form-data">
                    <div>
                        <label>Name</label>
                        <input type="text" name="name" placeholder="Write category title" id="category-title" required>
                    </div>
                    <div>
                        <label>Description</label>
                        <textarea type="text" name="description" id="category-description" placeholder="Write category's description"
                            required></textarea>
                    </div>

                    <input type="submit" value="Edit">
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->

<!--  Edit modal -->