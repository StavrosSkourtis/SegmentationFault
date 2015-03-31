<?php
    include_once("utils/Database.php");

    /*
        This file contains an abstact class that describes a User

    */
    abstract class User{
        /*
            User information
        */
        public $id;
        public $name;
        public $surname;
        public $email;
        public $username;


        /*
            returns true if the login was successful
            else it returns false
        */
        public function signIn($email,$password){
            $con = new DatabaseConnection();
            $query = new DatabaseQuery("select password,uid,username from user where email=?" , $con);
            $query->addParameter('s',$email);
            $user = $query->execute();
            if(isset($user)){
                if(password_verify($password,$user["password"])){
                    session_start();
                    $_SESSION["uid"]=$user["uid"];
                    return TRUE;
                }
            }
            return FALSE;
        }


        /*
            create a user and insert his data in the database
        */
        public function signUp($username,$password,$email,$name,$surname){
            $con = new DatabaseConnection();


            /*check if a user with the given username already exists*/
            $query = new DatabaseQuery("select uid from user where username=?" , $con);
            $query->addParameter('s',$username);
            $user = $query->execute();
            if(isset($user)){
                /*if a username is taken ,return false*/
                return FALSE;
            }

            /*create the sql query and add the parameters,id must be auto-increment*/
            $query = new DatabaseQuery("insert into user(username,password,name,surname,email,join_date,type,user_icon) values(?,?,?,?,?,now(),?,?)" , $con);

            $query->addParameter("sssssis",
                $username,
                password_hash($password,PASSWORD_DEFAULT),
                $name,
                $surname,
                $email,
                User::getUserType('User'),
                $icon="null"
            );


            $query->executeUpdate();


            /*
                return TRUE ,which means everything went well,maybe check the affected rows and
                return true only if effectedRows>0.

                If it returns true ,a call to login  should be made for the user to automatically login
            */
            return TRUE;
        }

        /*
            Get all the data of the user,the user must be logged in,'
            this is in the user class instread of the simpleUser cause both Admin and SimpleUser
            should have it,but in general this class should only have methods that an unregistered
            or unlogged user has to call
        */
        public function getData(){
            if(!isset($id)){
                /*id the user is not logged in,return null*/
                return NULL;
            }
            $con = new DatabaseConnection();
            $query = new DatabaseQuery("select * from user where uid=?" , $con);
            $query->addParameter('i',$id);
            $row = $query->execute();

            // store user info
            $this->name = $row["name"];
            $this->surname = $row["surname"];
            $this->email = $row["email"];
            $this->username = $row["username"];
        }
        /*
          signout method(no shit sherlock)
        */
        public function signOut(){
          session_destroy();
          return TRUE;
        }


        /**
         *  This method finds the id of a specific user type in the database.
         *  @param $user_type_string the user type we want the id
         *  @return an integer value of the id of the user type
         */
        public static function getUserType($user_type_string){
            $con = new DatabaseConnection();

            $cmd = new DatabaseQuery("select type_id from UserType where type_name=?" , $con);
            $cmd->addParameter('s',$user_type_string);
            $row = $cmd->execute();

            return $row['type_id'];
        }
    }
?>
