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

    function verifData($mail,$pwd){
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
?>