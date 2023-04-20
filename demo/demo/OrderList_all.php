<!DOCTYPE html>

<?php require 'config.php';
session_start(); ?>
<html>

<head>
    <meta http-equiv="refresh" content="10">

    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/Order.css">
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
            <li class="nav-item">
                <a class="nav-link" href="admin_combo_view.php"><i class="fa fa-cutlery" aria-hidden="true"></i>
                    Combos</a>
            </li>
            <li class="nav-item  active">
                <a class="nav-link" href="#"><i class="fa fa-book" aria-hidden="true"></i> Orders</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Admin_order_history.php"><i class="fa fa-check-square" aria-hidden="true"></i> Order History</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Sales.php"><i class="fa fa-pie-chart" aria-hidden="true"></i> Sales
                    Report</a>
            </li>
        </ul>
    </nav>

    <nav class="navbar navbar-expand-sm navbar-custom1">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="OrderList_all.php">
                    All</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="OrderList_new.php">
                    New</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="OrderList_prepare.php"> Preparing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="OrderList_complete.php"> Completed</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="OrderList_reject.php"> Reject</a>
            </li>
        </ul>
    </nav>
    <?php
    if (isset($_POST['accept'])) {
        $id = $_POST['accept'];
        $sql = "UPDATE `order_today` SET `status`='1' WHERE `Order_id`='" . $id . "';";
        $result = mysqli_query($conn, $sql);
    }
    if (isset($_POST['reject'])) {
        $id = $_POST['reject'];
        $sql = "UPDATE `order_today` SET `status`='3' WHERE `Order_id`='" . $id . "';";
        $result = mysqli_query($conn, $sql);
    }
    if (isset($_POST['cancel'])) {
        $id = $_POST['cancel'];
        $sql = "UPDATE `order_today` SET `status`='3' WHERE `Order_id`='" . $id . "';";
        $result = mysqli_query($conn, $sql);
    }
    if (isset($_POST['complete'])) {
        $id = $_POST['complete'];
        $sql = "UPDATE `order_today` SET `status`='2' WHERE `Order_id`='" . $id . "';";
        $result = mysqli_query($conn, $sql);
        $sql = "SELECT * FROM `order_today` WHERE `status`='2' AND `Order_id`='" . $id . "';";
        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()) {
            $combo = unserialize($row['combo']);
            $food = unserialize($row['food']);
            if (!empty($food)) {
                foreach ($food as $item => $itemQuantity) {
                    $result = mysqli_query($conn, "SELECT food_id,price from `menu` WHERE name='" . $item . "';");
                    if ($result->num_rows == 1) {
                        $r = $result->fetch_assoc();
                        $res = mysqli_query($conn, "INSERT INTO `sales`(`item_id`, `item_name`, `category`, `price`, `quantity`, `time`) VALUES ('" . $r['food_id'] . "','" . $item . "','food','" . $r['price'] . "','" . intval($itemQuantity) . "','" . $row['time'] . "')");
                    }
                }
            }
            if (!empty($combo)) {
                foreach ($combo as $item => $itemQuantity) {
                    $result = mysqli_query($conn, "SELECT combo_id,price from `combo` WHERE name='" . $item . "';");
                    if ($result->num_rows == 1) {
                        $r = $result->fetch_assoc();
                        $res = mysqli_query($conn, "INSERT INTO `sales`(`item_id`, `item_name`, `category`, `price`, `quantity`, `time`) VALUES ('" . $r['combo_id'] . "','" . $item . "','combo','" . $r['price'] . "','" . intval($itemQuantity) . "','" . $row['time'] . "')");
                    }
                }
            }
        }
    }
    $sql = "select * from order_today order by `time` DESC;";
    $result = mysqli_query($conn, $sql);
    while ($row = $result->fetch_assoc()) {
        $date = explode(' ', $row['time']);
        $combo = unserialize($row['combo']);
        $food = unserialize($row['food']);
        switch ($row['status']) {
            case 0:
    ?>
                <form action='' method='post'>
                    <div class="order new">
                        <div class="Order-hist">
                            <h5><b>Order ID: <?php echo $row['Order_id'] ?></b></h5>
                            <h5><b>Customer ID: <?php echo $row['user_id'] ?></b></h5>
                        </div>
                        <div class="time-date">
                            <h6> Date: <?php echo $date[0]; ?>
                                <br>Time: <?php echo $date[1]; ?>
                            </h6>
                        </div>
                        <div class="odetails">
                            <?php
                            if (!empty($food)) {
                                foreach ($food as $item => $itemQuantity) {
                                    echo $item . ' x' . $itemQuantity . '<br>';
                                }
                            }
                            if (!empty($combo)) {
                                foreach ($combo as $item => $itemQuantity) {
                                    echo $item . '(Combo) x' . $itemQuantity . '<br>';
                                }
                            }
                            $id = $row['Order_id'];
                            ?>
                        </div>
                        <div class="cost">
                            <h5>Cost: <?php echo $row['cost']; ?></h5>
                        </div>

                        <button class="btn1 accept" name='accept' value='<?php echo $id; ?>'>Accept</button>
                        <button name='reject' class="btn1 reject" value='<?php echo $id; ?>'>Reject</button>

                    </div>
                </form>
            <?php break;
            case 2:
            ?>
                <div class="order complete">
                    <div class="Order-hist">
                        <h5><b>Order ID: <?php echo $row['Order_id'] ?></b></h5>
                        <h5><b>Customer ID: <?php echo $row['user_id'] ?></b></h5>
                    </div>
                    <div class="time-date">
                        <h6> Date: <?php echo $date[0]; ?>
                            <br>Time: <?php echo $date[1]; ?>
                        </h6>
                    </div>
                    <div class="odetails">
                        <?php
                        if (!empty($food)) {
                            foreach ($food as $item => $itemQuantity) {
                                echo $item . ' x' . $itemQuantity . '<br>';
                            }
                        }
                        if (!empty($combo)) {
                            foreach ($combo as $item => $itemQuantity) {
                                echo $item . '(Combo) x' . $itemQuantity . '<br>';
                            }
                        }
                        $id = $row['Order_id'];
                        ?>
                    </div>
                    <div class="cost">
                        <h5>Cost: <?php echo $row['cost']; ?></h5>
                    </div>
                </div>
            <?php break;
            case 1:
            ?>
                <form action='' method='post'>
                    <div class="order prepare">
                        <div class="Order-hist">
                            <h5><b>Order ID: <?php echo $row['Order_id'] ?></b></h5>
                            <h5><b>Customer ID: <?php echo $row['user_id'] ?></b></h5>
                        </div>
                        <div class="time-date">
                            <h6> Date: <?php echo $date[0]; ?>
                                <br>Time: <?php echo $date[1]; ?>
                            </h6>
                        </div>
                        <div class="odetails">
                            <?php
                            if (!empty($food)) {
                                foreach ($food as $item => $itemQuantity) {
                                    echo $item . ' x' . $itemQuantity . '<br>';
                                }
                            }
                            if (!empty($combo)) {
                                foreach ($combo as $item => $itemQuantity) {
                                    echo $item . '(Combo) x' . $itemQuantity . '<br>';
                                }
                            }
                            $id = $row['Order_id'];
                            ?>
                        </div>
                        <div class="cost">
                            <h5>Cost: <?php echo $row['cost']; ?></h5>
                        </div>
                        <button class="btn1 complete" name='complete' value='<?php echo $id; ?>'>Order Completed</button>
                        <button class="btn1 cancel" name='cancel' value='<?php echo $id; ?>'>Cancel Order</button>
                    </div>
                </form>
            <?php break;
            case 3:
            ?>
                <div class="order reject">
                    <div class="Order-hist">
                        <h5><b>Order ID: <?php echo $row['Order_id'] ?></b></h5>
                        <h5><b>Customer ID: <?php echo $row['user_id'] ?></b></h5>
                    </div>
                    <div class="time-date">
                        <h6> Date: <?php echo $date[0]; ?>
                            <br>Time: <?php echo $date[1]; ?>
                        </h6>
                    </div>
                    <div class="odetails">
                        <?php
                        if (!empty($food)) {
                            foreach ($food as $item => $itemQuantity) {
                                echo $item . ' x' . $itemQuantity . '<br>';
                            }
                        }
                        if (!empty($combo)) {
                            foreach ($combo as $item => $itemQuantity) {
                                echo $item . '(Combo) x' . $itemQuantity . '<br>';
                            }
                        }
                        $id = $row['Order_id'];
                        ?>
                    </div>
                </div>
    <?php
                break;
        }
    }
    ?>

</body>

</html>