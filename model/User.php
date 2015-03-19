<?php
    /*
        This file contains an abstact class that describes a User

    */
    abstract class User{
        /*
            User information
        */
        private $id

        /*
            returns true if the login was successful
            else it returns false
        */
        public function login($email,$password){
            $con = new DatabaseConnetion();
            $query = new DatabaseQuery("select password,uid,username from user where email=?" , $con);
            $query->addParameter('s',$email);
            $result = $query->execute();
            $user = $result->fetch_assoc()
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
            $con = new DatabaseConnetion();

            /*check if a user with the given username already exists*/
            $query = new DatabaseQuery("select uid from user where username=?" , $con);
            $query->addParameter('s',$username);
            $result = $query->execute();
            $user = $result->fetch_assoc()
            if(isset($user)){
                /*if a username is taken ,return false*/
                return FALSE;
            }
           
            /*create the sql query and add the parameters,id must be auto-increment*/
            $query = new DatabaseQuery(
                "insert into user(username,password,name,surname,email,join_date,type,user_icon) "+
                "values(?,?,?,?,?,?,?,?)" , $con);

            $query->addParameter('s',$username);
            $query->addParameter('s',password_hash($password));
            $query->addParameter('s',$name);
            $query->addParameter('s',$surname);
            $query->addParameter('s',$email);
            $query->addParameter('s',date("Y-m-d H:i:s"));
            $query->addParameter('i',0);/*unregistered user=0,simple user=1,mod=2,admin=3*/
            $query->addParameter('s',"null");

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
            $con = new DatabaseConnetion();
            $query = new DatabaseQuery("select * from user where uid=?" , $con);
            $query->addParameter('i',$id);
            return $query->execute();
        }

    }
