<?php
    $q=$_GET["q"];
    require("connexionBD.php");
    
    $result = mysqli_query($link,"SELECT dateStat,nbrHeuresInutiles FROM stats WHERE fk_habitat=".$q);
                           
    echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Date\",\"pattern\":\"\",\"type\":\"date\"}, {\"id\":\"\",\"label\":\"Nombre d'heures inutiles\",\"pattern\":\"\",\"type\":\"number\"} ], \"rows\": [ ";
                           
    $total_rows = mysqli_num_rows($result);
    $row_num = 0;                           
    while($row = mysqli_fetch_assoc($result)){
        $row_num++;
        $date = explode('-',$row['dateStat']);
        $annee = $date[0];
        $mois = $date[1];
        $jour = $date[2];
        echo "{\"c\":[{\"v\":\"Date(".$annee.",".$mois.",".$jour.")\",\"f\":null},{\"v\":".$row['nbrHeuresInutiles'].",\"f\":null}]}";
        if ($row_num != $total_rows){
            echo ",";
        }
        
    }
    echo " ] }";
    mysqli_close($link);
?>