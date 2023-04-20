<?php
require 'config.php';
session_start();

$erroremail = $errorpassword = $errormess = '';
$uname = $pass = " ";
if (isset($_POST['submit'])) {

    if (empty($_POST["email"])) {
        $erroremail = '<i class="error error-icon icon-exclamation-circle"></i> Email is required';
    } else {
        $uname = test_input($_POST['email']);
        if (!(preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^", $_POST["email"]))) {
            $erroremail = '<i class="error error-icon icon-exclamation-circle"></i> Invalid Email';
            $uname = '';
        }
    }
    if (empty($_POST["password"])) {
        $errorpassword = '<i class="error error-icon icon-exclamation-circle"></i>Password is required';

    } else {
        $pass = test_input($_POST['password']);

        $sql = "select * from user where email_id='" . $uname . "' AND password='" . $pass . "'";

        $result = mysqli_query($conn, $sql);

        if ($result->num_rows == 1) 
        {
            $row = $result->fetch_assoc();
            $_SESSION['uid'] = $row['User_ID'];
            if ($row['category'] == 'admin') 
            {
                if ($row['first_login'] == 0) 
                {
                    $sql = "update user set first_login = 1 where email_id='" . $uname . "'";
                    $result = mysqli_query($conn, $sql);
                    header('Location: Adminprofile.php');
                } 
                else 
                {
                    header('Location: Adminhome.php');
                }
            } 
            else 
            {
                if ($row['first_login'] == 0) 
                {
                    $sql = "update user set first_login = 1 where email_id='" . $uname . "'";
                    $result = mysqli_query($conn, $sql);
                    header('Location: Userprofile.php');
                } 
                else 
                {
                    header('Location: Userhome.php');
                }
            }
        } 
        else {
            $errormess = '<i class="error error-icon icon-exclamation-circle"></i> Invalid Credentials!';

        }
    }
}
function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/User.css">
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://file.myfontastic.com/YiBddkXWfe3mydtbcoTSGn/icons.css">
    <link href="https://file.myfontastic.com/YiBddkXWfe3mydtbcoTSGn/icons.css" rel="stylesheet">
</head>
<style>
    .error {
        color: #dc3545;
    }
</style>

<body>
    <div class="header">
        <img class="logo" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/logo.jpeg">
        </input>
    </div>
    <div class="wrapper">
        <header>Login Form</header>
        <form name="form1" action="" method="POST">
            <div class="imgcontainer">
                <img src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/canteenwala.png" alt="Avatar" class="avatar">
            </div>
            <div class="field email">
                <div class="input-area">
                    <input type="text" placeholder="Email Address" name="email" value=<?php echo $uname; ?>>
                    <i class="icon icon-envelope"></i>
                </div>
            </div>
            <span class="error"><?php
                                echo $erroremail; ?></span>
            <div class="field password">
                <div class="input-area">
                    <input type="password" placeholder="Password" name="password" value=<?php echo $pass; ?>>
                    <i class="icon icon-lock"></i>
                </div>
            </div>
            <div class="error"><?php  echo $errorpassword; ?></div>
            <div class="error "><?php  echo $errormess; ?></div>
            <br>
            <div class="pass-txt"><a href="http://canteenwala-env.eba-t3xuqrt4.us-east-1.elasticbeanstalk.com/php/forgot_password.php">Forgot password?</a></div>
            <input type="submit" name="submit" value="Login">
            <div class="sg-text">or go back to
                <label class="sg-text=label">
                    <span id="gf0vvq" aria-hidden="true"><a href="http://canteenwala-env.eba-t3xuqrt4.us-east-1.elasticbeanstalk.com/php/home.php">Home page</a></span>
                </label>
            </div>

        </form>
    </div>

</body>

</html>