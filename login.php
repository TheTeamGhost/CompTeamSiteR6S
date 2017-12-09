<!DOCTYPE html>
<html>
     <head>
          <meta charset="utf-8">
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>Login</title>
          <link rel="stylesheet" href="style/master.css">
          <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
          <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
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
          <section class="mid-section">
               <ul uk-accordion>
                    <li class="uk-open">
                         <h3 class="uk-accordion-title">Login</h3>
                         <div class="uk-accordion-content">
                              <form action="inc/login/login.php" method="get">
                                   <div class="uk-margin">
                                        <div class="uk-inline">
                                             <span class="uk-form-icon" uk-icon="icon: user"></span>
                                             <input name="username" class="uk-input" type="text">
                                        </div>
                                   </div>
                                   <div class="uk-margin">
                                        <div class="uk-inline">
                                             <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                             <input name="password" class="uk-input" type="password">
                                        </div>
                                   </div>
                                   <div class="uk-margin">
                                        <label><input name="rememberMe" class="uk-checkbox" type="checkbox" value="true"> Remember Me</label>
                                   </div>
                                   <button type="submit" class="uk-button uk-button-text scale"> Submit </button>
                              </form>
                         </div>
                    </li>
                    <li>
                         <h3 class="uk-accordion-title">Sign Up</h3>
                         <div class="uk-accordion-content">
                              <form action="inc/login/register.php" method="get">
                                   <fieldset class="uk-fieldset">
                                        <div class="uk-margin">
                                             <input name="username" class="uk-input" required="required" type="text" placeholder="Username">
                                        </div>
                                        <div class="uk-margin-medium">
                                             <input name="email" class="uk-input" required="required" type="text" placeholder="e-mail">
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
                                        <button type="submit" class="uk-button uk-button-text scale"> Submit </button>
                                   </fieldset>
                              </form>
                         </div>
                    </li>
               </ul>
          </section>
     </body>
</html>
