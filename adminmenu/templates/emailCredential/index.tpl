<section>
    {if (isset($emailCredentials)) && (count($emailCredentials) > 0)}
        <div class="tecSee-table-parent">
            <div class='tecSee-table-container'>
                <div class="tecSee-remove-padding">
                    <table class="tecSee-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Mail Host</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Port</th>
                            <th>Update</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                        <tbody>
                            {foreach from=$emailCredentials item=email}
                            <tr>
                                <td>{$email->id}</td>
                                <td>{$email->email}</td>
                                <td>{$email->mail_host}</td>
                                <td>{$email->username}</td>
                                <td>{$email->password}</td>
                                <td>{$email->port}</td>
                                <td><center><button class="btn btn-primary tecSee-button-update" style="font-size:16px; width: 100px">Update</button></center></td>
                                <td><center><button class="btn btn-danger tecSee-button-delete" style="font-size:16px; width: 100px">Delete</button></center></td>
                            </tr>
                        {/foreach}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    {/if}
</section>