<?php
    class Question{
        private $html;
        private $id;
        private $userId;
        private $datePosted;
        private $lastEdited;
        private $solved;
        private $upvotes;
        private $downvote;

        public function getHtml(){
            return $this->html;
        }

        public function getId(){
            return $this->id;
        }

        public function getUserId(){
            return $this->userId;
        }

        public function getDatePosted(){
            return $this->datePosted;
        }

        public function getLastEdited(){
            return $this->lastEdited;
        }

        public function getUpvotes(){
            return $this->upvotes;
        }

        public function getDownvotes(){
            return $this->downvotes;
        }

        public function getPoints(){
            return $upvotes-$downvotes;
        }

        public function setHtml($html){
            $this->html = $html;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setUserId($userId){
            $this->userId = $userId;
        }

        public function setDatePosted($datePosted){
            $this->datePosted = $datePosted;
        }

        public function setLastEdited($lastEdited){
            $this->lastEdited = $lastEdited;
        }

        public function setUpvotes($upvotes){
            $this->upvotes = $upvotes;
        }

        public function setDownvotes($downvotes){
            $this->downvotes = $downvotes;
        }

        public function upvote(){
            $this->upvotes++;
        }

        public function downvotes(){
            $this->downvotes++;
        }
    }
