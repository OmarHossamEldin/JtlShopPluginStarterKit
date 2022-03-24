<section>
    {if (isset($posts)) && (count($posts) > 0)}


        <div class="tecSee-table-parent">
            <div class='tecSee-table-container'>
                <div class="tecSee-remove-padding">
                    <table class="tecSee-table">
                        <tr>
                            <th>select</th>
                            <th>id</th>
                            <th>title</th>
                            <th>body</th>
                            <th>category</th>
                            <th>delete</th>
                        <tr>
                            {foreach from=$posts item=post}
                            <tr>
                                <td>
                                    <button class="fas fa-edit text-dark update-this-item" date-attributes='{$post->id}'
                                        plugin-url='{$pluginURL}'>
                                    </button>
                                </td>
                                <td>{$post->id}</td>
                                <td>{$post->title}</td>
                                <td>{$post->body}</td>
                                <td>{$post->name}</td>

                                <td>
                                    <form action="" method="get">
                                        <input type="hidden" name="kPlugin" value="{$pluginId}">
                                        <input type="hidden" name="fetch" value="posts">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="postId" value="{$post->id}">
                                        {$jtl_token}
                                        <button type="submit" class="btn btn-danger tecSee-button-delete"
                                            style="font-weight: bold;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        {/foreach}
                    </table>
                </div>
            </div>
        </div>
    {/if}

    <button type="button" hidden class="btn btn-info btn-lg" id="posteditmodal" data-toggle="modal"
        data-target="#postModal"></button>

</section>