<?php 

require_once "core/init.php";

session_destroy();
setcookie('X-LUMINTU-TOKEN', 'LOGOUT');
Redirect::to('login');

?>