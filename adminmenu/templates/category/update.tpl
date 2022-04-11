<button type="button" hidden class="btn btn-info btn-lg" id="categoryeditmodal" data-toggle="modal"
    data-target="#categoryModal"></button>

<!--  Edit modal -->

<div class="modal fade" id="categoryModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-xmark close" data-dismiss="modal">X</i>
                <h4>Edit</h4>
            </div>

            <div class="modal-body">
                <form class="tecSee-form update-category" method="POST"
                    autocomplete="off" enctype="multipart/form-data">
                    {$jtl_token}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="categoryId" name="categoryId">
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