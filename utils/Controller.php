<?php
    /*
        Controller class, all controllers must extend this class
        right now it only forces you to implement the handle method
        it might do other operations in the future.
    */
    abstract class Controller{
        protected $title = "TeiOverflow";

        public function getTitle(){
            return $this->title;
        }
        public function setTitle($title){
            $this->title = $title;
        }

        abstract public function handle();
    }
