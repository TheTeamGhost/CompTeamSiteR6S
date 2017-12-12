<?php
if (!isset($_SESSION['id'])) {
    if (isset($_COOKIE['userid'])) {
        if (isset($_COOKIE['rememberMe'])) {
            $verify_hash = $_COOKIE['rememberMe'];
            $userid = $_COOKIE['userid'];
            $qry = "SELECT id, password_hash FROM users WHERE password_hash=".$verify_hash." AND id='".$userid."'";
            $fetch_data = $conn->query($qry);
            while($fetched_userdata = $fetch_data->fetch_assoc()) {
                $id = $fetched_userdata['id'];
                $hash = $fetch_userdata['password_hash'];
            }
            if ($verify_hash == $hash) {
                $_SESSION['id'] = $id;
                $rnd_hash = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
                $conn->query("UPDATE users SET password_hash='$rnd_hash' WHERE id='$id'") or die($conn->error);
                setcookie("userid", $id, time() + 86400 * 365, "/");
                setcookie("rememberMe", $rnd_hash, time() + (86400 * 365), "/"); // 86400 = 1 day
            }
            else {
                setcookie("userid", "", time() - 86400, "/");
                setcookie("rememberMe", "", time() - 86400, "/");
                echo "<script> window.location.assign('index.php'); </script>";
            }
        }
        else {
            setcookie("userid", "", time() - 86400, "/");
            setcookie("rememberMe", "", time() - 86400, "/");
            echo "<script> window.location.assign('index.php'); </script>";
        }
    }
}
?>
