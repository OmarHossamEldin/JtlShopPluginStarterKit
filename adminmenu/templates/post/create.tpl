<section>
    <form class="tecSee-form" action="?kPlugin={$pluginId}&fetch=posts" method="POST" autocomplete="off"
        enctype="multipart/form-data">
        {$jtl_token}
        <div>
            <label>Title</label>
            <input type="text" name="title" placeholder="Write post title" required>
        </div>
        <div>
            <label>Description</label>
            <textarea type="text" name="Body" placeholder="Write post's description" required></textarea>
        </div>
        <input type="submit" value="Create">
    </form>
    <hr />
</section>