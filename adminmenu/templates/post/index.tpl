{if (isset($posts)) && (count($posts) > 0)}
    <div class="table-responsive">
        <table class="table table-hover table-align-top">
            <thead>
                <tr>
                    <th>id</th>
                    <th>title</th>
                    <th>body</th>
                <tr>
            </thead>
            <tbody>
                {foreach from=$posts item=post}
                    <tr>
                        <td>{$post->id}</td>
                        <td>{$post->title}</td>
                        <td>{$post->body}</td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    </div>
{/if}