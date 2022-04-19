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
        <div>
            <label>Category</label>
            <select name='tec_see_category_id' class="input-post-category" required>
            </select>
        </div>
        <div>
            <label>Quantity</label>
            <input type="number" name="quantity" placeholder="Write post quantity" required>
        </div>
        <input type="submit" value="Create">
    </form>
    <hr />
</section>