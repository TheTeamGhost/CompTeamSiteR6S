<?php
    session_start();
    require 'inc/steamauth/steamauth.php';
    require 'inc/db_connect.php';
    require 'inc/signout_handler.php';
    require 'inc/login_check.php';
    require 'inc/settings/steamauth.php';

    $userid = $_SESSION['id'];

    $fetch_userprofile = $conn->query("SELECT * FROM users WHERE id='".$userid."'");
    while ($fetched_userprofile = $fetch_userprofile->fetch_assoc()) {
        $username = $fetched_userprofile['username'];
        $userquote = $fetched_userprofile['quote'];
        $userbio = $fetched_userprofile['bio'];
        $steamid = $fetched_userprofile['steamid'];
        $rank_verified = $fetched_userprofile['rank_verified'];
    }

    include 'inc/formatter.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Editing <?php echo $username; ?></title>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="style/master.css">
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/css/uikit.min.css" />

        <!-- UIkit JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit-icons.min.js"></script>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

        <script type='text/javascript' src="js/check-password.js"></script>
    </head>
    <body>
        <img class="banner" src="img/banner_profile.png" alt="">
        <nav class="fixed-background uk-navbar-container" uk-navbar style="position: relative; z-index: 980;">
            <div class="uk-navbar-center">
                <div class="uk-navbar-center-left"><div>
                    <ul class="uk-navbar-nav">
                        <li><a class="anchor" href="index.php">Home</a></li>
                        <li><a class="anchor" href="index.php#team">The Team</a></li>
                    </ul>
                </div></div>
                <a class="anchor uk-navbar-item uk-logo" href="#">TwisT</a>
                <div class="uk-navbar-center-right"><div>
                    <ul class="uk-navbar-nav">
                        <li><a class="anchor" href="#" uk-toggle="target: #latest-news">News</a></li>
                        <div id="latest-news" uk-offcanvas="overlay: true">
                            <div class="uk-offcanvas-bar">
                                <h3>$news_title</h3>
                                <p>$news_text</p>
                                <div class="uk-card-badge uk-label">$news_date</div>
                            </div>
                        </div>
                        <?php
                            if (isset($_SESSION['id'])) {
                                $userid = $_SESSION['id'];
                                $fetchusername_session = $conn->query("SELECT id, username, quote, bio, steamid, user_role FROM users WHERE id='".$userid."'");
                                while ($fetched_userinfo = $fetchusername_session->fetch_assoc()) {
                                    $username_session = $fetched_userinfo['username'];
                                    $userrole = $fetched_userinfo['user_role'];
                                    $userid = $fetched_userinfo['id'];
                                    $bio = htmlspecialchars($fetched_userinfo['bio']);
                                    $quote = htmlspecialchars($fetched_userinfo['quote']);
                                    $steamid = $fetched_userinfo['steamid'];
                                }
                                echo
                                '
                                    <li><a class="anchor" href="#" uk-toggle="target: #userinterface">'.$username_session.'</a></li>
                                    <div id="userinterface" uk-offcanvas="overlay: true; flip: true;">
                                        <div class="uk-offcanvas-bar">
                                            <div class="uk-card-badge uk-label">'.$username_session.'</div>
                                            <li class="user-li"><a class="user-nav-items" href="profile.php?profile='.$userid.'">Profile</a></li>
                                            <li class="user-li"><a class="user-nav-items" href="settings.php">Settings</a></li>
                                ';
                                if ($userrole == "1" || $userrole == "2" || $userrole == "3" || $userrole == "4") {
                                    echo '<li class="user-li"><a class="user-nav-items" href="#">Admin Control Panel</a></li>';
                                }
                                echo
                                '
                                            <li class="user-li"><a class="user-nav-items" href="?slogout">Logout</a></li>
                                        </div>
                                    </div>
                                ';
                            }
                            elseif (isset($_SESSION['steamid'])) {
                                $steamid = $_SESSION['steamid'];
                                $fetchinfo_steamid_session = $conn->query("SELECT id, username, quote, bio, steamid, user_role FROM users WHERE steamid='".$steamid."'");
                                while ($fetched_userinfo = $fetchinfo_steamid_session->fetch_assoc()) {
                                    $username_session = $fetched_userinfo['username'];
                                    $userrole = $fetched_userinfo['user_role'];
                                    $userid = $fetched_userinfo['id'];
                                    $bio = htmlspecialchars($fetched_userinfo['bio']);
                                    $quote = htmlspecialchars($fetched_userinfo['quote']);
                                    $steamid = $fetched_userinfo['steamid'];
                                }
                                echo
                                '
                                    <li class="navbar-li"><a class="anchor nav-items" href="#" uk-toggle="target: #userinterface">'.$username_session.'</a></li>
                                    <div id="userinterface" uk-offcanvas="overlay: true; flip: true;">
                                        <div class="uk-offcanvas-bar">
                                            <div class="uk-card-badge uk-label">'.$username_session.'</div>
                                            <li class="user-li"><a class="anchor user-nav-items" href="profile.php?profile='.$userid.'">Profile</a></li>
                                            <li class="user-li"><a class="anchor user-nav-items" href="settings.php">Settings</a></li>
                                ';
                                if ($userrole == "1" || $userrole == "2" || $userrole == "3" || $userrole == "4") {
                                    echo '<li class="user-li"><a class="user-nav-items" href="#">Admin Control Panel</a></li>';
                                }
                                echo
                                '
                                            <li class="user-li"><a class="anchor user-nav-items" href="?slogout">Logout</a></li>
                                        </div>
                                    </div>
                                ';
                            }
                            else {
                                echo "<script> window.location.assign('login.php'); </script>";
                            }
                        ?>
                    </ul>
                </div></div>
            </div>
        </nav>
        <video playsinline autoplay muted loop poster="img/poster.jpg" id="bgvid">
            <source src="img/bg-profile.webm" type="video/webm">
            <source src="img/bg-profile.mp4" type="video/mp4">
        </video>
        <section class="mid-profile">
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if (!empty($_POST["password"])) {
                        $newpassword = $_POST['password'];
                        $oldpassword = $_POST['oldpassword'];

                        $finduser = "SELECT * FROM users WHERE id='".$userid."'";
                        $verifylogin = $conn->query($finduser);

                        while ($parsed_login =  $verifylogin->fetch_assoc()) {
                            $fetched_password = $parsed_login["password"];
                            $fetched_userid = $parsed_login["id"];
                        }

                        if (password_verify($oldpassword, $fetched_password)) {
                            $newhash_pass = password_hash($newpassword, PASSWORD_DEFAULT);
                            $conn->query("UPDATE users SET password='$newhash_pass' WHERE id='$fetched_userid'");
                        }
                        else {
                            echo "Failed to verify user identity!";
                        }
                    }

                    if (!empty($_POST["rank"])) {
                        $rankid = $_POST['rank'];
                        $update_qry = "UPDATE users SET rank='$rankid' WHERE id='$userid'";
                        $conn->query($update_qry);
                    }

                    if (!empty($_POST["quote"])) {
                        $newquote = htmlspecialchars($_POST['quote'], ENT_QUOTES);
                        $update_qry = "UPDATE users SET quote='$newquote' WHERE id='$userid'";
                        $conn->query($update_qry);
                    }

                    if (!empty($_POST["bio"])) {
                        $newbio = htmlspecialchars($_POST['bio'], ENT_QUOTES);
                        $update_qry = "UPDATE users SET bio='$newbio' WHERE id='$userid'";
                        $conn->query($update_qry);
                    }
                }
            ?>
            <form class="settings-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES);?>" method="post">
                <fieldset class="uk-fieldset">
                    <legend class="uk-legend">Editing profile</legend>
                    <hr>
                    <legend class="uk-legend">Change Password</legend>
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                         <p class="uk-margin-right">Old Password:</p>
                         <input name="oldpassword" class="uk-input" type="password" placeholder="Password" autocomplete="nope">
                    </div>
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                         <p class="uk-margin-right">Password:</p>
                         <input name="password" id="Password" class="uk-input" type="password" placeholder="Password">
                         <p class="uk-margin-right">Confirm Password:</p>
                         <input class="uk-input" id="ConfirmPassword" type="password" placeholder="Confirm Password" onchange="checkPasswordMatch();">
                    </div>
                    <div id="infoBox" class="hidden smooth" uk-alert>
                        <p id="CheckPasswordMatch"></p>
                    </div>
                    <hr>
                    <div class="uk-margin">
                        <select name="rank" class="uk-select">
                            <option value="0">Unranked</option>
                            <option value="1">Copper IV</option>
                            <option value="2">Copper III</option>
                            <option value="3">Copper II</option>
                            <option value="4">Copper I</option>
                            <option value="5">Bronze IV</option>
                            <option value="6">Bronze III</option>
                            <option value="7">Bronze II</option>
                            <option value="8">Bronze I</option>
                            <option value="9">Silver IV</option>
                            <option value="10">Silver III</option>
                            <option value="11">Silver II</option>
                            <option value="12">Silver I</option>
                            <option value="13">Gold IV</option>
                            <option value="14">Gold III</option>
                            <option value="15">Gold II</option>
                            <option value="16">Gold I</option>
                            <option value="17">Platinum III</option>
                            <option value="18">Platinum II</option>
                            <option value="19">Platinum I</option>
                            <option value="20">Daimond</option>
                        </select>
                    </div>
                    <hr>
                    <legend id="steam" class="uk-legend">Set you profile image by linking your Steam Account:</legend>
                    <?php
                    if (isset($_SESSION['steamid']) && !empty($steamid)) {
                        $session_steamid = $_SESSION['steamid'];
                        $json = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$api_key.'&steamids='.$session_steamid.'');
                        $steamAccountData = json_decode($json, true);
                        $profile = $steamAccountData['response']['players'][0]['avatarfull'];
                        $conn->query("UPDATE users SET profile_img=$profile WHERE id=$userid");
                    }
                    elseif (!empty($steamid)){
                        echo "<p>Steam Account already linked!</p>";
                    }
                    else {
                        echo '<a href="?login-settings">Link Steam</a>';
                    }
                    ?>

                    <!-- We'll skip this for when I try or want to try it again
                    <form action="img/upload.php" method="post" enctype="multipart/form-data">
                        Select profile image to upload:
                        <input type="file" name="fileToUpload" id="fileToUpload">
                        <input type="submit" value="Upload Image" name="submit">
                    </form>-->
                    <hr>
                    <legend class="uk-legend">Quote:</legend>
                    <div class="uk-margin">
                        <?php
                            echo
                            '
                                <input name="quote" class="uk-input" type="text" placeholder="User Quote" value="'.$quote.'">
                                </div>
                                <legend class="uk-legend">Bio:</legend>
                                <div class="uk-margin">
                                <textarea name="bio" class="uk-textarea" rows="5" placeholder="User Bio">'.$bio.'</textarea>
                            ';
                        ?>
                    </div>
                    <hr>
                    <button type="submit" class="uk-button uk-button-text scale"> Submit </button>
                </fieldset>
            </form>
        </section>
    </body>
</html>
