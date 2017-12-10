<?php
if (isset($_GET['clogout'])){
	setcookie("userid", "", time() - (86400), "/"); // setcookie to expire on yesterday
    header('Location: http://liamd.pw/TwisTDevelopment/');
	exit;
}

if (isset($_GET['slogout'])){
    session_unset();
	session_destroy();
    header('Location: http://liamd.pw/TwisTDevelopment/');
	exit;
}
?>
