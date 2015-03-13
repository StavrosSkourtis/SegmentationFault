<!DOCTYPE html>
<html>
    <head>
        <title><?php print $controller->getTitle(); ?></title>
        <link rel="stylesheet" href="view/css/header.css">
        <link rel="stylesheet" href="view/css/body.css">
    </head>
    <body>
        <div id="Header">

        </div>
        <?php
            //calls the controller witch in turn loads the use case's view
            $controller->handle();
        ?>
        <div id="Footer">

        </div>
    </body>
</html>
