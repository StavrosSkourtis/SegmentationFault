<div id="Header">
    <div id="HeaderContent">
        <div id="HeaderLeft">
            <!-- <img src="res/ui/banner.png" > -->
            <h1>
            <a class="titleBracket">&lt;</a>
            <a  id="HeaderLink" href="?p=home&ofset=0&sorting=newest"> 
            Segmentation Fault</a>
            <a class="titleBracket">/&gt;</a></h1>
        </div>
        <?php if(!isset($_SESSION["uid"])) : ?>
          <div id="HeaderRight">
              <a class="sign_inup" href="?p=signup" >Sign up</a>
              <a class="sign_inup" href="?p=signin" >Sign in</a>
          </div>
        <?php else: ?>
          <div id="HeaderRight">
              <a class="user_link" href="?p=user&id=<?php print $_SESSION["uid"]; ?>" >Logged in as <?php print $_SESSION["username"]; ?></a>
              <a class="sign_out" href="?p=signout" >Sign out</a>
          </div>
        <?php endif; ?>
    </div>
</div>
<div id="EmptySpaceBellowHeader"></div>
