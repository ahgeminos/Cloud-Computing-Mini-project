<?php require 'config.php' ?>
<?php session_start(); ?>
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
                <a class="dropdown-item" href="Userprofile.php">Profile</a>
                <a class="dropdown-item" href="home.php">Log Out</a>
            </div>
        </div>
    </div>
    </div>

    <nav class="navbar navbar-expand-sm navbar-custom ">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="Userhome.php"><i class="fa fa-fw fa-home" aria-hidden="true"></i>
                    Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="menu.php"><i class="fa fa-spoon" aria-hidden="true"></i> Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="combos.php"><i class="fa fa-cutlery" aria-hidden="true"></i> Combos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="OrderHistory.php"><i class="fa fa-check-square" aria-hidden="true"></i>
                    Order
                    History</a>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="Cart.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart</a>
            </li>
        </ul>
    </nav>


    <div class="orderlist">
        <div class="yourlist">
            Your Order History:
            <br>
            <?php

            $sql = "select * from order_today where `user_id`='" . $_SESSION['uid'] . "' order by `time` desc;";
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
                        
                        <?php switch($row['status']){
                            case '0': $path="pending.jpg";
                                    break;
                            case '1': $path="waiting.jpg";
                                    break;
                            case '2': $path='completed.jpg';
                                    break;
                            case '3': $path='reject.jpg';
                                    break;
                        } ?>
                        <img src='https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/<?php echo $path;?>' alt="">
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
            <?php }; ?>


        </div>
    </div>
    <hr>
    </div>

</body>

</html>