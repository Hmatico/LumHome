<?php

    /**
    * Fonction vérifiant si le capteur est déjà en base
    */
    function capteurExistant(&$cap){
        require ("modele/connexionBD.php");
        $select= "select * from CeMAC where numeroSerie='%s'"; 
        $req = sprintf($select,$cap);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        if(mysqli_num_rows($res) > 0)
            return true;
        else return false;
    }
?>