<?php
session_start();
include 'connection.php';
if (isset($_POST['btn-lanch'])) {
    $var_course_name = mysqli_real_escape_string($con, $_POST['cname']);
    $var_course_duration_int = mysqli_real_escape_string($con, $_POST['cdurationint']);
    $var_course_duration_var = mysqli_real_escape_string($con, $_POST['cdurationvar']);
    $var_course_price = mysqli_real_escape_string($con, $_POST['cprice']);
    $var_course_exams = mysqli_real_escape_string($con, $_POST['cexam']);
    $var_course_category = mysqli_real_escape_string($con, $_POST['ccategory']);
    $var_course_detail = mysqli_real_escape_string($con, $_POST['cdetail']);
    $path = "assets/thumbnails/" . $_FILES['cthumbnail']['name'];
    $fakepath = $_FILES['cthumbnail']['tmp_name'];
    $full_duration = $var_course_duration_int . "-" . $var_course_duration_var;
    $var_teacher_id = mysqli_real_escape_string($con, $_SESSION['ID']);
    $sql = "INSERT INTO `courses`(`course_title`, `course_duration`, `course_price`, `course_thumbnail`, `course_category`, `course_exams`, `course_detail`, `teacher_id`) VALUES ('$var_course_name','$full_duration','$var_course_price','$path','$var_course_category','$var_course_exams', '$var_course_detail', '$var_teacher_id')";
    $run_sql = mysqli_query($con, $sql);
    if ($run_sql) {
        $_SESSION['msg'] = "Course lanched successfully";
        $_SESSION['color'] = "success";
        header('location:../lanchcourse.php');
        exit();
    } else {
        $_SESSION['msg'] = "Internal Server Error";
        $_SESSION['color'] = "danger";
        header('location:../lanchcourse.php');
        exit();
    }
}
