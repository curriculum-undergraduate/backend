<?php
require_once('classes/Database.php');
if(isset($_GET['hapus'])){ 
	mysqli_query($_db, "DELETE FROM user WHERE user_id=$id");
    header('location: users.php');
}
?>