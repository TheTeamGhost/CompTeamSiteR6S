<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Join the Team</title>
        <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="style/master.css">
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/css/uikit.min.css" />

        <!-- UIkit JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit-icons.min.js"></script>
    </head>
    <body>
        <nav>
            <div class="mainWrapper">
                <ul>
                    <li><a class="nav-items" href="index.php">Home</a></li>
                    <li><a class="nav-items" href="index.php#team">The Team</a></li>
                    <li><a class="nav-items" href="news.php">News</a></li>
                    <li><a class="nav-items" href="login.php">Login</a></li>
                </ul>
            </div>
        </nav>
        <img class="banner" src="img/banner_header.png" alt="banner image">
        <section>
            <ul uk-tab>
                <li><a href="#">Flop</a></li>
                <li><a href="#">Aspect</a></li>
                <li><a href="#">Random1</a></li>
            </ul>

            <ul class="uk-switcher uk-margin">
                <li>
                    <article class="uk-article">
                        <h1 class="uk-article-title"><a class="uk-link-reset" href="$userprofile">$username</a></h1>
                        <p class="uk-text-lead">$shorttext</p>
                        <p>$biotext</p>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <a class="uk-button uk-button-text" href="#">Goto profile</a>
                            </div>
                        </div>
                    </article>
                </li>
                <li>
                    <article class="uk-article">
                        <h1 class="uk-article-title"><a class="uk-link-reset" href="$userprofile">$username</a></h1>
                        <p class="uk-text-lead">$shorttext</p>
                        <p>$biotext</p>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <a class="uk-button uk-button-text" href="#">Goto profile</a>
                            </div>
                        </div>
                    </article>
                </li>
                <li>
                    <article class="uk-article">
                        <h1 class="uk-article-title"><a class="uk-link-reset" href="$userprofile">$username</a></h1>
                        <p class="uk-text-lead">$shorttext</p>
                        <p>$biotext</p>
                        <div class="uk-grid-small uk-child-width-auto" uk-grid>
                            <div>
                                <a class="uk-button uk-button-text" href="#">Goto profile</a>
                            </div>
                        </div>
                    </article>
                </li>
            </ul>
        </section>
    </body>
</html>
