<?php
    /*
        This script prints a question item that will be shown at the home page list
        it uses a object ($question) of the class Question to get the correct data.
        that will be predifined from home page.
    */
?>

<div class="question_item">

    <div class="question_title_div">
        <a class="question_item_title" href="?p=question&id=<?php print $question->getId(); ?>" target="_blank">
            <?php print $answer->getTitle(); ?>
        </a>
    </div>

    <br>
    <div class="q_label_div">
        <div class="question_score">
            <?php  print $question->getVotes();?>
        </div>
        <div class="username_and_date">
            <p class="question_item_sub_label">by <a href=""><?php  print $question->getUser()->getUserName();?></a> <?php  print $question->getDatePosted();?></p>
        </div>
    </div>
</div>
<hr>
