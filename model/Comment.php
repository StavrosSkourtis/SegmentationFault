<?php
    /*
        This class descibes a comment

    */
    if(!isset($ajax))
        $ajax = "";
    include_once $ajax.'model/Votable.php';
    include_once $ajax.'utils/Database.php';

    class Comment implements Votable{
        /*
            The of the comment
        */
        private $id;
        /*
            The date this was posted
        */
        private $date;
        /*
            The date it was last edited
        */
        private $editDate;

        /*
            The comment text
        */
        private $text;
        /*
            The score of this comment
        */
        private $votes;
        /*
            Object of the type question
        */
        private $user;
        /*
            Can be object of the class Answer or Question
        */
        private $target;
        /*
            The type of the target
        */
        private $type;

        /*
            Creates a comment

            @param $id is the id of the comment
            @param $type shows if this is a Comment to an answer or to a question, must be 'Q' or 'A'


        */
        public function create($id , $type){
            $this->type = $type;
            $this->id = $id;

            /*
                Create the connection
            */
            $dbConnection = new DatabaseConnection();

            /*
                Create the query
            */
            if($type == 'Q'){

                $query = new DatabaseQuery("select * from questioncomment where cid=?" , $dbConnection);
            }else if($type == 'A'){
  
                $query = new DatabaseQuery("select * from answercomment where cid=?" , $dbConnection);
            }

            /*
                Add the parameter and execute
            */
            $query->addParameter('i',$id);
            $set = $query->execute();

            $row = $set->next();
            $this->date = $row['post_date'];
            $this->text = $row['text'];
            $this->editDate = $row['edit_date'];


            if($type == 'Q'){
                $this->target = $row['question'];
            }
            else if($type == 'A'){
                $this->target = $row['answer'];
            }
            
          

            $user = new SimpleUser();
            $user->create($row["user"]);
            $this->user = $user;

            if($type == 'Q'){
                $votesQuery = new DatabaseQuery("select COALESCE(sum(vote),0) as votes from qcommentscore where cid=?" , $dbConnection);
            }else if($type == 'A'){
                $votesQuery = new DatabaseQuery("select COALESCE(sum(vote),0) as votes from acommentscore where cid=?" , $dbConnection);
            }
            $votesQuery->addParameter('i',$id);
            $set2 = $votesQuery->execute();

            $votesRow = $set2->next();

            $votes = $votesRow['votes'];

            $this->votes = $votes;   

            $dbConnection->close();
        }

        public function fetchTarget(){
            if($this->type == 'Q'){
                $qid = $this->target;
                $this->target = new Question();
                $this->target->create($qid);
            }else{
                $aid = $this->target;
                $this->target = new Answer();
                $this->target->create($aid);
            }
        }

        /*
            Inserts a vote to the database

            First check if exists a record on acommentscore or qcommentscore table depending on the $this->type
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

				
			if($this->getType() == 'Q') {
				/*
                Create query
				*/
				$dbQuery = new DatabaseQuery('select cid from qcommentscore where cid=?' , $dbConnection);
			}
			else if($this->getType() == 'A') {
				/*
                Create query
				*/
				$dbQuery = new DatabaseQuery('select cid from acommentscore where cid=?' , $dbConnection);
			}
			
           

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
					Create insert query question or answer
				*/
				if($this->getType() == 'Q') {
					/*
					type question
					*/
					$dbQuery = new DatabaseQuery('insert into qcommentscore(cid,uid,vote) values(?,?,?)' , $dbConnection);
				
				}
				else if($this->getType() == 'A') {
					/*
					type answer
					*/
					$dbQuery = new DatabaseQuery('insert into acommentscore(cid,uid,vote) values(?,?,?)' , $dbConnection);

				}
				
				/*
					Set the parameters 
				*/
				$dbQuery->addParameter('iii',$this->getId(),$uid,$vote);
				
			}
			/*
				else we must update the table
			*/
			else {
				
				if($this->getType() == 'Q') {
					/*
					type question
					*/
				
					$dbQuery = new DatabaseQuery('update qcommentscore set vote=? where cid=?' , $dbConnection);
				}
				else if($this->getType() == 'A') {
					/*
					type answer
					*/
				
					$dbQuery = new DatabaseQuery('update acommentscore set vote=? where cid=?' , $dbConnection);
				}
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
            if($this->type == 'Q'){
                $votesQuery = new DatabaseQuery("select COALESCE(sum(vote),0) as votes from qcommentscore where cid=?" , $dbConnection);
            }else if($this->type == 'A'){
                $votesQuery = new DatabaseQuery("select COALESCE(sum(vote),0) as votes from acommentscore where cid=?" , $dbConnection);
            }
            $votesQuery->addParameter('i',$this->id);
            $set2 = $votesQuery->execute();

            $votesRow = $set2->next();

            $votes = $votesRow['votes'];

            $this->votes = $votes;   
        }


        /*
            Getter and Setter methods
        */
        public function getId(){
            return $this->id;
        }

        public function getDate(){
            return $this->date;
        }

        public function getText(){
            return $this->text;
        }

        public function getUser(){
            return $this->user;
        }

        public function getTarget(){
            return $this->target;
        }

        public function getType(){
            return $this->type;
        }

        public function getVotes(){
            return $this->votes;
        }

        public function setId($id){
            $this->id = $id;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function setText($text){
            $this->text = $text;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function setTarget($target){
            $this->target = $target;
        }

        public function setType($type){
            $this->type = $type;
        }

        public function setVotes($votes){
            $this->votes = $votes;
        }


        /*
            Static method
        */

        /*
            Creates and returns an Array of Comments
            @param target_id the id of the target
            @param target_type the type of the target , 'Q' means question , 'A' means answer

        */
        public static function getComments($target_id , $target_type ,$target){
            /*  
                Create the connection
            */
            $dbConnection = new DatabaseConnection();

            if($target_type == 'Q'){
                $query = new DatabaseQuery("select cid from questioncomment where question=?" , $dbConnection);
            }else if($target_type == 'A'){
                $query = new DatabaseQuery("select cid from answercomment where answer=?" , $dbConnection);
            }

            $query->addParameter('i',$target_id);

            $set = $query->execute();

            $comments = array();

            while($row = $set->next()){
                $comment = new Comment();
                $comment->create($row['cid'] , $target_type);
                $comment->setTarget($target);

                $comments[count($comments)] = $comment;
            }

            $dbConnection->close();

            return $comments;
        }
    }
