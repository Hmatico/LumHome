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
                return $tab['type'];
            }else {
                mysqli_close($link);
                return "incorrect";
            }
        } else {
            mysqli_close($link);
            return "inconnu";
        }
    }

    function inscription($email, $nom, $pwd, $profil){
        require("modele/connexionBD.php");
        $objet = new Crypto($pwd);
        $hash = $objet->get_encrypte();
        $insert = "insert into UTILISATEUR (adresseMail, nomUser,type, mdpUser,pin,actif) values('%s', '%s', '%s', '%s', '%s','%d\n')";
        $req = sprintf($insert,$email, $nom,$profil,$hash,"0000",true);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        mysqli_close($link);
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
    
    function UpdateFK(&$mail,$fk){
        require("modele/connexionBD.php");
        $update = "update Utilisateur set adresseFacturation = '%d' where adresseMail = '%s'";
        $req = sprintf($update,intval($fk),$mail);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        return "OK";
    }

    function setConnecte(&$mail,$boolean){
        require("modele/connexionBD.php");
        $update = "update Utilisateur set actif = '%d\n' where adresseMail = '%s'";
        $req = sprintf($update,$boolean,$mail);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        mysqli_close($link);
        return "actif";
    }

    function nbActif(){
        require("modele/connexionBD.php");
        $count = "select count(actif) as nombre from Utilisateur where actif = true";
        $req = sprintf($count);
        $answer = '<img src="./resources/co.png" class="logo_co" alt="Utilisateurs actifs">';
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        mysqli_close($link);
        return $answer . mysqli_fetch_assoc($res)['nombre'] . " actif(s)";
    }

    function nbInactif(){
        require("modele/connexionBD.php");
        $count = "select count(actif) as nombre from Utilisateur where actif = false";
        $req = sprintf($count);
        $answer = '<img src="./resources/deco.png" class="logo_co" alt="Utilisateurs inactifs">';
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        mysqli_close($link);
        return $answer . mysqli_fetch_assoc($res)['nombre'] . " inactif(s)";
    }
?>