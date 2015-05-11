<?php
    if(!isset($ajax))
        $ajax = "";
    include_once $ajax.'model/Votable.php';
    /*
        This class describes an answer
    */

    class Answer{
        /*
            The html of the answer
        */
        private $html;
        /*
            The user this belongs to
            Object of the type SimpleUser
        */
        private $user;
        /*
            Thd id of the answer
        */
        private $id;
        /*
            The question this answer
            Object of the type Question
        */
        private $question;
        /*
            Array of objects (Comment)
        */
        private $comments;
        /*
            The date this was posted
        */
        private $date;
        /*
            The date this was last edited
        */
        private $editDate;
        /*
            the score of the answer
        */
        private $votes;

        /*
            Fills the object with data from the database using the given id
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
            $query = new DatabaseQuery("select * from answer where aid=?" ,$dbConnection);
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
            $this->html = $row["html"];
            $this->date = $row["post_date"];
            $this->editDate = $row["edit_date"];
            $this->question = $row["question"];

            /*
                Get the user
            */
            $user = new SimpleUser();
            $user->create($row["user"]);

            $this->user = $user;

            /*
                get the answers and the comments
            */
            $this->comments = Comment::getComments($id,'A', $this);
            
            $votesQuery = new DatabaseQuery("select sum(vote) as score from answerscore where aid=?",$dbConnection);
            $votesQuery->addParameter('i',$id);

            $votesSet = $votesQuery->execute();
            $votesRow = $votesSet->next();
            $this->votes = $votesRow['score'];


            $dbConnection->close();
            /*
                every thing is ok return true
            */
            return true;
        
        }

        public function fetchQuestion(){
            $qid = $this->question;

            $this->question = new Question();
            $this->question->create($qid);
        }


        /*
            Inserts a vote to the database

            First check if exists a record on answerscore table
            with $uid and $this->id

            if true
            alter that row and set vote to $vote

            if false
            insert a rown with $uid , $this->id and $vote
        */
        public function vote($uid, $vote){
            
        }


        /*
            Getters and Setters
        */
        public function getHtml(){
            return $this->html;
        }

        public function getUser(){
            return $this->user;
        }

        public function getQuestion(){
            return $this->question;
        }

        public function getComments(){
            return $this->comments;
        }

        public function getDate(){
            return $this->date;
        }

        public function getVotes(){
            return $this->votes;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }
        public function setHtml($html){
            $this->html = $html;
        }

        public function setUser($user){
            $this->user = $user;
        }

        public function setQuestion($question){
            $this->question = $question;
        }

        public function setComments($comments){
            $this->comments = $comments;
        }

        public function setDate($date){
            $this->date = $date;
        }

        public function setVotes($votes){
            $this->votes = $votes;
        }
        public function addComment($comment){
            $this->comments[count($this->comments)] = $comment;
        }

        /*
            Static method

        */

        /*
            Returns an Array of answers that belong to that question
        */
        public static function getAnswers($question_id , $question){
            $dbConnection = new DatabaseConnection();
            $query = new DatabaseQuery( "select aid from answer where question=?", $dbConnection);
            $query->addParameter('i' , $question_id);

            $set = $query->execute();
            $answers = array();

            while( $row = $set->next()){
                $answer = new Answer();
                $answer->create($row['aid']);
                $answer->setQuestion($question);

                $answers[count($answers)] = $answer;
            }

            $dbConnection->close();

            return $answers;
        }

    }
