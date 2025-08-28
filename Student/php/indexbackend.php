<?php
session_start();
include 'connection.php';
if (isset($_POST['btn-login'])) {
    $var_email = mysqli_real_escape_string($con, $_POST['email']);
    $var_password = mysqli_real_escape_string($con, $_POST['password']);
    $type = "Student";
    $var_type = mysqli_real_escape_string($con, $type);
    $sql = "SELECT * FROM `users` WHERE `user_email` = '$var_email' AND `user_type` = '$type'";
    $run_sql = mysqli_query($con, $sql);
    $num_rows = mysqli_num_rows($run_sql);
    if ($num_rows == "1") {
        $row = mysqli_fetch_assoc($run_sql);
        $hash = $row['user_password'];
        if (password_verify($var_password, $hash)) {
            $acc_status = $row['user_acc_status'];
            $check = "Verified";
            $var_check = mysqli_real_escape_string($con, $check);
            if ($acc_status === $var_check) {
                $profile = $row['user_activity_status'];
                if ($profile == "Active") {
                    $_SESSION['ID'] = $row['user_id'];
                    $_SESSION['EMAIL'] = $row['user_email'];
                    $_SESSION['NAME'] = $row['user_name'];
                    header('location:../../index.php');
                    exit();
                } else {
                    $_SESSION['msg'] = "Account is blocked by admin";
                    $_SESSION['color'] = "info";
                    header('location:../index.php');
                    exit();
                }
            } else {
                $_SESSION['msg'] = "Verify your account";
                $_SESSION['color'] = "info";
                header('location:../index.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Invalid email or password";
            $_SESSION['color'] = "danger";
            header('location:../index.php');
            exit();
        }
    } else {
        $_SESSION['msg'] = "Invalid email or password";
        $_SESSION['color'] = "danger";
        header('location:../index.php');
        exit();
    }
}
