<?php
    require 'inc/steamauth/steamauth.php';
    require 'inc/db_connect.php';
?>
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
                    <li>
                        <?php
                            // define variables and set to empty values
                            $usernameErr = $passwordErr ="";
                            $name = $password = "";

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (empty($_POST["username"])) {
                                    $usernameErr = "Please fill in a username!<br>";
                                } else {
                                    $name = url_input($_POST["username"]);
                                }

                                if (empty($_POST["email"])) {
                                    $passwordErr = "Please fill in a password!<br>";
                                } else {
                                    $password = url_input($_POST["password"]);
                                }
                            }

                            function url_input($data) {
                              $data = trim($data);
                              $data = stripslashes($data);
                              $data = htmlspecialchars($data);
                              return $data;
                            }
                        ?>
                         <h3 class="uk-accordion-title">Login</h3>
                         <div class="uk-accordion-content">
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                   <div class="uk-margin">
                                        <div class="uk-inline">
                                             <span class="uk-form-icon" uk-icon="icon: user"></span>
                                             <input name="username" class="uk-input" type="text" value="<?php echo $name; ?>">
                                        </div>
                                   </div>
                                   <div class="uk-margin">
                                        <div class="uk-inline">
                                             <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon: lock"></span>
                                             <input name="password" class="uk-input" type="password">
                                        </div>
                                   </div>
                                   <?php
                                       if (!empty($usernameErr) || !empty($passwordErr)) {
                                           echo
                                           '
                                               <div class="smooth infoBox uk-alert-danger" uk-alert>
                                                   <p>';
                                           echo $usernameErr, $passwordErr;
                                           echo
                                           '
                                                   </p>
                                               </div>
                                           ';
                                       }
                                   ?>
                                   <div class="uk-margin">
                                        <label><input name="rememberMe" class="uk-checkbox" type="checkbox" value="true"> Remember Me</label>
                                   </div>
                                   <button type="submit" class="uk-button uk-button-text scale"> Submit </button>
                              </form>
                         </div>
                    </li>
                    <li>
                        <?php
                            // define variables and set to empty values
                            $nameErr = $emailErr ="";
                            $username = $email = "";

                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                if (empty($_POST["username_register"])) {
                                    $nameErr = "UserName is required!<br>";
                                } else {
                                    $username = url_input($_POST["username_register"]);
                                    $unamecheck = True;
                                }

                                if (empty($_POST["email"])) {
                                    $emailErr = "Email is required!<br>";
                                } else {
                                    $email = url_input($_POST["email"]);
                                    $emailSuc = True;
                                }

                                if (empty($_POST["passregister"])) {
                                    $passErr = "Password is required!<br>";
                                } else {
                                    $pass = url_input($_POST["passregister"]);
                                    $passSuc = True;
                                }
                            }

                            if ($passSuc && $emailSuc && $unamecheck) {
                                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                                $createuser = "INSERT INTO users (username, password, email) VALUES ('$username', '$hashed_pass', '".mysqli_real_escape_string($conn, $email)."')";
                                $conn->query($createuser) or die($conn->error);
                                echo "User created";
                            }
                            else {
                                echo "Failed to create user";
                                echo "p", $passSuc, "e", $emailSuc, "u", $unamecheck;
                                echo "<br>",$pass;
                            }
                        ?>
                         <h3 class="uk-accordion-title">Sign Up</h3>
                         <div class="uk-accordion-content">
                              <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                                   <fieldset class="uk-fieldset">
                                        <div class="uk-margin">
                                             <input name="username_register" class="uk-input" type="text" placeholder="Username" value="<?php echo $username; ?>">
                                        </div>
                                        <div class="uk-margin-medium">
                                             <input name="email" class="uk-input" type="email" placeholder="e-mail" value="<?php echo $email; ?>">
                                        </div>
                                        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
                                             <p class="uk-margin-right">Password:</p>
                                             <input name="passregister" id="Password" class="uk-input" type="password" placeholder="Password">
                                             <p class="uk-margin-right">Confirm Password:</p>
                                             <input class="uk-input" id="ConfirmPassword" type="password" placeholder="Confirm Password" onchange="checkPasswordMatch();">
                                        </div>
                                        <div id="infoBox" class="hidden smooth infoBox" uk-alert>
                                            <p id="CheckPasswordMatch"></p>
                                        </div>
                                        <?php
                                            if (!empty($nameErr) || !empty($emailErr) || !empty($passErr)) {
                                                echo
                                                '
                                                    <div class="smooth infoBox uk-alert-danger" uk-alert>
                                                        <p>';
                                                echo $nameErr, $emailErr, $passErr;
                                                echo
                                                '
                                                        </p>
                                                    </div>
                                                ';
                                            }
                                        ?>
                                        <button type="submit" class="uk-button uk-button-text scale"> Submit </button>
                                   </fieldset>
                              </form>
                         </div>
                    </li>
                    <li>
                         <h3 class="uk-accordion-title">Steam Login</h3>
                         <div class="uk-accordion-content">
                              <a href="?login">Click here</a>
                         </div>
                    </li>
               </ul>
          </section>
     </body>
</html>
