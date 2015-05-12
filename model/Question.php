<?php
    /*
        This class describes a Question

        note static methods are located at the bottom
    */
    if(!isset($ajax))
        $ajax = "";

    include_once($ajax."utils/Database.php");
    include_once $ajax.'utils/Parsedown.php';
    include_once($ajax."model/SimpleUser.php");
    include_once($ajax."model/Votable.php");
    include_once($ajax."model/SimpleUser.php");
    include_once($ajax."model/Answer.php");
    include_once($ajax."model/Comment.php");

    class Question implements Votable{
        /*
            The questions text
        */
        private $html;
        /*
            The questions id
        */
        private $id;
        /*
            The date it was posted
        */
        private $datePosted;
        /*
            The date it was last edited
        */
        private $lastEdited;
        /*
            boolean
        */
        private $solved;
        /*
            The score of the question
        */
        private $votes;
        /*
            Array of Strings
        */
        private $tags =  array();
        /*
            The Title of the question
        */
        private $title;
        /*
            Object of the type SimpleUser
            DONT mistake this for user id
            DONT mistake this for username
        */
        private $user;
        /*
            Array of comments
        */
        private $comments;
        /*
            Array of answers
        */
        private $answers;


        /*
            Fills data from the database
        */
        public function create($id){
            $this->id = $id;

            /*
                Create the database connection
            */
            $dbConnection = new DatabaseConnection();

            /*
                set up the query
            */
            $query = new DatabaseQuery("select * from question where qid=?" ,$dbConnection);
            $query->addParameter('i',$id);
            /*
                execute the query
            */
            $set  = $query->execute();  

            /*
                if the number of rows is equal or bellow zero we return false
            */
            if($set->getRowCount() <= 0 )
                return false;

            /*
                Get the data in an array
                there is no need for a while loop because it is not possible for this query to return for than 1 rows
                because question id is unique
            */
            $row  = $set->next();

            /*
                Get basic data
            */
            $this->title = $row["title"];
            $this->html = $row["html"];
            $this->datePosted = $row["post_date"];
            $this->lastEdited = $row["edit_date"];

            /*
                Get the user
            */
            $user = new SimpleUser();
            $user->create($row["user"]);

            $this->user = $user;

            /*
                get the answers and the comments
            */
            $this->answers = Answer::getAnswers($id,$this);
            $this->comments = Comment::getComments($id,'Q',$this);
            


            /*
                Get the tags
            */
            
            $tagQuery = new DatabaseQuery("select tag_string 
                                           from tag 
                                           inner join questiontags on tag.tag_id=questiontags.tag 
                                           where questiontags.question=? "
                                          ,$dbConnection);
            $tagQuery->addParameter('i',$id);

            $tagSet = $tagQuery->execute();

            while($tagRow = $tagSet->next() ){

                $this->tags[count($this->tags)] = $tagRow['tag_string'];

            }
            


            $votesQuery = new DatabaseQuery("select sum(vote) as score from questionscore where qid=?",$dbConnection);
            $votesQuery->addParameter('i',$id);


            $votesSet = $votesQuery->execute();

            if($votesSet->getRowCount() == 0)
                $this->votes = 0;
            else{                
                $votesRow = $votesSet->next();
                if(is_null($votesRow['score']) )
                    $this->votes = 0;
                else
                    $this->votes = $votesRow['score'];
            }

            $dbConnection->close();
            /*
                every thing is ok return true
            */
            return true;
        }


        /*
            Inserts a vote to the database

            First check if exists a record on questionscore table
            with $uid and $this->id

            if true
            alter that row and set vote to $vote

            if false
            insert a rown with $uid , $this->id and $vote
        */
        public function vote($uid, $vote){

			/*
                Create database connection
            */
				$dbConnection = new DatabaseConnection();

            /*
                Create query
            */
				$dbQuery = new DatabaseQuery('select qid from questionscore where qid=?' , $dbConnection);
			
            

            /*
                Set the parameters 
            */
           
			$dbQuery->addParameter('i',$this->getId());
          
            /*
                exucute the query
            */
			
			$qresults = $dbQuery->execute();	

			/*
				count returned rows
			*/
			
			$count=0;
			while($qresults->next()) {
				$count=$count+1;
				break;
			}
			
			/*
				if we didnt have any row we can insert a new one
			*/
			if($count == 0) {
				/*
					Create query
				*/
				
				$dbQuery = new DatabaseQuery('insert into questionscore(qid,uid,vote) values(?,?,?)' , $dbConnection);
				
				/*
					Set the parameters
				*/
				$dbQuery->addParameter('iii',$this->getId(),$uid,$vote);
				
			}
			/*
				else we must update the table
			*/
			else {
				/*
					Create query
				*/
				
				$dbQuery = new DatabaseQuery('update questionscore set vote =? where qid=?' , $dbConnection);
				
				/*
					Set the parameters
				*/
				$dbQuery->addParameter('ii',$vote,$this->getId());
				
			}
			
			
			/*
				exucute the query
			*/
				$qresults = $dbQuery->execute();
				
			
            /*
                close the database connection
            */
			
			$dbConnection->close();
        }

        public function refreshVotes(){
            $dbConnection = new DatabaseConnection();
            $votesQuery = new DatabaseQuery("select sum(vote) as score from questionscore where qid=?",$dbConnection);
            $votesQuery->addParameter('i',$this->id);


            $votesSet = $votesQuery->execute();

            if($votesSet->getRowCount() == 0)
                $this->votes = 0;
            else{                
                $votesRow = $votesSet->next();
                if(is_null($votesRow['score']) )
                    $this->votes = 0;
                else
                    $this->votes = $votesRow['score'];
            }
        }

        /*
            Getter and setters
        */
        public function setTags($tags){
          $this->tags=$tags;
        }
        /*
          appends an answer to the question
        */
        public function setAnswers($answers){
            $this->answers = $answers;
        }
        public function getAnswers(){
            return $this->answers;
        }
        /*
          get the abstract of a question,the abstract is shown at the question's listing
        */
        public function getAbstract(){
          return substr($this->html,0,100);
        }
        public function getHtml(){
            return $this->html;
        }
        public function getId(){
            return $this->id;
        }
        public function getUserId(){
            return $this->userId;
        }
        public function getDatePosted(){
            return $this->datePosted;
        }
        public function getLastEdited(){
            return $this->lastEdited;
        }
        public function getVotes(){
            return $this->votes;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getUser(){
            return $this->user;
        }
        public function setUser($user){
            $this->user=$user;
        }
        public function getPoints(){
            return $upvotes-$downvotes;
        }
        public function getTags(){
            return $this->tags;
        }
        public function setHtml($html){
            $this->html = $html;
        }
        public function setId($id){
            $this->id = $id;
        }
        public function setTitle($title){
            $this->title = $title;
        }
        public function setUserId($userId){
            $this->userId = $userId;
        }
        public function setDatePosted($datePosted){
            $this->datePosted = $datePosted;
        }
        public function setLastEdited($lastEdited){
            $this->lastEdited = $lastEdited;
        }
        public function setVotes($votes){
            $this->votes = $votes;
        }
        public function setDownvotes($downvotes){
            $this->downvotes = $downvotes;
        }
        public function getComments(){
            return $this->comments;
        }
        public function setComment($comments){
            $this->comments;
        }

        public function addComment($comment){
            $this->comments[count($this->comments)] = $comment;
        }

        public function addAnswer($answer){
            $this->answers[count($this->answers)] = $answer;
        }


        public function getHtmlParsed(){
            /*
                create parsedown object
            */
            $parsedown = new Parsedown();

            /*
                parse the text given and return the output
                we use setsetMarkupEscaped(true) to protect
                against xss.
            */
            return $parsedown->setMarkupEscaped(true)->text($this->html);
        }

        /*
            Static methods
        */
        public static function getQuestions($offset,$count,$sorting){
            $con = new DatabaseConnection();


            if($sorting == 'top' ){
                /*
                    Create a query that returns the ids of all the questions defined by $offset and $count
                    the questions are ordered by the number of votes they have
                */
                $query = new DatabaseQuery('select question.qid , sum(questionscore.vote) as votes from question 
                                            inner join questionscore on question.qid=questionscore.qid 
                                            order by votes desc limit ?, ?' , $con);

            }else{

                /*
                    Create a query that returns the ids of all the questions defined by $offset and $count
                    the questions are ordered by their insert date
                */
                $query = new DatabaseQuery('select qid from question order by qid desc limit ?, ?' , $con);

            }

            /*
                And the parameters to the query
            */
            $query->addParameter('ii',$offset , $count);

            /*
                Execute the query
            */
            $set = $query->execute();
            

            /*
                array of Question objects
            */
            $questions = array();

            while( $row = $set->next()){
                /*
                    create the question
                */
                $question = new Question();
                $question->create($row['qid']);

                /*
                    add the question to the array
                */
                $questions[ count($questions) ] = $question;
            }

            $con->close();

            /*
                return the array
            */
            return $questions;
        }

        

        public static function getQuestionsLike($matchString){
            /*
                Create connection
            */
            $dbConnection = new DatabaseConnection();

            /*
                Create the query
            */
            $query = new DatabaseQuery( 'select qid from question where title like ?',$dbConnection);

            /*
                Add the parameter 
            */
            $query->addParameter('s','%' . $matchString.'%');


            /*
                Execute the query
            */
            $set = $query->execute();

            $questions = array();
            while($row = $set->next()){
                 /*
                    create the question
                */
                $question = new Question();
                $question->create($row['qid']);

                /*
                    add the question to the array
                */
                $questions[ count($questions) ] = $question;
            }


            return $questions;
        }


    }
