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
                $error=FALSE;
                if($_POST["username"]==""){
                  $error_msg = "Username can't be empty";
                  $error=TRUE;
                }
                if($_POST["email"]==""){
                  $error_msg ="Email can't be empty";
                  $error=TRUE;
                }else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                  $error_msg = "The email address is not valid";
                  $error=TRUE;
                }
                if($_POST["password"]!=$_POST["password2"]){
                  $error_msg ="Passwords are not the same";
                  $error=TRUE;
                }else if(strlen($_POST["password"])<8){
                  $error_msg ="Password must be atleast 8 chars long";
                  $error=TRUE;
                }

                if($error==FALSE){
                  if($this->signup()){
                    header("Location: ?p=signin");
                    exit();
                  }else{
                    $error_msg = "Username is already in use";
                  }

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
        public function signup(){
            $simpleUser=new SimpleUser();
            $res=$simpleUser->signUp($_POST["username"],$_POST["password"],$_POST["email"]);
            return $res;
        }
    }
