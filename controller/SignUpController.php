<?php
    include_once 'model/SimpleUser.php';
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
            if(!empty($_POST)){
                 if($this->signup()){
                   header("Location: ?p=signin");
                   exit();
                 }
            }

            /*
                Show the view
            */
            $this->showView();

        }
        public function signup(){
            $simpleUser=new SimpleUser();
            return $simpleUser->signUp($_POST["username"],$_POST["password"],$_POST["email"],$_POST["name"],$_POST["surname"]);
        }
    }
