<?php
    function verifIdent(&$mail,&$pwd){
        require ("modele/connexionBD.php"); //connexion $link à MYSQL et sélection de la base

        $select= "select * from UTILISATEUR where adresseMail='%s' and mdpUser='%s'"; 
        $req = sprintf($select,$mail,$pwd);

        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req); 

        if (mysqli_num_rows ($res) > 0){
            mysqli_close($link);
            return "OK";
        } else {
            mysqli_close($link);
            return "inconnu";
        }
    }

?>