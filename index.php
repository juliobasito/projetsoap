<?php

require 'vendor/autoload.php';
require 'models/mission.php';
require 'models/user.php';

$app = new \Slim\Slim(array(
    'view' => '\Slim\LayoutView', // I activate slim layout component
    'layout' => 'layouts/main.php' // I define my main layout
    ));
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
    $app->render('infos.php');
});

$app->get('/getLocalisationStartMission/:id', function($id) use ($app){
    Mission::getLocalisationStartMission($id);
});

$app->get('/getLocalisationEndMission/:id', function($id) use ($app) {
    Mission::getLocalisationEndMission($id);
});

$app->get('/mission/:id', function ($id) use ($app) {
    $mission = Mission::getMissionById($id);
    $missionstart = Mission::getLocalisationStartMission($id);
    $missionend = Mission::getLocalisationEndMission($id);
    $app->render('missiontest.php',array('mission'=>json_decode($mission), 'missionstart'=>json_decode($missionstart), 'missionend'=>json_decode($missionend)));
});

    $app->get('/mission', function () use ($app) {
        $app->render('mission.php');
    })->name('mission');
    $app->get('/map', function () use ($app) {
        $app->render('map.html');
    })->name('map');
$app->get('/login', function () use ($app) {
    $app->render('login.php');
})->name('connexion');

$app->post('/login', function () use ($app) {
    $email = $_POST["mail"];
    $password = $_POST["password"];
    $res = user::login($email, $password);
    if($res!=null)
    {
        $app->redirect($app->urlFor('mission'));
    }
    else
    {
        $app->flash('error', 'L\'adresse email et le mot de passe que vous avez entrés ne correspondent pas à ceux présents dans nos fichiers. Veuillez vérifier et réessayer.');
        $app->redirect($app->urlFor('connexion'));

    }
});
    $app->run();

?>