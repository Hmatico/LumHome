<?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_lumhome";
    
    $conn = new mysqli($servername, $username, $password,$dbname);
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }   
    
    $result = mysqli_query($conn,"SELECT nomHabitat,idHabitat FROM habitat WHERE fk_proprietaire='test'");

    while ($row = mysqli_fetch_assoc($result)){
        echo '<option value='. $row['idHabitat'] . '>'. $row['nomHabitat'] . '</option>';
    }
    mysql_close($con);
?>