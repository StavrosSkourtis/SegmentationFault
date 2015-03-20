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
                include 'view/question_list_item.php';
                include 'view/question_list_item.php';
                include 'view/question_list_item.php';
                include 'view/question_list_item.php';
                include 'view/question_list_item.php';
                include 'view/question_list_item.php';
                include 'view/question_list_item.php';
                include 'view/question_list_item.php';
                include 'view/question_list_item.php';

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
