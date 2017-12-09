<?php
    $userinfo = "SELECT username, quote, bio, steamid, active, profile_img FROM users";
    $fetch_userinfo = $conn->query($userinfo) or die($conn->error);

    while ($parsed_userinfo =  $fetch_userinfo->fetch_assoc()) {
        $username = $parsed_userinfo["username"];
        $quote = $parsed_userinfo["quote"];
        $bio = $parsed_userinfo["bio"];
        $steamid = $parsed_userinfo["steamid"];
        $user_active = $parsed_userinfo["active"];
        $profile_img = $parsed_userinfo["profile_img"];
    }
?>
