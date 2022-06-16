<button type="button" hidden class="btn btn-info btn-lg open-update-post-model" data-toggle="modal"
    data-target=".post-update-modal"></button>

<!--  Edit modal -->

<div class="modal fade post-update-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-xmark close post" data-dismiss="modal">X</i>
                <h4>Edit</h4>
            </div>

            <div class="modal-body">
                <form class="tecSee-formupdate-post-form" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    <div>
                        <label>Title</label>
                        <input type="text" name="title" placeholder="Write post title" id="post-title" required>
                    </div>
                    <div>
                        <label>Description</label>
                        <textarea type="text" name="Body" id="post-body" placeholder="Write post's description"
                            required></textarea>
                    </div>

                    <div>
                        <label>Category</label>
                        <select name='tec_see_category_id' class="input-post-category" required>
                        </select>
                    </div>

                    <div>
                        <label>Quantity</label>
                        <input type="number" name="quantity" placeholder="Write post quantity" required>
                    </div>
                    <input type="submit" value="Edit">
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->

<!--  Edit modal -->