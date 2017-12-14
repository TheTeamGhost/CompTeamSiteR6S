<?php
    session_start();
    require 'inc/steamauth/steamauth.php';
    require 'inc/db_connect.php';
    require 'inc/signout_handler.php';
    require 'inc/login_check.php';

    $userid = $_GET['profile'];
    $fetch_userprofile = $conn->query("SELECT * FROM users WHERE id='".$userid."'");
    while ($fetched_userprofile = $fetch_userprofile->fetch_assoc()) {
        $username = $fetched_userprofile['username'];
        $userquote = $fetched_userprofile['quote'];
        $userbio = $fetched_userprofile['bio'];
        $steamid = $fetched_userprofile['steamid'];
        $userimg = $fetched_userprofile['profile_img'];
        $rank = $fetched_userprofile['rank'];
        $rank_verified = $fetched_userprofile['rank_verified'];
    }

    include 'inc/formatter.php';
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
                <div>
                    <div uk-grid>
                        <div class="uk-width-auto@m uk-flex-last@m">
                            <ul class="uk-tab-right" uk-tab="connect: #component-tab-right; animation: uk-animation-fade">
                                <li><a href="#">Userprofile</a></li>
                                <li><a href="#">Steam</a></li>
                                <li><a href="#" disabled>Uplay Stats</a></li>
                            </ul>
                        </div>
                        <div class="uk-width-expand@m">
                            <ul id="component-tab-right" class="uk-switcher">
                                <li>
                                    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                                        <div class="uk-width-auto">
                                            <?php
                                                    echo '<img class="smooth uk-comment-avatar" src="'.$userimg.'"  width="120" height="120" alt="">';
                                            ?>
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
                                </li>
                                <?php
                                    $json = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key='.$api_key.'&steamids='.$steamid.'');
                                    $steamAccountData = json_decode($json, true);
                                    $personaname = $steamAccountData['response']['players'][0]['personaname'];
                                    $online = $steamAccountData['response']['players'][0]['personastate'];
                                    $profile = $steamAccountData['response']['players'][0]['avatarfull'];
                                    $serverip = $steamAccountData['response']['players'][0]['gameserverip'];
                                    $gameinfo = $steamAccountData['response']['players'][0]['gameextrainfo'];
                                ?>
                                <li>
                                    <header class="uk-comment-header uk-grid-medium uk-flex-middle" uk-grid>
                                        <div class="uk-width-auto">
                                            <?php
                                                    echo '<img class="smooth uk-comment-avatar" src="'.$profile.'"  width="120" height="120" alt="">';
                                            ?>
                                        </div>
                                        <div class="uk-width-expand">
                                            <h4 class="uk-comment-title uk-margin-remove"><a class="uk-link-reset" href="#"><?php print_r($personaname); ?></a></h4>
                                            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                                <li>
                                                    <?php
                                                    switch ($online) {
                                                        case '0':
                                                            echo 'Offline';
                                                            break;
                                                        case '1':
                                                            echo 'Online';
                                                            break;
                                                        case '2':
                                                            echo 'Busy';
                                                            break;
                                                        case '3':
                                                            echo 'Away';
                                                            break;
                                                        case '4':
                                                            echo 'Snooze';
                                                            break;
                                                        case '5':
                                                            echo 'Looking to Trade';
                                                            break;
                                                        case '6':
                                                            echo 'Looking to Play';
                                                            break;
                                                    }
                                                    ?>
                                                </li>
                                            </ul>
                                            <ul class="uk-comment-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                                                <li>
                                                    <?php
                                                        if (empty($gameinfo)) {
                                                            echo "Player not Playing Currently";
                                                        }
                                                        else {
                                                            echo "In-Game: ", $gameinfo;
                                                        }
                                                    ?>
                                                </li>
                                                <li>
                                                    <?php
                                                        if ($serverip !== "0.0.0.0") {
                                                            echo "Player is not in joinable session.";
                                                        }
                                                        else {
                                                            echo $onlinestate, '</li><li>', '<a href="steam://connect/'.$serverip.'">Join Game</a>';
                                                        }
                                                    ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </header>
                                    <div class="uk-comment-body">
                                        <p><?php echo "(For Later)"; ?></p>
                                    </div>
                                </li>
                                <li>
                                    Uplay Profile
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="uk-child-width-expand@l uk-text-center" uk-grid-parallax>
                    <div>
                        <div class="card-top uk-card uk-card-default uk-grid-margin">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <div class="uk-width-expand">
                                        <h3 class="uk-card-title uk-margin-remove-bottom">Rank</h3>
                                        <p class="uk-text-meta uk-margin-remove-top" title="This way you know if the rank is verified in-game by Admins" uk-tooltip>Rank verified:
                                            <?php
                                                if ($rank_verified == "1") {
                                                    echo
                                                    '
                                                        <span class="verify-green" uk-icon="icon: check"></span>
                                                    ';
                                                }
                                                elseif ($rank_verified == "0") {
                                                    echo
                                                    '
                                                        <span class="verify-red" uk-icon="icon: close"></span>
                                                    ';
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body uk-card-body">
                                <?php
                                echo
                                '
                                    <img class="smooth" src="img/ranks/'.$rank.'.png" alt="">
                                ';
                                ?>
                            </div>
                            <div class="card-footer uk-card-footer">
                                <a class="uk-button uk-button-text"><?php echo $ranktext; ?></a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="card-top uk-card uk-card-default uk-grid-margin">
                            <div class="uk-card-header">
                                <div class="uk-grid-small uk-flex-middle" uk-grid>
                                    <div class="uk-width-expand">
                                        <h3 class="uk-card-title uk-margin-remove-bottom">Reputation</h3>
                                        <p class="uk-text-meta uk-margin-remove-top">Steam Linked:
                                            <?php
                                                if (empty($steamid)) {
                                                    echo
                                                    '
                                                        <span class="verify-red" uk-icon="icon: close"></span>
                                                    ';
                                                }
                                                else {
                                                    echo
                                                    '
                                                        <span class="verify-green" uk-icon="icon: check"></span>
                                                    ';
                                                }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body uk-card-body">
                                <?php
                                    if (!empty($steamid)) {
                                        echo '<p>Steam Account Rep:<br>';
                                        $json = file_get_contents('http://api.steampowered.com/ISteamUser/GetPlayerBans/v1/?key='.$api_key.'&steamids='.$steamid.'');
                                        $steamBanData = json_decode($json, true);
                                        $commBan = $steamBanData['players'][0]["CommunityBanned"];
                                        $VACBanned = $steamBanData['players'][0]["VACBanned"];
                                        $countVACs = $steamBanData['players'][0]["NumberOfVACBans"];
                                        $countBans = $steamBanData['players'][0]["NumberOfGameBans"];
                                        $economyBan = $steamBanData['players'][0]["EconomyBan"];
                                        if ($commBan == "true") {
                                            echo '<p>Community Ban: <span class="verify-red" uk-icon="icon: close"></span></p>';
                                            $trust = 1;
                                        }
                                        else {
                                            echo '<p>Community Ban: <span class="verify-green" uk-icon="icon: check"></span></p>';
                                        }
                                        if ($VACBanned == "true") {
                                            echo '<p>VAC Banned: <span class="verify-red" uk-icon="icon: close"></span></p>';
                                            $trust2 = 1;
                                        }
                                        else {
                                            echo '<p>VAC Banned: <span class="verify-green" uk-icon="icon: check"></span></p>';
                                        }
                                        if ($economyBan == "none") {
                                            echo '<p>Trade Banned: <span class="verify-green" uk-icon="icon: check"></span></p>';
                                        }
                                        else {
                                            echo '<p>Trade Banned: <span class="verify-red" uk-icon="icon: close"></span></p>';
                                            $trust3 = 1;
                                        }

                                        $trust_result = 3 - $trust - $trust2 - $trust3;
                                        $ban_count = 11 - $countBans - $countVACs;

                                        if ($ban_count < 0) {
                                            $trust_percentage = ((0 / 11 * 100) + ($trust_result / 3 * 100)) / 2;
                                        }
                                        else {
                                            $trust_percentage = (($ban_count / 11 * 100) + ($trust_result / 3 * 100)) / 2;
                                        }
                                    }
                                    else {
                                        echo '<span class="verify-red" uk-icon="icon: close"></span><p>Steam Account not linked.<br>Cannot verify!</p>';
                                        $trust_percentage = "";
                                    }
                                ?>
                                </p>
                            </div>
                            <div class="card-footer uk-card-footer">
                                <a class="uk-button uk-button-text">
                                <?php
                                if (empty($trust_percentage)) {
                                    echo 'Unable to verify Steam Account: <span class="verify-red" uk-icon="icon: close"></span>';
                                }
                                else {
                                    echo "", round($trust_percentage, 2), "%";
                                }
                                ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </body>
</html>
