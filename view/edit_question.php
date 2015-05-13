<script src="view/javascript/markdownParser.js"></script>
<script src="view/javascript/droplist.js"></script>

<script>
<?php
	
	print 'tags = [ ';
	for ($i=0; $i < count($args['question']->getTags()) ; $i++) { 
		print '\''.$args['question']->getTags()[$i].'\', ';

    }
    print '];';
?>
</script>
<div id="ContentWraper">
    <h1 id="ContentTitle">Edit Question</h1>
    <p id="error_mesg"><?php
                            /*
                                Check if error msg is set , if true then show it
                            */
                            if(isset($args["error_msg"]))
                                print $args["error_msg"];
                        ?></p>
    <form method="post">
        <div id="hiddenInput">
        <input type="hidden" id="tagsPostData" name="tags" value="<?php 
           	for ($i=0; $i < count($args['question']->getTags()) ; $i++) { 
           		if($i == count($args['question']->getTags())-1)
           			print $args['question']->getTags()[$i];
           		else
           			print $args['question']->getTags()[$i].'*';
           	}
        ?>">
        </div>
        <div class="sub_section">
            <p class="label">Title</p>
            <input type="text" name="title" class="textfield" value="<?php 
            	print $args['question']->getTitle();
            ?>">
        </div>


        <div class="sub_section">
            <p class="label">Edit your question bellow</p>
            <br>
            <textarea id="questionField" name="question"><?php 
            		print $args['question']->getHtml();
            	?></textarea>
        </div>

        <div class="sub_section">
            <p class="label">Preview</p>
            <div id="markdown" class="markdown">
            	<?php 
            		print $args['question']->getHtmlParsed();
            	?>
            </div>
        </div>


        <p class="label" id="informationMessage"></p>
        <div class="sub_section">
            <p class="label">Add tags</p>
            <input type="text" class="textfield" id="tagTextfield" autocomplete="off">
            <div id="dropList">
            </div>
        </div>


        <div id="selectedTags">
        	<?php 
            		foreach ($args['question']->getTags() as $tag) {
            			print '<div class="tagDiv"><a class="tag">'.$tag.'</a><img src="res/ui/remove.png" onclick="removeTag(\''.$tag.'\')"></div>';
            		}
           	?>
        </div>

        <div class="sub_section">
            <input class="button" type="submit" value="Post Question">
        </div>
    </form>
</div>
