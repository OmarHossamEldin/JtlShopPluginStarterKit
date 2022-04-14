<section>
    <form class="tecSee-form create-post"" action=" ?kPlugin={$pluginId}&fetch=posts" method="POST" autocomplete="off"
            enctype="multipart/form-data">
            <div>
                <label>Title</label>
                <input type="text" name="title" placeholder="Write post title" required>
            </div>
            <div>
                <label>Description</label>
                <textarea type="text" name="Body" placeholder="Write post's description" required></textarea>
            </div>
            {if (isset($categories)) && (count($categories) > 0)}
                <div class="full-width">
                    <label>Category</label>
                    <select name="tec_see_category_id">
                        {foreach from=$categories item=category}
                        <option value="{($category->id)}"> {$category->name} </option>
                        {/foreach}>
                    </select>
                </div>
        {/if}
            <input type="submit" value="Create">
        </form>
        <hr />
    </section>