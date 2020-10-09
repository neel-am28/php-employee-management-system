<?php
require('db.php');
$msg=" ";
if(isset($_POST['email']) && isset($_POST['password'])){
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $res=mysqli_query($conn,"select * from employee where email='$email' and password='$password'");
    $count=mysqli_num_rows($res);
    if($count>0){
        $row=mysqli_fetch_assoc($res);
        if($row['role'] == 1){
            $_SESSION['ADMIN_ROLE']=$row['role'];
            $_SESSION['ADMIN_USER_ID']=$row['id'];
            $_SESSION['ADMIN_USERNAME']=$row['name'];   
            header('location:index.php');
            die();        
        }
        else{
            $_SESSION['USER_ROLE']=$row['role'];
            $_SESSION['USER_USER_ID']=$row['id'];
            $_SESSION['USER_USERNAME']=$row['name'];
            header("location:add_employee.php?id=".$_SESSION['USER_USER_ID']);
            die();
        }
        
        
    }else{
        $msg="Please enter correct login details";
    }
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

<div class="login-area">
    <div class="container">
        <div class="login-box ptb--100">
            <form method="post">
                <div class="login-form-head">
                    <h4>Sign In</h4>
                    <p>Hello there, Sign in and start managing your account</p>
                </div>
                <div class="login-form-body">
                    <div class="form-gp">
                        <input type="email" name="email" placeholder="Enter email address" required>
                        <i class="ti-email"></i>
                    </div>
                    <div class="form-gp">
                        <input type="password" name="password" placeholder="Enter password" required>
                        <i class="ti-lock"></i>
                    </div>
                    <div class="submit-btn-area">
                        <button name="submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                    </div>
                    <div class="py-3">
                        <p style="color:red;"><?php echo $msg; ?></p>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>