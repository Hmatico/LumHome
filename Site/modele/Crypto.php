<?php
    class Crypto {
        var $cryptage;
        
        function __construct($mot){
            $this->cryptage = $mot;
        }
        
        function get_decrypte($hash){
            if(password_verify($this->cryptage, $hash))
                return true;
            else return false;
        }
        
        function get_encrypte(){
            return password_hash($this->cryptage, PASSWORD_ARGON2I);
        }
    }
?>