<?php
include '../db_connect.php';
$username = $_POST['username'];
$password = $_POST['password'];
$checklogin = "SELECT id, username, password FROM users";
$verify_login = $conn->query($checklogin);

if(isset($username, $password))
    {
        $login = $conn->query("SELECT id, username, password FROM Users WHERE username = '".$name."' AND  password = '".$password."'");

        if(mysql_num_rows($resul1) > 0 )
        {
            if ($verify_login['username'] = $username && $verify_login['password'] = $password && $_POST['rememberMe'] == 'true') {
                $userid = "userid";
                $clientid = $login['id'];
                setcookie($userid, $clientid, time() + (86400 * 365), "/"); // 86400 = 1 day
            }
            else {
                $_SESSION['id'] = $login['id'];
                session_start();
            }
        }
        else
        {
            echo 'The username or password are incorrect!';
        }
}
?>
