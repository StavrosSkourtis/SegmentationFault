<div id="postCommentForm">
	<h1>Edit comment</h1>
	<p><?php
		if(isset($args['error_msg']))
			print $args['error_msg'];
	?></p>
	<form method="post" >
		<textarea name="commentText" id="QuestionCommentTextField"><?php print $args['comment']->getText();?></textarea>
		<input type="submit" value="Enter Comment" id="QuestionCommentSubmit">
	</form>
</div>