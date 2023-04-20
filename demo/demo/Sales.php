<?php require 'config.php';
session_start();

?>
<html>

<head>
  <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/Userhome.css">
  <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/header.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/footer.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" media="screen and (max-width: 1101px)" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/phone.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
</head>

<style>
  table {
    margin-top: 2%;
    margin-left: 2%;
    padding-top: 50%;
    padding-left: 10px;
    text-align: center;
  }

  th,
  td {
    border: 1px solid black;
    text-align: center;
  }
</style>

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
        <a class="nav-link" href="admin_combo_view.php"><i class="fa fa-cutlery" aria-hidden="true"></i> Combos</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="OrderList_all.php"><i class="fa fa-check-square" aria-hidden="true"></i> Orders</a>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="Admin_order_history.php"><i class="fa fa-check-square" aria-hidden="true"></i>
          Order History</a>
        </a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="Sales.php"><i class="fa fa-check-square" aria-hidden="true"></i> Sales Report</a>
        </a>
      </li>
    </ul>
  </nav>
  <form action="" method="POST">
    <div id='sortbox'> <label for="sort">Sort By: </label>
      <select name="sort" id="sort">
        <option value="">Select</option>
        <option value="item">Item</option>
        <option value="time">Time</option>
      </select>
      <button id='submit' name='submit'> Submit</button>
    </div>



    <?php
    if (isset($_POST['submit'])) {
      $selected = $_POST['sort'];
    ?>
      <table style="width:90%">
        <?php
        switch ($selected) {
          case 'item':
            $sql = "SELECT `item_id`, `item_name`, `category`, `price`, SUM(`quantity`), `time` FROM `sales` GROUP BY item_name;";
        ?>
            <tr>
              <th>Item ID</th>
              <th>Item</th>
              <th>Category</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Total</th>
            </tr>
            <?php
            $total = 0;
            $count = 0;
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td><?php echo $row['item_id']; ?></td>
                <td><?php echo $row['item_name']; ?></td>
                <td><?php echo $row['category']; ?></td>
                <td><?php echo $row['price']; ?></td>
                <td><?php $count = $count + $row['SUM(`quantity`)'];
                    echo $row['SUM(`quantity`)']; ?></td>
                <td><?php $total = $total + ($row['price'] * $row['SUM(`quantity`)']);
                    echo $row['price'] * $row['SUM(`quantity`)']; ?></td>
              </tr>
            <?php
            }
            $sql = "SELECT SUM(`quantity`) FROM sales;";
            $result = mysqli_query($conn, $sql);
            while ($row = $result->fetch_assoc()) {
            ?>
              <tr>
                <td colspan="5"><?php echo $count; ?></td>
                <td><?php echo $total; ?></td>
              </tr>
            <?php
            }
            break;
          case 'time':
            ?>
              <?php date_default_timezone_set("Asia/Kolkata");
              $cdate = date("d-m-y"); ?>
            <form action='' method="POST">

              <label for="start">
                Enter the Start Date:
              </label>

              <input type="date" name="start" placeholder="yyyy-mm-dd" value="" min="2000-01-01" max=<?php echo $cdate; ?>>
              <br>

              <label for="end">
                Enter the End Date:
              </label>

              <input type="date" name="end" placeholder="yyyy-mm-dd" value="" min="2000-01-01" max=<?php echo $cdate; ?>>
              <br>
              <button class="search" name="search">Search</button>
            
  </form>

  <?php
            if (isset($_POST['search'])) {
              $sdate = $_POST['start'];
              $edate = $_POST['end'];
              $sql = "SELECT `item_id`, `item_name`, `category`, `price`, SUM(`quantity`), `time` FROM `sales` WHERE time between '" . $sdate . "' and '" . $edate . "' group by item_name;";
              $result = mysqli_query($conn, $sql);
  ?>
    <th>Item ID</th>
    <th>Item</th>
    <th>Category</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Time</th>
    <th>Total</th>
    </tr>
    <?php
              while ($row = $result->fetch_assoc()) {
                $date = explode(' ', $row['time']);

    ?>
      <tr>
        <td><?php echo $row['food_id']; ?></td>
        <td><?php echo $row['item']; ?></td>
        <td><?php echo $row['category']; ?></td>
        <td><?php echo $row['price']; ?></td>
        <td><?php echo $row['SUM(`quantity`)']; ?></td>
        <td><?php echo $row['time']; ?></td>
        <td><?php echo $row['price'] * $row['SUM(`quantity`)'] ?></td>
      </tr>
  <?php
              }
            }
            break;
          case '':
            $sql = "SELECT * FROM `sales`;";
            $result = mysqli_query($conn, $sql);
  ?>
  <th>Order ID</th>
  <th>Item</th>
  <th>Category</th>
  <th>Price</th>
  <th>Quantity</th>
  <th>Time</th>
  <th>Total</th>
  </tr>
  <?php
            while ($row = $result->fetch_assoc()) {
              $date = explode(' ', $row['time']);

  ?>
    <tr>
      <td><?php echo $row['item_id']; ?></td>
      <td><?php echo $row['item_name']; ?></td>
      <td><?php echo $row['category']; ?></td>
      <td><?php echo $row['price']; ?></td>
      <td><?php echo $row['quantity']; ?></td>
      <td><?php echo $row['time']; ?></td>
      <td><?php echo $row['price'] * $row['quantity'] ?></td>

    </tr>
<?php
            }
            break;
        }
      }
?>
</table>

</body>

</html>