<?php
require_once('init.inc.php');
require_once('inc/header.inc.php');
require_once('inc/nav.inc.php');

$dao = new userDAO("http://tank.iai-system.com/api/user/add");

if(isset($_POST['newUserRegistred'])){
$result = $dao->addUser(
    $_POST['newUserName'],
    $_POST['newUserPswd'],
  );
}
?>
<div class="container register-form mt-5">
  <form class="form" method="POST" action="registerUser.php">
    <div class="note">
        <p>Register form</p>
    </div>

    <div class="form-content">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Your Name" name="newUserName" required/>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Your Password" name="newUserPswd" required/>
          </div>
        </div>

      </div>
      <div>
        <button type="submit" class="btnSubmit" name='newUserRegistred'>Submit</button>
      </div>
    </div>
  </form>
</div>
<?php
if (!empty($result)) {
  print $result;
}

 ?>
