<!DOCTYPE html>
<html>
<head>
  <!--Import Google Icon Font-->
  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <!--Import materialize.css-->
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="css/css.css"  media="screen,projection"/>

  <!--Let browser know website is optimized for mobile-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
  <nav>
    <div class="nav-wrapper blue lighten-1">
      <a href="#" class="brand-logo center">TRUCK</a>
    </div>
  </nav>
<?php
/**
 * Created by PhpStorm.
 * User: julesbasse
 * Date: 16/12/2016
 * Time: 10:44
 */

echo $yield;

?>
  <?php
  if (isset($_SESSION["id"]))
  {
  ?>
<div class="foot blue lighten-1">
  <div class="row noMarge">
    <div class="col s4 center-align">
      <a href="infos" class="white-text"><i class="small material-icons">info</i></a>
    </div>
    <div class="col s4 center-align">
      <a href="mission" class="white-text"><i class="small material-icons">work</i></a>
    </div>
    <div class="col s4 center-align">
      <a href="" class="white-text"><i class="small material-icons">comment</i></a>
    </div>
  </div>
</div>
  <?php } ?>
  <!--Import jQuery before materialize.js-->
  <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>