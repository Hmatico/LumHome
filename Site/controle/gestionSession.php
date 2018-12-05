<?php
    function accueil(){
        header("Location: vue/accueil.html");   
    }

    function ident(){
        $login = $_POST['login'];
        $pwd = $_POST['pwd'];
        require("modele/utilisateurBD.php");
        echo verifIdent($login,$pwd);
    }

    function nouvelUtilisateur(){
        $email = $_POST['login'];
        $pwd = $_POST['pwd'];
        require("vue/inscription.php");
    }

    function creationCompte(){
        $email = $_POST['email'];
        $emailc = $_POST['emailc'];
        $pwd = $_POST['pwd'];
        $pwdc = $_POST['pwdc'];
        if(verifEqual($email,$emailc))
            if(verifEqual($pwd,$pwdc))
                if(verifData($email,$pwd) == "OK")
                    if(verifDataNum()=="OK")
                        inscriptionUtilisateur();
                    else echo verifDataNum();
                else echo verifData($email,$pwd);
            else echo "pwdc";  
        else echo "emailc";
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
            return 'emailFaux';
        }
    }

    function verifDataNum(){
        
    }

    function inscriptionUtilisateur(){
        $nom = $_POST['email'];
        $prenom = $_POST['emailc'];
        $email = $_POST['pwd'];
        $pwd = $_POST['pwdc'];
        $nrue = $_POST['nrue'];
        $nomrue = $_POST['nomrue'];
        $cpostal = $_POST['cpostal'];
        $ville = $_POST['ville'];
        $comp = $_POST['comp'];
        $ncarte = $_POST['ncarte'];
        $date = $_POST['date'];
        $crypto = $_POST['crypto'];
    }
?>