<script src="view/javascript/markdownParser.js"></script>
<script src="view/javascript/droplist.js"></script>

<div id="ContentWraper">
    <h1 id="ContentTitle">Ask a Question</h1>
    <p id="error_mesg"><?php
                            /*
                                Check if error msg is set , if true then show it
                            */
                            if(isset($args["error_msg"]))
                                print $args["error_msg"];
                        ?></p>
    <form method="post">
        <div id="hiddenInput">
        <input type="hidden" id="tagsPostData" name="tags" value="">
        </div>
        <div class="sub_section">
            <p class="label">Title</p>
            <input type="text" name="title" class="textfield">
        </div>


        <div class="sub_section">
            <p class="label">Your question</p>
            <br>
            <textarea id="questionField" name="question"></textarea>
        </div>

        <div class="sub_section">
            <p class="label">Preview</p>
            <div id="markdown" class="markdown">

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

        </div>

        <div class="sub_section">
            <input class="button" type="submit" value="Post Question">
        </div>
    </form>
</div>
