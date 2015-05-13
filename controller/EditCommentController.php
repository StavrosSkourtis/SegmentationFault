<?php
	include_once 'utils/Controller.php';
	include_once 'model/SimpleUser.php';
	include_once 'model/Comment.php';

	class EditCommentController extends Controller{


		public function __construct(){
			$this->setTitle("Edit Comment");

			$this->setView("edit_comment.php");
			$this->addCss("edit_comment.css");
			$this->addCss("parsedown.css");
		}	

		public function handle(){
			if(isset($_SESSION['uid']) && isset($_GET['cid']) && isset($_GET['type']) && SimpleUser::ownsComment($_SESSION['uid'] , $_GET['cid'] ,$_GET['type']) ){
				$comment = new Comment();

				$comment->create($_GET['cid'] , $_GET['type']);
			}else{
				header("Location: ?p=home");
                die();
			}

			if( isset($_POST['commentText']) ){
				
				if(strlen($_POST['commentText'])<50){
                    $args["error_msg"] = "Your comment needs to be at least 15 characters";
				}
                else{
					$user = new SimpleUser();
					$user->create($_SESSION['uid']);

					$comment->setUser($user);
					$comment->setText($_POST['commentText']);

					$user->editComment($comment);

					header("Location: ?p=user&id=".$user->getId());
                    die();
				}
			}

			$args["comment"] = $comment;
			$this->showView($args);
		}

	}