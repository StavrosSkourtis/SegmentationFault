<div class="Comment">
	
	<div class="CommentVoteWraper">
		<div class="QuestionIconWraper">
				<img class="commentVoteIcon" src="res/ui/up.png">
				<img class="commentVoteIcon" src="res/ui/down.png">  
		</div>
		<p class="CommentVotes"> <?php  print $comment->getVotes(); ?>  </p>
	</div>
	<div class="CommentRightPartWraper">
		<div class="CommentText">
			<p class="CommentTextParagraph">
				<?php  print $comment->getText(); ?> 
			</p>
		</div>

		<div class="CommentInfo">
			<p class="CommentUsernameField"> <?php print 'By '.$comment->getUser()->getUsername(); ?></p>
			<p class="CommentDateField"> <?php print 'Posted on '.$comment->getDate(); ?></p>
		</div>

	</div>

	<hr>
</div>