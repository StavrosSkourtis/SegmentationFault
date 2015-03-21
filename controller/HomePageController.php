<?php

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



            /*
                Show the view
            */
            $this->showView();
        }

    }
