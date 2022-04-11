<!--  Edit modal -->

<div class="modal fade" id="credentialModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-xmark close" data-dismiss="modal">X</i>
                <h4>Edit</h4>
            </div>

            <div class="modal-body">
                <form class="tecSee-form update-api-credential" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    {$jtl_token}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="credentialId" name="credentialId">


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