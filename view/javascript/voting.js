function vote(node , id , type){
	var vote = 0;



	pathList = node.src.split('/');

	icon = pathList[pathList.length-1];

	if(icon == 'pressed_up.png' || icon=='pressed_down.png'){
		vote = 0;

		if( icon =='pressed_up.png')
			voteChange = -1;
		else 
			voteChange = 1;
	}else if(icon == 'up.png'){
		vote = 1;
		voteChange = 1;
	}else if(icon == 'down.png'){
		vote = -1;
		voteChange = -1;
	}

	postData = {
		"pid" : id ,
		"type" : type ,
		"vote" : vote
	};

    $.ajax({url: 'ajax/vote.php'  ,type: "POST",data: postData, success: function(result){
       
		/*
			Check if the result is numeric
 		*/
        if( !isNaN(result)){
        	/*
			Script executed successfuly
	       	*/
	       	if(vote ==1 ){
	       		node.src = 'res/ui/pressed_up.png';
	       	}else if(vote ==-1){
	       		node.src = 'res/ui/pressed_down.png';
	       	}else {
        		if(icon == 'pressed_up.png')
        			node.src = 'res/ui/up.png';
        		else
        			node.src = 'res/ui/down.png';
        	}

        	if( node.id==("UP"+type+id) ){
        		document.getElementById("DN"+type+id).src='res/ui/down.png';
        	}else if( node.id==("DN"+type+id) ){
        		document.getElementById("UP"+type+id).src='res/ui/up.png';
        	}
        	label = document.getElementById("LB"+type+id);
        	label.innerHTML = result;
       	}
    }});

}