<?php

/**
 * Created by PhpStorm.
 * User: julesbasse
 * Date: 16/12/2016
 * Time: 14:30
 */
class mission
{
    public static function getUserMission($id)
    {
        $db = null;
        include('bdd.php');
        $sql = $db->prepare("SELECT * FROM Mission WHERE id_user = ".$id);
        $sql->execute();
        $donnees = $sql->fetch();
        echo json_encode($donnees);
    }

    public static function getLocalisationStartMission($id)
    {
        $db = null;
        include('bdd.php');
        $sql = $db->prepare("SELECT Start.localisation, Start.name, Start.Quality, Start.ReceptionNumber FROM Mission JOIN Start ON mission.id_Start = Start.id  WHERE mission.id = ".$id);
        $sql->execute();
        $donnees = $sql->fetch();
        echo json_encode($donnees);
    }

    public static function getLocalisationEndMission($id)
    {
        $db = null;
        include('bdd.php');
        $sql = $db->prepare("SELECT End.localisation, End.name, End.Quality, End.ReceptionNumber FROM Mission JOIN End ON mission.id_Start = End.id  WHERE mission.id = ".$id);
        $sql->execute();
        $donnees = $sql->fetch();
        echo json_encode($donnees);
    }
}