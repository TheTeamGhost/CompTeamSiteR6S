<?php
    session_start();
    require 'inc/steamauth/steamauth.php';
    require 'inc/db_connect.php';
    require 'inc/signout_handler.php';

    $userid = $_GET['profile'];
    $fetch_userprofile = $conn->query("SELECT * FROM users WHERE id='".$userid."'");
    while ($fetched_userprofile = $fetch_userprofile->fetch_assoc()) {
        $username = $fetched_userprofile['username'];
        $userquote = $fetched_userprofile['quote'];
        $userbio = $fetched_userprofile['bio'];
        $steamid = $fetched_userprofile['steamid'];
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Profile from <?php echo $username; ?></title>
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
    </head>
    <body background="img/bg-profile.webm">
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
                            if (isset($_COOKIE['userid'])) {
                                $userid = $_COOKIE['userid'];
                                $fetchusername_cookie = $conn->query("SELECT id ,username, user_role FROM users WHERE id='".$userid."'");
                                while ($fetched_userinfo = $fetchusername_cookie->fetch_assoc()) {
                                    $username_cookie = $fetched_userinfo['username'];
                                    $userrole = $fetched_userinfo['user_role'];
                                    $userid = $fetched_userinfo['id'];
                                }
                                echo
                                '
                                    <li><a class="anchor" href="#" uk-toggle="target: #userinterface">'.$username_cookie.'</a></li>
                                    <div id="userinterface" uk-offcanvas="overlay: true; flip: true;">
                                        <div class="uk-offcanvas-bar">
                                            <div class="uk-card-badge uk-label">'.$username_cookie.'</div>
                                            <li class="user-li"><a class="user-nav-items" href="profile.php?profile='.$userid.'">Profile</a></li>
                                            <li class="user-li"><a class="user-nav-items" href="#">Settings</a></li>
                                ';
                                if ($userrole == "1" || $userrole == "2" || $userrole == "3" || $userrole == "4") {
                                    echo '<li class="user-li"><a class="user-nav-items" href="#">Admin Control Panel</a></li>';
                                }
                                echo
                                '
                                            <li class="user-li"><a class="user-nav-items" href="?clogout">Logout</a></li>
                                        </div>
                                    </div>
                                ';
                            }
                            elseif (isset($_SESSION['id'])) {
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
                                            <li class="user-li"><a class="user-nav-items" href="#">Settings</a></li>
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
                            elseif (isset($steamprofile['steamid'])) {
                                $id = $steamprofile['steamid'];
                                $fetchusername_session_steam = $conn->query("SELECT username FROM users WHERE steamid='".$id."'");
                                echo
                                '
                                    <li class="navbar-li">
                                        <a class="nav-items" href="#">Welcome back '.$fetchusername_session_steam['username'].' (Signed in through SESSION Steam)</a>
                                        <div class="uk-navbar-dropdown">
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li><a href="#">Profile</a></li>
                                                <li><a href="#">Settings</a></li>
                                ';
                                if ($userrole == "1" || $userrole == "2" || $userrole == "3" || $userrole == "4") {
                                    echo '<li><a href="#">Admin Control Panel</a></li>';
                                }
                                echo
                                '
                                                <li><a href="?logout">Logout</a></li>
                                            </ul>
                                        </div>
                                    </li>
                                ';
                            }
                            else {
                                echo '<li class="profile_navbar-li"><a class="anchor profile_nav-items" href="login.php">Login</a></li>';
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
            <article class="profile-article uk-comment">
                <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                    <div class="uk-width-auto">
                        <img class="smooth uk-comment-avatar" src="img/profiles/yimura.jpg" width="120" height="120" alt="">
                    </div>
                    <div class="uk-width-expand">
                        <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#"><?php echo $username; ?></a></h4>
                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li><?php echo $userquote; ?></li>
                        </ul>
                        <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li><?php echo '<a href="https://steamcommunity.com/profiles/'.$steamid.'" target="_blank">', "Steam", $usersteamname; ?></a></li>
                            <li><?php echo "Uplay: (Comming Soon)"; ?></li>
                        </ul>
                    </div>
                </header>
                <div class="uk-comment-body">
                    <p><?php echo $userbio; ?></p>
                </div>
            </article>
        </section>
    </body>
</html>
