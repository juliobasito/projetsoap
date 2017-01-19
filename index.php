<?php

require 'vendor/autoload.php';
require 'models/mission.php';
require 'models/user.php';

$app = new \Slim\Slim(array(
    'view' => '\Slim\LayoutView', // I activate slim layout component
    'layout' => 'layouts/main.php' // I define my main layout
    ));

session_start();
/*------------------EXEMPLE--------------------------
$app->get('/getSeeting/:userId', function ($userId) {
    //renvoi les seetings de l'utilisateur
    $seeting = User::getSeeting($userId);
});
-----------------------------------------------------*/

$app->hook('slim.before.router', function () use ($app){
    $app->view()->setData('app',$app);
});

$view = $app->view();
$view->setTemplatesDirectory('views');


$app->get('/getusermission/:id', function ($id) use ($app){
    Mission::getUserMission($id);
});
$app->get('/infos', function () use ($app){
    $vehicule = user::getVehiculesByUser($_SESSION['id']);
    $vehiculedecod = json_decode($vehicule);
    $now = $_SESSION['date'];
    $date = user::dateDiff($now);
    $permis = null;
    $ct = null;
    if(!empty($vehiculedecod)) {
        $permis = user::getPermisbyUser($_SESSION["id"], $vehiculedecod->Id);
        $ct = user::getCT($vehiculedecod->Id);
    }
    $app->render('infos.php', array('vehicule'=>$vehiculedecod, 'date'=>$date, 'permis'=>$permis, 'ct'=>$ct));
})->name('infos');

$app->get('/getLocalisationStartMission/:id', function($id) use ($app){
    Mission::getLocalisationStartMission($id);
});

$app->get('/getCT/:id', function($id) use ($app){
    user::getCT($id);
});

$app->get('/getLocalisationEndMission/:id', function($id) use ($app) {
    Mission::getLocalisationEndMission($id);
});


    $app->get('/mission', function () use ($app) {
        $id = Mission::getMissionByUser($_SESSION["id"]);
        if(!empty($id)) {
            $mission = Mission::getMissionById($id);
            $missionstart = Mission::getLocalisationStartMission($id);
            $missionend = Mission::getLocalisationEndMission($id);
            $app->render('missiontest.php', array('mission' => json_decode($mission), 'missionstart' => json_decode($missionstart), 'missionend' => json_decode($missionend)));
        }
        else {
            $app->render('nomission.php');
        }
    })->name('mission');

    $app->get('/map', function () use ($app) {
        $app->render('map.html');
    })->name('map');
$app->get('/login', function () use ($app) {
    $app->render('login.php');
})->name('connexion');

$app->get('/panique/:camionid', function ($id) use ($app) {
    Mission::updatePanic($id);
    $app->redirect('../infos');
});

$app->get('/accident/:camionid', function ($id) use ($app) {
    Mission::updateAccident($id);
    $app->redirect('../infos');
});

$app->post('/login', function () use ($app) {
    $email = $_POST["mail"];
    $password = $_POST["password"];
    $res = user::login($email, $password);
    $tab = json_decode($res);
    $_SESSION['id'] = $tab->Id;
    setcookie("cookieid", $tab->Id);
    $_SESSION['date'] = time();
    if($res!=null)
    {
        $app->redirect($app->urlFor('mission'));
    }
    else
    {
        $app->flash('error', 'L\'adresse email et le mot de passe que vous avez entrés ne correspondent pas à ceux présents dans nos fichiers. Veuillez vérifier et réessayer.');
        console.log("erreu");

    }
});
    $app->run();

?>