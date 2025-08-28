<?php
include 'connection.php';
session_start();
if (isset($_POST['btn-cat'])) {
    $var_cat = mysqli_real_escape_string($con, $_POST['cat']);
    $sql = "INSERT INTO `course_category`(`cat_title`) VALUES ('$var_cat')";
    $run_sql = mysqli_query($con, $sql);
    if ($run_sql) {
        $_SESSION['msg'] = "Category added";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['msg'] = "Error while adding category";
        $_SESSION['color'] = "danger";
    }
    header('location:../managecategory.php');
    exit();
}




if (isset($_POST['btn-upd'])) {
    $var_cat = mysqli_real_escape_string($con, $_POST['cat']);
    $var_id = mysqli_real_escape_string($con, $_POST['id']);
    $sql = "UPDATE `course_category` SET `cat_title` = '$var_cat' WHERE `cat_id` = '$var_id'";
    $run_sql = mysqli_query($con, $sql);
    if ($run_sql) {
        $_SESSION['msg'] = "Category updated";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['msg'] = "Error while updating category";
        $_SESSION['color'] = "danger";
    }
    header('location:../managecategory.php');
    exit();
}



if (isset($_GET['del'])) {
    $var_id = mysqli_real_escape_string($con, $_GET['del']);
    $sql = "DELETE FROM `course_category` WHERE `cat_id` = '$var_id'";
    $run_sql = mysqli_query($con, $sql);
    if ($run_sql) {
        $_SESSION['msg'] = "Category removes";
        $_SESSION['color'] = "success";
    } else {
        $_SESSION['msg'] = "Error while deleting category";
        $_SESSION['color'] = "danger";
    }
    header('location:../managecategory.php');
    exit();
}
