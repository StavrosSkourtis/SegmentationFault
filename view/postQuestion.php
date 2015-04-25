<script src="view/javascript/markdownParser.js"></script>
<script src="view/javascript/droplist.js"></script>

<div id="ContentWraper">
    <h1 id="ContentTitle">Ask a Question</h1>

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
            <div id="markdown">

            </div>
        </div>


        <p class="label" id="informationMessage"></p>
        <div class="sub_section">
            <p class="label">Add tags</p>
            <input type="text" class="textfield" id="tagTextfield">
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
