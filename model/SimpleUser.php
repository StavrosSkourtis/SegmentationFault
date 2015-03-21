<?php 

    /*
        This scripts contains the SimpleUser class
        It defines the basic action of a registered user
    */
    include_once 'model/User.php';

    class SimpleUser extends User {
        /*
        constructor used to create the object when the user is login in or creating a new account.
        After this,login or signup should be called to populate the object
        */
        function __construct(){
            

        }
        /*
            Creates a new question.
            @param $html contains the text of the question
            @param $tags is an array of tags , it must contain a least 3 tags
        */
        public function postQuestion($html,$tags){

        }

        /*
            Creates a comment on a given post(question or answer)
            @param $text is the text of the comment
            @param $post_id is the post this comment belongs to
            @param $type it shows if this is a comment of an answer(1) or to a question(0)
        */
        public function postComment($text,$post_id,$type){

        }

        /*
            Creates a answer for a given question
            @param $html the text of the answer
            @param $question_id the question this post answers
        */
        public function postAnswer($html ,$question_id){

        }

        public function deleteQuestion($question_id){

        }

        public function deleteAnswer($answer_id){

        }

        public function deleteComment($comment_id){

        }

        public function editAnswer($html,$answer_id){

        }

        public function editQuestion($html,$question_id){

        }

    }
?>