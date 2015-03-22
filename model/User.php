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
        public function login($email,$password){
            $con = new DatabaseConnection();
            $query = new DatabaseQuery("select password,uid,username from user where email=?" , $con);
            $query->addParameter('s',$email);
            $result = $query->execute();
            $user = $result->fetch_assoc();
            if(isset($user)){
                if(password_verify($password,$user["password"])){
                    $id=$user["uid"];
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
            $result = $query->execute();
            $user = $result->fetch_assoc();
            if(isset($user)){
                /*if a username is taken ,return false*/
                return FALSE;
            }

            /*create the sql query and add the parameters,id must be auto-increment*/
            $query = new DatabaseQuery("insert into user(username,password,name,surname,email,join_date,type,user_icon) values(?,?,?,?,?,now(),?,?)" , $con);

            $query->getQuery()->bind_param("sssssis" ,
              $username,
              password_hash($password,PASSWORD_DEFAULT),
              $name,
              $surname,
              $email,
              $type=1,
              $icon="null"
            );

            $result = $query->execute();


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
            $result = $query->execute();

            //fetch the row
            $row = $result->fetch_assoc();

            // store user info
            $this->name = $row["name"];
            $this->surname = $row["surname"];
            $this->email = $row["email"];
            $this->username = $row["username"];
        }

    }
?>
