<?php

    class HomePageController extends Controller{

        public function __construct(){
            $this->setTitle("Home Page");
        }

        public function handle(){


            //show view
            include 'view/home.php';
        }

    }
