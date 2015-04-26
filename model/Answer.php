<?php
    include_once 'model/Votable.php';
    /*
        This class describes an answer
    */

    class Answer{
        /*
            The text of the answer
        */
        private $html;
        /*
            The user this belongs to
            Object of the type SimpleUser
        */
        private $user;
        /*
            Thd id of the answer
        */
        private $id;
        /*
            The question this answer
            Object of the type Question
        */
        private $question;
        /*
            Array of objects (Comment)
        */
        private $comments;
        /*
            The date this was posted
        */
        private $date;
        /*
            the score of the answer
        */
        private $votes;

        /*
            Fills the object with data from the database using the given id
        */
        public function create($id){

        }


        /*
            Inserts a vote to the database
        */
        public function vote($uid, $vote){

        }


        /*
            Getters and Setters
        */
        public function getText(){
            return $this->text;
        }

        public function getUser(){
            return $this->user;
        }

        public function getQuestion(){
            return $this->question;
        }

        public function getComments(){
            return $this->comments;
        }

        public function getDate(){
            return $this->date;
        }

        public function getVotes(){
            return $this->votes;
        }

        public function setText($text){
            $this->text = $text;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function getQuestion($question){
            $this->question = $question;
        }

        public function getComments($comments){
            $this->comments = $comments;
        }

        public function getDate($date){
            $this->date = $date;
        }

        public function getVotes($votes){
            $this->votes = $votes;
        }


        /*
            Static method

        */

        /*
            Returns an Array of answers that belong to that question
        */
        public static function getAnswers($question_id){

        }
    }
