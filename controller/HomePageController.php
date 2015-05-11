<?php
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
            $args["tags"] = $this->getTopTenTags();

            /*
                Show the view
            */
            $this->showView($args);
        }

        /*
            will return an array of string that represent tag names
        */
        public function getTopTenTags(){
            /*
                Create the connection
            */
            $dbConnection = new DatabaseConnection();


            /*
                Create the query
            */
            $query = new DatabaseQuery('select tag.tag_string, COALESCE(count(questiontags.tag),0) as c from tag
                                        inner join questiontags on questiontags.tag=tag.tag_id
                                        order by c desc limit 10' ,$dbConnection);

            $set = $query->execute();

            $tags = array();

            while($row = $set->next()){
                $tags[count($tags)] = $row['tag_string'];
            }

            $dbConnection->close();

            return $tags;

        }

    }
