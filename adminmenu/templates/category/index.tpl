<section>
    {if (isset($categories)) && (count($categories) > 0)}


        <div class="tecSee-table-parent">
            <div class='tecSee-table-container'>
                <div class="tecSee-remove-padding">
                    <table class="tecSee-table">
                        <tr>
                            <th>select</th>
                            <th>id</th>
                            <th>name</th>
                            <th>description</th>
                            <th>delete</th>
                        <tr>
                            {foreach from=$categories item=category}
                            <tr>
                                <td>
                                    <button class="fas fa-edit text-dark update-this-category" category-attributes='{$category->id}'
                                        plugin-url='{$pluginURL}'>
                                    </button>
                                </td>
                                <td>{$category->id}</td>
                                <td>{$category->name}</td>
                                <td>{$category->description}</td>
                                <td>
                                    <button class="btn btn-danger tecSee-button-delete delete-this-category"
                                    delete-category-attributes='{$category->id}'>
                                   Delete </button>
                                </td>
                            </tr>
                        {/foreach}
                    </table>
                </div>
            </div>
        </div>
    {/if}



</section>