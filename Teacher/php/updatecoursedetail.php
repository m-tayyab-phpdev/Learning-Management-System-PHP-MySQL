<?php
session_start();
include 'connection.php';
if (isset($_POST['btn-upd'])) {
    $var_course_name = mysqli_real_escape_string($con, $_POST['cname']);
    $var_course_duration_int = mysqli_real_escape_string($con, $_POST['cdurationint']);
    $var_course_duration_var = mysqli_real_escape_string($con, $_POST['cdurationvar']);
    $var_course_price = mysqli_real_escape_string($con, $_POST['cprice']);
    $var_course_exams = mysqli_real_escape_string($con, $_POST['cexam']);
    $var_course_category = mysqli_real_escape_string($con, $_POST['ccategory']);
    $var_course_detail = mysqli_real_escape_string($con, $_POST['cdetail']);
    $var_course_id = mysqli_real_escape_string($con, $_POST['token']);
    $path = "assets/thumbnails/" . $_FILES['cthumbnail']['name'];
    $fakepath = $_FILES['cthumbnail']['tmp_name'];
    $full_duration = $var_course_duration_int . "-" . $var_course_duration_var;
    $sql = "UPDATE `courses` SET `course_title`='$var_course_name',`course_duration`='$full_duration',`course_price`='$var_course_price',`course_thumbnail`='$path',`course_category`='$var_course_category',`course_exams`='$var_course_exams',`course_detail`='$var_course_detail' WHERE `course_id` = '$var_course_id'";
    $run_sql = mysqli_query($con, $sql);
    if ($run_sql) {
        $_SESSION['msg'] = "Details updated successfully";
        $_SESSION['color'] = "success";
        header('location:../coursedetailsreadmore.php?token=' . $var_course_id . '');
        exit();
    } else {
        $_SESSION['msg'] = "Internal Server Error";
        $_SESSION['color'] = "danger";
        header('location:../coursedetailsreadmore.php?token=' . $var_course_id . '');
        exit();
    }
}
