<?php include_once "model/Question.php"; ?>

<script>
    function change_sorting() {
        window.location="?p=home&ofset=0&sorting="+document.getElementById("ToolBar").value;
    }
</script>

<div id="ContentWraper">
    <select id="ToolBar" onchange="change_sorting()">
        <option class="ToolBarItem" value="newest" <?php if($_GET["sorting"] == 'newest'){echo("selected");}?>>
            Newest
        </option>
        <option class="ToolBarItem" value="toptoday" <?php if($_GET["sorting"] == 'toptoday'){echo("selected");}?>>
            Top Today
        </option>
        <option class="ToolBarItem" value="alltimetop" <?php if($_GET["sorting"] == 'alltimetop'){echo("selected");}?>>
            All Time Top
        </option>
    </select>

    <div id="DynamicLeftPart">
        <div id="EmptySpaceUnderToolBar">
        </div>
          <div id="Questions">
              <?php if($args["questions"]!==null) foreach ($args["questions"] as $question): ?>
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
                              <p class="question_item_sub_label">by <a href=""><?php echo $question->getUser()->getUsername(); ?> </a><?php echo $question->getDatePosted(); ?></p>
                          </div>
                      </div>
                  </div>
                <?php endforeach; ?>

        </div>
        <br><br>

        <?php

          if($_SESSION["questions_ofset"]!=0){
            echo '<a class="next_page_link" href="?p=home&ofset='.($_SESSION["questions_ofset"]-$args["questions_per_page"]).'">newer</a>';
          }
          if($args["questions"]!==null)echo '<a class="next_page_link" href="?p=home&ofset='.($_SESSION["questions_ofset"]+$args["questions_per_page"]).'">older</a>';
        ?>

    </div>

    <div id="FixedRightPart">
        <a id="ask_question_link" href="">Ask a question</a>
        <br>
        <input id="search_box" type="text" hint="Search...">

        <img id="search_icon" src="res/ui/search.png">


        <h2>Selected Tags</h2>
        <div class="tag_div" >
            <a href="" class="tag">Java</a>
            <a href="" class="tag">C++</a>
            <a href="" class="tag">Android</a>
            <a href="" class="tag">C#</a>
            <a href="" class="tag">Java</a>
            <a href="" class="tag">C++</a>
            <a href="" class="tag">Android</a>
            <a href="" class="tag">C#</a>
            <div style="clear: both"></div>
        </div>


        <h2>Most Popular Tags</h2>
        <div class="tag_div">
            <a href="" class="tag">Java</a>
            <a href="" class="tag">C++</a>
            <a href="" class="tag">Android</a>
            <a href="" class="tag">C#</a>
            <a href="" class="tag">Java</a>
            <a href="" class="tag">C++</a>
            <a href="" class="tag">Android</a>
            <a href="" class="tag">C#</a>
            <div style="clear: both"></div>
        </div>

    </div>

</div>
