<!--  Edit modal -->

<div class="modal fade" id="postModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-xmark close" data-dismiss="modal">X</i>
                <h4>Edit</h4>
            </div>

            <div class="modal-body">
                <form class="tecSee-form" action="?kPlugin={$pluginId}&fetch=posts" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    {$jtl_token}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="postId" name="postId">
                    <div>
                    <label>Title</label>
                    <input type="text" name="title" placeholder="Write post title" id="post-title" required>
                </div>
                <div>
                    <label>Description</label>
                    <textarea type="text" name="Body" id="post-body" placeholder="Write post's description" required></textarea>
                </div>
                    <input type="submit" value="Edit">
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->

<!--  Edit modal -->