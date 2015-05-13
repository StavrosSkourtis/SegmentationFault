<?php
	include_once 'utils/Controller.php';
	include_once 'model/SimpleUser.php';
	include_once 'model/Question.php';

	class EditQuestionController extends Controller{


		public function __construct(){

			$this->setTitle("Edit Question");

			$this->setView("edit_question.php");

			$this->addCss("edit_question.css");
			$this->addCss("parsedown.css");
		}	

		public function handle(){
			if(isset($_SESSION['uid']) && isset($_GET['qid']) && SimpleUser::ownsQuestion($_SESSION['uid'],$_GET['qid'])){
				$question = new Question();
				$question->create($_GET['qid']);
			}else{
				header("Location: ?p=home");
                die();
			}

			if(isset($_GET["qid"]) && isset($_POST["tags"]) && isset($_POST["title"]) && isset($_POST["question"])){	
				

				$title=htmlspecialchars($_POST["title"]);
                $html=($_POST["question"]);

                $tags=explode("*",$_POST["tags"]);

                if(count($tags)==0)
                    $error_msg = "You need atleast 1 tag";
                if(strlen($title)<20)
                    $error_msg = "Title should be at least 20 characters";
                if(strlen($html)<50)
                    $error_msg = "Your question needs to be at least 50 characters";

                if(isset($error_msg))
                	$args["error_msg"] = $error_msg;
                else{
                    $args = null;

                    $question = new Question();
					$question->create($_GET["qid"]);
                    $question->setTitle($title);
                    $question->setTags($tags);
                    $question->setHtml($html);


                    $user=new SimpleUser();
                        
                    $user->create($_SESSION['uid']);
                        
                    $question->setUser($user);
                        
                        
                        
                    $user->editQuestion($question);
                        
                    header("Location: ?p=question&id=".$question->getId());
                   	die();
                }
	        }


			
				

			$args["question"] = $question;
			


			$this->showView($args);
		}

	}