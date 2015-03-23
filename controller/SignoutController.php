<?php
    include_once 'model/SimpleUser.php';
    include_once 'utils/Controller.php';

    class SignOutController extends Controller{
        public function __construct(){

        }

        public function handle(){
          $simpleUser=new SimpleUser($_SESSION["uid"]);
          if($simpleUser->signOut()){
            header("Location: ?p=home");
            exit();
          }
        }

    }
