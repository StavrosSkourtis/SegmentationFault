
$(document).ready(function(){

    $("#questionField").keyup(function(){

        text = $("#questionField").val();
        postData = {"plain_text" : text };
        $.ajax({url: 'ajax/getMarkdown.php'  ,type: "POST",data: postData, success: function(result){
            $("#markdown").html(result);
        }});


    });

});
