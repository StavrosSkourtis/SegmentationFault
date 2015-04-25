<?php

    if(isset($_POST["search_text"])){
        require '../utils/Database.php';

        $con = new DatabaseConnection();

        $query = new DatabaseQuery('select tag_string from tag where tag_string like ? limit 5',$con);

        $query->addParameter('s','%'.$_POST["search_text"].'%');

        $set = $query->execute();

        $json = '[';

        $counter = 0;
        $max = $set->getRowCount();

        while($row = $set->next()){

            $json = $json . '{"tagName":"'. $row['tag_string'].'"}';
            if($max-1 != $counter){
                $json = $json.',';
            }
            $counter++;
        }
        $json = $json.']';

        print $json;
    }
