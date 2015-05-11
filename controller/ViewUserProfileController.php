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