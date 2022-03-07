<!--  Edit modal -->

<!-- Modal -->
<div class="modal fade" id="postModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit</h4>
            </div>
            <div class="modal-body">

                <form action="?kPlugin={$pluginId}&fetch=posts" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    {$jtl_token}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="postId" name="postId">

                    <div class="form-group">
                        <label> Title</label>
                        <input name='title' type="text" id="post-title">
                    </div>
                    <div class="form-group">
                        <label> Body</label>
                        <textarea name='body' id="post-body"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="margin: 0 auto;display: block;">Edit</button>
                </form>
            </div>
        </div>

    </div>
</div>
<!--  Edit modal -->