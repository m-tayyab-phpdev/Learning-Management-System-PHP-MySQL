<?php
include 'format.php';
if (isset($_GET['coursetoken']) && isset($_GET['teachertoken'])) {
    $var_course_token = mysqli_real_escape_string($con, $_GET['coursetoken']);
    $var_teacher_token = mysqli_real_escape_string($con, $_GET['teachertoken']);
    $_SESSION['TEACHER'] = $var_teacher_token;
    $_SESSION['COURSE'] = $var_course_token;
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="container">

                <div class="row mt-5">
                    <div class="card">
                        <div class="card-header">
                            Exams
                        </div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM `exams` WHERE `course_id` = '$var_course_token' AND `teacher_id` = '$var_teacher_token'";
                            $run_sql = mysqli_query($con, $sql);
                            $num_row = mysqli_num_rows($run_sql);
                            if ($num_row > 0) { ?>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>
                                            Exam status
                                        </th>
                                        <th>
                                            Result
                                        </th>
                                    </tr>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($run_sql)) { ?>
                                        <tr>
                                            <?php
                                            $student = $_SESSION['ID'];
                                            $quiz_id = $row['exam_id'];
                                            $check = "SELECT * FROM `exam_answers` WHERE `student_id` = '$student' AND `exam_id` = '$quiz_id'";
                                            $run_check = mysqli_query($con, $check);
                                            $num_row = mysqli_num_rows($run_check);
                                            if ($num_row == 0) { ?>
                                                <td><a href="startexam.php?quiz=<?php echo $row['exam_id'] ?>&teacher=<?php echo $row['teacher_id'] ?>&course=<?php echo $var_course_token ?>">Start Exam</a></td>
                                            <?php } else { ?>
                                                <td class="text-center text-success">Done</td>
                                                <?php
                                                $check_marks = "SELECT `marks` FROM `exam_grades` WHERE `student_id` = '$student' AND `teacher_id` = '$var_teacher_token' AND `exam_id` = '$quiz_id'";
                                                $run_check_marks = mysqli_query($con, $check_marks);
                                                $row_marks = mysqli_fetch_assoc($run_check_marks);
                                                if (isset($row_marks['marks'])) {
                                                    $marks = $row_marks['marks'];
                                                } else {
                                                    $marks = null;
                                                }
                                                ?>
                                                <td><?php echo $marks ?></td>
                                            <?php } ?>

                                        </tr>
                                    <?php }
                                    ?>
                                </table>
                            <?php }
                            ?>
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