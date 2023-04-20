
<html>

<head>
    <link rel="stylesheet" href="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/css/Userhome.css">
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
        <li class="nav-item active">
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
        <li class="nav-item">
          <a class="nav-link" href="Sales.php"><i class="fa fa-check-square" aria-hidden="true"></i> Sales Report</a>
          </a>
        </li>
      </ul>
    </nav>

    <section id="sec1">
      <img src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/logo.png" alt="" class="cheflogo">
      <h1><b>THE CANTEEN FOOD ORDERING SYSTEM</b></h1>
    </section>

    <section id="sec2">
      <div class="cards" onclick="location.href='admin_menu_view.php'">
        <img src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/menu-removebg-preview.png" alt="">
        <h1><b>MENU</b></h1>
        <h3>Set and Update your Menu</h3>
      </div>
      <div class="cards" onclick="location.href='OrderList_all.php'">
        <img src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/order-removebg-preview.png" alt="">
        <h1><b>ORDER</b></h1>
        <h3>Find your Orders</h3>
      </div>
      <div class="cards" onclick="location.href='sales.php'">
        <img src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/sales-removebg-preview.png" alt="">
        <h1><b>SALES REPORT</b></h1>
        <h3>Check sales for this month</h3>
      </div>
    </section>

    <section id="sec3">
      <div class="content">Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia
        consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem.Nemo
        enim ipsam volu ptatem quia voluptas sit aspernatur aut</div>
      <img src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/bg2.jpeg" alt="">
    </section>


    <footer>
      <ul class="ull">
        <li class="lii">Blog</li>
        <li><img class="imglogo" src="https://canteenwala.s3.amazonaws.com/canteenfoodordering/assets/img/icon.png" width="350px"></li>
        <li class="lii">HelpDesk</li>
      </ul>
      <!-- <div class="bloog" value="blog">
 
         Blog</div>  -->


      <!-- <div class="helpdesk" value="helpdesk"> Help Desk</div> -->
      <hr style="width:90%; margin-left:60px">
      <section class="foot">
        <div class="social">


          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-pinterest"></i></a>
          <a href="#"><i class="fab fa-facebook"></i></a>

          <a href="#"><i class="fab fa-telegram"></i></a>

          <a href="#"><i class="fab fa-instagram"></i></a>
        </div>


      </section>
    </footer>



</body>

</html>