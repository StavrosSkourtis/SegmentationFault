function vote(node , id , type){
	var vote = 0;

	pathList = node.src.split('/');

	icon = pathList[pathList.length-1];

	if(icon == 'pressed_up.png' || icon=='pressed_down.png'){
		vote = 0;
	}else if(icon == 'up.png'){
		vote = 1;
	}else if(icon == 'down.png'){
		vote = -1;
	}

	postData = {
		"pid" : id ,
		"type" : type ,
		"vote" : vote
	};

    $.ajax({url: 'ajax/vote.php'  ,type: "POST",data: postData, success: function(result){
       
        	/*
				Script executed successfuly
        	*/
        	if(vote ==1 ){
        		node.src = 'res/ui/pressed_up.png';
        	}else if(vote ==-1){
        		node.src = 'res/ui/pressed_down.png';
        	}else {
        		if(node.src == 'res/ui/pressed_up.png')
        			node.src = 'res/ui/up.png';
        		else
        			node.src = 'res/ui/down.png';
        	}

        
    }});

}