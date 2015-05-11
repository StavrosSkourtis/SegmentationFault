<?php
	include_once 'utils/Controller.php';
	include_once 'model/Question.php';
	include_once 'model/Answer.php';
	include_once 'model/Comment.php';
	include_once 'utils/Parsedown.php';

	class ViewQuestionController extends Controller{

		public function __construct(){
			/*
				Set title
			*/
			$this->setTitle('Question');
			/*
				Set View
			*/
			$this->setView('question.php');


			/*
				Add css files
			*/
			$this->addCss('question.css');
			$this->addCss('parsedown.css');
			$this->addCss('answer.css');
			$this->addCss('comment.css');
		}

		public function handle(){
			
			/*
				Post a comment to a question
			*/
			if(isset($_POST['question_id']) && isset($_POST['question_comment'])){
				$this->postQuestionComment($_POST['question_id']  , $_POST['question_comment']);
			}

			/*
				Post an answer to a question
			*/
			if(isset($_POST['question_id']) && isset($_POST['postedAnswer']) ){
				$this->postAnswer($_POST['question_id']  , $_POST['postedAnswer']);
			}

			/*
				Post a comment to an answer
			*/
			if(isset($_POST['answer_id']) && isset($_POST['answer_comment'])){
				$this->postAnswerComment($_POST['answer_id']  , $_POST['answer_comment']);
			}

			
			/*
				if the id is set
			*/
			if( isset($_GET["id"]) ){
				/*
					create question object
				*/
				$question = new Question();
				/*
					check if question exists and fill it with data
				*/
				if ( $question->create( intval( $_GET["id"] ) ) ) {
					/*
						all is ok set the question to the view
					*/
					$args['question'] = $question;
				}else{
					/*
						Question does not exist redirect to home
					*/
					header("Location: ?p=home");
                	die();
				}
			}else{
				/*
					Question does not exist redirect to home
				*/
				header("Location: ?p=home");
                die();
			}


			/*
				Show View
			*/
			$this->showView($args);
		}


		/*
			Posts an answer
		*/
		private function postAnswer($qid , $answerText){
			/*
				If not logged in return
			*/
			if(  !isset($_SESSION["uid"] ) )
				return 'You must login to post';

			/*
				Get question
			*/
			$question = new Question();
			$question->create($qid);

			/*
				Check if the question exists
			*/
			if($question == false)
				return 'Questions doesnt exist';

			/*
				Create the user
			*/
			$user = new SimpleUser();
			$user->create($_SESSION['uid']);

			/*
				Create the answer
			*/
			$answer = new Answer();

			/*
				set the data
			*/
			$answer->setHtml($answerText);
			$answer->setQuestion($question);
			$answer->setUser($user);


			/*
				post it
			*/
			$user->postAnswer($answer);

			header("Location: ?p=home");
		}

		private function postAnswerComment($aid , $commentText){
			$answer = new Answer();
			$answer->create($aid);

			$this->postComment($answer,'A',$commentText);
		}

		private function postQuestionComment($qid , $commentText){
			$question = new Question();
			$question->create($qid);

			$this->postComment($question, 'Q' ,$commentText);
		}

		private function postComment($target,$target_type,$commentText){
			$user = new SimpleUser();
			$user->create($_SESSION['uid']);

			$comment = new Comment();
			$comment->setUser($user);
			$comment->setText($commentText);
			$comment->setTarget($target);
			$comment->setType($target_type);

			$user->postComment($comment);
		}

	}