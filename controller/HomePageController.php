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
        public static $questions_per_page = 4;
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
            if(isset($_GET["ofset"]))
                $_SESSION["questions_ofset"]=$_GET["ofset"];

            if(!isset($_SESSION["questions_ofset"]))
                $_SESSION["questions_ofset"]=0;
            
            if(isset($_GET["sorting"])){
              $sorting=$_GET["sorting"];
            }else $sorting=$_GET["sorting"]="newest";


            $args["questions"] = Question::getQuestions($_SESSION["questions_ofset"],self::$questions_per_page,$sorting);;

            $args["questions_per_page"]=self::$questions_per_page;
            /*
                Show the view
            */
            $this->showView($args);
        }

    }
