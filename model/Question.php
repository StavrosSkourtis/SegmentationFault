<?php
    /*
        This class describes a Question

        note static methods are located at the bottom
    */
    include_once("utils/Database.php");
    include_once("model/SimpleUser.php");
    include_once("model/Votable.php");
    include_once("model/SimpleUser.php");
    include_once("model/Answer.php");
    include_once("model/Comment.php");

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
            $this->answers = Answer::getAnswers($id);
            $this->comments = Comment::getComments($id,'Q');
            

            /*
                Get the tags

            */
            $tagQuery = new DatabaseQuery("select tag_string ".
                                          "from tag ".
                                          "inner join questiontags on tag.tag_id=questiontags.tag ".
                                          "where questiontags.qustion=?"
                                          ,$dbConnection);
            $tagQuery->addParameter('i',$id);

            $tagSet = $tagQuery->execute();

            while($tagRow = $tagSet->next() ){
                $this->tags[count($this->tags)] = $tagRow['tag_string'];
            }



            $votesQuery = new DatabaseQuery("select sum(vote) as score from questionscore where qid=?",$dbConnection);
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


        /*
            Inserts a vote to the database
        */
        public function vote($uid, $vote){

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
        //  return array("java","c++");
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


        /*
            Static methods
        */
        public static function getQuestions($offset,$count,$sorting){
          $con = new DatabaseConnection();

          if($sorting=="newest"){
            $questionsQuery = new DatabaseQuery(
              "select question.html as data,question.qid as id,question.title as title,question.post_date as date,user.username as username,user.uid as userid
               from question,user where user.uid=question.user order by date DESC limit ".$count." OFFSET ".$offset
            , $con);
          }
          if($sorting=="toptoday"){
            $questionsQuery = new DatabaseQuery(
              "select question.html as data,question.qid as id,question.title as title,question.post_date as date,user.username as username,user.uid as userid
               from question,user where user.uid=question.user and question.post_date=now() order by date DESC limit ".$count." OFFSET ".$offset
            , $con);
          }
          if($sorting=="alltimetop"){
            $questionsQuery = new DatabaseQuery(
            "select question.html as data,sum(questionscore.vote) as votes,question.qid as id,question.title as title,question.post_date as date,user.username as username,user.uid as userid
            from question,user,questionscore where user.uid=question.user and questionscore.qid=question.qid order by votes DESC limit ".$count." OFFSET ".$offset
            , $con);
          }

          $result = $questionsQuery->execute();
          while($questionRow = $result->next()){
            $question=new Question;
            $question->setTitle($questionRow["title"]);
            $question->setDatePosted($questionRow["date"]);
            $question->setHtml($questionRow["data"]);

            $tagsQuery = new DatabaseQuery(
              "select tag.tag_id as id,tag.tag_string as name
               from tag,questiontags
               where questiontags.question=? and
               questiontags.tag=tag.tag_id"
            , $con);

            $user=new SimpleUser;
            $user->setUsername($questionRow["username"]);
            $user->setUserid($questionRow["userid"]);
            $question->setUser($user);

            $tagsQuery->getQuery()->bind_param("i" ,$questionRow["id"]);
            $tags = $tagsQuery->execute();

            unset($tagsData);
            while($tagRow=$tags->next()){
              $tagsData[$tagRow["id"]]=$tagRow["name"];
            }
            if(isset($tagsData)){
              $question->setTags($tagsData);
            }

            /*
              the following can be used as a query above instead of a new query just for the votes,the problem is that every question needs atleast
              1 vote(can be 0)

              select sum(questionscore.vote) as votes,question.qid as id,question.title as title,question.post_date as date,user.name as username,user.uid as userid
              from question,user,questionscore where user.uid=question.user and questionscore.qid=question.qid
            */

            $votesQuery = new DatabaseQuery(
              "select sum(questionscore.vote) as v from questionscore where
              questionscore.qid=".$questionRow["id"]
            , $con);
            $rsVotes = $votesQuery->execute();
            $vote=$rsVotes->next();
            if(!isset($vote))$question->setVotes(0);
            else $question->setVotes($vote["v"]);
            $questions[$questionRow["id"]]=$question;
          }
          if(isset($questions)){
            return $questions;
          }

        }

        /*
        the following need to be implemented
        */


    }
