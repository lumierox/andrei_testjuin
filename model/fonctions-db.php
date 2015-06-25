<?php

    $db = mysqli_connect(DB_SERVER, DB_USER, DB_MDP, DB_NAME);
        if (mysqli_connect_errno()) 
            print "Failed to connect to MySQL: " . mysqli_connect_error();
    
    mysqli_set_charset($db, "utf8");
        
    function select($table, $colonne, $condition){

        global $db;
        $query = "SELECT $colonne FROM $table $condition";
        //var_dump($query); //TEST QUERRY
        if(mysqli_query($db, $query)){
            if(mysqli_num_rows(mysqli_query($db, $query))>0){
                return mysqli_query($db, $query);
            }
            else{ 
                return "Aucun résultat.";
            }
        }
        else{
            return $query.  mysqli_error($db);
        }
    }

    function insert($table, $colonne, $condition){

        global $db;
        $query = "INSERT INTO $table ($colonne) VALUES ($condition)";
        //var_dump($query); //TEST QUERRY
        if(mysqli_query($db,$query))
            return "Ajout réussi!";
        else
            return "Ajout echoué.";
    }

    function update($table, $colonne_valeur, $condition){

        global $db;
        $query = "UPDATE $table SET $colonne_valeur WHERE $condition";
        //var_dump($query); //TEST QUERRY
        if(mysqli_query($db,$query)){
            return 'Mise à jour réussie';
        }else{
            return 'Mise à jour echouée';
        }
    }

    function delete($table, $condition){

        global $db;
        $query = "DELETE FROM $table $condition";
        //var_dump($query); //TEST QUERRY
        if(mysqli_query($db,$query)){
            return 'Suppression réussie';
        }else{
            return 'Suppression echouée';
        }
    }
    

