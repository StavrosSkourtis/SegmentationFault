<div class="Comment">
	
	<div class="CommentVoteWraper">
		<div class="QuestionIconWraper">
				<img class="commentVoteIcon" 
					id="<?php print 'UP'.$comment->getType().'C'.$comment->getId(); ?>"
					<?php 
						if(isset($args['user']) && $args['user']->hasVoted($comment->getId() ,$comment->getType().'C') ==1){
							print 'src="res/ui/pressed_up.png" ';
						}else{
							print 'src="res/ui/up.png" ';
						}
					?>
					onclick="vote(this, <?php   print $comment->getId() ?>, <?php print '\''.$comment->getType().'C\'';  ?>)">
				<img 
					id="<?php print 'DN'.$comment->getType().'C'.$comment->getId(); ?>";
					class="commentVoteIcon" 
					<?php 
						if(isset($args['user']) && $args['user']->hasVoted($comment->getId() ,$comment->getType().'C') ==-1){
							print 'src="res/ui/pressed_down.png" ';
						}else{
							print 'src="res/ui/down.png" ';
						}
					?>
					onclick="vote(this, <?php   print $comment->getId() ?>, <?php print '\''.$comment->getType().'C\'';  ?>)">  
		</div>
		<p  id="<?php print 'LB'.$comment->getType().'C'.$comment->getId(); ?>" class="CommentVotes"> <?php  print $comment->getVotes(); ?>  </p>
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
			<p><?php 
				/*
					Print the edit date
				*/
				if(!is_null($comment->getEditDate()))
				print 'Last Edit on '.$comment->getEditDate();
			?></p>
		</div>

	</div>

	<hr>
</div>