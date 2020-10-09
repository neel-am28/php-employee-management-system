<?php 
require('db.php');
// session_destroy();
// session_start();
// print_r($_SESSION);
// die();
if(!isset($_SESSION['USER_ROLE']) && !isset($_SESSION['ADMIN_ROLE'])){
    header("location:login.php");
    die();
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>srtdash - ICO Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/metisMenu.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>
<body>
    <div class="page-container">
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="index.html"><img src="assets/images/icon/logo.png" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">               
                <div class="menu-inner" style="overflow: hidden; width: auto; height: 505px;">
                    <nav>
                        <ul class="metismenu" id="menu">
                            <?php if(isset($_SESSION['ADMIN_ROLE'])){ ?>
                                <li>
                                    <a href="index.php"><i class="ti-dashboard"></i><span>Department Master</span></a>
                                </li>
                                <li><a href="employee.php"><i class="ti-map-alt"></i> <span>Employee Master</span></a></li>
                                <li><a href="leave_type.php"><i class="ti-receipt"></i> <span>Leave Type</span></a></li>
                            <?php } else { ?>
                                <li>
                                    <a href="add_employee.php?id=<?php echo $_SESSION['USER_USER_ID']; ?>"><i class="ti-dashboard"></i><span>My Profile</span></a>
                                </li>
                            <?php } ?>
                                <li>
                                <a href="leave.php"><i class="ti-dashboard"></i><span>Leave</span></a>
                                </li>                       
                        </ul>
                    </nav>
                </div>
            </div> 
        </div> <!-- sidebar end --> 

       
                    