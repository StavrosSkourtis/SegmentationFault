<?php
    if(!isset($ajax))
        $ajax = "";
    include_once($ajax."utils/Database.php");

    /*
        This file contains an abstact class that describes a User

    */
    abstract class User{
        /*
            User information
        */
        protected $id;
        protected $name;
        protected $surname;
        protected $email;
        protected $username;
        protected $joinDate;
        protected $reputation;

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getSurname(){
            return $this->surname;
        }

        public function setSurname($surname){
            $this->surname = $surname;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getJoinDate(){
            return $this->joinDate;          
        }
        public function setJoinDate($joinDate){
            $this->joinDate = $joinDate;
        }

        public function getReputation(){
            return $this->reputation;
        }

        public function setReputation($reputation){
            $this->reputation = $reputation;
        }
        /*
            Creates a user based on the id
        */
        public function create($id){
            $dbConnection = new DatabaseConnection();

            $dbQuery = new DatabaseQuery('select * from user where uid=?' , $dbConnection);

            $dbQuery->addParameter('i',$id);
            $set = $dbQuery->execute();

            if($set->getRowCount() <=0)
                return false;

            $row = $set->next();
            $this->id = $id;
            $this->name = $row["name"];
            $this->surname = $row["surname"];
            $this->email = $row["email"];
            $this->joinDate = $row["join_date"];
            $this->username = $row["username"];

            /*
                Get reputation from questions
            */
            $questionRepQuery = new DatabaseQuery('SELECT COALESCE(sum(questionscore.vote),0) as reputation from user
                                                   inner join question on user.uid=question.user
                                                   inner join questionscore on question.qid=questionscore.qid
                                                   where user.uid=?'
                                            ,$dbConnection);
            $questionRepQuery->addParameter('i' , $this->id);

            $repSet = $questionRepQuery->execute();
            $repRow = $repSet->next();

            $this->reputation = $repRow['reputation'];

            /*
                Get reputation from answers
            */
            $answerRepQuery = new DatabaseQuery("SELECT COALESCE(sum(answerscore.vote),0)  as reputation from user
                                                   inner join answer on user.uid=answer.user
                                                   inner join answerscore on answerscore.aid=answer.aid
                                                   where user.uid=?"
                                            ,$dbConnection);
            $answerRepQuery->addParameter('i' , $this->id);

            $repSet = $answerRepQuery->execute();
            $repRow = $repSet->next();

            $this->reputation += $repRow['reputation'];

            /*
                Get reputation from question comments
            */  
            $commentQRepQuery = new DatabaseQuery('SELECT COALESCE(sum(qcommentscore.vote),0)  as reputation from user
                                                   inner join questioncomment on user.uid=questioncomment.user
                                                   inner join qcommentscore on qcommentscore.cid=questioncomment.cid
                                                   where user.uid=?'
                                            ,$dbConnection);
            $commentQRepQuery->addParameter('i' , $this->id);

            $repSet = $commentQRepQuery->execute();
            $repRow = $repSet->next();

            $this->reputation += $repRow['reputation'];

            /*
                Get reputation from answer comments
            */  
            $commentARepQuery = new DatabaseQuery('SELECT COALESCE(sum(acommentscore.vote),0)  as reputation from user
                                                   inner join answercomment on user.uid=answercomment.user
                                                   inner join acommentscore on acommentscore.cid=answercomment.cid
                                                   where user.uid=?',
                                                   $dbConnection);

            $commentARepQuery->addParameter('i' , $this->id);

            $repSet = $commentARepQuery->execute();
            $repRow = $repSet->next();

            $this->reputation += $repRow['reputation'];

            
            $dbConnection->close();
            return true;
        }

        /*
            returns true if the login was successful
            else it returns false
        */
        public function signIn($email,$password){
            $con = new DatabaseConnection();
            $query = new DatabaseQuery("select password,uid,username from user where email=?" , $con);
            $query->addParameter('s',$email);
            $set = $query->execute();
            $user = $set->next();
            if(isset($user)){
                if(password_verify($password,$user["password"])){
                    session_start();
                    $_SESSION["uid"]=$user["uid"];
                    $_SESSION["username"] = $user["username"];
                    return TRUE;
                }
            }
            return FALSE;
        }


        /*
            create a user and insert his data in the database
        */
        public function signUp($username,$password,$email){
            $con = new DatabaseConnection();

            /*check if a user with the given username already exists*/
            $query = new DatabaseQuery("select uid from user where username=?" , $con);
            $query->addParameter('s',$username);

            $set = $query->execute();
            if($set->getRowCount() > 0){
                /*if a username is taken ,return false*/
                return FALSE;
            }


            /*create the sql query and add the parameters,id must be auto-increment*/
            $query = new DatabaseQuery("insert into user(username,password,email,join_date,type,user_icon) values(?,?,?,now(),?,?)" , $con);
            

            $hashed_password = password_hash($password , PASSWORD_DEFAULT);
            $user_type = User::getUserType('User');

            $query->addParameter("sssis",
                $username,
                $hashed_password,
                $email,
                $user_type,
                "null"
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

            $cmd = new DatabaseQuery("select type_id from usertype where type_name=?" , $con);
            $cmd->addParameter('s',$user_type_string);
            $set = $cmd->execute();
            $row = $set->next();
            return $row['type_id'];
        }
        public function getUsername(){
          return $this->username;
        }
        public function setUsername($username){
            $this->username=$username;
        }
        public function setUserid($id){
            $this->id=$id;
        }




    }