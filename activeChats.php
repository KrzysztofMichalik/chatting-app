<?php
require_once('init.inc.php');
require_once('inc/header.inc.php');
require_once('inc/nav.inc.php');

if (empty($_SESSION['name'])) {
  echo '<div class="container mt-5">'.
  '<div class="row justify-content-md-center">'.
  '<div class="col-md-auto alert alert-danger" role="alert">'.
  '<h1>Zaloguj się!</h1>'.
  '</div></div></div>';
  die;
}

$dao = new chatDAO("http://tank.iai-system.com/api/chat/getActive");
$v = $dao->getActive();

var_dump($v);
