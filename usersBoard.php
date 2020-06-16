<?php
require_once('init.inc.php');
require_once('inc/header.inc.php');
require_once('inc/nav.inc.php');
$dao = new userDAO("http://tank.iai-system.com/api/user/getAll");


if (isset($_POST['showActive']) ) {
  $status = 'active';
  $outputArray = $dao->getActive();
} else {
  $status='all';
  $outputArray = $dao->getAll();
}

if (empty($_SESSION['name']) ) {
  echo '<div class="container mt-5">'.
        '<div class="row justify-content-md-center">'.
        '<div class="col-md-auto alert alert-danger" role="alert">'.
        '<h1>BRAK DOSTĘPU</h1>'.
        '</div></div></div>';
  die;
}

// ?>
<div class="container">
  <div class="row">
    <div class="col-md-12 d-flex flex-row-reverse mt-5">

        <?php
        if ($status == "all") {
          echo '<form action="usersBoard.php" method="post"> Show only active users
            <input type="submit" class="btn btn-danger" name="showActive" value="Check it!"/>
          </form>';
        } else {
            echo '<form action="usersBoard.php" method="post"> Show all users
              <input type="submit" class="btn btn-danger" name="showAll" value="Check it!"/>
            </form>';
        }
        ?>


    </div>
    <div class="col-md-6 mx-auto">
      <table class="table mt-5">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Login</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php

            if (!empty($outputArray)) {
              foreach ($outputArray as $key => $value) {
                if (empty($value['icon'])) {
                  $src = "https://cdn.iconscout.com/icon/free/png-512/incognito-6-902117.png";
                } else {
                  $src = $value['icon'];
                }
                print '<tr>'.
                '<th scopre="row">' . $key .'</th>' .
                '<td><img class="icon" src="'. $src .'"/>' . "\t". $value['login'] .'</td>'.
                '<td>'. $value['status'] .'</td>'.
                '</tr>';
              }
            }


  // przekazać parametr w get .
           ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
