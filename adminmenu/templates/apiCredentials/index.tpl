<form class="tecSee-form">
    <h2 class="trainer-name">
        Payment process will be redirected to these links:
    </h2>
    <div class="full-width">
        <label>Success Payment</label>
        <input type="text" value="{$successUrl}" style="background: lightgrey;" readonly>
    </div>

    <div class="full-width">
        <label>Canceled Payment</label>
        <input type="text" value="{$cancelUrl}" style="background: lightgrey;" readonly>
    </div>

</form>

<hr />
{if (isset($credentials))}

    <div class="tecSee-table-parent">
        <div class='tecSee-table-container'>
            <div class="tecSee-remove-padding">
                <table class="tecSee-table">
                    <tr>
                        <td>select</td>
                        <th>id</th>
                        <th>Business account/Business-Konto</th>
                        <th>Client Id/Kunden-ID</th>
                        <th>Secret Key/Geheimcode</th>
                        <th>delete</th>
                    <tr>
                        {foreach from=$credentials item=credential}
                        <tr>
                            <td>
                                <button class="fas fa-edit text-dark update-credentials"
                                    credential-attributes="{$credential->id}" plugin-url='{$pluginURL}'></button>
                            </td>
                            <td>{$credential->id}</td>
                            <td>{$credential->business_account}</td>
                            <td>{$credential->client_id}</td>
                            <td>{$credential->secret_key}</td>
                            <td>
                                <form action="" method="get">
                                    <input type="hidden" name="kPlugin" value="{$pluginId}">
                                    <input type="hidden" name="fetch" value="api-credentials">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="credentialId" value="{$credential->id}">
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



<button type="button" hidden class="btn btn-info btn-lg" id="credentialmodeledit" data-toggle="modal"
data-target="#credentialModal"></button>