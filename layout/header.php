<?php
require_once('config/db.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>F.O.O.D.S</title>
  <!-- plugins:css -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dashboard/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="dashboard/vendor/slick/slick.css">
  <link rel="stylesheet" href="css/mainbu.css">
  <link rel="stylesheet" href="css/util.css">
  <link rel="stylesheet" href="dashboard/vendors/feather/feather.css">
  <link rel="stylesheet" href="dashboard/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="dashboard/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="dashboard/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="dashboard/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="dashboard/vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" type="text/css" href="dashboard/js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="dashboard/css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="dashboard/images/favicon.ico" />
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.php"><img src="dashboard/images/logo.png" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.php"><img src="dashboard/images/logo.png" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <!--<ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>-->
            <ul class="navbar-nav navbar-nav-right">
                
                <?php
                if(isset($_SESSION['loggedinuser'])){
                ?>
                <li class="nav-item">
                  <span class="linedivide1"></span>
                    <div class="header-wrapicon2">
                        <a href="cart.php" class="nav-link">
                            <i class="ti-shopping-cart menu-icon"></i>
                        </a>
                        <span class="header-icons-noti">
                            <?php
                                $productObj->getNumberOfItemsInCart($_SESSION['user_id']);
                            ?>
                        </span>
                    </div>
                </li>
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <i class="icon-head menu-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="transactionHistory.php">
                        <i class="ti-settings text-primary"></i>
                        Transaction History
                    </a>
                    <a class="dropdown-item" href="logout.php">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                    </div>
                </li>
                <?php
                }
                else if(!isset($_SESSION['loggedinuser'])){
                ?>
                <li class="nav-item nav-profile dropdown">
                    <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <i class="icon-head menu-icon"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a class="dropdown-item" href="login.php">
                        Login
                    </a>
                    <a class="dropdown-item" href="register.php">
                        Register
                    </a>
                    </div>
                </li>
                <?php
                }
                ?>
            </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">
              <i class="ti-home menu-icon"></i>
              <span class="menu-title">Home</span>
            </a>
          </li>
            <?php
                $rowArr = $categoryObj->getAllCategoryData();
                if(!is_null($rowArr)){
                    foreach($rowArr as $row){
                        echo "<li class='nav-item ".(!empty($_GET['category']) ? ($row['CategoryID'] == $_GET['category'] ? "active" : "") : "") ."'>";
                        echo "<a class='nav-link' href='index.php?category=". $row['CategoryID'] ."'>";
                        echo "<i class='icon-grid menu-icon'></i>";
                        echo "<span class='menu-title'>".$row['CategoryName']."</span>";
                        echo "</a>";
                        echo "</li>";
                    }
                }
            ?>
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">