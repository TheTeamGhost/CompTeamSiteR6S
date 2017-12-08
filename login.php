<!DOCTYPE html>
<html>
     <head>
          <meta charset="utf-8">
          <meta charset="utf-8">
          <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
          <title>Login</title>
          <link rel="stylesheet" href="css/master.css">
          <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
          <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
          <!-- UIkit CSS -->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/css/uikit.min.css" />

          <!-- UIkit JS -->
          <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.0-beta.35/js/uikit-icons.min.js"></script>
     </head>
     <body>
          <section class="mid">
               <ul uk-accordion>
                    <li class="uk-open">
                         <h3 class="uk-accordion-title">Login</h3>
                         <div class="uk-accordion-content">
                              <form>
                                   <div class="uk-margin">
                                        <div class="uk-inline">
                                             <span class="uk-form-icon" uk-icon="icon: user"></span>
                                             <input class="uk-input" type="text">
                                        </div>
                                   </div>
                                   <div class="uk-margin">
                                        <div class="uk-inline">
                                             <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                             <input class="uk-input" type="password">
                                        </div>
                                   </div>
                                   <div class="uk-margin">
                                        <label><input class="uk-checkbox" type="checkbox"> Remember Me</label>
                                   </div>
                              </form>
                         </div>
                    </li>
                    <li>
                         <h3 class="uk-accordion-title">Sign Up</h3>
                         <div class="uk-accordion-content">
                              <form>
                                   <fieldset class="uk-fieldset">
                                        <div class="uk-margin">
                                             <input class="uk-input" required="required" type="text" placeholder="Username">
                                        </div>
                                        <div class="uk-margin-medium">
                                             <input class="uk-input" required="required" type="text" placeholder="e-mail">
                                        </div>
                                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                             <p class="uk-margin-right">Password:</p>
                                             <input id="password" class="uk-input" required="required" type="password" placeholder="Password">
                                             <p class="uk-margin-right">Confirm Password:</p>
                                             <input class="uk-input" required="required" type="password" placeholder="Confirm Password" oninput="check(this)">
                                        </div>
                                        <script language='javascript' type='text/javascript'>
                                            function check(input) {
                                                if (input.value != document.getElementById('password').value) {
                                                    input.setCustomValidity('Password does not match!');
                                                } else {
                                                    // input is valid -- reset the error message
                                                    input.setCustomValidity('');
                                                }
                                            }
                                        </script>
                                        <button type="button" name="submit" class="uk-button uk-button-text scale"> Submit </button>
                                   </fieldset>
                              </form>
                         </div>
                    </li>
               </ul>
          </section>
     </body>
</html>
