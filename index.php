<?php
    require 'inc/db_connect.php';
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
    </head>
    <body>
        <nav class="navbar">
            <div class="mainWrapper">
                <ul class="navbar-ul">
                    <li class="navbar-li"><a class="nav-items" href="index.php">Home</a></li>
                    <li class="navbar-li"><a class="nav-items" href="index.php#team">The Team</a></li>
                    <li class="navbar-li"><a class="nav-items" href="#" uk-toggle="target: #latest-news">News</a></li>
                    <div id="latest-news" uk-offcanvas="mode: push; overlay: true">
                        <div class="uk-offcanvas-bar">
                            <button class="uk-offcanvas-close" type="button" uk-close></button>
                            <h3>$news_title</h3>
                            <p>$news_text</p>
                            <div class="uk-card-badge uk-label">$news_date</div>
                        </div>
                    </div>
                    <?php
                        if (isset($userid)) {
                            echo
                            '

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
            <ul uk-tab>
                <?php
                    if ($active_user = 1) {
                        echo '<li><a class="first-section-font" href="#">'.$username.'</a></li>';
                    }
                ?>
                <li><a class="first-section-font" href="#">Become a Member</a></li>
            </ul>

            <ul class="uk-switcher uk-margin">
                <?php
                    if ($user_active = 1) {
                        echo
                        '
                        <li>
                            <article class="uk-article">
                                <img class="uk-align-right profile-pic" src="img/profiles/'.$profile_img.'" alt="">
                                <h1 class="uk-article-title"><a class="uk-link-reset" href="#">'.$username.'</a></h1>
                                <p class="uk-text-lead">'.$quote.'</p>
                                <p>'.$bio.'</p>
                                <div class="uk-grid-small uk-child-width-auto" uk-grid>
                                    <div>
                                        <a class="uk-button uk-button-text" href="index.php">Site profile (in the works)</a><!--Will be added later on -->
                                    </div>
                                </div>
                                <div class="uk-grid-small uk-child-width-auto" uk-grid>
                                    <div>
                                        <a class="uk-button uk-button-text" href="http://steamcommunity.com/profiles/'.$steamid.'" target="_blank">Steam profile</a>
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
                        <h1 class="uk-article-title"><a class="uk-link-reset" href="$userprofile">Become a Member</a></h1>
                        <p class="uk-text-lead">Comming soon...</p>
                    </article>
                </li>
            </ul>
        </section>
    </body>
</html>
