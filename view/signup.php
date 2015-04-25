<div id="SignUpWraper">
    <form method="post">


        <h1>Join us</h1>


        <?php if(isset( $args["error_msg"])) : ?>
            <div class='UnfilledField'>
                <?php print $args["error_msg"]; ?>
            </div>
        <?php endif; ?>


        <div id="FieldWraper">
            <div id="Left">
                <p class="label">Username</p>
                <input class="textfield" type="text" name="username"  value="<?php echo @$_POST['username']; ?>" ><br>

                <p class="label">Password</p>
                <input class="textfield" type="password" name="password"><br>
            </div>
            <div id="Right">
                <p class="label">E-mail</p>
                <input class="textfield" type="text" name="email"  value="<?php echo @$_POST['email']; ?>" ><br>

                <p class="label">Password again</p>
                <input class="textfield" type="password" name="password2" ><br>
            </div>
        </div>
            <br><br>

            <div id="forgot_password_div">
                <a href="?p=signin">Already have an account?</a>
                <a href="">Sign in with Google account (not rly).</a>
            </div>
            <input class="submit_button" type="submit" value="Create Account">
    </form>
</div>
