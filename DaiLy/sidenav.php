<?php

if (!isset($_SESSION['admin_name'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: .././index.php');
}
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin_name']);
    header("location: .././index.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        BIGCORP|Vendor
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport'/>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU"
          crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="../assets/css/material-dashboard.css?v=2.1.0" rel="stylesheet"/>
</head>

<body class="dark-edition">
<div class="wrapper ">
    <div class="sidebar" data-color="azure" data-background-color="black" data-image="../assets/img/sidebar-2.jpg">
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item active  ">
                    <a class="nav-link" href="index.php">
                        <i class="material-icons">dashboard</i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="manageImportedProduct.php">
                        <i class="material-icons">factory</i>
                        <p>Manage Imported Products</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="manageErrorProduct.php">
                        <i class="material-icons">factory</i>
                        <p>Manage Error Product</p>
                    </a>

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="addNewErrorProduct.php">
                        <i class="material-icons">error</i>
                        <p>Add New Error Product</p>
                    </a>

                </li>

                <li class="nav-item ">
                    <a class="nav-link" href="addProduct.php">
                        <i class="material-icons">add</i>
                        <p>Add new imported Product</p>
                    </a>

                </li>
                <!-- <li class="nav-item ">
                    <a class="nav-link" href="manageFactory.php">
                        <i class="material-icons">factory</i>
                        <p>Manage Factories</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="manageStore.php">
                        <i class="material-icons">store</i>
                        <p>Manage Stores</p>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="manageWarrantyCenter.php">
                        <i class="material-icons">construction</i>
                        <p>Manage Warranty Centers</p>
                    </a>
                </li> -->

                <li class="nav-item ">
                    <a class="nav-link" href="profile.php">
                        <icons-image _ngcontent-aye-c22="" _nghost-aye-c19=""><i _ngcontent-aye-c19=""
                                                                                 class="material-icons icon-image-preview">settings</i>
                        </icons-image>
                        <p>setting</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>