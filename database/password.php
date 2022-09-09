<?php 

    function password($password){
        $salt = "!OdstampajMEoDSTAMPAcUtE!";

        $passwordHash = md5($password.$salt);
        return $passwordHash;
    }


?>