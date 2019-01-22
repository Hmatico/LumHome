<?php
/* Permet d'instancier une seule fois l'objet de cryptage de mot de passe */
function chargerClasse($classe){
    require_once 'modele/' . $classe . '.php';
}

spl_autoload_register('chargerClasse');

    /**
    * Fonction vérifiant si l'utilisateur est connu en base
    *   $mail : son adresse mail
    *   $pwd : son mot de passe non crypté
    */
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

    /**
    * Fonction inscrivant un nouvel utilisateur en base
    *   $email : son adresse mail
    *   $nom : son nom
    *   $pwd : son mot de passe non crypté
    *   $profil : le type d'utilisateur
    */
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

    /**
    * Fonction vérifiant si l'utilisateur est connu en base
    *   $email : son adresse mail
    */
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
    
    /**
    * Fonction modifiant la clé primaire entre un utilisateur et son habitat
    *   $mail : adresse mail de l'utilisateur
    *   $fk : clé étrangère de l'habitat
    */
    function UpdateFK(&$mail,$fk){
        require("modele/connexionBD.php");
        $update = "update Utilisateur set adresseFacturation = '%d' where adresseMail = '%s'";
        $req = sprintf($update,intval($fk),$mail);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        return "OK";
    }

    /**
    * Fonction mettant un utilisateur connecté
    *   $mail : adresse mail de l'utilisateur
    *   $boolean : (true) s'il est connecté, (false) sinon
    */
    function setConnecte(&$mail,$boolean){
        require("modele/connexionBD.php");
        $update = "update Utilisateur set actif = '%d\n' where adresseMail = '%s'";
        $req = sprintf($update,$boolean,$mail);
        $res = mysqli_query($link, $req)	
            or die (utf8_encode("erreur de requête : ") . $req .'\n'.mysqli_error($link));
        mysqli_close($link);
        return "actif";
    }

    /**
    * Fonction comptant d'utilisateurs actif sur le site
    */
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

    /**
    * Fonction comptant d'utilisateurs inactif sur le site
    */
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