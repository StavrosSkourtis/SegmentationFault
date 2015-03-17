<?php
    /*
        This file contains an abstact class that describes a User

    */

    abstract class User{

        /*
            User information
        */
        private $id
        private $username;
        private $email;
        private $name;
        private $surname;

        /*
            returns true if the login was successful
            else it returns false
        */
        public function login($password){

        }

        /*
            create a user and insert his data in the database
        */
        public function signUp($id,$username,$email,$name,$surname){

        }

        /*
            Getter methods
        */

        public function getId(){
            return $this->id;
        }

        public function getName(){
            return $this->name;
        }

        public function getUsername(){
            return $this->username;
        }

        public function getEmail(){
            return $this->email;
        }

        public function getSurname(){
            return $this->surname;
        }

    }
