<?php
    /*
        This file contains 2 classes DatabaseConnection
        and DatabaseQuery. The first is used  to open a
        connection to the database   and  the second to
        create  and  run a query  on  an  already  open
        database   connection   DatabaseQuery  is  safe
        against  sql injectionsbecause it uses prepared
        statements

        see testbed/database_test.php for an example
    */

    class DatabaseConnection{
        // Variable that holds the connection
        private $mysql;

        /*
            Create the database connection
            if no parameters are passed we create it
            with the default ones.
            $socket and $port will most likely not be used.

        */
        public function __construct($hostname = "localhost" ,$user = "root" ,$pass = "dbpass",$database = "mydb",$socket = "null",$port = "null"){
            if($port!="null" && $socket!="null"){
                // create db from unix domain socket
            }else{
                $this->mysql = new mysqli($hostname,$user,$pass,$database);
            }
        }

        /*
            returns the mysql connection
        */
        public function getConnection(){
            return $this->mysql;
        }

        /*
            Close database connection
        */
        public function close(){
            $this->mysql->close();
        }

    }

    class DatabaseQuery{
        // holds the prepared query
        private $query;
        private $result;

        // constructor
        public function __construct($query,$connection){
            // create the prepared query
            $this->query = $connection->getConnection()->prepare($query);
        }

        /*
            bind a parameter to the query ,char for a parameters in the original query should be ?
            example : select * from table where a=?
            and then addParameter('s','name');
            's' stands for string
         */
        public function addParameter($param_types){
            /*
                Get the parameters
            */
            $args = array_slice(func_get_args(),1);

            $params = array();

            $params[] = & $param_types;

            for($i=0 ; $i<count($args) ;$i++)
                $params[] = & $args[$i];


            call_user_func_array(array($this->query, 'bind_param'), $params);
        }
        /*
          returns the query
        */
        public function getQuery(){
          return $this->query;
        }

        /*
            Execute the query
            returns the result
        */
        public function execute(){
            $this->query->execute();
            $result = $this->query->get_result();
            $this->result = $result;
            return $result->fetch_assoc();
        }

        public function executeUpdate(){
            $this->query->execute();
        }

        public function getResultNumber(){
            return $this->result->num_rows;
        }
    }
