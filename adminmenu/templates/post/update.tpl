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
                <form class="tecSee-form update-post" action="?kPlugin={$pluginId}&fetch=posts" method="POST" autocomplete="off"
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

                {if (isset($categories)) && (count($categories) > 0)}
                    <div class="full-width">
                        <label>Category</label>
                        <select name="tec_see_category_id" id="category-name">
                            {foreach from=$categories item=category}
                            <option value="{($category->id)}"> {$category->name} </option>
                            {/foreach}>
                        </select>
                    </div>
            {/if}
                    <input type="submit" value="Edit">
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->

<!--  Edit modal -->