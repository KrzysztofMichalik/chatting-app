<?php
require_once('classes/userDAO.class.php');

if (isset($_COOKIES['my_session'])) {
  @session_id($_COOKIES['my_session']);
}
session_name('my_session');
session_start();
