<?php
function getAll(){
  try {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://tank.iai-system.com/api/user/getAll");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);

    $output = curl_exec($ch);
    $outputArray = json_decode($output, true);

    if (is_array($outputArray)) {
      return $outputArray;
    } else {
      var_dump($output);
    }
    curl_close($ch);
  } catch (\Exception $e) {
    return $e->getMessage();
  }
}

function getActive() {
  $inputArray = getAll();
  $outputArray = [];

  if (is_array($inputArray)) {
    foreach ($inputArray as $key => $value) {
      if ($value['status'] == 'online') {
        array_push($outputArray, $value);
      }
    }
    return $outputArray;
  }
}
