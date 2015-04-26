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

        }


        /*
            Creates a answer
            @param $answer object of the type Answer

            TODO
            Run an sql statement that inserts the parameter
            answer to the database and the tags

            Database tables
            -Answer

            check database for correct column names

            Για οδηγίες σχετικά με την βαση δεδομένων στην php πάνε εδώ testbed/database_test.php
        */
        public function postAnswer($answer){

        }

        /*
            Creates a comment on a given post(question or answer)
            @param the question
        */
        public function postComment($comment){

        }


        /*
            Start of the DELETE methods
        */

        /*
            Deletes a question from the database, first all its answer must be deleted
        */
        public function deleteQuestion($question){

        }

        /*
            Deletes an answer from the database, first all its comments must be deleted
        */
        public function deleteAnswer($answer){


        /*
            Deletes a comment from the database.
        */
        public function deleteComment($comment){

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

        }

        /*
            Edits the answer : updates all its data to match the data of the parameter
            dont alter comments
            dont change the owner (user id)
        */
        public function editQuestion($question){

        }

        /*
            Edits the answer : updates all its data to match the data of the parameter
            dont alter comments
            dont change the owner (user id)
        */
        public function editComment($comment){

        }


        /*
            Checks if THIS user if logged in
        */
        public function checkIfLoggedIn(){

        }

    }
?>
