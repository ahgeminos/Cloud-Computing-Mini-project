<?php require 'config.php' ?>

<html>

<head>
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/combos.css">
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
            <li class="nav-item active">
                <a class="nav-link" href="combos.php"><i class="fa fa-cutlery" aria-hidden="true"></i> Combos</a>
            </li>
            <li class="nav-item">
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

    <div class="search-container">
        <form action="/action_page.php">
            <input type="text" placeholder="Search here" name="search" size="50">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

    <div class="combo-menu">
        <?php
        session_start();

        if (isset($_POST['increment'])) {
            $id = $_POST['increment'];
            $quantity = $_POST['quantity' . $id];
            $quantity = (int)$quantity + 1;
            if (!empty($_SESSION['cart'])) {

                $_SESSION['cart'][$id] = $quantity;
            } else {
                $_SESSION['cart'] = array($id => $quantity);
            }
        }
        if (isset($_POST['decrement'])) {
            $id = $_POST['decrement'];
            $quantity = $_POST['quantity' . $id];
            $quantity = (int)$quantity - 1;
            if ($quantity <= 0) {
                $quantity = 0;
            }
            if (!empty($_SESSION['cart'])) {

                $_SESSION['cart'][$id] = $quantity;
            }

        }


        $sql = "select * from combo where `visible`='1';";

        $result = mysqli_query($conn, $sql);

        while ($row = $result->fetch_assoc()) {
        ?>
            <form action="" method="POST">
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
                        <div class="cost">
                            Cost:<?php echo $row["price"]; ?>
                            <br>
                            <?php
                            $name = $row["combo_id"];
                            $_POST['quantity' . $name] = 0;

                            if (!empty($_SESSION['cart'])) {
                                
                                  foreach($_SESSION['cart'] as $item=>$itemQuantity)
                                  {
                                    $_POST['quantity'.$item]=$itemQuantity;
                                  }
                                }
                            
                            ?>
                    <button class='decrement' name="decrement" value='<?php echo $name; ?>'>-</button>
                        <input class='quantity' name="quantity<?php echo $name; ?>" value=<?php echo $_POST['quantity' . $name]; ?>></input>
                            <button class="increment" name="increment" value='<?php echo $name; ?>'>+</button>
                </div>
                    </div>
                </div>
            </form>
        <?php }; ?>
    </div>


    </div>
    </div>


</body>

</html>