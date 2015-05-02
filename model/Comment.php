<?php
    /*
        This class descibes a comment

    */
    include_once 'model/Votable.php';
    include_once 'utils/Database.php';

    class Comment implements Votable{
        /*
            The of the comment
        */
        private $id;
        /*
            The date this was posted
        */
        private $date;
        /*
            The date it was last edited
        */
        private $editDate;

        /*
            The comment text
        */
        private $text;
        /*
            The score of this comment
        */
        private $votes;
        /*
            Object of the type question
        */
        private $user;
        /*
            Can be object of the class Answer or Question
        */
        private $target;
        /*
            The type of the target
        */
        private $type;


        /*
            Creates a comment

            @param $id is the id of the comment
            @param $type shows if this is a Comment to an answer or to a question, must be 'Q' or 'A'


        */
        public function create($id , $type){
            $this->type = $type;
            $this->id = $id;

            /*
                Create the connection
            */
            $dbConnection = new DatabaseConnection();

            /*
                Create the query
            */
            if($target_type == 'Q'){
                $query = new DatabaseQuery("select * from questioncomment where cid=?" , $dbConnection);
            }else if($target_type == 'A'){
                $query = new DatabaseQuery("select * from answercomment where cid=?" , $dbConnection);
            }

            /*
                Add the parameter and execute
            */
            $query->addParameter('i',$id);
            $set = $query->execute();

            $row = $set->next();
            $this->date = $row['post_date'];
            $this->text = $row['text'];
            $this->editDate = $row['edit_date'];

            if($target_type == 'Q')
                $this->target = $row['question'];
            else if($target_type == 'A')
                $this->target = $row['answer'];
            
            $user = new SimpleUser();
            $user->create($row["user"]);
            $this->user = $user;

            if($target_type == 'Q'){
                $votesQuery = new DatabaseQuery("select sum(vote) as votes from qcommentscore where cid=?" , $dbConnection);
            }else if($target_type == 'A'){
                $votesQuery = new DatabaseQuery("select sum(vote) as votes from acommentscore where cid=?" , $dbConnection);
            }
            $votesQuery->addParameter('i',$id);
            $set2 = $votesQuery->execute();

            $votesRow = $set2->next();

            $votes = $votesRow['votes'];

            $this->votes = $votes;   

            $dbConnection->close();
        }


        /*
            Inserts a vote to the database
        */
        public function vote($uid, $vote){

        }


        /*
            Getter and Setter methods
        */
        public function getId(){
            return $this->id;
        }

        public function getDate(){
            return $this->date;
        }

        public function getText(){
            return $this->text;
        }

        public function getUser(){
            return $this->user;
        }

        public function getTarget(){
            return $this->target;
        }

        public function getType(){
            return $this->type;
        }

        public function getVotes(){
            return $this->votes;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function setText($text){
            $this->text = $text;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function setTarget($target){
            $this->target = $target;
        }

        public function setType($type){
            $this->type = $type;
        }

        public function setVotes($votes){
            $this->votes = $votes;
        }


        /*
            Static method
        */

        /*
            Creates and returns an Array of Comments
            @param target_id the id of the target
            @param target_type the type of the target , 'Q' means question , 'A' means answer

        */
        public static function getComments($target_id , $target_type ){
            /*  
                Create the connection
            */
            $dbConnection = new DatabaseConnection();

            if($target_type == 'Q'){
                $query = new DatabaseQuery("select cid from questioncomment where question=?" , $dbConnection);
            }else if($target_type == 'A'){
                $query = new DatabaseQuery("select cid from answercomment where answer=?" , $dbConnection);
            }

            $query->addParameter('i',$target_id);

            $set = $query->execute();

            $comments = array();

            while($row = $set->next()){
                $comment = new Comment();
                $comment->create($row['cid'] , $target_type);

                $comments[count($comments)] = $comment;
            }

            $dbConnection->close();

            return $comments;
        }
    }
