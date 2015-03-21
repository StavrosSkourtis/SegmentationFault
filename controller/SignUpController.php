<?php
    include_once 'utils/Controller.php';

    class SignUpController extends Controller{

        public function __construct(){
            /*
                set the title of the page
            */
            $this->setTitle("Join us!");

            /*
                Set the view file
            */
            $this->setView("signup.php");
            /*
                Add the css files
            */
            $this->addCss("signup.css");
        }

        public function handle(){



            /*
                Show the view
            */
            $this->showView();
        }

    }
