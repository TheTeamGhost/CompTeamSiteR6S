<?php
    session_start();
    require 'inc/steamauth/steamauth.php';
    require 'inc/db_connect.php';
    require 'inc/signout_handler.php';
    require 'inc/login_check.php';

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
                                $fetchusername_session = $conn->query("SELECT id, username, user_role FROM users WHERE id='".$userid."'");
                                while ($fetched_userinfo = $fetchusername_session->fetch_assoc()) {
                                    $username_session = $fetched_userinfo['username'];
                                    $userrole = $fetched_userinfo['user_role'];
                                    $userid = $fetched_userinfo['id'];
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
                                $fetchinfo_steamid_session = $conn->query("SELECT id, username, user_role, steamid FROM users WHERE steamid='".$steamid."'");
                                while ($fetched_userinfo = $fetchinfo_steamid_session->fetch_assoc()) {
                                    $username_session = $fetched_userinfo['username'];
                                    $userrole = $fetched_userinfo['user_role'];
                                    $userid = $fetched_userinfo['id'];
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
            <form class="settings-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                <fieldset class="uk-fieldset">
                    <legend class="uk-legend">Editing profile</legend>
                    <hr>
                    <legend class="uk-legend">Change Password</legend>
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                         <p class="uk-margin-right">Old Password:</p>
                         <input name="oldpassword" class="uk-input" type="password" placeholder="Password">
                    </div>
                    <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                         <p class="uk-margin-right">Password:</p>
                         <input name="password" id="Password" class="uk-input" type="password" placeholder="Password">
                         <p class="uk-margin-right">Confirm Password:</p>
                         <input class="uk-input" id="ConfirmPassword" type="password" placeholder="Confirm Password" onchange="checkPasswordMatch();">
                    </div>
                    <div id="infoBox" class="hidden smooth infoBox" uk-alert>
                        <p id="CheckPasswordMatch"></p>
                    </div>
                    <hr>
                    <p>Set Your Rank:</p>
                    <div class="uk-margin">
                        <select class="uk-select">
                            <option value="ur">Unranked</option>
                            <option value="c4">Copper IV</option>
                            <option value="c3">Copper III</option>
                            <option value="c2">Copper II</option>
                            <option value="c1">Copper I</option>
                            <option value="b4">Bronze IV</option>
                            <option value="b3">Bronze III</option>
                            <option value="b2">Bronze II</option>
                            <option value="b1">Bronze I</option>
                            <option value="s4">Silver IV</option>
                            <option value="s3">Silver III</option>
                            <option value="s2">Silver II</option>
                            <option value="s1">Silver I</option>
                            <option value="g4">Gold IV</option>
                            <option value="g3">Gold III</option>
                            <option value="g2">Gold II</option>
                            <option value="g1">Gold I</option>
                            <option value="p3">Platinum III</option>
                            <option value="p2">Platinum II</option>
                            <option value="p1">Platinum I</option>
                            <option value="d">Daimond</option>
                        </select>
                    </div>
                    <hr>
                    <div class="uk-margin">
                        <?php

                            echo
                            '
                                <input name="quote" class="uk-input" type="text" placeholder="User Quote" value="'.$quotetext.'">
                                </div>
                                <legend class="uk-legend">Bio:</legend>
                                <div class="uk-margin">
                                <textarea name="bio" class="uk-textarea" rows="5" placeholder="User Bio">'.$biotext.'</textarea>
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
