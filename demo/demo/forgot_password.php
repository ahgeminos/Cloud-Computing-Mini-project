<?php require "config.php";        ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/forgot_password.css">
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://file.myfontastic.com/YiBddkXWfe3mydtbcoTSGn/icons.css">
    <link href="https://file.myfontastic.com/YiBddkXWfe3mydtbcoTSGn/icons.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>

    <div class="header">
        <img class="logo" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/logo.jpeg">
        </input>
    </div>
    <div class="container1">
        <div class="Forgot-password">
            <h1><b>Forgot your Password?</b></h1>
        </div>
        <div class="container-fluid">
            <div class="row">
                <p>No worries, we've got your back. Tell us where we should send link to reset password.
                </p>
            </div>
            <div>
                <form action="" method="POST">
                    <?php

                    $error = "";

                    if (isset($_POST['btn_submit'])) {
                        if (!empty($_POST["email"])) {
                            $error = "";
                            $email = $_POST["email"];
                            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
                            if (!$email) {
                                $error .= '<i class="error error-icon icon-exclamation-circle"></i>Invalid email address please type a valid email address!';
                            } else {
                                $sel_query = "SELECT * FROM `user` WHERE email_id='" . $email . "'";
                                $results = mysqli_query($conn, $sel_query);
                                if ($results->num_rows == 1) {


                                    $expFormat = mktime(
                                        date("H"),
                                        date("i"),
                                        date("s"),
                                        date("m"),
                                        date("d") + 1,
                                        date("Y")
                                    );
                                    $expDate = date("Y-m-d H:i:s", $expFormat);
                                    $key = 2418 * 2 + intval($email);
                                    $addKey = substr(md5(uniqid(rand(), 1)), 3, 10);
                                    $key = $key . $addKey;
                                    // Insert Temp Table
                                    mysqli_query($conn, "INSERT INTO `password_reset_temp` (`email`, `onetimekey`, `expDate`) VALUES ('" . $email . "', '" . $key . "', '" . $expDate . "');");
                                    $output = '<p>Dear user,</p>';
                                    $output .= '<p>Please click on the following link to reset your password.</p>';
                                    $output .= '<p>-------------------------------------------------------------</p>';
                                    $output .= '<p><a href="http://localhost/canteenfoodordering/set_password.php?
key=' . $key . '&email=' . $email . '&action=reset" target="_blank">
http://localhost/canteenfoodordering/set_password.php
?key=' . $key . '&email=' . $email . '&action=reset</a></p>';
                                    $output .= '<p>-------------------------------------------------------------</p>';
                                    $output .= '<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
                                    $output .= '<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';
                                    $output .= '<p>Thanks,</p>';
                                    $output .= '<p>AllPHPTricks Team</p>';
                                    $body = $output;
                                    $subject = "Password Recovery - AllPHPTricks.com";
                                    $receiver = $email;
                                    $sender = "From:20102164.meghasoni@gmail.com";
                                    $sender .= "MIME-Version: 1.0\r\n";
                                    $sender .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

                                    if (mail($receiver, $subject, $body, $sender)) {
                                        echo "Email sent successfully to $receiver";
                                        echo '<script> window.alert("Email has been sent");window.location.href="Login.php";</script>';
                                    } else {
                                        echo "Sorry, failed while sending mail!";
                                    }
                                } else {
                                    $error .= '<i class="error error-icon icon-exclamation-circle"></i>No user is registered with this email address!';
                                }
                            }
                        } else {
                            $error = '<i class="error error-icon icon-exclamation-circle"></i>Email is required';
                        }
                    }

                    ?>
                    <div class="sg-content-box">
                        <div id='email_input'>
                            <input placeholder="Enter Your Email" name="email" type="email" class="sg-input">
                            <div name=error><?php print($error); ?></div>
                            <br>
                            <button value='btn_submit' name='btn_submit' class="sg-button">
                                I forgot my password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="sg-text">or go back to
                <label class="sg-text=label">
                    <span id="gf0vvq" aria-hidden="true"><a href="Login.php">login page</a></span>
                </label>
            </div>

        </div>
    </div>
</body>

</html>