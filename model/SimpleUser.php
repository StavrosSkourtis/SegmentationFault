<?php

    /*
        This scripts contains the SimpleUser class
        It defines the basic action of a registered user
    */
    if(!isset($ajax))
        $ajax = "";
    include_once $ajax.'model/User.php';

    class SimpleUser extends User {
        /*
        constructor used to create the object when the user is login in or creating a new account.
        After this,login or signup should be called to populate the object
        */
        function __construct(){

        }


        public function upvote($votable){
            $votable->vote( $this->id ,+1);
        }

        public function neutralvote($votable){
            $votable->vote( $this->id , 0);
        }

        public function downvote($votable){
            $votable->vote( $this->id ,-1);
        }


        /*
            Start of the ADD methods
        */


        /*
            Creates a answer for a given question
            @param $question object of the type Question
            @param $tags is an ARRAY of STRINGS containing tag names

            TODO
            Run an sql statement that inserts the parameter
            question to the database and the tags

            Question columns:

            qid , auto increment (αυξάνεται αυτόματα) DO NOT include this in the insert statement
            title , the title of the question
            html , the text of the question
            user , the user id , NOT username
            post_date , the date it is posted
            edit_date , the last edit date , dont include this

            After that insert the tags to the database
            target sql table : questiongtags

            questiongtags columns

            question , question id (πρέπει να το πάρεις αυτο μονο σου απο την βαση)
            tag , tag id (πρεπει να βρείς τα id που αντιστοιχουν στα string που δινονται)

            Για οδηγίες σχετικά με την βαση δεδομένων στην php πάνε εδώ testbed/database_test.php
        */
        public function postQuestion($question){
            if(!$this->checkIfLoggedIn())
                return;		
			
            /*
                Create database connection
            */
				$dbConnection = new DatabaseConnection();

            /*
                Create query
            */
				$dbQuery = new DatabaseQuery('insert into question (title,html,user,post_date) values(?,?,?,CURDATE())' , $dbConnection);
			
            

            /*
                Set the parameters from the question object
            */
			$title =$question->getTitle();
			$html = $question->getHtml();
			$user = $question->getUser()->getId();
			
           
			$dbQuery->addParameter('ssi',$title,$html,$user);
          
            /*
                exucute the query
            */
			$qresults = $dbQuery->execute();	

            /*
                close the database connection
            */
			$dbConnection->close();
        }


        /*
            Creates a answer
            @param $answer object of the type Answer

            TODO
            Run an sql statement that inserts the parameter
            answer to the database

            Database tables
            -Answer

            check database for correct column names

            Για οδηγίες σχετικά με την βαση δεδομένων στην php πάνε εδώ testbed/database_test.php
        */
		
		/*
			Creates an answer on a given question
            @param the answer
		*/
        public function postAnswer($answer){
            if(!$this->checkIfLoggedIn())
                return;
			
			 
			$dbConnection = new DatabaseConnection();

            $dbQuery = new DatabaseQuery('insert into answer(html,user,question,post_date) values(?,?,?,CURDATE())' , $dbConnection);

	
			/*
				query parameters
			*/
			$html=$answer->getHtml();
			$user=$answer->getUser()->getId();
			$question=$answer->getQuestion()->getId();
			

            print $html;
			
            $dbQuery->addParameter('sii',$html,$user,$question);

             
			$qresults = $dbQuery->execute();			
			
			/*
                close the database connection
            */
			$dbConnection->close();
        }

        /*
            Creates a comment on a given post(question or answer)
            @param the question
        */
        public function postComment($comment){
            if(!$this->checkIfLoggedIn())
                return;
			
			
            /*
                Create database connection
            */
				$dbConnection = new DatabaseConnection();

            /*
                Create query
            */
			
			$text=$comment->getText();
			$user=$comment->getUser()->getId();
			/*
				same method name so no problem if is a question or an answer
			*/
			$id=$comment->getTarget()->getId();
			
			
			if($comment->getType() == 'Q') {			
				$dbQuery = new DatabaseQuery('insert into questioncomment (text,user,post_date,question) values(?,?,CURDATE(),?)' , $dbConnection);
			}
			else if ($comment->getType() == 'A') {				
				$dbQuery = new DatabaseQuery('insert into answercomment (text,user,post_date,answer) values(?,?,CURDATE(),?)' , $dbConnection);
			}
			
			
			/*
				Set the parameters from the question object
			*/
			$dbQuery->addParameter('sii',$text,$user,$id);
			
			/*
                exucute the query
            */
			$qresults = $dbQuery->execute();	

            /*
                close the database connection
            */
			$dbConnection->close();
			
			
        }


        /*
            Start of the DELETE methods
        */

        /*
            Deletes a question from the database, first all its answer must be deleted
        */
        public function deleteQuestion($question){
            if(!$this->checkIfLoggedIn())
                return;
        }

        /*
            Deletes an answer from the database, first all its comments must be deleted
        */
        public function deleteAnswer($answer){
            if(!$this->checkIfLoggedIn())
                return;
        }

        /*
            Deletes a comment from the database.
        */
        public function deleteComment($comment){
            if(!$this->checkIfLoggedIn())
                return;
        }


        /*
            Start of the EDIT methods
        */

        /*
            Edits the answer : updates all its data to match the data of the parameter
            dont alter comments
            dont change the owner (user id)
        */
        public function editAnswer($answer){
            if(!$this->checkIfLoggedIn())
                return;
        }

        /*
            Edits the answer : updates all its data to match the data of the parameter
            dont alter comments
            dont change the owner (user id)
        */
        public function editQuestion($question){
            if(!$this->checkIfLoggedIn())
                return;
        }

        /*
            Edits the answer : updates all its data to match the data of the parameter
            dont alter comments
            dont change the owner (user id)
        */
        public function editComment($comment){
            if(!$this->checkIfLoggedIn())
                return;
        }


        /*
            Checks if THIS user is logged in
        */
        public function checkIfLoggedIn(){
            if( isset($_SESSION["uid"])  && $_SESSION["uid"]==$this->id)
                return true;
            else
                return false;
        }


        /*
            Returns an array of Question objects that were posted by this user
        */
        public function getQuestions(){
            /*
                Create the connection
            */
            $dbConnection = new DatabaseConnection();

            /*
                Create the query that gets the id of the questions            
            */
            $query = new DatabaseQuery( 'select qid from question where user=?', $dbConnection);

            /*
                Set the parameter and execute
            */
            $query->addParameter('i',$this->id);
            $set = $query->execute();

            /*
                init the array
            */
            $questions = array();

            /*
                Loop throught the results , create the questions and add it to the array
            */
            while($row = $set->next()){
                $question = new Question();
                $question->create($row['qid']);

                $questions[count($questions)] = $question;
            }

            $dbConnection->close();

            /*
                return the array
            */
            return $questions;
        }

        /*
            Returns an array of Comment objects that were posted by this user
        */
        public function getComments(){
            /*
                Create the connection
            */
            $dbConnection = new DatabaseConnection();

            /*
                Create the query
                add the parameter and execute it
            */
            $qCommentQuery = new DatabaseQuery( 'select cid from questioncomment where user=?' ,$dbConnection);
            $qCommentQuery->addParameter('i' , $this->id);
            $qCommentSet = $qCommentQuery->execute();

            /*
                the array that will hold the cooments
            */
            $comments = array();

            /*
                Loop through the result set , create the comment and add it to the array
            */
            while($qRow = $qCommentSet->next()){
                $comment = new Comment();
                $comment->create($qRow['cid'] , 'Q');
                $comment->fetchTarget();
                $comments[ count($comments) ] = $comment;
            }


            /*
                Create the query that will get the id of the comments to answers
                add the parameter and execute it 
            */
            $aCommentQuery = new DatabaseQuery('select cid from answercomment where user=?' , $dbConnection );
            $aCommentQuery->addParameter('i' , $this->id);
            $aCommentSet = $aCommentQuery->execute();

            /*
                loop through the result set , create the comment and add it to the array
            */
            while ( $aRow = $aCommentSet->next()){
                $comment = new Comment();
                $comment->create($aRow['cid'] , 'A');
                $comment->fetchTarget();
                $comment->getTarget()->fetchQuestion();
                $comments[ count($comments) ] = $comment;
            }

            $dbConnection->close();


            /*
                return the array
            */
            return $comments;
        }

        public function hasVoted($pid , $type){
            /*
                Create the connection
            */
            $dbConnection = new DatabaseConnection();

            /*
                Create the query
            */
            if($type == 'Q' ){
                $query = new DatabaseQuery('select vote from questionscore where qid=?,uid=?' ,$dbConnection);
            }else if($type == 'A'){
                $query = new DatabaseQuery('select vote from answerscore where aid=?,uid=?' ,$dbConnection);
            }else if($type == 'AC'){
                $query = new DatabaseQuery('select vote from acommentscore where cid=?,uid=?' ,$dbConnection);
            }else if($type == 'QC'){
                $query = new DatabaseQuery('select vote from qcommentscore where cid=?,uid=?' ,$dbConnection);
            }

            /*
                add the parameter and execute
            */
            $query->addParameter('ii',$pid,$this->id);
            $set = $query->execute();

            /*
                If number of rows equals zero then return false
            */
            if($set->getRowCount() ==0)
                return false;

            /*
                Get first row
            */  
            $row = $set->next();

            /*
                If vote equals 0 then return false
            */
            if($row['vote'] == '0')
                return false;

            /*
                Any other case the user has voted , so return true
            */
            return true;
        }

        /*
            returns an array of Answer objects that were posted by this user
        */
        public function getAnswers(){
            /*
                Create the database Connection
            */
            $dbConnection = new DatabaseConnection();

            /*
                Create the query
                add the parameter and execute it
            */
            $query = new DatabaseQuery('select aid from answer where user=?' , $dbConnection);
            $query->addParameter('i' , $this->id);
            $set = $query->execute();

            /*
                create the array that will hold the answers
            */

            $answers = array();

            /*
                loop through the result set , create the answers and add them to the array
            */
            while($row = $set->next()){
                $answer = new Answer();
                $answer->create($row['aid']);
                $answer->fetchQuestion();

                $answers[ count($answers) ] = $answer; 
            }

            $dbConnection->close();

            /*
                return the array
            */
            return $answers;
        }
    }
