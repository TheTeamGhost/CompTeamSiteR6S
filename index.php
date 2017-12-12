<?php
    session_start();
    require 'inc/steamauth/steamauth.php';
    require 'inc/db_connect.php';
    require 'inc/signout_handler.php';
    require 'inc/login_check.php';
    include 'inc/profile_handler.php';
    include 'inc/getnews.php';
?>
<!DOCTYPE html>
<html class="bg-grey">
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
                    <li class="navbar-li"><a class="anchor nav-items" href="index.php">Home</a></li>
                    <li class="navbar-li"><a class="anchor nav-items" href="index.php#team">The Team</a></li>
                    <li class="navbar-li"><a class="anchor nav-items" href="#" uk-toggle="target: #latest-news">News</a></li>
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
                                <li class="navbar-li"><a class="anchor nav-items" href="#" uk-toggle="target: #userinterface">'.$username_session.'</a></li>
                                <div id="userinterface" uk-offcanvas="overlay: true; flip: true;">
                                    <div class="uk-offcanvas-bar">
                                        <div class="uk-card-badge uk-label">'.$username_session.'</div>
                                        <li class="user-li"><a class="anchor user-nav-items" href="profile.php?profile='.$userid.'">Profile</a></li>
                                        <li class="user-li"><a class="anchor user-nav-items" href="settings.php?profile='.$userid.'">Settings</a></li>
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
                                        <li class="user-li"><a class="anchor user-nav-items" href="settings.php?profile='.$userid.'">Settings</a></li>
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
                            echo '<li class="navbar-li"><a class="anchor nav-items" href="login.php">Login</a></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>
        <img class="banner loading" src="img/banner_header.png" alt="banner image">
        <section id="team" class="first-section">
            <ul class="uk-flex-center" uk-tab="animation: uk-animation-slide-left, uk-animation-slide-right">
                <?php
                    $fetch_username = $conn->query('SELECT username FROM users WHERE active="1"');
                    while ($parsed_username =  $fetch_username->fetch_assoc()) {
                        echo '<li><a class="anchor first-section-font" href="#">'.$parsed_username['username'].'</a></li>';
                    }
                ?>
                <li><a class="anchor first-section-font" href="#">Become a Member</a></li>
            </ul>
            <ul class="uk-switcher uk-margin">
                <?php
                    $fetch_userinfo2 = $conn->query('SELECT * FROM users WHERE active="1"');
                    while ($parsed_userinfo2 =  $fetch_userinfo2->fetch_assoc()) {
                        $rank = $parsed_userinfo2['rank'];
                        include 'inc/ranks.php';
                        echo
                        '
                        <li>
                            <article class="uk-article">
                                <img class="uk-align-right profile-pic" src="img/profiles/yimura.jpg" alt="">
                                <h1 class="uk-article-title"><a class="anchor uk-link-reset" href="#">'.$parsed_userinfo2['username'].'</a></h1>
                                <p class="uk-text-lead">'.$parsed_userinfo2['quote'].'</p>
                                <p>'.$parsed_userinfo2['bio'].'<br></p>
                                <p>User Rank: '.$ranktext2.' </p>
                                <div class="uk-grid-small uk-child-width-auto" uk-grid>
                                    <div>
                                        <a class="anchor uk-button uk-button-text" href="profile.php?profile='.$parsed_userinfo2['id'].'">Site profile</a><!--Will be added later on -->
                                    </div>
                                    <div>
                                        <a class="anchor uk-button uk-button-text" href="http://steamcommunity.com/profiles/'.$parsed_userinfo2['steamid'].'" target="_blank">Steam profile</a>
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
                        <h1 class="uk-article-title"><a class="anchor uk-link-reset" href="login.php">Become a Member</a></h1>
                        <p class="uk-text-lead">Comming soon...</p>
                    </article>
                </li>
            </ul>
        </section>
    </body>
</html>
