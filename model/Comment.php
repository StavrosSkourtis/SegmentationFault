<?php
    /*
        This class descibes a comment

    */
    include_once 'model/Votable.php';

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
            if($type == 'Q'){
                /*
                    This is a comment to a question
                */
                $query = "";

            }else if($type == 'A'){
                /*
                    This is a comment to a answer
                */
                $query = "";

            }

            /*
                TODO run query and fill data
            */


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


        }
    }
