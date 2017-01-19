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

    public static function getVehiculesByUser($id)
    {
        $db = null;
        include('bdd.php');
        $sql = $db->prepare("SELECT * FROM truck WHERE Id_User= ".$id);
        $sql->execute();
        $tab = $sql->fetch();
        return json_encode($tab);
    }


    public static function dateDiff($date1){
        $now   = time();
        $diff = abs($date1 - $now); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
        $retour = array();

        $tmp = $diff;
        $retour['second'] = $tmp % 60;

        $tmp = floor( ($tmp - $retour['second']) /60 );
        $retour['minute'] = $tmp % 60;

        $tmp = floor( ($tmp - $retour['minute'])/60 );
        $retour['hour'] = $tmp % 24;

        $tmp = floor( ($tmp - $retour['hour'])  /24 );
        $retour['day'] = $tmp;

        $minutes = $retour['minute'] + ($retour['hour']*60);
        $retour['pourcentage']= (100*$minutes)/600;
        if($minutes<120)
            $retour["tempspause"]= 120-$minutes;
        else if($minutes<240)
            $retour["tempspause"] = 120-($minutes-120);
        else if($minutes<360)
            $retour["tempspause"] = 120 - ($minutes-240);
        else if($minutes<480)
            $retour["tempspause"] = 120 - ($minutes-360);
        else if($minutes<600)
            $retour["tempspause"] = 120 - ($minutes-480);
        $retour['pausepourcentage'] = (100*$minutes)/120;

        return $retour;
    }

    public static function getPermisbyUser($id, $truckid)
    {
        $db = null;
        include('bdd.php');
        $sql = $db->prepare("SELECT category.Formation AS formation FROM `truck` JOIN category On truck.Id_Category = category.Id where truck.Id = ".$truckid);
        $sql->execute();
        $truckformation = $sql->fetch();
        $sql = $db->prepare("SELECT Formation FROM user WHERE Id = ".$id);
        $sql->execute();
        $userformation = $sql->fetch();
        if($userformation["Formation"]=="C")
            return true;
        if($userformation["Formation"]=="B")
        {
            if($truckformation["formation"]=="C")
            {
                return false;
            }
            else{
                return true;
            }
        }
        if($userformation["Formation"]=="A")
        {
            if($truckformation["formation"]=="A")
            {
                return true;
            }
            else{
                return false;
            }
        }
    }

    public static function getCT($truckid)
    {
        $db = null;
        include('bdd.php');
        $sql = $db->prepare("SELECT ct FROM `truck` WHERE Id = ".$truckid);
        $sql->execute();
        $truckct = $sql->fetch();
        if(date("Y-m-d")>$truckct["ct"])
            return false;
        return true;
    }

    public static function getRoleByUser($id)
    {
        $db = null;
        include('bdd.php');
        $sql = $db->prepare("SELECT * FROM `role` WHERE Id = ".$id);
        $sql->execute();
        $donnees = $sql->fetch();
        return json_encode($donnees);
    }

}