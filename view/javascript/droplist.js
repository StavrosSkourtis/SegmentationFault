$(document).ready(function(){
    $("#dropList").hide();
    $("#tagTextfield").focus(function (){
        showMatchingTags();
        $("#dropList").fadeIn();
    });

    $("#tagTextfield").focusout(function (){
        $("#dropList").fadeOut();

    });


    $("#tagTextfield").keyup(function(){
        showMatchingTags();
    });



});


function showMatchingTags(){
    text = $("#tagTextfield").val();
    postData = {"search_text" : text };

    $.ajax({url: 'ajax/getMatchingTags.php'  ,type: "POST",data: postData, success: function(result){
        var tagList = JSON.parse(result);

        var text="";

        for ( i = 0 ;  i < tagList.length ; i++) {
            text += '<p class="listItem" onclick="addTag(\''+tagList[i].tagName+'\')">'+tagList[i].tagName+'</p>';
        }

        $("#dropList").html(text);
    }});
}


tags = [];

function removeTag(target){
    $('.tagDiv').each(function(i, obj) {
        text = $( this ).text();
        if(text.trim()==target){
            $(this).hide();
            tags.splice(i,1);
            setHiddenInput();
        }
    });
}

function addTag(tag){
    for( i =0 ; i < tags.length ; i++ ){
        if(tags[i] == tag){
            $("#informationMessage").html("You have already added this tag!");
            return;
        }

    }

    if(tags.length<5){
        $("#informationMessage").html("");
        tags[tags.length] = tag;
        $("#selectedTags").html( $("#selectedTags").html() +'<div class="tagDiv"><a class="tag">'+tag+'</a><img src="res/ui/remove.png" onclick="removeTag(\''+tag+'\')"></div>');
        setHiddenInput();
    }else{
        $("#informationMessage").html("You can't add any more tags! 5 is the maximum number.");
    }
}

function setHiddenInput(){
    data = "";
    for( i =0 ; i < tags.length ; i++ ){
        if(i== tags.length-1)
            data = data.concat(tags[i]);
        else
            data =data.concat(tags[i].concat("*") );

    }


    $("#tagsPostData").val(data);

}
