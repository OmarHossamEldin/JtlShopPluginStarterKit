<form class="tecSee-form">
    <h2 class="trainer-name">
        Payment process will be redirected to these links:
    </h2>
    <div class="full-width">
        <label>Success Payment</label>
        <input type="text" value="{$pluginURL}io.php/ressource?return=success" style="background: lightgrey;" readonly>
    </div>

    <div class="full-width">
        <label>Canceled Payment</label>
        <input type="text" value="{$pluginURL}io.php/ressource?return=cancel" style="background: lightgrey;" readonly>
    </div>

</form>

<hr />

<div class="tecSee-table-parent">
    <div class='tecSee-table-container'>
        <div class="tecSee-loading-container">
            <div class="loading-api-credentials" style="display: none;">
                <img src='{$pluginURL}/mediafiles/Resources/images/loading.gif' width="150px;" />
            </div>
        </div>
        <div class="tecSee-table-container d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-sm prev-api-credentials"
                style="font-weight: bold; width:70px; margin-bottom: 3px; display:none;">Prev</button>
            <button type="submit" class="btn btn-primary btn-sm next-api-credentials"
                style="font-weight: bold; width:70px; margin-bottom: 3px; display:none;">Next</button>
        </div>
        <div class="tecSee-remove-padding">
            <table class="tecSee-table">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Business account/Business-Konto</th>
                        <th>Client Id/Kunden-ID</th>
                        <th>Secret Key/Geheimcode</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody class="results-api-credentials">
                </tbody>

            </table>
        </div>
    </div>
</div>