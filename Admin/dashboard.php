<?php
include 'format.php';

$sql = [
    "SELECT * FROM `courses`", 
    "SELECT * FROM `users` WHERE `user_type` = 'Student'", 
    "SELECT * FROM `users` WHERE `user_type` = 'Teacher'"
];


$runCourses = mysqli_query($con, $sql[0]);
$numCourses = mysqli_num_rows($runCourses);

$runStudents = mysqli_query($con, $sql[1]);
$numStudents = mysqli_num_rows($runStudents);

$runTeachers = mysqli_query($con, $sql[2]);
$numTeachers = mysqli_num_rows($runTeachers);
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4"> 

            <div class="container">
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card bg-danger text-light" style="height: 200px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                        <h1 style="font-family: 'Times New Roman', Times, serif;">Active Students</h1>
                                        <span style="font-size: 80px;"><?php echo $numStudents?></span> <span style="font-size: 40px;">+</span>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fas fa-user-graduate" style="height: 90px; padding-top: 35px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card bg-info text-light" style="height: 200px;">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-9">
                                <h1 style="font-family: 'Times New Roman', Times, serif;">Active Teachers</h1>
                                <span style="font-size: 80px;"><?php echo $numTeachers?></span> <span style="font-size: 40px;">+</span>
                                </div>
                                    <div class="col-md-3">
                                    <i class="fas fa-chalkboard-teacher" style="height: 90px; padding-top: 35px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="card bg-success text-light" style="height: 200px;">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-9">
                                    <h1 style="font-family: 'Times New Roman', Times, serif;">Available Courses</h1>
                                    <span style="font-size: 80px;"><?php echo $numCourses?></span> <span style="font-size: 40px;">+</span>
                                    </div>
                                    <div class="col-md-3">
                                        <i class="fas fa-book" style="height: 90px; padding-top: 35px; padding-left: 130px;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div> 
    </main>
    <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between small">
                <div class="text-muted">Copyright &copy; Vitrrual University of Pakistan </div>
            </div>
        </div>
    </footer>
</div>