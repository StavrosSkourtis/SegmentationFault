<?php
    include_once 'model/SimpleUser.php';
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


        /*
            This is method is called by index.php
        */
        public function handle(){
            if(!empty($_POST)){
                 if($this->signin()){
                   header("Location: ?p=home");
                   exit();
                 }else{
                   $error_msg = "username or password doesn't match";
                 }
            }

            if(isset($error_msg))
                $args["error_msg"] = $error_msg;
            else
                $args = null;
            /*
                Show the view
            */
            $this->showView($args);
        }

        public function signin(){
            $simpleUser=new SimpleUser();
            return $simpleUser->signIn($_POST["email"],$_POST["password"]);
        }
    }
