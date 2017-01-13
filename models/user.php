<?php

class user {

    public static function login($email, $password)
    {
        $db = null;
        include('bdd.php');
        $sql = $db->prepare("SELECT * FROM user WHERE Mail = '".$email."'AND Password ='".$password."'");
        $sql->execute();
        $donnees = $sql->fetch();
        if($donnees!=null)
        {
            return json_encode($donnees);
        }
        else{
            return null;
        }

    }
}