<!DOCTYPE html>
<html>
    <head>
        <title><?php print $controller->getTitle(); ?></title>
        <link rel="stylesheet" href="view/css/header.css">
        <link rel="stylesheet" href="view/css/main.css">
        <link rel="stylesheet" href="view/css/footer.css">
        <link rel="stylesheet" href="view/css/home.css">
        <link rel="stylesheet" href="view/css/question_list_item.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/themes/smoothness/jquery-ui.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
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
