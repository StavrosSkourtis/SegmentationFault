
<?php
    include_once("utils/Database.php");
    class Question{
        private $html;
        private $id;
        private $userId;
        private $username;
        private $datePosted;
        private $lastEdited;
        private $solved;
        private $votes;
        private $tags;
        private $title;


        public static function getQuestions($offset,$count){
          $con = new DatabaseConnection();

          $questionsQuery = new DatabaseQuery(
            "select question.qid as id,question.title as title,question.post_date as date
             from question"
          , $con);

          $result = $questionsQuery->execute();
          while($questionRow = $result->next()){
            $question=new Question;
            $question->setTitle($questionRow["title"]);
            $question->setDatePosted($questionRow["date"]);

            $tagsQuery = new DatabaseQuery(
              "select tag.tag_id as id,tag.tag_string as name
               from tag,questiontags
               where questiontags.question=? and
               questiontags.tag=tag.tag_id"
            , $con);

            $usernameQuery = new DatabaseQuery(
              "select user.username as username from user,question where question.user=user.uid and question.qid=".$questionRow["id"]
            , $con);
            $rsUser = $usernameQuery->execute();
            $user=$rsUser->next();
            $question->setUsername($user["username"]);

            $tagsQuery->getQuery()->bind_param("i" ,$questionRow["id"]);
            $tags = $tagsQuery->execute();

            unset($tagsData);
            while($tagRow=$tags->next()){
              $tagsData[$tagRow["id"]]=$tagRow["name"];
            }

            $question->setTags($tagsData);

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

          return $questions;
        }

        /*
        the following need to be implemented
        */

        /*
          returns all the data of a question
        */
        public static function getQuestion($qid){

        }
        /*
          deletes the question
        */
        public function delete(){

        }
        public function setTags($tags){
          $this->tags=$tags;
        }
        public function setUsername($username){
          $this->username=$username;
        }
        public function getUsername(){
          return $this->username;
        }
        /*
          appends an answer to the question
        */
        public function addAnswer($answer){

        }
        /*
          votes 1/-1
        */
        public function vote($vote){

        }
        /*
          get the abstract of a question,the abstract is shown at the question's listing
        */
        public function getAbstract(){
          return "the abstract of the question";
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

        public function upvote(){
            $this->upvotes++;
        }

        public function downvotes(){
            $this->downvotes++;
        }
    }
