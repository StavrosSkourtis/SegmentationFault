<?php
    include '../utils/Parsedown.php';


    /*
        We check if data was given
    */
    if(isset($_POST["plain_text"])){

        /*
            create parsedown object
        */
        $parsedown = new Parsedown();

        /*
            parse the text given and return the output
            we use setsetMarkupEscaped(true) to protect
            against xss.
        */
        print $parsedown->setMarkupEscaped(true)->text($_POST["plain_text"]);

    }
