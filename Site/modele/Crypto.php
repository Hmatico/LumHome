<?php
    /**
    * Objet de cryptage du mot de passe
    */
    class Crypto {
        /* Mot de passe */
        var $cryptage;
        
        /* Constructeur */
        function __construct($mot){
            $this->cryptage = $mot;
        }
        /* Vérifie si le hash est celui du mot de passe */
        function get_decrypte($hash){
            if(password_verify($this->cryptage, $hash))
                return true;
            else return false;
        }
        
        /* créé le hash du mot de pass */
        function get_encrypte(){
            return password_hash($this->cryptage, PASSWORD_ARGON2I);
        }
    }
?>