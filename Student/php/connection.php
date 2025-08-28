<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "skillshub";
$con = mysqli_connect($server, $user, $password, $db);
if (!($con)) {
    die($con);
    mysqli_error($con);
}
