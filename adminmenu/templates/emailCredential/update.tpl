<button type="button" hidden class="btn btn-info btn-lg open-update-email-credential-model" data-toggle="modal"
    data-target=".email-credential-update-modal"></button>

<!--  Edit modal -->

<div class="modal fade email-credential-update-modal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-xmark close email-credential" data-dismiss="modal">X</i>
                <h4>Edit</h4>
            </div>

            <div class="modal-body">
                <form class="tecSee-form update-email-credential-form" method="POST" autocomplete="off"
                    enctype="multipart/form-data">
                    <div>
                        <label>Sender</label>
                        <input type="email" name="email" placeholder="Write sender email" required>
                    </div>
                    <div>
                        <label>Mail Host</label>
                        <input type="text" name="mail_host" placeholder="Write mail host" required>
                    </div>

                    <div>
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Write username" required>
                    </div>
                    <div>
                        <label>Password</label>
                        <input type="text" name="password" placeholder="Write password" required>
                    </div>

                    <div class="full-width">
                        <label>Port</label>
                        <input type="text" name="port" placeholder="Write mail port" required>
                    </div>

                    <input type="submit" value="Edit">
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->

<!--  Edit modal -->