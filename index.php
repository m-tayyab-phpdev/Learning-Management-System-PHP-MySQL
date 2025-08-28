<?php
session_start();
include 'Student/php/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SkillsHub - Home</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">


    <link rel="stylesheet" href="lib/animate/animate.min.css" />
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


                    <?php
                    if (empty($_SESSION['ID']) && empty($_SESSION['EMAIL']) && empty($_SESSION['NAME'])) { ?>

                        <div class="dropdown me-3">
                            <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown">
                                <small><i class="fa fa-user text-primary me-2"></i>Register as</small>
                            </a>
                            <div class="dropdown-menu rounded">
                                <a href="Teacher/register.php" class="dropdown-item"><i class="fas fa-chalkboard-teacher"></i> Teacher</a>
                                <a href="Student/register.php" class="dropdown-item"><i class="fas fa-user-graduate"></i> Student</a>
                            </div>
                        </div>


                        <div class="dropdown me-3">
                            <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown">
                                <small><i class="fa fa-sign-in-alt text-primary me-2"></i>Login as</small>
                            </a>
                            <div class="dropdown-menu rounded">
                                <a href="Teacher/index.php" class="dropdown-item"><i class="fas fa-chalkboard-teacher"></i> Teacher</a>
                                <a href="Student/index.php" class="dropdown-item"><i class="fas fa-user-graduate"></i> Student</a>
                                <a href="Admin/index.php" class="dropdown-item"><i class="fas fa-user-shield"></i> Admin</a>
                            </div>
                        </div>
                    <?php   } else { ?>


                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle text-dark" data-bs-toggle="dropdown">
                                <small><i class="fa fa-home text-primary me-2"></i><?php echo $_SESSION['NAME'] ?></small>
                            </a>
                            <div class="dropdown-menu rounded">

                                <a href="Student/php/logout.php" class="dropdown-item"><i class="fas fa-power-off me-2"></i> Log Out</a>
                            </div>
                        </div>

                    <?php  }
                    ?>








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
                    <a href="index.php" class="nav-item nav-link active">Home</a>
                    <a href="about.php" class="nav-item nav-link">About</a>
                    <a href="contact.php" class="nav-item nav-link">Contact Us</a>
                </div>

            </div>
        </nav>


        <div class="header-carousel owl-carousel">
            <div class="header-carousel-item">
                <img src="img/banner-1.jpg" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row gy-0 gx-5">
                            <div class="col-lg-0 col-xl-5"></div>
                            <div class="col-xl-7 animated fadeInLeft">
                                <div class="text-sm-center text-md-end">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Welcome To Skills Hub</h4>
                                    <h3 class="display-4 text-uppercase text-white mb-4">Education is the key to success</h3>
                                    <div class="d-flex justify-content-center justify-content-md-end flex-shrink-0 mb-4"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-carousel-item">
                <img src="img/banner-2.1.jpg" class="img-fluid w-100" alt="Image">
                <div class="carousel-caption">
                    <div class="container">
                        <div class="row g-5">
                            <div class="col-12 animated fadeInUp">
                                <div class="text-center">
                                    <h4 class="text-primary text-uppercase fw-bold mb-4">Paid & Free courses</h4>
                                    <h3 class="display-4 text-uppercase text-white mb-4">Be the part of Skills Hub</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <div class="container-fluid service pb-5">
        <div class="container pb-5">
            <div class="text-center mx-auto pb-5 wow fadeInUp" data-wow-delay="0.2s" style="max-width: 800px;">
                <h4 class="text-primary mt-4">Offered Courses</h4>
                <h1 class="display-5 mb-4">We provided best offers</h1>
                <p class="mb-0">Our initiative is to provide students with the best courses at very affordable fees. Our mission is to educate every student who is unable to attend school, college, and university. We believe that quality education should be accessible to everyone, regardless of their circumstances. By offering flexible and inclusive learning opportunities, we aim to empower individuals to build a better future.
                </p>
            </div>
            <div class="row g-4">

                <?php
                $sql = "SELECT * FROM `courses`";
                $run_sql = mysqli_query($con, $sql);
                $num_row = mysqli_num_rows($run_sql);
                $address = "Teacher/";
                if ($num_row > 0) {
                    $counter = 0;
                    while ($row = mysqli_fetch_assoc($run_sql)) {
                        if ($counter % 3 == 0 && $counter != 0) { // Close and open new row after every 3 items
                            echo '</div><div class="row g-4">';
                        }
                ?>
                        <div class="col-md-4 col-lg-4 wow fadeInUp" data-wow-delay="0.2s">
                            <div class="service-item">
                                <div class="service-img">
                                    <img src="<?php echo $address . $row['course_thumbnail'] ?>" class="img-fluid rounded-top w-100" alt="Image" style="height: 200px;">
                                </div>
                                <div class="rounded-bottom p-4">
                                    <a href="#" class="h4 d-inline-block mb-4"><?php echo $row['course_title'] ?></a>
                                    <p class="mb-4"><b>Price</b> <?php echo $row['course_price'] ?> Rs</p>
                                    <a class="btn btn-primary rounded-pill py-2 px-4" href="details.php?course=<?php echo $row['course_id'] ?>">Details</a>
                                </div>
                            </div>
                        </div>
                <?php
                        $counter++;
                    }
                }
                ?>
            </div>

        </div>
    </div>
    </div>

    <div class="container-fluid footer py-5 wow fadeIn" data-wow-delay="0.2s">
        <div class="container py-5 border-start-0 border-end-0" style="border: 1px solid; border-color: rgb(255, 255, 255, 0.08);">
            <div class="row g-5">
                <div class="col-md-6 col-lg-6 col-xl-4">
                    <div class="footer-item">
                        <a href="index.php" class="p-0">
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