<?php
    session_start();
    require 'inc/steamauth/steamauth.php';
    require 'inc/db_connect.php';
    require 'inc/signout_handler.php';
    include 'inc/profile_handler.php';
    include 'inc/getnews.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Join the Team</title>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="style/master.css">
        <script type="text/javascript" src="js/rotate-nav.js"></script>
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/css/uikit.min.css" />

        <!-- UIkit JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit-icons.min.js"></script>
        <!-- JQuery -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav>
            <div class="mainWrapper">
                <ul class="navbar-ul">
                    <li class="navbar-li"><a class="nav-items" href="index.php">Home</a></li>
                    <li class="navbar-li"><a class="nav-items" href="index.php#team">The Team</a></li>
                    <li class="navbar-li"><a class="nav-items" href="#" uk-toggle="target: #latest-news">News</a></li>
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
                            $fetchusername_cookie = $conn->query("SELECT username, user_role FROM users WHERE id='".$userid."'");
                            while ($fetched_userinfo = $fetchusername_cookie->fetch_assoc()) {
                                $username_cookie = $fetched_userinfo['username'];
                                $userrole = $fetched_userinf['user_role'];
                            }
                            echo
                            '
                                <li class="navbar-li"><a class="nav-items" href="#" uk-toggle="target: #userinterface">'.$username_cookie.'</a></li>
                                <div id="userinterface" uk-offcanvas="overlay: true; flip: true;">
                                    <div class="uk-offcanvas-bar">
                                        <div class="uk-card-badge uk-label">'.$username_cookie.'</div>
                                        <li class="user-li"><a class="user-nav-items" href="#">Profile</a></li>
                                        <li class="user-li"><a class="user-nav-items" href="#">Settings</a></li>
                            ';
                            if ($userrole = 1 || $userrole = 2 || $userrole = 3 || $userrole = 4) {
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
                            $fetchusername_session = $conn->query("SELECT username, user_role FROM users WHERE id='".$userid."'");
                            while ($fetched_userinfo = $fetchusername_session->fetch_assoc()) {
                                $username_session = $fetched_userinfo['username'];
                                $userrole = $fetched_userinf['user_role'];
                            }
                            echo
                            '
                                <li class="navbar-li"><a class="nav-items" href="#" uk-toggle="target: #userinterface">'.$username_session.'</a></li>
                                <div id="userinterface" uk-offcanvas="overlay: true; flip: true;">
                                    <div class="uk-offcanvas-bar">
                                        <div class="uk-card-badge uk-label">'.$username_session.'</div>
                                        <li class="user-li"><a class="user-nav-items" href="#">Profile</a></li>
                                        <li class="user-li"><a class="user-nav-items" href="#">Settings</a></li>
                            ';
                            if ($userrole = 1 || $userrole = 2 || $userrole = 3 || $userrole = 4) {
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
                            if ($userrole = 1 || $userrole = 2 || $userrole = 3 || $userrole = 4) {
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
                            echo '<li class="navbar-li"><a class="nav-items" href="login.php">Login</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
        <img class="banner loading" src="img/banner_header.png" alt="banner image">
        <section id="team" class="first-section">
            <ul uk-tab="animation: uk-animation-slide-left, uk-animation-slide-right">
                <?php
                    $fetch_username = $conn->query('SELECT username FROM users WHERE active="1"');
                    while ($parsed_username =  $fetch_username->fetch_assoc()) {
                        echo '<li class="active-black"><a class="first-section-font" href="#">'.$parsed_username['username'].'</a></li>';
                    }
                ?>
                <li><a class="first-section-font" href="#">Become a Member</a></li>
            </ul>

            <ul class="uk-switcher uk-margin">
                <?php
                    $fetch_userinfo2 = $conn->query('SELECT username, quote, bio, steamid, profile_img FROM users WHERE active="1"');
                    while ($parsed_userinfo2 =  $fetch_userinfo2->fetch_assoc()) {
                        echo
                        '
                        <li>
                            <article class="uk-article">
                                <img class="uk-align-right profile-pic" src="img/profiles/'.$parsed_userinfo2['profile_img'].'" alt="">
                                <h1 class="uk-article-title"><a class="uk-link-reset" href="#">'.$parsed_userinfo2['username'].'</a></h1>
                                <p class="uk-text-lead">'.$parsed_userinfo2['quote'].'</p>
                                <p>'.$parsed_userinfo2['bio'].'</p>
                                <div class="uk-grid-small uk-child-width-auto" uk-grid>
                                    <div>
                                        <a class="uk-button uk-button-text" href="index.php">Site profile (in the works)</a><!--Will be added later on -->
                                    </div>
                                </div>
                                <div class="uk-grid-small uk-child-width-auto" uk-grid>
                                    <div>
                                        <a class="uk-button uk-button-text" href="http://steamcommunity.com/profiles/'.$parsed_userinfo2['steamid'].'" target="_blank">Steam profile</a>
                                    </div>
                                </div>
                            </article>
                        </li>
                        ';
                    }
                ?>
                <li>
                    <article class="uk-article">
                        <img class="uk-align-right profile-pic" src="img/profiles/$user_profile_pic" alt="">
                        <h1 class="uk-article-title"><a class="uk-link-reset" href="login.php">Become a Member</a></h1>
                        <p class="uk-text-lead">Comming soon...</p>
                    </article>
                </li>
            </ul>
        </section>
    </body>
</html>
