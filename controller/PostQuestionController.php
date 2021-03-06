<?php
    include_once 'utils/Controller.php';
    include_once 'model/Question.php';
    include_once 'controller/SignInController.php';

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
            if(!isset($_SESSION["uid"])){
                /*
                    User has not logged in
                    redirect to sign in page
                */

                header("Location: ?p=signin");
                die();
            }else{
                /*
                    User has logged in
                */
                if(isset($_POST["tags"]) && isset($_POST["title"]) && isset($_POST["question"])){
                    $title=htmlspecialchars($_POST["title"]);
                    $html=($_POST["question"]);

                    $tags=explode("*",$_POST["tags"]);

                    if(count($tags)==0)
                        $error_msg = "You need atleast 1 tag";
                    if(strlen($title)<20)
                        $error_msg = "Title should be atleast 20 characters";
                    if(strlen($html)<50)
                        $error_msg = "Your question needs to be atleast 50 characters";

                    if(isset($error_msg))
                        $args["error_msg"] = $error_msg;
                    else{
                        $args = null;


                        $question=new Question();
                        $question->setTitle($title);
                        $question->setTags($tags);
                        $question->setHtml($html);


                        $user=new SimpleUser();
                        
                        $user->create($_SESSION['uid']);
                        
                        $question->setUser($user);
                        
                        
                        
                        $user->postQuestion($question);
                        
                        header("Location: ?p=home");
                        die();
                    }
                }

                /*
                    show view
                */
                $args['status'] = 'init';
                $this->showView($args);
            }


        }

    }
