<?php
    
    function getData(){
        $q=$_POST["q"];
        $periode=$_POST["periode"];
        require("modele/connexionBD.php");

        $req = "SELECT dateStat,nbrHeuresInutiles FROM stats WHERE fk_habitat=".$q;
        $req = $req." AND dateStat >= DATE_ADD(NOW(), INTERVAL -1 ".$periode.") AND dateStat < NOW()";
        $result = mysqli_query($link,$req);

        $json = "{ \"cols\": [ {\"id\":\"\",\"label\":\"Date\",\"pattern\":\"\",\"type\":\"date\"}, {\"id\":\"\",\"label\":\"Nombre d'heures inutiles\",\"pattern\":\"\",\"type\":\"number\"} ], \"rows\": [ ";

        if($result != FALSE){
            $total_rows = mysqli_num_rows($result);
            $row_num = 0;                           
            while($row = mysqli_fetch_assoc($result)){
                $row_num++;
                $date = explode('-',$row['dateStat']);
                $annee = (int) $date[0];
                //on ennlève -1 pcq l'api considère janvier comme le mois 0 
                $mois = ((int) $date[1]) - 1;
                $jour = (int) $date[2];
                $json .= "{\"c\":[{\"v\":\"Date(".$annee.",".$mois.",".$jour.")\",\"f\":null},{\"v\":".$row['nbrHeuresInutiles'].",\"f\":null}]}";
                if ($row_num != $total_rows){
                    $json .= ",";
                }

            }
        }
        $json .= " ] }";
        mysqli_close($link);
        echo $json;
    }
    
?>