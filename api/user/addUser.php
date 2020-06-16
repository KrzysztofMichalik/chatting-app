<?php

function addUser(string $login, string $pasword)
{
 try {
  $ch = curl_init();

  // set URL and other appropriate options
  curl_setopt($ch, CURLOPT_URL, "http://tank.iai-system.com/api/user/add");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_HEADER, 0);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, "login=". $login. "&password=" . $pasword);

  // grab URL and pass it to the browser
  $output = curl_exec($ch);
  $array = json_decode($output, true);

  if (is_array($array)) {
    echo '<div class="container">'.
    '<div class="row justify-content-md-center">'.
    '<div class="col-md-auto alert alert-success" role="alert">'.
    '<h1>Utworzyłes konto '.$array['login'].' teraz możesz się zalogować</h1>'.
    '</div></div></div>';

  } else {
    echo '<div class="container">'.
          '<div class="row justify-content-md-center">'.
          '<div class="col-md-auto alert alert-danger" role="alert">'.
          '<h1>Wystąpił błąd zapytania</h1>'.
          '</div></div></div>';
  }
  // close cURL resource, and free up system resources
  curl_close($ch);

  } catch (Exception $e) {
    var_dump($e);
    return false;
  }
}
