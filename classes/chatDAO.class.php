<?php

class chatDAO
{
  private $ch;

  protected $chat_id;

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

  public function getActive()
  {
    try {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS,
                              "login=". $_SESSION['name'].
                              "&key=" . $_SESSION['key']);
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

  public function createChat($name)
  {
    try {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS,
                            "login=". $_SESSION['name'].
                            "&key=" . $_SESSION['key'].
                            "&name=" . $name
                          );
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

  public function addBuddy($buddy, $chat_id)
  {
    $chat_id = intval($chat_id);
    try {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS,
                              "login=". $_SESSION['name'].
                              "&key=" . $_SESSION['key'].
                              "&user=" . $buddy.
                              "&chat_id=" . $chat_id);
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

  public function leaveConv($chat_id)
  {
    $chat_id = intval($chat_id);
    try {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS,
                              "login=". $_SESSION['name'].
                              "&key=" . $_SESSION['key'].                              
                              "&chat_id=" . $chat_id);
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

  public function sentMsg($chat_id, $message)
  {
    $chat_id = intval($chat_id);
    try {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS,
                              "login=". $_SESSION['name'].
                              "&key=" . $_SESSION['key'].                              
                              "&chat_id=" . $chat_id.
                              "&message=" . $message
                              );

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

  public function getMsg( $last_id) 
  {
    try {
      curl_setopt($this->ch, CURLOPT_POSTFIELDS,
                              "login=". $_SESSION['name'].
                              "&key=" . $_SESSION['key'].                              
                              "&last_id=" . $last_id);
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
}

