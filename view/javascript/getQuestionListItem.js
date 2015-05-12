var offset = 10;
var count = 10;
var sorting;
var viewQuestions = true;
$(document).ready(function (){

	(function($) {
	    $.fn.hasScrollBar = function() {
	        return this.get(0).scrollHeight > this.height();
	    }
	})(jQuery);

	$(document).scroll(function(){
		var percentage = (100*$(document).scrollTop() ) / $(document).height();

		if( percentage > 30){

			sendRequest();

		}
	})

	for (var i = 0; i < 5; i++) {
		sendRequest();
	}

	$("#search_box").keyup(function (){
		

		postData = {
			"question_search_text" : $("#search_box").val()
		};

	    $.ajax({url: 'ajax/getQuestions.php'  ,type: "POST",data: postData, success: function(result){
	        $("#Questions").html(result);

	        viewQuestions = false;
	    }});
	});

});

function sendRequest(){
	if(!viewQuestions)
		return;
	
	postData = {
		"offset" : offset ,
		"count" : count ,
		"sorting" : sorting
	};

    $.ajax({url: 'ajax/getQuestions.php'  ,type: "POST",data: postData, success: function(result){
        $("#Questions").append(result);
        offset+= count;
    }});

}

