<?php
	$ajax ='../';
	include_once '../model/Question.php';
	include_once '../model/SimpleUser.php';

	$tags[0] = 'Java';
	$tags[1] = 'C++';
	$tags[2] = 'C';
	$tags[3] = 'Python';

    $question=new Question();
    $question->setTitle("This is title");
    $question->setTags($tags);
    $question->setHtml("tasdad asdsalololol sdaos ldaos dloloolol");


    $user=new SimpleUser();
                       
    $user->create(5);
                        
    $question->setUser($user);
                        
                         
    $user->postQuestion($question);

    print 'All is ok';