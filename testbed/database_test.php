<?php
    /*
        This file is just for testing
    */

    // Πρώτα πρέπει να κάνουμε inclue το αρχείο με την class της Database
    include "../utils/Database.php";


    // Φτιάχνουμε το αντικείμενο της σύνδεσης
    $con = new DatabaseConnection();


    /*
        Example
    */

    /*
        Φτιάχνουμε το query, σαν παραμέτρους δίνουμε:
            -το query string οπου είναι ο sql κώδικας που πρέπει να εκτελεστή
            όπου θέλουμε να περάσουμε παραμέτρους βάζουμε '?'.
            -το αντικείμενο της σύνδεσης
    */
    $cmd = new DatabaseQuery("select email from user where name=? and surname=?" , $con);

    /*
        Κάνουμε bind τις παραμέτρους.
        η πρώτη παράμετρος της μεθόδου ειναι ενα string οπου ορίζουμε τους sql τυπούς τών παραμέτρων του query.
            i 	integer
            d 	double
            s 	string
            b   blob
        οι επώμενες παράμετροι ειναι οι παράμετροι του query , μπορούν να έχουν μεταβλητό αριθμό (οχι πάντα 2 οπως στο παράδειγμα)
    */
    $cmd->addParameter('ss','Stavros','Skourtis');

    // Εκτελούμε το query, επιστέφει ένα associative array
    $set = $cmd->execute();

    while($row = $set->next() ){
        print $row['email'];
    }


    /*
        Example 2
    */
    $query2 = new DatabaseQuery("select * from user",$con);

    $set2 = $query2->execute();

    while($r = $set2->next()){
        print $r['username'];
    }
