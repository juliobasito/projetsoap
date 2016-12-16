<?php

require 'vendor/autoload.php';

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

$view = $app->view();
$view->setTemplatesDirectory('views');

$app->get('/', function () use ($app){
	$app->render('login.php');
});
$app->get('/infos', function () use ($app){
	$app->render('infos.php');
});

$app->get('/mission', function () use ($app){
	$app->render('mission.php');
});
$app->get('/map', function () use ($app){
	$app->render('map.html');
});
$app->run();

?>
































