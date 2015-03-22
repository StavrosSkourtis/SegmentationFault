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
                  echo "<div class='UnfilledField'>Username can't be empty</div>";
                  $error=TRUE;
                }
                if($_POST["email"]==""){
                  echo "<div class='UnfilledField'>Email can't be empty</div>";
                  $error=TRUE;
                }else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)){
                  echo "<div class='UnfilledField'>The email address is not valid</div>";
                  $error=TRUE;
                }
                if($_POST["name"]==""){
                  echo "<div class='UnfilledField'>Name can't be empty</div>";
                  $error=TRUE;
                }
                if($_POST["surname"]==""){
                  echo "<div class='UnfilledField'>Surname can't be empty</div>";
                  $error=TRUE;
                }
                if($_POST["password"]!=$_POST["password2"]){
                  echo "<div class='UnfilledField'>Passwords are not the same</div>";
                  $error=TRUE;
                }else if(strlen($_POST["password"])<8){
                  echo "<div class='UnfilledField'>Password must be atleast 8 chars long</div>";
                  $error=TRUE;
                }

                if($error==FALSE){
                  if($this->signup()){
                    header("Location: ?p=signin");
                    exit();
                  }else{
                    echo "<div class='UnfilledField'>Username is already in use</div>";
                  }

                }
            }

            /*
                Show the view
            */
            $this->showView();

        }
        public function signup(){
            $simpleUser=new SimpleUser();
            $res=$simpleUser->signUp($_POST["username"],$_POST["password"],$_POST["email"],$_POST["name"],$_POST["surname"]);
            return $res;
        }
    }
