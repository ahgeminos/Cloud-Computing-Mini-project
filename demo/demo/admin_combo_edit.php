<?php require 'config.php';
session_start(); ?>
<html>

<head>
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/admin_combo_view.css">
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>

<body>
    <div class="header">
    <img class="logo" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/logo.jpeg">
        <div class="dropdown">
            <input class="btn btn-secondary dropdown-toggle userbutton btn-lg" type="image" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/user.png" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
            <li class="nav-item">
                <a class="nav-link" href="admin_menu_view.php"><i class="fa fa-spoon" aria-hidden="true"></i>
                    Menu</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="admin_combo_view.php"><i class="fa fa-cutlery" aria-hidden="true"></i>
                    Combos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="OrderList_all.php"><i class="fa fa-check-square" aria-hidden="true"></i>
                    Orders</a>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Admin_order_history.php"><i class="fa fa-check-square" aria-hidden="true"></i> Order History</a>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Sales.php"><i class="fa fa-check-square" aria-hidden="true"></i> Sales
                    Report</a>
                </a>
            </li>
        </ul>
    </nav>

    <nav class="navbar navbar-expand-sm navbar-custom1">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="admin_combo_view.php"><i class="fa fa-eye" aria-hidden="true"></i>
                    View</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="admin_combo_edit.php"><i class="fa fa-pencil" aria-hidden="true"></i>
                    Edit</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_combo_add.php"><i class="fa fa-plus" aria-hidden="true"></i>
                    Add</a>
            </li>
        </ul>
    </nav>

    <div class="search-container">
        <form action="/action_page.php">
            <input type="text" placeholder="Search here" name="search" size="50">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div class="combo-menu">
        <?php

if (isset($_POST['qbtn'])) {
    $id= $_POST['qbtn'];
    $sql = "select visible from combo where combo_id='".$id."';";
        $result = mysqli_query($conn, $sql);
        $v=$result->fetch_assoc();
    if ($v['visible'] == 0) {
        $sql = "UPDATE `combo` SET `visible`='1' WHERE combo_id='".$id."';";
        $result = mysqli_query($conn, $sql);
        $button_display = "Remove from the Menu";
    } else {
        $sql = "UPDATE `combo` SET `visible`='0' WHERE combo_id='".$id."';";
        $result = mysqli_query($conn, $sql);
        $button_display = "Add to Menu";
    }

}
        $sql = "select * from combo;";

        $result = mysqli_query($conn, $sql);

        while ($row = $result->fetch_assoc()) {
        ?>
        <form action="" method ="POST"> 
                <div class="single-combo-menu">
                    <img src='https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/<?php echo $row['image'] ?>' alt="">
                    <div class="menu-content">
                        <h5><b><?php echo $row["name"]; ?></b></h5>
                        <?php $food = explode(',', $row['food_id']);
                        foreach ($food as $item) {
                        ?>
                            <h6><?php echo $item; ?></h6>
                        <?php
                        } ?>
                        <br>
                        <br>
                        <div class="cost">
                            Cost:<?php echo $row["price"]; ?>
                            <br>
                            <?php
                            if ($row["visible"] == 0) {
                                $button_display = "Add to Menu";
                            } else {
                                $button_display = "Remove from the Menu";
                            }
                            $name=$row["combo_id"];
                            ?>
                            <button class="qbtn" name='qbtn' value='<?php echo $name;?>'><?php echo $button_display ?></button>
                        </div>
                    </div>
                </div>
        </form>
        <?php }; ?>

    </div>


</body>

</html>