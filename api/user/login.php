<?php

function loginsys(array $post)
{
  if (!empty($post['name']) && !empty($post['pswd']) && empty($post['logOut'])) {

    try {
      $ch = curl_init();
      $key = md5( $post['name'] . hash('sha256', $post['pswd'] ));

      // set URL and other appropriate options
      curl_setopt($ch, CURLOPT_URL, "http://tank.iai-system.com/api/user/verify");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, "login=". $post['name']. "&key=" . $key);

      // grab URL and pass it to the browser
      $output = curl_exec($ch);
      $outputArray = json_decode($output, true);

      if (is_array($outputArray) ) {
        
        $_SESSION['pswd'] = $post['pswd'];
        $_SESSION['name'] = $post['name'];
        $_SESSION['key'] =  $key;

        $html_result = '<div class="container">'.
        '<div class="row justify-content-md-center">'.
        '<div class="col-md-auto mt-5 alert alert-primary" role="alert">'.
        '<h1>Zalogowałeś się.</h1>'.
        '</div></div></div>';
        $returned_arr = array('isLogged'=>true, 'result'=>$html_result);
        return $returned_arr;

      } else {

        $html_result = '<div class="container">'.
        '<div class="row justify-content-md-center">'.
        '<div class="col-md-auto mt-5 alert alert-danger" role="alert">'.
        '<h1>' . $output . '</h1>'.
        '</div></div></div>';
        $returned_arr = array('isLogged'=>false, 'result'=>$html_result);
        return $returned_arr;
      }
    } catch (\Exception $e) {
      var_dump($e);
      return false;
    }

} elseif(!empty($_POST['logOut']) ){

     $html_result ='<div class="container">'.
     '<div class="row justify-content-md-center">'.
     '<div class="col-md-auto mt-5 alert alert-danger" role="alert">'.
     '<h1>Zostałeś wylogowany</h1>'.
     '</div></div></div>';
     $returned_arr = array('isLogged'=>false, 'result'=>$html_result);
     unset($_SESSION['name']);
     unset($_SESSION['pswd']);
     unset($_SESSION['key']);
     return $returned_arr;
   }
}
