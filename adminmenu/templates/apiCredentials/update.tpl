<button type="button" hidden class="btn btn-info btn-lg open-api-credential-model" data-toggle="modal"
    data-target=".api-credential-modal"></button>
<!--  Edit modal -->

<div class="modal fade api-credential-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-xmark close api-credential" data-dismiss="modal">X</i>
                <h4>Edit</h4>
            </div>

            <div class="modal-body">
                <form class="tecSee-form update-api-credential-form" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    <div>
                        <label>Business account/Business-Konto</label>
                        <input type="text" name="business_account" id="businessAccount"
                            placeholder="Write your business account/Schreiben sie ihre Business-Konto" required>
                    </div>

                    <div>
                        <label>Client Id/Kunden-ID</label>
                        <input type="text" name="client_id" id="clientId"
                            placeholder="Write your client id/Schreiben Sie Ihre Kunden-ID" required>
                    </div>

                    <div class="full-width">
                        <label>Secret Key/Geheimcode</label>
                        <input type="text" name="secret_key" id="secretKey"
                            placeholder="Write your secret key/Schreiben Sie Ihren Geheimcode" required>
                    </div>

                    <input type="submit" value="Edit">
                </form>
            </div>
        </div>

    </div>
</div>

<!--  Edit modal -->