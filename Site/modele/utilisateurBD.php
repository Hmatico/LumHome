<?php
function chargerClasse($classe){
    require_once 'modele/' . $classe . '.php';
}

spl_autoload_register('chargerClasse');

    function verifIdent(&$mail,&$pwd){
        require("modele/connexionBD.php"); //connexion $link à MYSQL et sélection de la base
        $objetT = new Crypto($pwd);
        $select= "select * from UTILISATEUR where adresseMail='%s'"; 
        $req = sprintf($select,$mail);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : "). $req .'\n'.mysqli_error($link)); 

        if (mysqli_num_rows ($res) >0){
            $tab = mysqli_fetch_assoc($res);
            if($objetT->get_decrypte($tab['mdpUser'])){
                mysqli_close($link);
                return "OK";
            }else {
                mysqli_close($link);
                return "incorrect";
            }
        } else {
            mysqli_close($link);
            return "inconnu";
        }
    }

    function inscription($nom, $prenom, $email, $pwd, $ncarte, $date, $c){
        require("modele/connexionBD.php");
        $objet = new Crypto($pwd);
        $hash = $objet->get_encrypte();
        $insert = "insert into UTILISATEUR (adresseMail,nomUser, prenomUser, type, mdpUser,pin,numeroCarte,cryptogramme,dateExpiration) values('%s', '%s', '%s', '%s','%s', '%s', '%d', '%d', '%s')";
        $req = sprintf($insert,$email,$nom,$prenom,'user',$hash,"0000",$ncarte,$c,$date);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        return true;
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
    
    function UpdateFK(&$mail,$fk){
        require("modele/connexionBD.php");
        $update = "update Utilisateur set adresseFacturation = '%d' where adresseMail = '%s'";
        $req = sprintf($update,intval($fk),$mail);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        return "OK";
    }
?>