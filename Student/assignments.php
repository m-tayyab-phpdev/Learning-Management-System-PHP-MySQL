<?php
include 'format.php';
if (isset($_GET['coursetoken']) && isset($_GET['teachertoken'])) {
    $var_course_token = mysqli_real_escape_string($con, $_GET['coursetoken']);
    $var_teacher_token = mysqli_real_escape_string($con, $_GET['teachertoken']);
}

if (isset($_POST['upload-assignment'])) {
    $var_assignment_id = mysqli_real_escape_string($con, $_POST['assid']);
    $path = "assets/assignmentsolution/" . $_FILES['solutionfile']['name'];
    $fakepath = $_FILES['solutionfile']['tmp_name'];
    $teacher_id = $var_teacher_token;
    $course_id = $var_course_token;
    $student_id = $_SESSION['ID'];

    $submit = "INSERT INTO `assignment_solutions`(`ass_id`, `teacher_id`, `student_id`, `course_id`, `file_path`) VALUES ('$var_assignment_id','$teacher_id','$student_id','$course_id','$path')";
    $run_submit = mysqli_query($con, $submit);
    if ($run_submit) {
        echo "<script>alert('Assignment submitted')</script>";
    } else {
        echo "<script>alert('Internal Server error')</script>";
    }
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="row mt-4">
                <div class="col-md-6">
                    <h3 class="text-dark" style="font-family:'Times New Roman', Times, serif; font-weight: bold;"><u>Assignments</u></h3>
                </div>
            </div>


            <div class="row mt-5">
                <div class="card">
                    <div class="card-header">
                        Course name
                    </div>
                    <div class="card-body">
                        <?php

                        $fetch_assignment = "SELECT * FROM `assignments` WHERE `course_id` = '$var_course_token'";
                        $run_fetch = mysqli_query($con, $fetch_assignment);
                        $num_assignment = mysqli_num_rows($run_fetch);
                        $path = "../Teacher/";
                        if ($num_assignment) { ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Title</th>
                                    <th>Assignment file</th>
                                    <th>Start date</th>
                                    <th>Expire date</th>
                                    <th>Upload solution</th>
                                    <th>Upload</th>
                                    <th>Obt. marks</th>
                                </tr>
                                <?php while ($row = mysqli_fetch_assoc($run_fetch)) { ?>

                                    <tr>
                                        <th><?php echo $row['ass_title'] ?></th>
                                        <td><a href="<?php echo $path . $row['ass_file'] ?>">Downlaod file</a></td>
                                        <td><?php echo $row['ass_start'] ?></td>
                                        <td><?php echo $row['ass_expire'] ?></td>
                                        <?php
                                        $assid = $row['ass_id'];
                                        $student = $_SESSION['ID'];
                                        $check = "SELECT * FROM `assignment_solutions` WHERE `ass_id` = '$assid' AND `student_id` = '$student'";
                                        $run_check = mysqli_query($con, $check);
                                        $get_row = mysqli_num_rows($run_check);
                                        if ($get_row != 1) { ?>
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <td><input type="file" name="solutionfile" class="form-control"></td>
                                                <td>
                                                    <input type="hidden" name="assid" value="<?php echo $row['ass_id'] ?>">
                                                    <button type="submit" name="upload-assignment"><i class="fas fa-upload"></i></button>
                                            </form>
                                            </td>
                                        <?php } else { ?>
                                            <td class="text-success text-center">Submitted</td>
                                            <td></td>
                                        <?php }
                                        ?>

                                        <?php
                                        $fetching_row = mysqli_fetch_assoc($run_check);
                                        $id = isset($fetching_row['sol_id']) ? $fetching_row['sol_id'] : null;
                                        $result = "SELECT `marks` FROM `assignment_grades` WHERE `sol_id` = '$id'";
                                        $run_result = mysqli_query($con, $result);
                                        $count = mysqli_num_rows($run_result);
                                        if ($count == 1) {
                                            $marks = mysqli_fetch_assoc($run_result);
                                            echo '<td>' . $marks['marks'] . '&nbsp;marks</td>';
                                        } else {
                                            echo '<td class="text-center text-danger">unchecked</td>';
                                        }


                                        ?>

                                    </tr>

                                <?php } ?>
                            </table>
                        <?php } else {
                        }
                        ?>
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