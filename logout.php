<?php 

require_once "core/init.php";

session_start();
unset($_SESSION['email']);
unset($_SESSION['jwt']);
unset($_SESSION['expiry']);
// setcookie('X-LUMINTU-TOKEN', 'LOGOUT');
Redirect::to('login');