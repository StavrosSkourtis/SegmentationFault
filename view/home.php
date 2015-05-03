<script type="text/javascript" src="view/javascript/getQuestionListItem.js"></script>
<script type="text/javascript">
    
    sorting = <?php print "'".$args["sorting"]."'"; ?>;

</script>
<div id="ContentWraper">
    <div id="ToolBar">
        <a class="sortingOption" href="?p=home&sorting=new">Latest</a>
        <a class="sortingOption" href="?p=home&sorting=top">Top</a>
        <hr>
    </div>


    <div id="DynamicLeftPart">
        <div id="EmptySpaceUnderToolBar">
        </div>
          <div id="Questions">
              <?php
                    if($args["questions"]!==null){
                        foreach ($args["questions"] as $question){
                            include 'question_list_item.php';
                        }
                    }
              ?>

        </div>
        <br><br>

    </div>

    <div id="FixedRightPart">
        <a id="ask_question_link" href="?p=postquestion">Ask a question</a>
        <br>
        <input id="search_box" type="text" hint="Search...">

        <img id="search_icon" src="res/ui/search.png">


        <h2>Top 10 Tags</h2>
        <div class="tag_div">
            <p href="" class="tag">Java</p> 
            <p href="" class="tag">C++</p>
            <p href="" class="tag">Android</p>
            <p href="" class="tag">C#</p>
            <p href="" class="tag">Java</p>
            <p href="" class="tag">C++</p>
            <p href="" class="tag">Android</p>
            <p href="" class="tag">C#</p>
            <p href="" class="tag">C#</p>
            <p href="" class="tag">C#</p>
            <div style="clear: both"></div>
        </div>

    </div>

</div>
