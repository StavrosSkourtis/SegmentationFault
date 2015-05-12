<?php
	
	/*
		Check if post data is set

	*/
	if( isset($_POST['offset']) && isset($_POST['count']) && isset($_POST['sorting'] ) ){
		/*
			include the Question class
		*/
		$ajax = "../";
		include_once '../model/Question.php';
		include_once '../utils/Database.php';

		/*
			get the array of questions
		*/

		$questions = Question::getQuestions($_POST['offset'] , $_POST['count'] ,$_POST['sorting']);
		
		/*
			loop thought the questions
		*/
		foreach ($questions as $question) {
			
			/*
				The bellow script will use the $question object and print html
				
			*/
			include '../view/question_list_item.php';

		}

	}else if(isset($_POST['question_search_text']) ){
		$ajax= "../";
		include_once '../model/Question.php';
		include_once '../utils/Database.php';

		$questions = Question::getQuestionsLike($_POST['question_search_text']);

		
		foreach ($questions as $question) {
			
			/*
				The bellow script will use the $question object and print html
				
			*/
			include '../view/question_list_item.php';
			
		}
	}