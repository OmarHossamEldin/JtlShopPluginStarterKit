<section>
    <form class="tecSee-form create-email-credentials"  method="POST" autocomplete="off"
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

        <input type="submit" value="Create">
    </form>
    <hr />
</section>