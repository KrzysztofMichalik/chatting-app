<?php
$html = array();
$html['isLogged'] = false;
$html['isAdmin'] = false;
$dao = new userDAO("http://tank.iai-system.com/api/user/verify");

if (!empty($_POST['name']) && !empty($_POST['pswd']) && empty($_POST['LogOut']) ) {

  $html = $dao->logIn($_POST);

} elseif(!empty($_POST['logOut'])){
  $html = $dao->logOut();
}

if(!empty($_SESSION['name'])){
  // warunek sprawdzajacy czy uzytkownik został zalogowany, przy implementowaniu navigacji na różnych podstromach, stąd konieczność uzycia sesji.
  $html['isLogged'] = true;

}

?>
<nav class="navbar navbar-expand-md navbar-dark bg-primary">
  <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
    <ul class="navbar-nav mr-auto">
      <?php if ($html['isLogged'] == true ): ?>
        <!-- edit user link -->
      <li class="nav-item active">
        <a class="nav-link" href="./editUser.php">Edit profile</a>
      </li>
    <?php endif; ?>
    <?php if ($html['isLogged'] == false): ?>
      <li class="nav-item active">
        <a class="nav-link" href="./registerUser.php">Register</a>
      </li>
    <?php endif; ?>
    <?php if ($html['isLogged'] == true): ?>
      <li class="nav-item active">
        <a class="nav-link" href="./chat.php">Chats</a>
      </li>
    <?php endif; ?>

    </ul>
  </div>
    <div class="mx-md-auto order-0">
      <a class="navbar-brand mx-auto pr-4" href="./">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
      <div class="navbar-nav ml-auto">
          <?php
            if ($html['isLogged'] == true) {
              print '<form action="index.php" method="post">'.
                    '<input type="submit" class="btn btn-danger" name="logOut" value="LogOut"/></form>';
            }
           else {
            print '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginForm">LogIn</button>';
          }

          ?>
        </button>
        <!-- Modal -->
        <div class="modal fade" id="loginForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Please Log in</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form class="" action="index.php" method="post">
                <div class="modal-body">
                  <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" name="pswd" id="inputPassword3" required>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">LogIn</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
  <?php
  if (isset($html['result'])) {
    print $html['result'];
  }
