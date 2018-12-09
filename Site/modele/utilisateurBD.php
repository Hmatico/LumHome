<?php
function chargerClasse($classe){
    require_once 'modele/' . $classe . '.php';
}

spl_autoload_register('chargerClasse');

    function verifIdent(&$mail,&$pwd){
        require("modele/connexionBD.php"); //connexion $link à MYSQL et sélection de la base
        $objetT = new Crypto($pwd);
        $pwdHash = $objetT->get_encrypte();
        $select= "select * from UTILISATEUR where adresseMail='%s' and mdpUser='%s'"; 
        $req = sprintf($select,$mail,$pwdHash);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 

        if (mysqli_num_rows ($res) == 1){
            mysqli_close($link);
            return "OK";
        } else {
            mysqli_close($link);
            return "inconnu";
        }
    }

    function inscription(&$nom, &$prenom, &$email, &$pwd, &$nrue, &$nomrue, &$cpostal, &$ville, &$comp, &$ncarte, &$date, &$c){
        require_once("modele/habitatBD.php");
        nouvelHabitatF($nrue,$nomrue,$cpostal,$ville,$comp);
        require("modele/connexionBD.php");
        $idHabitat = getIdHabitatFacturation($nrue,$nomrue,$ville,$cpostal,$comp);
        $objet = new Crypto($pwd);
        $hash = $objet->get_encrypte();
        $insert = "insert into UTILISATEUR (adresseMail,nomUser, prenomUser,adresseFacturation, type, mdpUser,pin,numeroCarte,cryptogramme,dateExpiration) values('%s', '%s', '%s', '%d', '%s','%s', '%s', '%d', '%d', '%s')";
        $req = sprintf($insert,$email,$nom,$prenom,$idHabitat,'user',$hash,"0000",$ncarte,$c,$date);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        updateFK($email,$nrue,$nomrue,$ville,$cpostal,$comp);
        return "OK";
    }

    function existant(&$email){
        require("modele/connexionBD.php");
        $select= "select * from UTILISATEUR where adresseMail='%s'"; 
        $req = sprintf($select,$email);

        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link)); 

        if (mysqli_num_rows ($res) == 1){
            mysqli_close($link);
            return true;
        } else {
            mysqli_close($link);
            return false;
        }
    }
/*
insert into UTILISATEUR (adresseMail,nomUser, prenomUser,adresseFacturation, type, mdpUser,pin,numeroCarte,cryptogramme,dateExpiration) values('mathieu@test.fr', 'Mat', 'VAL', 1, 'user','dfghjklfmghghmlkgfvbdvsnfng!:bvksxcdzvbemfnzgR%ù', 0000, '0000-0000-0000-0000', '000', '00/00')*/
?>