<?php

function hashPassword( $password )
    {
        $salt = "ABQWRT";
        $hashedPassword = hash("sha256" , $password.$salt);
        for($i=0 ; $i<3 ; $i++ )
            $hashedPassword = hash("sha256" , $hashedPassword);
        return $hashedPassword;

    }

function testPassword( $password , $db_password)
    {
    $hashedPassword = hashPassword($password);
        if(strcmp($hashedPassword , $db_password) == 0)
            return true;
        else return false;
    }
?>