<?php
	session_start();
	/*
		check if the data we need has been set
		else we exit with -1 code
	*/

	
	if( isset( $_POST['pid']) && isset($_POST['type']) && isset($_POST['vote']) && isset($_SESSION['uid']) ){
		/*
			Load all the files we need
		*/
		$ajax = '../';
		include_once '../model/SimpleUser.php';
		include_once '../model/Question.php';
		include_once '../model/Answer.php';
		include_once '../model/Comment.php';

		/*
			Create the user from the current session
		*/
		$user = new SimpleUser();
		$user->create($_SESSION['uid']);



		/*
			Compate the type of the post and create it
			if the type is not a valid option then we termitate the script
		*/
		if($_POST['type'] == 'Q' ){
			/*
				Create question
			*/
			$target = new Question();
			$target->create($_POST['pid']);
		}else if($_POST['type'] == 'A'){
			/*
				Create answer
			*/
			$target = new Answer();
			$target->create($_POST['pid']);
		}else if($_POST['type'] == 'AC'){
			/*
				Create the comment
			*/
			$target = new Comment();
			$target->create($_POST['pid'], 'A');
		}else if($_POST['type'] == 'QC'){
			/*
				Create the comment
			*/
			$target = new Comment();
			$target->create($_POST['pid'], 'Q');
		}else{
			print 'Type not defined';
			exit();
		}

		/*
			vote
		*/
		if( $_POST['vote'] == 1 ){
			$user->upvote($target);
		}else if( $_POST['vote'] == -1 ){
			$user->downvote($target);
		}else if( $_POST['vote'] == 0){
			$user->neutralvote($target);
		}else{
			print 'Vote not valid';
		}

		/*
			exit with code 1
			means all is ok
		*/
		print  'All is ok';
	}else
		print 'Data is not set';
