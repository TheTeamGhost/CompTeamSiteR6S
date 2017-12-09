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
                    <li class="navbar-li"><a class="nav-items" href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
        <img class="banner loading" src="img/banner_header.png" alt="banner image">
        <section id="team" class="first-section">
            <ul uk-tab>
                <li><a class="first-section-font" href="#">Flop</a></li>
                <li><a class="first-section-font" href="#">Aspect</a></li>
                <li><a class="first-section-font" href="#">$user_name</a></li>
            </ul>

            <ul class="uk-switcher uk-margin">
                <li>
                    <article class="uk-article">
                        <img class="uk-align-right profile-pic" src="img/profiles/flop_steam.jpg" alt="">
                        <h1 class="uk-article-title"><a class="uk-link-reset" href="$userprofile">Flop</a></h1>
                        <p class="uk-text-lead">Everybody do the Flop</p>
                        <p>My name is Liam, Also known as Flop</p>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <a class="uk-button uk-button-text" href="#">Site profile</a>
                            </div>
                        </div>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <a class="uk-button uk-button-text" href="http://steamcommunity.com/profiles/76561198296219146" target="_blank">Steam profile</a>
                                <!--get steam link with php, http://steamcommunity.com/profiles/$steamid  $steamid staat in database -->
                            </div>
                        </div>
                    </article>
                </li>
                <li>
                    <article class="uk-article">
                        <img class="uk-align-right profile-pic" src="img/profiles/dummy-profile.png" alt="">
                        <h1 class="uk-article-title"><a class="uk-link-reset" href="$userprofile">$username</a></h1>
                        <p class="uk-text-lead">$shorttext</p>
                        <p>$biotext</p>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <a class="uk-button uk-button-text" href="#">Site profile</a>
                            </div>
                        </div>
                    </article>
                </li>
                <li>
                    <article class="uk-article">
                        <img class="uk-align-right profile-pic" src="img/profiles/$user_profile_pic" alt="">
                        <h1 class="uk-article-title"><a class="uk-link-reset" href="$userprofile">$user_name</a></h1>
                        <p class="uk-text-lead">$quote</p>
                        <p>$bio</p>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <a class="uk-button uk-button-text" href="#">Site profile (in the works)</a><!--Will be added later on -->
                            </div>
                        </div>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <a class="uk-button uk-button-text" href="http://steamcommunity.com/profiles/$steamid" target="_blank">Steam profile</a>
                                <!--get steam link with php, http://steamcommunity.com/profiles/$steamid  $steamid staat in database -->
                            </div>
                        </div>
                    </article>
                </li>
            </ul>
        </section>
    </body>
</html>
