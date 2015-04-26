<?php
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
            Constructor creates an object and fills the data with the given id

        */
        public function __construct($id){

        }




        /*
            Getters
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

    }
