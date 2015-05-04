<div id="ContentWraper">
	
	<h1 class="title" ><?php print $args['user']->getUsername(); ?></h1>
	<p class="label"><?php print count($args['questions']);?> Questions</p>
	<p class="label"><?php print count($args['answers']);  ?> Answers</p>
	<p class="label"><?php print count($args['comments']); ?> Comments</p>
	<p>Reputation <?php print $args['user']->getReputation(); ?> </p>
	
	<div id="UserQuestions" class="PostContainer">
		<h2 class="subtitle">Questions</h2>
		<hr>

		<?php
			foreach ($args['questions'] as $question ) {
				print '<a href="?p=question&id='.$question->getId().'" >';
				print $question->getTitle();
				print '</a>';
				print '<br>';
			}
		?>

	</div>

	<div id="UserAnswers" class="PostContainer">
		<h2 class="subtitle">Answers</h2>
		<hr>
		<?php
			foreach ($args['answers'] as $answer ) {
				print '<a href="?p=question&id='.$answer->getQuestion()->getId().'" >';
				print $answer->getQuestion()->getTitle();
				print '</a>';
				print '<br>';
			}
		?>
	</div>

	<div id="UserComments" class="PostContainer">
		<h2 class="subtitle">Comments</h2>
		<hr>
		<?php
			foreach ($args['comments'] as $comment ) {

				if($comment->getType() == 'Q'){
					print '<a href="?p=question&id='.$comment->getTarget()->getId().'" >';
					print $comment->getTarget()->getTitle();	
				}
				else{
					print '<a href="?p=question&id='.$comment->getTarget()->getQuestion()->getId().'" >';
					print $comment->getTarget()->getQuestion()->getTitle();
				}
				print '</a>';
				print '<br>';
			}
		?>
	</div>

</div>