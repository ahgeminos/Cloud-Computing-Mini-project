<?php require "config.php" ?>
<?php
session_start();
$uid = $_SESSION['uid'];
$select1 = $select2 = '';
$errorfirst_name = $errorlast_name = $erroremail = $errorphone_no = '';
$query = "SELECT * FROM `user` WHERE `User_ID`= '" . $uid . "';";
$res = mysqli_query($conn, $query);
if ($res->num_rows == 1) {
    $row = $res->fetch_assoc();
    $umail = $row['email_id'];
    if ($row['first_login'] == 1) {
        $uname = $row['first_name'];
        $vname = $row['last_name'];
        $phone = $row['contact'];
        $dept1 = $row['category'];
        switch ($dept1) {
            case 'Student':
                $select1 = 'selected disabled';
            case 'Faculty':
                $select2 = 'selected disabled';
        }
    } else {
        $uname = $vname = $phone = '';
    }
}


if (isset($_POST['submit'])) {

    if (empty($_POST["first_name"])) {
        $errorfirst_name = '<i class="error error-icon icon-exclamation-circle"></i> First name is required';
    } else {
        $uname = test_input($_POST['first_name']);
        if (!(preg_match("/[A-Za-z]/", $_POST["first_name"]))) {
            $errorfirst_name = '<i class="error error-icon icon-exclamation-circle"></i> Invalid First name';
            $uname = '';
        }
    }

    if (empty($_POST["last_name"])) {
        $errorlast_name = '<i class="error error-icon icon-exclamation-circle"></i> Last name is required';
    } else {
        $vname = test_input($_POST['last_name']);
        if (!(preg_match("/[A-Za-z]/", $_POST["last_name"]))) {
            $errorfirst_name = '<i class="error error-icon icon-exclamation-circle"></i> Invalid Last name';
            $vname = '';
        }
    }

    if (empty($_POST["phone_no"])) {
        $errorphone_no = '<i class="error error-icon icon-exclamation-circle"></i> Phone number is required';
    } else {
        $phone = test_input($_POST['phone_no']);
        if (!(preg_match("/^[0-9]{10}+$/", $_POST["phone_no"]))) {
            $errorphone_no = '<i class="error error-icon icon-exclamation-circle"></i> Invalid Phone number';
            $phone = '';
        }
    }

    $uname = $_POST['first_name'];
    $vname = $_POST['last_name'];
    $contact = $_POST['phone_no'];
    $category = $_POST['Category'];
    $dept = $_POST['department'];
    if (!empty($uname) and !empty($vname) and !empty($contact) and !($category == 'Select') and !($dept == 'Select')) {
        $updatequery = "UPDATE `user` SET `first_name`='" . $uname . "',`last_name`='" . $vname . "' WHERE User_ID='" . $uid . "';";
        $res = mysqli_query($conn, $updatequery);
        $rse = mysqli_query($conn, "UPDATE `user` SET `contact`='" . $phone . "' WHERE User_ID='" . $uid . "';");
        $selected = mysqli_query($conn, "UPDATE `user` SET `Category`='" . $category . "',`department`='" . $dept . "' WHERE User_ID='" . $uid . "';");
        if ($res and $rse and $selected) {
?>
            <script>
                alert("data updated properly");
            </script>
        <?php
        } else {
        ?>
            <script>
                alert("data not updated");
            </script>
<?php
        }
    }
}

$error = $error1 = "";

if (isset($_POST['update'])) {

    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];
    $confirmpass = $_POST['confirmpass'];

    $query = "SELECT * FROM `user` WHERE User_ID= '" . $uid . "';";
    $result = mysqli_query($conn, $query);
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $oldpwd = $row['password'];

        if (!empty($oldpass)) {
            if (!empty($newpass)) {
                if (!empty($confirmpass)) {
                    if ($oldpwd == $oldpass) {
                        if ($newpass == $confirmpass) {
                            $updatequery = "UPDATE `user` SET `password`='" . $newpass . "' WHERE `User_ID`='" . $uid . "';";
                            $res = mysqli_query($conn, $updatequery);
                            echo '<script> window.alert("Password Reset Successfully!");</script>';
                        } else {
                            $error1 = '<i class="error error-icon icon-exclamation-circle"></i>Incorrect Password';
                        }
                    } else {
                        $error1 = '<i class="error error-icon icon-exclamation-circle"></i>Incorrect Old Password';
                    }
                } else {
                    $error = '<i class="error error-icon icon-exclamation-circle"></i>Enter password';
                }
            } else {
                $error = '<i class="error error-icon icon-exclamation-circle"></i>Enter password';
            }
        } else {
            $error = '<i class="error error-icon icon-exclamation-circle"></i>Enter password';
        }
        /*if($oldpwd==$oldpass){
            $updatequery = "UPDATE `user` SET `password`='".$newpass."' WHERE `User_ID`='".$uid."';";
            $res = mysqli_query($conn, $updatequery);
            echo '<script> window.alert("Password Reset Successfully!");</script>';
        }
        else{
            $error1 = '<i class="error error-icon icon-exclamation-circle"></i>Incorrect Old Password';
        }*/
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
<html>

<head>
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets\css\Userprofile.css">
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://file.myfontastic.com/YiBddkXWfe3mydtbcoTSGn/icons.css">
    <link href="https://file.myfontastic.com/YiBddkXWfe3mydtbcoTSGn/icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>
<style>
    .error {
        color: #dc3545;
    }
</style>

<body>
    <div class="header">
        <img class="logo" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/logo.jpeg">
        <div class="dropdown">
            <input class="btn btn-secondary dropdown-toggle userbutton btn-lg" type="image" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/user.png" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </input>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="Userhome.php">Home</a>
                <a class="dropdown-item" href="home.php">Log Out</a>
            </div>
        </div>
    </div>
    </div>

    <div class="container">
        <h1 class="Profile">My Profile</h1>
        <form action="" method="POST">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="first_name" value=<?php echo $uname; ?>>
                        <span class="error"><?php echo $errorfirst_name; ?></span>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="last_name" value=<?php echo $vname; ?>>
                        <span class="error"><?php echo $errorlast_name; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name="email" disabled value=<?php echo $umail; ?>>
                        <span class="error"><?php echo $erroremail; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Phone number</label>
                        <input type="text" class="form-control" name="phone_no" value=<?php echo $phone; ?>>
                        <span class="error"><?php echo $errorphone_no; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="Category">Category:</label>
                        <select name="Category" id="Category">
                            <option value="select">Select</option>
                            <option value="Faculty" <?php echo $select1; ?>>Faculty</option>
                            <option value="Student" <?php echo $select2; ?>>Student</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="department">Department: </label>
                        <select name="department" id="department">
                            <option value="select">Select</option>
                            <option value="FE">FE</option>
                            <option value="Computer">COMPS</option>
                            <option value="Information Technology">IT</option>
                            <option value="EXTC">EXTC</option>
                            <option value="Civil">CIVIL</option>
                            <option value="CSE AI-ML">CSE AI-ML</option>
                            <option value="CSE DS">CSE DS</option>
                            <option value="Mechaical">MECH</option>
                        </select>
                    </div>
                </div>
            </div>
            <div>
                <button name="submit" class="btn btn-primary">Update</button>
                <button class="btn btn-light">Cancel</button>
            </div>
        </form>

        <br></br>

        <h4>Change Password</h4>
        <form action="" method="POST">

            <div class="pwd" id="password">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Old password</label>
                            <input type="password" name="oldpass" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>New password</label>
                            <input type="password" name="newpass" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirm new password</label>
                            <input type="password" name="confirmpass" class="form-control">
                        </div>
                    </div>
                </div>
                <span class="error"><?php echo $error1; ?></span>
                <span class="error"><?php echo $error; ?></span>
                <div>
                    <button class="btn btn-primary" name="update">Update</button>
                    <button class="btn btn-light">Cancel</button>
                </div>


            </div>
        </form>
        <br></br>

        <h4>Upload Profile Picture</h4>

        <div class="picture">
            <label for="img">Upload the image</label>
            <input type="file" id="img" name="img">
        </div>
        <div>
            <button class="btn btn-primary">Update</button>
            <button class="btn btn-light">Cancel</button>
        </div>
    </div>
    </div>
</body>

</html>