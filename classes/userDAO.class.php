<?php

class userDAO
{
  private $ch;

  public $output;
  public $outputArray;

  function __construct($url)
  {
    $this->ch = curl_init();
    curl_setopt($this->ch, CURLOPT_URL, $url);
    curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($this->ch, CURLOPT_HEADER, 0);
    curl_setopt($this->ch, CURLOPT_POST, 1);
  }

  public function addUser(string $login, string $password)
  {
    try {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS, "login=". $login. "&password=" . $password);

      $this->output = curl_exec($this->ch);
      $this->outputArray = json_decode($this->output, true);

      if (is_array($this->outputArray)) {

        $html_result = '<div class="container">'.
                        '<div class="row justify-content-md-center">'.
                        '<div class="col-md-auto alert alert-success" role="alert">'.
                        '<h1>Utworzyłes konto '.$this->outputArray['login'].' teraz możesz się zalogować</h1>'.
                        '</div></div></div>';
        return $html_result;

      } else {
        $html_result = '<div class="container">'.
              '<div class="row justify-content-md-center">'.
              '<div class="col-md-auto alert alert-danger" role="alert">'.
              '<h1>Wystąpił błąd zapytania</h1>'.
              '</div></div></div>';
        return $html_result;
      }
      // close cURL resource, and free up system resources
      curl_close($this->ch);

      } catch (Exception $e) {
        var_dump($e);
        return false;
      }

  }

  public function getAll()
  {
    try {
      $this->output = curl_exec($this->ch);
      $this->outputArray = json_decode($this->output, true);

      if (is_array($this->outputArray)) {
        return $this->outputArray;
      } else {
        var_dump($this->output);
      }
      curl_close($this->ch);
    } catch (\Exception $e) {
      return $e->getMessage();
    }
  }

  public function getActive()
  {
    $inputArray = $this->getAll();

    if (is_array($inputArray)) {
      foreach ($inputArray as $key => $value) {
        if ($value['status'] == 'online') {
          array_push($this->outputArray, $value);
        }
      }
      return $this->outputArray;
    }
  }

  function editUser(array $post)
  {

    try {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS,
                  "login=". $_SESSION['name'].
                  "&key=" . $_SESSION['key'].
                  "&new_password=". $post['newUserPass'].
                  "&status=". $post['status'].
                  "&newUserIcon=". $post['newUserIcon']
                );
      $this->output = curl_exec($this->ch);
      $this->outputArray = json_decode($this->output, true);

      if (is_array($this->outputArray)) {
        $html_result = '<div class="container">'.
          '<div class="row justify-content-md-center">'.
          '<div class="col-md-auto alert alert-primary" role="alert">'.
          '<h1>Twoje dane zostały zmienione.</h1>'.
          '</div></div></div>';
        return $html_result;
      } else {
        var_dump($this->output);
      }
      curl_close($this->ch);
    } catch (\Exception $e) {

    }

  }
// pomyśl o przeniesieniu tej funkcji do innej klasy
  public function logIn(array $post)
  {
    if (!empty($post['name']) && !empty($post['pswd']) && empty($post['logOut'])) {

      try {
        $key = md5( $post['name'] . hash('sha256', $post['pswd'] ));
        curl_setopt($this->ch, CURLOPT_POSTFIELDS,
                                "login=". $post['name'].
                                "&key=" . $key);

        $this->output = curl_exec($this->ch);
        $this->outputArray = json_decode($this->output, true);

        if (is_array($this->outputArray) ) {

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
          '<h1>' . $this->output . '</h1>'.
          '</div></div></div>';
          $returned_arr = array('isLogged'=>false, 'result'=>$html_result);
          return $returned_arr;
        }
        curl_close($this->ch);
      } catch (\Exception $e) {
        var_dump($e);
        return false;
      }
    }
  }
  public function logOut(){
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
