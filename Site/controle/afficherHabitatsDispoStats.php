<?php
    
    require("../modele/connexionBD.php");
    
    $result = mysqli_query($link,"SELECT nomHabitat,idHabitat FROM habitat WHERE fk_proprietaire='mailtest@gmail.com'");

    while ($row = mysqli_fetch_assoc($result)){
        echo '<option value='. $row['idHabitat'] . '>'. $row['nomHabitat'] . '</option>';
    }
    mysqli_close($link);
?>