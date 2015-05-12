var offset = 10;
var count = 5;
var sorting;
var viewQuestions = true;
$(document).ready(function (){

	(function($) {
	    $.fn.hasScrollBar = function() {
	        return this.get(0).scrollHeight > this.height();
	    }
	})(jQuery);



	$(window).scroll(function(){
	    if ($(window).scrollTop() == $(document).height()-$(window).height()){
	        sendRequest();
	    }
	});


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