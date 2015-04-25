
$(document).ready(function(){

    $("#questionField").keyup(function(){

        /*
            Runs every time the user releases the key from the question text input field
            converts the markdown text to html and prints it in the preview div
        */

        /*
            Get the markdown text
        */
        text = $("#questionField").val();

        /*
            Create post data and pass the text variable
        */
        postData = {"plain_text" : text };

        /*
            Craete an http request and to getMarkdown.php which converts the markdown text to html
        */
        $.ajax({url: 'ajax/getMarkdown.php'  ,type: "POST",data: postData, success: function(result){

            /*
                Print to the converted Text
            */
            $("#markdown").html(result);

        }});


    });

});
