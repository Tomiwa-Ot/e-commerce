<?php 

ob_start();
session_start(); 

if(!isset($_SESSION['admin'])) {
    header('Location: /admin/login');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title> Yem Yem | Dashboard</title>
    <link href="/views/admin/assets/vendor/fontawesome/css/fontawesome.min.css" rel="stylesheet">
    <link href="/views/admin/assets/vendor/fontawesome/css/solid.min.css" rel="stylesheet">
    <link href="/views/admin/assets/vendor/fontawesome/css/brands.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <link href="/views/admin/assets/css/master.css" rel="stylesheet">
    <link href="/views/admin/assets/vendor/datatables/datatables.min.css" rel="stylesheet">
    <link href="/views/admin/assets/vendor/flagiconcss/css/flag-icon.min.css" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <nav id="sidebar" class="active">
            <ul class="list-unstyled components text-secondary">
                <li>
                    <a href="/admin/home"><i class="fas fa-home"></i>Home</a>
                </li>
                <li>
                    <a href="/admin/products"><i class="fas fa-shopping-cart"></i>Products</a>
                </li>
                <li>
                    <a href="/admin/customers"><i class="fas fa-user"></i></i>Customers</a>
                </li>
                <li>
                    <a href="/admin/orders"><i class="fas fa-file"></i>Orders</a>
                </li>
                <li>
                    <a href="/admin/faq"><i class="fas fa-info-circle"></i>Faq</a>
                </li>
                <li>
                    <a href="/admin/settings"><i class="fas fa-cog"></i>Settings</a>
                </li>
            </ul>
        </nav>
        <div id="body" class="active">
            <!-- navbar navigation component -->
            <nav class="navbar navbar-expand-lg navbar-white bg-white">
                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-bars"></i><span></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ms-auto">
                     
                        <li class="nav-item dropdown">
                            <div class="nav-dropdown">
                                <a href="#" id="nav2" class="nav-item nav-link dropdown-toggle text-secondary" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-user"></i> <span><?= $_SESSION['admin'] ?></span> <i style="font-size: .8em;" class="fas fa-caret-down"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end nav-link-menu">
                                    <ul class="nav-list">
                                        <li><a href="/admin/reset-password" class="dropdown-item"><i class="fas fa-address-card"></i> Reset Password</a></li>
                                        <li><a href="/admin/logout" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <!-- end of navbar navigation -->
            <div class="content">