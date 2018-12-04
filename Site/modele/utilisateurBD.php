<?php
    function verifIdent(&$mail,&$pwd){
        require ("modele/connexionBD.php"); //connexion $link à MYSQL et sélection de la base
        require("modele/class_crypto.php");
        $objet = new crypto($pwd);
        $pwdHash = $objet->get_encrypte();
        $select= "select * from UTILISATEUR where adresseMail='%s' and mdpUser='%s'"; 
        $req = sprintf($select,$mail,$pwdHash);

        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req); 

        if (mysqli_num_rows ($res) == 1){
            mysqli_close($link);
            return "OK";
        } else {
            mysqli_close($link);
            return "inconnu";
        }
    }

?>