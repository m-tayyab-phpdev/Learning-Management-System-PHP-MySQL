<?php
session_start();
include 'Student/php/connection.php';
if (empty($_SESSION['ID']) && empty($_SESSION['EMAIL']) && empty($_SESSION['NAME'])) {
    header('location:index.php');
}

if (isset($_GET['course'])) {
    $var_course_id = mysqli_real_escape_string($con, $_GET['course']);
    $sql = "SELECT * FROM `courses` WHERE `course_id` = '$var_course_id'";
    $run_sql = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($run_sql);
}

if (isset($_GET['enrollment'])) {
    $var_course_id = mysqli_real_escape_string($con, $_GET['enrollment']);
    $fetch_course_information = "SELECT * FROM `courses` WHERE `course_id` = $var_course_id";
    $run_fetching = mysqli_query($con, $fetch_course_information);
    $info_row = mysqli_fetch_assoc($run_fetching);
    $var_teacher_id = mysqli_real_escape_string($con, $info_row['teacher_id']);
    $var_student_id = mysqli_real_escape_string($con, $_SESSION['ID']);
    $var_cat_id = mysqli_real_escape_string($con, $info_row['course_category']);
    $enorll = "INSERT INTO `course_enrollments`(`course_id`, `teacher_id`, `student_id`, `cat_id`) VALUES ('$var_course_id','$var_teacher_id','$var_student_id','$var_cat_id')";
    $run_enroll = mysqli_query($con, $enorll);
    header('location:details.php?course=' . $var_course_id . '');
}


if (isset($_GET['deroll']) && isset($_GET['crs'])) {
    $var_course_id = mysqli_real_escape_string($con, $_GET['crs']);
    $var_deroll = mysqli_real_escape_string($con, $_GET['deroll']);
    $remove = "DELETE FROM `course_enrollments` WHERE `enroll_id` = '$var_deroll'";
    $run_remove = mysqli_query($con, $remove);
    header('location:details.php?course=' . $var_course_id . '');
}

if (isset($_POST['btn-paynow'])) {
    $status = "Paid";
    $var_challan = mysqli_real_escape_string($con, $_POST['challanno']);
    $confirm_payment = "UPDATE `course_enrollments` SET `challan` = '$var_challan', `payment` = '$status'";
    $run_payment = mysqli_query($con, $confirm_payment);
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Course Details</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">


    <link href="css/style.css" rel="stylesheet">
</head>

<body>

    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="container-fluid topbar bg-light px-5 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-8 text-center text-lg-start mb-2 mb-lg-0">

        </div>
        <div class="col-lg-4 text-center text-lg-end">
            <div class="d-inline-flex align-items-center" style="height: 45px;">

                <div class="dropdown">
                    <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown"><small><i class="fa fa-home text-primary me-2"></i> <?php echo $_SESSION['NAME'] ?></small></a>
                    <div class="dropdown-menu rounded">
                        <a href="#" class="dropdown-item"><i class="fas fa-user-alt me-2"></i> My Profile</a>

                        <a href="Student/php/logout.php" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="container-fluid position-relative p-0">
        <nav class="navbar navbar-expand-lg navbar-light px-4 px-lg-5 py-3 py-lg-0">
            <a href="" class="navbar-brand p-0">
                <h1 class="text-primary">SKILLS HUB</h1>

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                    <a href="index.php" class="nav-item nav-link">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                </div>

            </div>
        </nav>

        <div class="container-fluid bg-breadcrumb">
            <div class="container text-center py-5" style="max-width: 900px;">
                <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">Details</h4>
            </div>
        </div>

    </div>

    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <?php
                            $address = "Teacher/"; ?>
                            <img src="<?php echo $address . $row['course_thumbnail'] ?>" alt="">
                        </div>
                    </div>
                </div>
                <div class="row mt-1 p-4">
                    <div class="card bg-dark text-light">
                        <div class="card-body">
                            <h5 class="text-light"><span>No of Students</span></h5> <span><?php
                                                                                            $enrollments = "SELECT * FROM `course_enrollments` WHERE `course_id` = '$var_course_id'";
                                                                                            $run_enrollments = mysqli_query($con, $enrollments);
                                                                                            $count = mysqli_num_rows($run_enrollments);
                                                                                            echo $count;
                                                                                            ?></span> +
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-borderless">
                            <tr>
                                <th>
                                    Title
                                </th>
                                <td>
                                    <?php echo $row['course_title'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Description
                                </th>
                                <td>
                                    <?php echo $row['course_detail'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Price
                                </th>
                                <td>
                                    Rs. <?php echo $row['course_price'] ?>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Duration
                                </th>
                                <td>
                                    <?php echo $row['course_duration'] ?>
                                </td>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-md-8"></div>
                            <?php
                            $student = $_SESSION['ID'];
                            $pay_status = "Paid";
                            $check_payment = "SELECT * FROM `course_enrollments` WHERE `course_id` = '$var_course_id' AND `student_id` = '$student' AND `payment` = '$pay_status'";
                            $run_check_payment = mysqli_query($con, $check_payment);
                            $check_row = mysqli_num_rows($run_check_payment);
                            if ($check_row != 1) { ?>
                                <div class="col-md-4">
                                    <?php
                                    $var_course_id = $row['course_id'];
                                    $student_id = $_SESSION['ID'];
                                    $check = "SELECT * FROM `course_enrollments` WHERE `course_id` = '$var_course_id' AND `student_id` = '$student_id'";
                                    $run_check = mysqli_query($con, $check);
                                    $num_row = mysqli_num_rows($run_check);
                                    if ($num_row == 1) {
                                        $data = mysqli_fetch_assoc($run_check);
                                        $enrollment_id = $data['enroll_id'];
                                    ?>

                                        <div class="d-flex" style="gap: 10px;">
                                            <div>
                                                <form action="">
                                                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Payment</button>
                                                    <input type="hidden" name="courseid" value="<?php echo $var_course_id ?>">
                                                </form>
                                            </div>

                                            <div>
                                                <a href="details.php?deroll=<?php echo $data['enroll_id'] ?>&crs=<?php echo $row['course_id'] ?>" class="btn btn-danger">Withdraw</a>
                                            </div>
                                        </div>

                                    <?php } else { ?>
                                        <a href="details.php?enrollment=<?php echo $row['course_id'] ?>" class="btn btn-warning" style="width: 200px;">Enroll now</a>
                                    <?php }
                                    ?>

                                </div>
                            <?php } else { ?>
                                <a href="Student/dashboard.php?coursetoken=<?php echo $var_course_id ?>&teachertoken=<?php echo $row['teacher_id'] ?>">Redirect to your course dashboard</a>
                            <?php }
                            ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="footer-item">
                        <a href="index.html" class="p-0">
                            <h4 class="text-white">Skills Hub</h4>

                        </a>
                        <p class="mb-4">Skills Hub is an online education platform where students can enroll in various courses to enhance their skills. We offer a wide range of flexible learning options to help you grow professionally and personally. Start learning today and unlock your full potential!</p>

                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-2">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Quick Links</h4>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> About Us</a>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Contact us</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Support</h4>
                        <a href="#"><i class="fas fa-angle-right me-2"></i> Help</a>
                    </div>
                </div>
                <div class="col-md-6 col-lg-6 col-xl-3">
                    <div class="footer-item">
                        <h4 class="text-white mb-4">Contact Info</h4>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-map-marker-alt text-primary me-3"></i>
                            <p class="text-white mb-0">Virtual University</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-envelope text-primary me-3"></i>
                            <p class="text-white mb-0">info@skillshub.com/p>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fa fa-phone-alt text-primary me-3"></i>
                            <p class="text-white mb-0">((+923) 111 0101)</p>
                        </div>
                        <div class="d-flex align-items-center mb-4">
                            <i class="fab fa-firefox-browser text-primary me-3"></i>
                            <p class="text-white mb-0">www.skillshub.com</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="#" class="btn btn-primary btn-lg-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/lightbox/js/lightbox.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="js/main.js"></script>
</body>

</html>



<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Course payment</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="cardNumber" class="form-label">Debit Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" maxlength="23">
                    </div>
                    <div class="mb-3">
                        <label for="cvv" class="form-label">CVV</label>
                        <input type="text" class="form-control" id="cvv" maxlength="3">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Amount</label>
                        <input type="text" class="form-control" value="<?php echo $row['course_price'] ?>">
                    </div>
                    <?php
                    $challan = rand(10000000, 99999999); ?>
                    <div class="mb-3">
                        <label class="form-label">Challan #</label>
                        <input type="text" class="form-control" name="challanno" value="<?php echo $challan ?>">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-dark" name="btn-paynow">Pay now</button>
            </div>
        </div>
    </div>
</div>
</form>