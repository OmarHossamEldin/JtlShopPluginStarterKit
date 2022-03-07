<section>
    {if (isset($posts)) && (count($posts) > 0)}
        <div class="table-responsive">
            <table class="table table-hover table-align-top">
                <thead>
                    <tr>
                        <th>select</th>
                        <th>id</th>
                        <th>title</th>
                        <th>body</th>
                    <tr>
                </thead>
                <tbody>
                    {foreach from=$posts item=post}
                        <tr>
                            <td>
                                <input type="radio" id="updateBox" name="updateBox" class="update-this-item" date-attributes='{$post->id}' plugin-url='{$pluginURL}' />
                            </td>
                            <td>{$post->id}</td>
                            <td>{$post->title}</td>
                            <td>{$post->body}</td>
                        </tr>
                    {/foreach}
                </tbody>
            </table>
        </div>
    {/if}

    <button type="button" hidden class="btn btn-info btn-lg" id="posteditmodal" data-toggle="modal"
    data-target="#postModal"></button>

</section>