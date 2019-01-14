<?php
    $q=$_GET["q"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_lumhome";
    
    $conn = new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }   
    
    $result = mysqli_query($conn,"SELECT dateStat,nbrHeuresInutiles FROM stats WHERE idHabitat=".$q;

    //format du json ?
    echo "{ \"cols\": [ {\"id\":\"\",\"label\":\"Jour\",\"type\":\"date\"}, {\"id\":\"\",\"label\":\"Nombre d'heures inutiles\",\"type\":\"number\"} ], \"rows\": [ ";

    echo "{\"c\":[{\"v\":\"Date(2019,10,23)\"},{\"v\":\"20\"}]}";
    echo " ] }";
    mysql_close($con);
?>