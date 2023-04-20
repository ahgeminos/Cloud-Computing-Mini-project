<?php
require "config.php"; 
$error = '';
$error1 = '';
if (isset($_POST['reset'])) {
    $pass = $_POST['password'];
    $pass1 = $_POST['password1'];
    if ((!empty($pass))) {
        if (!empty($pass1)) {
if($pass==$pass1){
    $email=$_GET['email'];
    //print($email);
   mysqli_query($conn, "UPDATE `user` SET `password`='".$pass1."' WHERE email_id='".$email."';");
   echo '<script> window.alert("Password Reset Successfully!");window.location.href="Login.php";</script>';

}else{
    $error1 = '<i class="error error-icon icon-exclamation-circle"></i>Incorrect Password';
}        
} else {
            $error1 = '<i class="error error-icon icon-exclamation-circle"></i>Enter password';
        }
    } else {
        $error = '<i class="error error-icon icon-exclamation-circle"></i>Enter password';
    }
}


?>
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
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            <h1><b>Reset Password</b></h1>
        </div>
        <form action='' method="POST">
            <div class="container-fluid">
                <div class="row">
                    <p>Enter Your New Password
                    </p>
                </div>
                <div class="sg-content-box">
                    <input placeholder="New Password" name="password" type="password" class="sg-input">
                    <br>
                    <div class="sg-text error">
                        <?php echo $error ?>
                    </div>
                    <input placeholder="Confirm Password" name="password1" type="password" class="sg-input">
                    <div class="sg-text error">
                        <?php echo $error1 ?>
                    </div>
                    <button class="sg-button" name='reset' value="reset">
                        <span class="sg-button__text">Reset Password</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</body>

</html>