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
					<img class="voteIcon" src="res/ui/up.png">

					<p class="VoteLabel"> 
						<?php 
							/*
								Print the number of votes
							*/
							print $args['question']->getVotes();
						?>
					</p>


					<img class="voteIcon" src="res/ui/down.png">  
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
			<?php print $args['question']->getHtml(); ?>
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
			<textarea name="question_comment" id="QuestionCommentTextField"></textarea>
			<input type="submit" value="Enter Comment" id="QuestionCommentSubmit">
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
				for ($i=0; $i < count( $args['question']->getAnswers()) ; $i++) { 
					$answer = $args['question']->getAnswers()[$i];
					include 'view/answer.php';
				}
				
			?>
	</div>


</div>