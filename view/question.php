<script type="text/javascript" src="view/javascript/answerPostPreview.js"></script>
<script type="text/javascript" src="view/javascript/voting.js"></script>
<div id="ContentWraper">

	<div id="Question">
		
		<div id="QuestionTitleWraper">
				<h1 id="QuestionTitle"> 
					<?php 
						/*
							Print the title
						*/
						print $args['question']->getTitle(); 
					?>
				</h1>
			</div>
		<div id="QuestionHeader">
			<div id="QuestionVote">
				<div id="QuestionVoteWraper">
					<img class="voteIcon" src="res/ui/up.png" onclick="vote(this, <?php   print $args['question']->getId() ?>, 'Q')" > 

					<p class="VoteLabel"> 
						<?php 
							/*
								Print the number of votes
							*/
							print $args['question']->getVotes();
						?>
					</p>


					<img class="voteIcon" src="res/ui/down.png" onclick="vote(this, <?php   print $args['question']->getId() ?>, 'Q')">  
				</div>
			</div>

			<div id="QuestionInfo">
				<p id="UsernameLabel"> 
						<?php 
							/*
								Print the username
							*/
							print 'Asked by '.$args['question']->getUser()->getUsername();
						?>
				</p>	
				<p id="QuestionDate">
						<?php 
							/*
								Print the date
							*/
							print 'on '.$args['question']->getDatePosted();
						?>
				</p>
			</div>
			
		</div>
		
		<hr>
		<div id="QuestionText" class="markdown">
			<?php print $args['question']->getHtmlParsed(); ?>
		</div>

		<hr>
		<div id="comments">
			<h2> 
				<?php
					print count( $args['question']->getComments()).' ';
				?>
				Comments
			</h2>
			<?php
				/*
					Loop throught the questions comments and show them
				*/
				for ($i=0; $i < count( $args['question']->getComments()) ; $i++) { 
					$comment = $args['question']->getComments()[$i];
					include 'view/comment.php';
				}
				
			?>
		</div>
			
		
		<div id="postCommentForm">
			<form method="post" >
				<input type="hidden" name="question_id" value="<?php print $args['question']->getId(); ?>">
				<textarea name="question_comment" id="QuestionCommentTextField"></textarea>
				<input type="submit" value="Enter Comment" id="QuestionCommentSubmit">
			</form>
		</div>

		<?php 
			/*
				The div bellow is used to make the parent div wrap all the floating children divs

			*/
		?>
		<div style="clear: both"></div>
	</div>


	
	<div id="Answers">
		<?php
				/*
					Loop throught the questions answers and show them
				*/
				foreach ($args['question']->getAnswers()  as $answer ) {
					include 'view/answer.php';
				}
				
			?>
	</div>


	<div id="AnswerForm">

		<form method="post">
			<input type="hidden" name="question_id" value="<?php print $args['question']->getId(); ?>" >
			<h1>Enter an answer</h1> 
			<textarea id="postAnswerTextarea" name="postedAnswer"></textarea> 
			
			

			<p class="label"> Preview</p>
			<hr>
			<div id="AnswerPreview" class="markdown">

			</div>
			<hr>
			<input id="postAnswerSubmit"  type="submit" value="Enter answer" >
		</form>
		<div style="clear: both"></div>
	</div>

</div>