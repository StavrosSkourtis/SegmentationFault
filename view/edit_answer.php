<script type="text/javascript" src="view/javascript/answerPostPreview.js"></script>
<div id="AnswerForm">

	<form method="post">
		<p> <?php
			if(isset($args['error_msg'])) 
				print $args["error_msg"];
			?></p>
			
		<h1>Edit an answer</h1> 
		<textarea id="postAnswerTextarea" name="postedAnswer"><?php print $args['answer']->getHtml(); ?></textarea> 
			
			
		<p class="label"> Preview</p>
		<hr>
		<div id="AnswerPreview" class="markdown"><?php print $args['answer']->getHtmlParsed(); ?></div>
		<hr>
		<input id="postAnswerSubmit"  type="submit" value="Enter answer" >

	</form>

	<div style="clear: both"></div>

</div>