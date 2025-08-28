<?php
session_start();
include 'php/connection.php';
if (isset($_GET['email'])) {
    $var_email = mysqli_real_escape_string($con, $_GET['email']);
    $change = "Verified";
    $sql = "UPDATE `users` SET `user_acc_status` = '$change' WHERE `user_email` = '$var_email'";
    $run_sql = mysqli_query($con, $sql);
    $_SESSION['msg'] = "Account verified";
    $_SESSION['color'] = "success";
    header('location:index.php');
}
