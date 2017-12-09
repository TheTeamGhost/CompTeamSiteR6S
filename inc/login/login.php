<?php
include '../db_connect.php';
$username = $_POST['username'];
$password = $_POST['password'];

if(isset($username, $password))
    {
        $login = $conn->query("SELECT id, username, password FROM Users WHERE username = '".$username."' AND  password = '".$password."'");

        if(mysql_num_rows($resul1) > 0 )
        {
            if ($_POST['rememberMe'] == 'true') {
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
