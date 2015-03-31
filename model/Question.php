
<?php
    include_once("utils/Database.php");
    class Question{
        private $html;
        private $id;
        private $userId;
        private $datePosted;
        private $lastEdited;
        private $solved;
        private $upvotes;
        private $downvote;
        private $tags;
        private $title;



        public static function getQuestions($offset,$count){
          $con = new DatabaseConnection();

          $questionsQuery = new DatabaseQuery(
            "select question.qid as id,question.title as title
             from question"
          , $con);

          $result = $questionsQuery->execute();
          while($row = $result->fetch_assoc()){
            $question=new Question;
            $question->setTitle($row["title"]);
            $questions[$row["id"]]=$question;

            $tagsQuery = new DatabaseQuery(
              "select tag.tag_id as id,tag.tag_string as name
               from tag,questiontags
               where questiontags.question=? and
               questiontags.tag=tag.tag_id"
            , $con);
            $tagsQuery->getQuery()->bind_param("i" ,$row["id"]);
            $tags = $tagsQuery->execute();
            while($tag = $tags->fetch_assoc()){
              $questions["tags"][$tag["id"]]=$tag["name"];
            }
          }
          /* votes have not been implemented yet*/
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

        public function getUpvotes(){
            return $this->upvotes;
        }
        public function getTitle(){
            return $this->title;
        }
        public function getDownvotes(){
            return $this->downvotes;
        }

        public function getPoints(){
            return $upvotes-$downvotes;
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

        public function setUpvotes($upvotes){
            $this->upvotes = $upvotes;
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
