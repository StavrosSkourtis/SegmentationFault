<?php
    /*
        Starting point of this application
    */
    include 'utils/controller.php';

    /*
        Define pages that exist on this web sercive
    */
    $pages = array(
        'signin'       => 'SignInController'        ,
        'signup'       => 'SignUpController'        ,
        'postquestion' => 'PostQuestionController'  ,
        'home'         => 'HomePageController'
    );

    /*
        Check if the GET argument 'p' is set.
        If it isn't we set the target controller
        to default ('home').
        If it is we set the target controller
        the value of the GET argument
    */
    if( !isset( $_GET['p'] ) )
        $target_controller = 'home';
    else
        $target_controller = $_GET['p'];

    /*
        We check if the controller to load
        exists in the $pages array.
        If it doesnt exist we set it to default
    */
    if(!array_key_exists($target_controller , $pages))
        $target_controller = 'home';

    /*
        Include and create the right controller object
    */
    include 'controller/'.$pages[$target_controller].'.php';
    $controller = new $pages[$target_controller];

    /*
        load the template
    */
    include 'view/template.php';
