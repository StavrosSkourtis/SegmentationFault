<?php
    /*
        This class descibes a comment

    */

    class Comment{
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
            Constructor

            @param $id is the id of the comment
            @param $type shows if this is a Comment to an answer or to a question, must be 'Q' or 'A'


        */
        public function __construct($id , $type){
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
            Getter methods
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
    }
