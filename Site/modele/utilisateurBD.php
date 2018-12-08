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

    function inscription(&$nom, &$prenom, &$email, &$pwd, &$nrue, &$numrue, &$cpostal, &$ville, &$comp, &$ncarte, &$date, &$crypto){
        require ("modele/connexionBD.php");
        require("modele/class_crypto.php");
        $objet = new crypto($pwd);
        $hash = $objet->get_encrypte();
        $insert = "insert into UTILISATEUR (adresseMail,nomUser, prenomUser,adresseFacturation, type, mdpUser,pin,numeroCarte,cryptogramme,dateExpiration) values('%s', '%s', '%s', '%c', 'user','%s', 0000, '%s', '%s', '%s')";
    }

    function existant(&$email){
        $select= "select * from UTILISATEUR where adresseMail='%s'"; 
        $req = sprintf($select,$email,);

        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req); 

        if (mysqli_num_rows ($res) == 1){
            mysqli_close($link);
            return true;
        } else {
            mysqli_close($link);
            return false;
        }
    }
/*
insert into UTILISATEUR (adresseMail,nomUser, prenomUser,adresseFacturation, type, mdpUser,pin,numeroCarte,cryptogramme,dateExpiration) values('mathieu@test.fr', 'Mat', 'VAL', 1, 'user','dfghjklfmghghmlkgfvbdvsnfng!:bvksxcdzvbemfnzgR%ù', 0000, '0000-0000-0000-0000', '000', '00/00')
?>