<?php include_once "model/Question.php"; ?>

<div id="ContentWraper">
    <div id="ToolBar">
        <div class="ToolBarItem">
            Newest
        </div>
        <div class="ToolBarItem">
            Top Today
        </div>
        <div class="ToolBarItem">
            All Time Top
        </div>
    </div>

    <div id="DynamicLeftPart">
        <div id="EmptySpaceUnderToolBar">
        </div>
          <div id="Questions">
              <?php

                $questions=Question::getQuestions(0,2);
                foreach ($questions as $question): ?>
                  <div class="question_item">
                      <div class="question_title_div">
                          <a class="question_item_title" href="" target="_blank">
                              <?php echo $question->getTitle() ?>
                          </a>
                      </div>

                      <?php echo $question->getAbstract(); ?>
                      <br><br>
                      <div class="question_tags" >
                          <?php
                            if($question->getTags()!==null){
                              foreach ($question->getTags() as $key => $tag){
                                echo "<div class='q_item_tag'><a href='home?tag=".$key."''>".$tag."</div>";
                              }
                            }
                          ?>
                      </div>
                      <br>
                      <div class="q_label_div">
                          <div class="question_score">
                            <?php echo $question->getVotes(); ?>
                          </div>

                          <div class="username_and_date">
                              <p class="question_item_sub_label">by <a href=""><?php echo $question->getUsername(); ?> </a><?php echo $question->getDatePosted(); ?></p>
                          </div>
                      </div>
                  </div>
                <?php endforeach; ?>


            ?>
        </div>
    </div>

    <div id="FixedRightPart">
        <a id="ask_question_link" href="">Ask a question</a>
        <br>
        <input id="search_box" type="text" hint="Search...">

        <img id="search_icon" src="res/ui/search.png">


        <h2>Selected Tags</h2>
        <div class="tag_div" >
            <div class="tag">Java</div>
            <div class="tag">C++</div>
            <div class="tag">Android</div>
            <div class="tag">C#</div>
            <div class="tag">Java</div>
            <div class="tag">C++</div>
            <div class="tag">Android</div>
            <div class="tag">C#</div>
            <div class="tag">Java</div>
            <div class="tag">C++</div>
            <div class="tag">Android</div>
            <div class="tag">C#</div>
            <div class="tag">C#</div>
            <div class="tag">Java</div>
            <div class="tag">C++</div>
            <div class="tag">Android</div>
            <div class="tag">C#</div>
            <div class="tag">Java</div>
            <div class="tag">C++</div>
            <div style="clear: both"></div>
        </div>


        <h2>Most Popular Tags</h2>
        <div class="tag_div">
            <div class="tag">Java</div>
            <div class="tag">C++</div>
            <div class="tag">Android</div>
            <div class="tag">C#</div>
            <div class="tag">asp.net</div>
            <div class="tag">Python</div>
            <div class="tag">graphics</div>
            <div class="tag">math</div>
            <div class="tag">stuff</div>
            <div class="tag">cpu</div>
            <div class="tag">pithia</div>
            <div style="clear: both"></div>
        </div>


    </div>

</div>
