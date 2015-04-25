<?php
    include_once 'utils/Controller.php';

    class PostQuestionController extends Controller{

        public function __construct(){
            /*
                set title
            */
            $this->setTitle("Ask a question");

            /*
                set view
            */
            $this->setView("postQuestion.php");

            /*
                add css
            */
            $this->addCss("post_question.css");
            $this->addCss("parsedown.css");

        }

        public function handle(){



            /*
                show view
            */
            $args['status'] = 'init';
            $this->showView($args);
        }

    }
