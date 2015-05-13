$(document).ready(function(){
    /*
        Default state of dropList is hidden
    */
    $("#dropList").hide();

    /*
        When the user focus on the tag textfield
        fade in the droplist and alse get the
        matching tags
    */
    $("#tagTextfield").focus(function (){
        showMatchingTags();
        $("#dropList").fadeIn();
    });


    /*
        When the user loses focus on the tag textfield
        fade out the drop list
    */
    $("#tagTextfield").focusout(function (){
        $("#dropList").fadeOut();

    });


    /*
        When the user changes the tag Textfield text
        recalculate the proposed tags
    */
    $("#tagTextfield").keyup(function(){
        showMatchingTags();
    });



});


/*
    Finds the tags that match the user's text
*/
function showMatchingTags(){
    /*
        get the user's text
    */
    textField = $("#tagTextfield").val();
    /*
        convert it to post data
    */
    postData = {"search_text" : textField };

    /*
        create a http ruquest to getMatchingTags.php which will return an array of tag names in json format
    */
    $.ajax({url: 'ajax/getMatchingTags.php'  ,type: "POST",data: postData, success: function(result){
        /*
            convert the json text into javascript array
        */
        var tagList = JSON.parse(result);

        /*
            Define variable that will be printed in the drop list
            set default value (empty string)
        */
        var text="";

        /*
            Loop through the array and create the appropriate html for the tag
        */
        for ( i = 0 ;  i < tagList.length ; i++) {
            text += '<p class="listItem" onclick="addTag(\''+tagList[i].tagName+'\')">'+tagList[i].tagName+'</p>';;
        }
        text += '<p class="newlistItem" onclick="addTag(\''+textField+'\')">'+textField+'</p>';
        /*
            print the result
        */
        $("#dropList").html(text);
    }});
}


/*
    Array, will hold the selected tag names
*/
tags = [];

/*
    removes a tag
    @param target the name of the tag to be removed
*/
function removeTag(target){
    /*
        for each element of  the class tagDiv
    */
    $('.tagDiv').each(function(i, obj) {
        /*
            get the text of this element
        */
        text = $( this ).text();

        /*
            check if it equals with the target
        */
        if(text.trim()==target){
            /*
                hide it from the div
            */
            $(this).hide();
            /*
                remove it from the
            */
            tags.splice(i,1);
            /*
                update the tag input element
            */
            setHiddenInput();
        }
    });
}

/*
    Adds a tag
*/
function addTag(tag){
    /*
        Check if that tag exist and show an appropriate message in that case
    */
    for( i =0 ; i < tags.length ; i++ ){
        if(tags[i] == tag){
            $("#informationMessage").html("You have already added this tag!");
            return;
        }

    }

    /*
        Check the number of tags
        show message if exceeds the limit
    */
    if(tags.length<5){
        /*
            reset the p element used for showing information to the user
        */
        $("#informationMessage").html("");
        /*
            Add the tag to the array
        */
        tags[tags.length] = tag;
        /*
            Append the html representation of the tag
        */
        $("#selectedTags").html( $("#selectedTags").html() +'<div class="tagDiv"><a class="tag">'+tag+'</a><img src="res/ui/remove.png" onclick="removeTag(\''+tag+'\')"></div>');
        /*
            update the hidden input field
        */
        setHiddenInput();
    }else{
        $("#informationMessage").html("You can't add any more tags! 5 is the maximum number.");
    }
}

/*
    sets the tag hidden input field
*/
function setHiddenInput(){
    /*
        default value for the data
    */
    data = "";

    /*
        loop through the tags array and add the tag names to the data var
        seperating the name with '*'
    */
    for( i =0 ; i < tags.length ; i++ ){
        if(i== tags.length-1)
            data = data.concat(tags[i]);
        else
            data =data.concat(tags[i].concat("*") );

    }

    /*
        set the value
    */
    $("#tagsPostData").val(data);
}
