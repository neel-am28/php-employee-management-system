<?php
session_start();
// print_r($_GET);
// print_r($_SESSION);
// die();
if($_GET['user_type'] == "admin"){
unset($_SESSION['ADMIN_ROLE']);
unset($_SESSION['ADMIN_USER_ID']);
unset($_SESSION['ADMIN_USERNAME']);
}
else{
unset($_SESSION['USER_ROLE']);
unset($_SESSION['USER_USER_ID']);
unset($_SESSION['USER_USERNAME']);
}
header('location:login.php');
die();
?>