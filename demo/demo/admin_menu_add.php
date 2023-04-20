<?php require "config.php" ?>
<?php
session_start();

$query = "SELECT * FROM `menu` ORDER BY food_id DESC LIMIT 1;";
$rse = mysqli_query($conn, $query);

$id1 = 0;
//print($rse);
while ($row = $rse->fetch_assoc()) {
    $id1 = $row['food_id']+1;
}

if (isset($_POST['submit'])){

$foodname = $_POST['fname'];
$category = $_POST['category'];
$quantity = $_POST['quantity'];
$cost = intval($_POST['cost']);
$image = '0';
$visible = 0;

//$insertquery = "INSERT INTO `menu`(`name`,`quantity`,`price`) VALUES ('".$foodname."','".$quantity."','".$cost"');";
$res = mysqli_query($conn, "INSERT INTO `menu`(`food_id`, `name`, `price`, `category`, `quantity`,`image`,`visible`) VALUES ('".$id1."','".$foodname."','".$cost."','".$category."','".$quantity."','".$image."','".$visible."');");

if($res){
    ?>
    <script>
        alert("data updated properly");
    </script>
    <?php
}else{
    ?>
    <script>
        alert("data not updated");
    </script>
    <?php
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
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/admin_menu_add.css">
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
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
                <a class="dropdown-item" href="AdminProfile.php">Profile</a>
                <a class="dropdown-item" href="home.php">Log Out</a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-sm navbar-custom ">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="Adminhome.php"><i class="fa fa-fw fa-home"></i>Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="admin_menu_view.php"><i class="fa fa-spoon" aria-hidden="true"></i>
                    Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_combo_view.php"><i class="fa fa-cutlery" aria-hidden="true"></i>
                    Combos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="OrderList_all.php"><i class="fa fa-book" aria-hidden="true"></i>
                    Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Admin_order_history.php"><i class="fa fa-check-square"
                        aria-hidden="true"></i> Order History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Sales.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> Sales
                    Report</a>
            </li>
        </ul>
    </nav>

    <nav class="navbar navbar-expand-sm navbar-custom1">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="admin_menu_view.php"><i class="fa fa-eye" aria-hidden="true"></i>
                    View</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_menu_edit.php"><i class="fa fa-pencil" aria-hidden="true"></i>
                    Edit</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="admin_menu_add.php"><i class="fa fa-plus" aria-hidden="true"></i> Add</a>
            </li>
        </ul>
    </nav>
    <h3 class="title">Add New Item</h3>
    <div class="container">
        <form action="" method="POST">
            <label for="fname">Food name </label>
            <input type="text" placeholder="Enter the Food Name" id="fname" name="fname">
            <br>
            <br>
            <label for="category">Category</label>
            <select id="category" name="category">
                <option value="opt 1">opt 1</option>
                <option value="opt 2">opt 2</option>
                <option value="opt 3">opt 3</option>
                <option value="opt 4">opt 4</option>
                <option value="opt 5">opt 5</option>
            </select>
            <br><br>
            <label for="quantity">Quantity </label>
            <input type="number" id="quantity" name="quantity">
            <br>
            <br>
            <label for="cost">Cost </label>
            <input type="number" id="cost" name="cost">
            <br><br>
            <label for="img">Upload the image</label>
            <input type="file" id="img" name="img">
            <br><br>
            <button type="submit" name="submit" class="savebtn">SAVE</button>
        </form>
    </div>
    </div>
</body>

</html>