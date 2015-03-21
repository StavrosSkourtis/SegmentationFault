<?php
    include_once 'utils/Controller.php';



    class SignInController extends Controller{
        public function __construct(){
            /*
                set the title of the page
            */
            $this->setTitle("Sign In");

            /*
                Set the view file
            */
            $this->setView("login.php");
            /*
                Add the css files
            */
            $this->addCss("login.css");
        }

        public function handle(){



            /*
                Show the view
            */
            $this->showView();
        }

    }
