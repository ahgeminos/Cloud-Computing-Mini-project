<html>

<head>
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets\css\Userprofile.css">
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
        crossorigin="anonymous"></script>
</head>

<body>
    <div class="header">
        <img class="logo" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/logo.jpeg">
        <div class="dropdown">
            <input class="btn btn-secondary dropdown-toggle userbutton btn-lg" type="image" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/user.png"
              id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </input>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="Adminhome.php">Home</a>
              <a class="dropdown-item" href="home.php">Log Out</a>
            </div>
          </div>
        </div>
    </div>

    <div class="container">
        <h1 class="Profile">My Profile</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" class="form-control" value="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" class="form-control" value="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" value="">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Phone number</label>
                    <input type="text" class="form-control" value="">
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary">Update</button>
            <button class="btn btn-light">Cancel</button>
        </div>


        <br></br>

        <h4>Change Password</h4>

        <div class="pwd" id="password">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Old password</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>New password</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Confirm new password</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary">Update</button>
                <button class="btn btn-light">Cancel</button>
            </div>


        </div>
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