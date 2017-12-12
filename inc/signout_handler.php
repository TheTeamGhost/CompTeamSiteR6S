<?php
if (isset($_GET['slogout'])){
	setcookie("userid", "", time() - 86400, "/");
	setcookie("rememberMe", "", time() - 86400, "/"); // 86400 = 1 day
	session_unset();
	session_destroy();
    header('Location: index.php');
	exit;
}
?>
