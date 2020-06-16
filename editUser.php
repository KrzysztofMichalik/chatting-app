<?php
require_once('init.inc.php');
require_once('inc/header.inc.php');
require_once('inc/nav.inc.php');


$dao = new userDAO("http://tank.iai-system.com/api/user/edit");
if (empty($_SESSION['name'])) {
  echo '<div class="container mt-5">'.
        '<div class="row justify-content-md-center">'.
        '<div class="col-md-auto alert alert-danger" role="alert">'.
        '<h1>Zaloguj się!</h1>'.
        '</div></div></div>';
  die;
}

if (isset($_POST['submitChanges'])) {
  $returned_html = $dao->editUser($_POST);
}

?>
<!--  -->

<div class="container register-form mt-5">
  <form class="form col-md-6 mx-auto " method="POST" action="editUser.php">
    <div class="note">
      <p>Edit form</p>
    </div>

    <div class="form-content">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label for="newUserPass">New Password</label>
                <input type="password" class="form-control" name="newUserPass"/>
            </div>
          </div>
          <div class="col-md-12">
            <div class="">Status</div>
            <div class="form-group">
                <input type="radio"  name="status" value="online" checked/>
                <label for="online">Online</label>
                <input type="radio"  name="status" value="offline"/>
                <label for="offline">Offline</label>
            </div>
          </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="userIcon">Icon</label>
                  <input type="text" class="form-control" name="newUserIcon" placeholder="enter url"/>
              </div>
            </div>
          </div>
        <div>
          <button type="submit" name="submitChanges" class="btnSubmit">Submit</button>
        </div>
    </div>
  </form>
  <?php

  if (isset($returned_html)) {
    print $returned_html;
  }
   ?>
</div>
