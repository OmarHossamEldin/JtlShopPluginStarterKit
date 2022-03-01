<section>
<form action="?kPlugin={$pluginId}&fetch=posts" method="POST">
    {$jtl_token}
    <div class="form-group">
        <label> Title</label>
        <input name='title' type="text">
    </div>
    <div class="form-group">
        <label> Body</label>
        <textarea name='body' ></textarea>
    </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</section>