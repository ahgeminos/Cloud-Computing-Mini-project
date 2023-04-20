<?php require 'config.php';
session_start(); ?>
<html>

<head>
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/OrderHistory.css">
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/header.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            <li class="nav-item">
                <a class="nav-link" href="OrderList_all.php"><i class="fa fa-check-square" aria-hidden="true"></i>
                    Orders</a>
                </a>
            </li>
            <li class="nav-item active">
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


    <div class="orderlist">
        <div class="yourlist">
            Your Order History:
            <br>
            <div class='date'>
                <form action='' method="POST">
                    <?php date_default_timezone_set('Asia/Kolkata');
                    $cdate = date('d-m-y '); ?>

                    <label for="start">
                        Enter the Start Date:
                    </label>

                    <input type="date" name="start" placeholder="dd-mm-yyyy" value="" min="2000-01-01" max=<?php echo $cdate; ?>>
                    <br>

                    <label for="end">
                        Enter the End Date:
                    </label>

                    <input type="date" name="end" placeholder="dd-mm-yyyy" value="" min="2000-01-01" max=<?php echo $cdate; ?>>
                    <br>
                    <button class='search' name='search'>Search</button>
                </form>
            </div>
            <?php
            if (isset($_POST['search'])) {
                $sdate = $_POST['start'];
                $edate = $_POST['end'];
                $sql = "select * from order_today where `status`='2' or `status`='3' and `time` between '" . $sdate . "' and '" . $edate . "' order by `time` desc;";
                $result = mysqli_query($conn, $sql);
                while ($row = $result->fetch_assoc()) {
                    $date = explode(' ', $row['time']);
                    $combo = unserialize($row['combo']);
                    $food = unserialize($row['food']);
            ?>
                    <div class="past-order">
                        <div class="Order-hist">
                            <h5><b>Order ID:<?php echo $row['Order_id']; ?></b></h5>
                            <div class="time-date">
                                <h6> Date:<?php echo $date[0]; ?><br>Time:<?php echo $date[1]; ?></h6>
                            </div>

                            <?php switch ($row['status']) {
                                case '2':
                                    $path = 'completed.jpg';
                                    break;
                                case '3':
                                    $path = 'reject.jpg';
                                    break;
                            } ?>
                            <img src='https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/<?php echo $path; ?>' alt="">
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
                            ?>
                        </div>
                            <div class="cost">
                                <h5>Cost: <?php echo $row['cost']; ?></h5>
                            </div>
                        </div>
                    </div>
            <?php };
            } ?>

        </div>
    </div>
    <hr>
    </div>

</body>

</html>