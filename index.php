<?php

require 'vendor/autoload.php';
require 'models/mission.php';

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


$app->get('/getusermission/:id', function ($id) use ($app){
    Mission::getUserMission($id);
});

$app->get('/getLocalisationStartMission/:id', function($id) use ($app){
    Mission::getLocalisationStartMission($id);
});

$app->get('/getLocalisationEndMission/:id', function($id) use ($app){
    Mission::getLocalisationEndMission($id);
});
$app->run();

?>
































