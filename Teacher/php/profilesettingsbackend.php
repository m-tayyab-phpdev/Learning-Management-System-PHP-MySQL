<?php
session_start();
include 'connection.php';
if (isset($_POST['btn-updprofile'])) {
    $var_name = mysqli_real_escape_string($con, $_POST['name']);
    $var_email = mysqli_real_escape_string($con, $_POST['email']);
    $var_phone = mysqli_real_escape_string($con, $_POST['phone']);
    $var_password = mysqli_real_escape_string($con, $_POST['password']);
    $var_cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $var_id = mysqli_real_escape_string($con, $_SESSION['ID']);
    if ($var_password && $var_cpassword != "") {
        if ($var_password === $var_cpassword) {
            $hash = password_hash($var_password, PASSWORD_DEFAULT);
            $sql = "UPDATE `users` SET `user_name` = '$var_name', `user_email` = '$var_email', `user_phone` = '$var_phone', `user_password` = '$hash' WHERE `user_id` = '$var_id'";
        } else {
            $_SESSION['msg'] = "Passwords not matched";
            $_SESSION['color'] = "danger";
            header('location:../profilesettings.php');
        }
    } else {
        $sql = "UPDATE `users` SET `user_name` = '$var_name', `user_email` = '$var_email', `user_phone` = '$var_phone' WHERE `user_id` = '$var_id'";
    }

    $run_sql = mysqli_query($con, $sql);
    if ($run_sql) {
        $_SESSION['msg'] = "Profile updated";
        $_SESSION['color'] = "success";
        header('location:../profilesettings.php');
    } else {
        $_SESSION['msg'] = "Internal server error";
        $_SESSION['color'] = "info";
        header('location:../profilesettings.php');
    }
}
