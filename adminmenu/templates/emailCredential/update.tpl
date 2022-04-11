<button type="button" hidden class="btn btn-info btn-lg" id="emailcredentialmodeledit" data-toggle="modal"
    data-target="#emailCredentialModal"></button>

<!--  Edit modal -->

<div class="modal fade" id="emailCredentialModal" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <i class="fas fa-xmark close" data-dismiss="modal">X</i>
                <h4>Edit</h4>
            </div>

            <div class="modal-body">
                <form class="tecSee-form update-category" method="POST"
                    autocomplete="off" enctype="multipart/form-data">
                    {$jtl_token}
                    <input type="hidden" name="_method" value="PUT">
                    <input type="hidden" id="emailCredentialId" name="emailCredentialId">
                    <div>
                    <label>Sender</label>
                    <input type="email" name="email" id="email-address" placeholder="Write sender email" required>
                </div>
                <div>
                    <label>Mail Host</label>
                    <input type="text" name="mail_host" id="mail-host" placeholder="Write mail host" required>
                </div>
        
                <div>
                    <label>Username</label>
                    <input type="text" name="username" id="username" placeholder="Write username" required>
                </div>
                <div>
                    <label>Password</label>
                    <input type="text" name="password" id="password" placeholder="Write password" required>
                </div>
        
                <div class="full-width">
                    <label>Port</label>
                    <input type="text" name="port" id="port" placeholder="Write mail port" required>
                </div>

                    <input type="submit" value="Edit">
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal -->

<!--  Edit modal -->