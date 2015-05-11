<div class="Answer">
	<div class="AnswerHeader">
		<img class="answerVoteIcon" src="res/ui/up.png">
		<p class="AnswerVoteLabel"> 
			<?php 
				/*
					Print the number of votes
				*/
				print $answer->getVotes();
			?>
		</p>
		<img class="answerVoteIcon" src="res/ui/down.png">  
		<p class="AnswerTopLabel"> 
		<?php 
			/*
				Print the username and the date
			*/
				print 'Posted on '.$answer->getDate().' by '.$answer->getUser()->getUsername();
			?>
		</p>	


	</div>
	<hr>
	<div class="AnswerText markdown">
		<?php print $answer->getHtml(); ?>
		
	</div>

	<hr>

	<div class="AnswerComments">
		<h2> 
			<?php
				print count( $answer->getComments()).' ';
			?>
			Comments
		</h2>
		<?php
			/*
				Loop throught the answer comments and show them
			*/
			for ($i=0; $i < count( $answer->getComments()) ; $i++) { 
				$comment = $answer->getComments()[$i];
				include 'view/comment.php';
			}
		?>
	</div>


	<div class="postCommentForm">
		<form method="post">
			<input type="hidden" name="answer_id" value="<?php print $answer->getId(); ?>">
			<textarea name="answer_comment" class="AnswerCommentTextField"></textarea>
			<input type="submit" value="Enter Comment" class="AnswerCommentSubmit">
		</form>
	</div>
	<?php 
		/*
			The div bellow is used to make the parent div wrap all the floating children divs
		*/
	?>
	<div style="clear: both"></div>
</div>