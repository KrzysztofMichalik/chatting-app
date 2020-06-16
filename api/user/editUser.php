<?php
print 'jestem';
function editUser($post) {

  // if (isset($post['newUserIcon'])) {
    try {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_POSTFIELDS,
                  "login=". $_SESSION['name'].
                  "&key=" . $_SESSION['key'].
                  "&new_password=". $post['newUserPass'].
                  "&status=". $post['status'].
                  "&newUserIcon=". $post['newUserIcon']
                );
      $output = curl_exec($ch);
      $outputArray = json_decode($output, true);

      if (is_array($outputArray)) {

        var_dump($outputArray);
      } else {
        var_dump($output);
      }
      curl_close($ch);
    } catch (\Exception $e) {

    }
  // }

}
