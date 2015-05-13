<?php
	include_once 'utils/Controller.php';
	include_once 'model/SimpleUser.php';
	include_once 'model/Answer.php';
	include_once 'model/Comment.php';
	include_once 'utils/Parsedown.php';

	class EditAnswerController extends Controller{


		public function __construct(){
			$this->setTitle("Edit Answer");

			$this->setView("edit_answer.php");
			$this->addCss("edit_answer.css");
			$this->addCss("parsedown.css");
		}	

		public function handle(){
			if(isset($_SESSION['uid']) && isset($_GET['aid']) && SimpleUser::ownsAnswer($_SESSION['uid'],$_GET['aid'])  ){
				$answer = new Answer();

				$answer->create($_GET['aid']);
			}else{
				header("Location: ?p=home");
                die();
			}

			if( isset($_POST['postedAnswer']) ){
				
				if(strlen($_POST['postedAnswer'])<50){
                    $args["error_msg"] = "Your answer needs to be at least 50 characters";
				}
                else{
					$user = new SimpleUser();
					$user->create($_SESSION['uid']);

					$answer->setUser($user);
					$answer->setHtml($_POST['postedAnswer']);

					$user->editAnswer($answer);

					header("Location: ?p=user&id=".$user->getId());
                    die();
				}
			}

			$args["answer"] = $answer;
			$this->showView($args);
		}

	}