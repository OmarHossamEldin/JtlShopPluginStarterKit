<h2 class="trainer-name">
    This data is used for business account</h2>
<hr />

<form class="tecSee-form store-api-credential" method="POST" autocomplete="off"
    enctype="multipart/form-data">
    {$jtl_token}
    <div>
        <label>Business account/Business-Konto</label>
        <input type="text" name="business_account"
            placeholder="Write your business account/Schreiben sie ihre Business-Konto" required>
    </div>

    <div>
        <label>Client Id/Kunden-ID</label>
        <input type="text" name="client_id" placeholder="Write your client id/Schreiben Sie Ihre Kunden-ID" required>
    </div>

    <div class="full-width">
        <label>Secret Key/Geheimcode</label>
        <input type="text" name="secret_key" placeholder="Write your secret key/Schreiben Sie Ihren Geheimcode"
            required>
    </div>

    <input type="submit" value="Create">
</form>

<hr />