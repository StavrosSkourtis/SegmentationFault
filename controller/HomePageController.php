<?php
	/*
        DILWSA ERGASIA ASURMATA
    */

    include_once 'model/Question.php';
    /**
     *  This file contains the controller for the main page
     *  this pages show the latest/top etc questions
     */
    class HomePageController extends Controller{

        public function __construct(){
            /*
                set the title of the page
            */
            $this->setTitle("Home Page");

            /*
                Set the view file
            */
            $this->setView("home.php");
            /*
                Add the css files
            */
            $this->addCss("home.css");
            $this->addCss("question_list_item.css");
        }

        public function handle(){

            if(isset($_GET["sorting"]))
                $sorting=$_GET["sorting"];
            else
                $sorting="new";

            
            $args["sorting"] = $sorting;
            $args["questions"] = Question::getQuestions(0,10,$sorting);;


            /*
                Show the view
            */
            $this->showView($args);
        }

    }
