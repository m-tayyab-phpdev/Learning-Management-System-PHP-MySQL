<?php
session_start();
include_once 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['btn-register'])) {


    function EMAIL($var_email, $var_name)
    {
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/SMTP.php';
        $mail = new PHPMailer(true);

        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'tayyaba209rajput@gmail.com';
        $mail->Password   = 'oyhy imaq mhdj hcak';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;


        $mail->setFrom('tayyaba209rajput@gmail.com', 'SkillsHub');
        $mail->addAddress($var_email, $var_name);


        $mail->isHTML(true);
        $mail->Subject = 'Skills Hub Account Varification';
        $mail->Body    = '<h2>Hello ' . $var_name . '</h2><br> This is account varification email. <br>Click <a href="http://localhost/tayyaba-skillshub/Student/verify.php?email=' . $var_email . '">Verify account</a> for varification';

        $mail->send();
        return true;
    }


    $var_name = mysqli_real_escape_string($con, $_POST['name']);
    $var_email = mysqli_real_escape_string($con, $_POST['email']);
    $var_phone = mysqli_real_escape_string($con, $_POST['phone']);
    $var_password = mysqli_real_escape_string($con, $_POST['password']);
    $var_cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $type = "Student";
    $var_type = mysqli_real_escape_string($con, $type);
    $check = "SELECT * FROM `users` WHERE `user_email` = '$var_email'";
    $run_check = mysqli_query($con, $check);
    $num_rows = mysqli_num_rows($run_check);
    if ($num_rows > "0") {
        $_SESSION['msg'] = "Email already registered";
        $_SESSION['color'] = "info";
        header('location:../register.php');
    } else {
        if ($var_password == $var_cpassword) {
            $hash = password_hash($var_password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users`(`user_name`, `user_email`, `user_password`, `user_phone`, `user_type`) VALUES ('$var_name','$var_email','$hash','$var_phone','$var_type')";
            $run_sql = mysqli_query($con, $sql);
            if ($run_sql) {
                if (EMAIL($var_email, $var_name)) {
                    $_SESSION['msg'] = "Check your email";
                    $_SESSION['color'] = "success";
                    header('location:../register.php');
                } else {
                    $_SESSION['msg'] = "Error while sending email";
                    $_SESSION['color'] = "danger";
                    header('location:../register.php');
                }
            }
        } else {
            $_SESSION['msg'] = "Passwords not match";
            $_SESSION['color'] = "danger";
            header('location:../register.php');
        }
    }
}
