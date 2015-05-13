<?php
	include_once 'utils/Controller.php';
	include_once 'model/SimpleUser.php';
	include_once 'model/Question.php';
	include_once 'model/Answer.php';

	class ViewUserProfileController extends Controller{

		public function __construct(){
			$this->setTitle("User profile");
			/*
				set the view and css files
			*/
			$this->setView("user_profile.php");
			$this->addCss("user_profile.css");
		}

		public function handle(){

			if( isset($_SESSION['uid']) && isset($_GET['pid'] ) && isset($_GET['type']) && isset($_GET['action'])  ){
				$user = new SimpleUser();
				$user->create($_SESSION['uid']);

				if($_GET['action'] == 'delete' ){
					if($_GET['type'] =='Q' && SimpleUser::ownsQuestion($_SESSION['uid'],$_GET['pid'])){
						$question = new Question();
						$question->create($_GET['pid']);

						$user->deleteQuestion($question);
					}else if($_GET['type'] == 'A' && SimpleUser::ownsAnswer($_SESSION['uid'],$_GET['pid']) ){
						$answer = new Answer();
						$answer->create($_GET['pid']);

						$user->deleteAnswer($answer);
					}else if($_GET['type'] == 'AC' && SimpleUser::ownsComment($_SESSION['uid'] , $_GET['pid'] ,'A')){
						$comment = new Comment();
						$comment->create($_GET['pid'],'A');

						$user->deleteComment($comment);
					}else if($_GET['type'] == 'QC' && SimpleUser::ownsComment($_SESSION['uid'] , $_GET['pid'] ,'Q') ){
						$comment = new Comment();
						$comment->create($_GET['pid'],'Q');

						$user->deleteComment($comment);
					}
				}else if($_GET['action'] == 'edit'){
					if($_GET['type'] =='Q'){
						header("Location: ?p=editquestion&qid=".$_GET['pid']);
                		die();
					}else if($_GET['type'] == 'A'){
						header("Location: ?p=editanswer&aid=".$_GET['pid']);
                		die();
					}else if($_GET['type'] == 'AC'){
						header("Location: ?p=editcomment&type=A&cid=".$_GET['pid']);
                		die();
					}else if($_GET['type'] == 'QC'){
						header("Location: ?p=editcomment&type=Q&cid=".$_GET['pid']);
                		die();
					}
				}

			}

			if ( isset($_GET['id']) ) {

				$user = new SimpleUser();

				$user->create($_GET['id']);

				$args["user"] = $user;
				$args['questions'] = $user->getQuestions();
				$args['answers'] = $user->getAnswers();
				$args['comments'] = $user->getComments();
			}


			$this->showView($args);
		}

	}