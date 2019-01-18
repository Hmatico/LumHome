<?php

    function accueil(){
        header("Location: vue/accueil.html");   
    }

    function ident(){
        $login = $_POST['login'];
        $pwd = $_POST['pwd'];
        require("modele/utilisateurBD.php");
        if(verifIdent($login,$pwd)=="OK"){
            $_SESSION['user'] = $login;
            $_SESSION['profil'] = getProfil($login);
            echo $_SESSION['profil'];
        } else echo verifIdent($login,$pwd);
    }

    function nouvelUtilisateur(){
        $email = $_POST['login'];
        $pwd = $_POST['pwd'];
        require("vue/accueil.php");
    }

    function creationCompte(){
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $sub = explode("@",$email);
        $nom = $sub[0];
        if(verifData($email,$pwd) == "OK")
            inscriptionUtilisateur($nom);
        else echo verifData($email,$pwd);
    }

    function verifEqual(&$var,&$varc){
        return $var===$varc;
    }

    function verifData(&$mail,&$pwd){
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            $upperCase = preg_match('@[A-Z]@', $pwd);
            $lowerCase = preg_match('@[a-z]@', $pwd);
            $number    = preg_match('@[0-9]@', $pwd);
            $specialChars = preg_match('@[^\w]@', $pwd);
            if(!$upperCase || !$lowerCase || !$number || !$specialChars || strlen($pwd) < 8){
                return 'pwdFAUX';
            } else return 'OK';
        } else {
            return 'emailFAUX';
        }
    }

    function verifDataNum(){
        $cpostal = $_POST['cpostal'];
        $date = $_POST['date'];
        $ncarte = $_POST['ncarte'];
        $crypto = $_POST['crypto'];
        if(preg_match('/^(0[1-9]|[1-9][0-9])\d{3}$/',$cpostal))
            if(preg_match('/^\d{3}[1-9]-\d{3}[1-9]-\d{3}[1-9]-\d{3}[1-9]$/',$ncarte))
                if(preg_match('/^(0[1-9]|1[0-2])\/(1[8-9]|2[0-9])$/',$date))
                    if(preg_match('/^[0-9]{2}[1-9]$/',$crypto))
                        return "OK";
                    else return "cryptoFAUX";
                else return "dateFAUX";
            else return "carteFAUX";
        else return "cpostalFAUX";
    }

    function inscriptionUtilisateur($nom){
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $cap = $_POST['cap'];
        $profil = $_POST['profil'];
        require("modele/utilisateurBD.php");
        if(existant($email))
            echo "existant";
        else {
            require("modele/capteurBD.php");
            if(!capteurExistant($cap))
                if(inscription($email, $nom, $pwd, $profil) == "OK"){
                    $_SESSION['user'] = $email;
                    $_SESSION['profil'] = $profil;
                    echo $_SESSION['profil'];
                } else echo inscription($email, $nom, $pwd);
            else echo "cexistant";
        }
    }

    function parseCarte(&$num) {
        $subString = explode("-",$num);
        $num = $subString[0] . $subString[1] . $subString[2] . $subString[3];
    }

    function parseDAte(&$dateE) {
        $subString = explode("/",$dateE);
        $dateE ="20" . $subString[1] . "-" . $subString[0] . "-01";
    }
?>