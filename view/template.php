<!DOCTYPE html>
<html>
    <head>
        <title><?php print $controller->getTitle(); ?></title>
        <link rel="stylesheet" href="view/css/header.css">
        <link rel="stylesheet" href="view/css/main.css">
        <link rel="stylesheet" href="view/css/footer.css">
    </head>
    <body>
        <?php
            //load the header html
            include 'view/header.php';
            //calls the controller witch in turn loads the use case's view
            $controller->handle();
            //load the footer html
            include 'view/footer.php';
        ?>
    </body>
</html>
