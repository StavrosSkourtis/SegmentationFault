<div id="LoginWraper">
    <form method="post">
        <h1>Welcome Back!</h1>
        <?php if(isset( $args["error_msg"])) : ?>
            <div class='ErrorField'>
                <?php print $args["error_msg"]; ?>
            </div>
        <?php endif; ?>

            <p class="label">E-mail</p>
            <input class="textfield" type="text" name="email" ><br>
            <p class="label">Password</p>
            <input class="textfield" type="password" name="password"><br>
            <br><br>
            <div id="forgot_password_div">
                <a href="?p=signup">Join our community!</a>
                <a href="?p=password_recovery">Recover your password.</a>
            </div>
            <input class="submit_button" type="submit" value="Sign in">
    </form>
</div>
