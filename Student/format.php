<?php
session_start();
include 'php/connection.php';
if (empty($_SESSION['ID']) && empty($_SESSION['EMAIL']) && empty($_SESSION['NAME'])) {
    header('location:index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Student Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha384-SxauHFuc7Q5/3HA4LxMY+29jOqPC6N0DlO0VsO2I3Lp0OmZTnQwMGnPZrfy3u1h8" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

        <a class="navbar-brand ps-3" href="dashboard.php"><?php echo $_SESSION['NAME'] ?></a>

        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>

        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profilesettings.php">Profile Settings</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="php/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">

                        <a class="nav-link" href="dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>

                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Course Activities
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="lectures.php?coursetoken=<?php if (isset($_SESSION['COURSE'])) {
                                                                                        $var_course_token = $_SESSION['COURSE'];
                                                                                        echo $var_course_token;
                                                                                    } ?>&teachertoken=<?php if (isset($_SESSION['TEACHER'])) {
                                                                                                            $var_teacher_token = $_SESSION['TEACHER'];
                                                                                                            echo $var_teacher_token;
                                                                                                        } ?>">Video lectures</a>
                                <a class="nav-link" href="assignments.php?coursetoken=<?php if (isset($_SESSION['COURSE'])) {
                                                                                            $var_course_token = $_SESSION['COURSE'];
                                                                                            echo $var_course_token;
                                                                                        } ?>&teachertoken=<?php if (isset($_SESSION['TEACHER'])) {
                                                                                                                $var_teacher_token = $_SESSION['TEACHER'];
                                                                                                                echo $var_teacher_token;
                                                                                                            } ?>">Assignments</a>
                                <a class="nav-link" href="quiz.php?coursetoken=<?php if (isset($_SESSION['COURSE'])) {
                                                                                    $var_course_token = $_SESSION['COURSE'];
                                                                                    echo $var_course_token;
                                                                                } ?>&teachertoken=<?php if (isset($_SESSION['TEACHER'])) {
                                                                                                        $var_teacher_token = $_SESSION['TEACHER'];
                                                                                                        echo $var_teacher_token;
                                                                                                    } ?>">Quizzes</a>
                                <a class="nav-link" href="exam.php?coursetoken=<?php if (isset($_SESSION['COURSE'])) {
                                                                                    $var_course_token = $_SESSION['COURSE'];
                                                                                    echo $var_course_token;
                                                                                } ?>&teachertoken=<?php if (isset($_SESSION['TEACHER'])) {
                                                                                                        $var_teacher_token = $_SESSION['TEACHER'];
                                                                                                        echo $var_teacher_token;
                                                                                                    } ?>">Exams</a>
                            </nav>
                        </div>

                    </div>
                </div>

            </nav>
        </div>


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
</body>

</html>