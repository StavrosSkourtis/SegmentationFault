<?php session_start() ?>

<div id="Header">
    <div id="HeaderContent">
        <div id="HeaderLeft">
            <h1><a href="?p=home&ofset=0&sorting=newest">Segmentation Fault</a></h1>
        </div>
        <?php if(!isset($_SESSION["uid"])) : ?>
          <div id="HeaderRight">
              <a class="sign_inup" href="?p=signup" >Sign up</a>
              <a class="sign_inup" href="?p=signin" >Sign in</a>
          </div>
        <?php else: ?>
          <div id="HeaderRight">
              <a class="sign_out" href="?p=signout" >Sign out</a>
          </div>
        <?php endif; ?>
    </div>
</div>
<div id="EmptySpaceBellowHeader"></div>
