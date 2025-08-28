<?php
include 'format.php';
if (isset($_GET['examid']) && isset($_GET['studentid'])) {
    $var_exam_id = mysqli_real_escape_string($con, $_GET['examid']);
    $var_student_id = mysqli_real_escape_string($con, $_GET['studentid']);
    $teacher_id = $_SESSION['ID'];
    $sql = "SELECT * FROM (exam_answers a, exam_bank b) WHERE (a.student_id = '$var_student_id' AND a.teacher_id = '$teacher_id' AND a.exam_id = '$var_exam_id' AND a.exam_bank_id = b.exam_bank_id)";
    $run_sql = mysqli_query($con, $sql);
}

if (isset($_POST['exam-marks'])) {
    $var_exam = mysqli_real_escape_string($con, $_POST['examid']);
    $var_student = mysqli_real_escape_string($con, $_POST['studentid']);
    $var_teacher = mysqli_real_escape_string($con, $_POST['teacherid']);
    $var_marks = mysqli_real_escape_string($con, $_POST['marks']);

    $marks = "INSERT INTO `exam_grades`(`student_id`, `exam_id`, `teacher_id`, `marks`) VALUES ('$var_student','$var_exam','$var_teacher','$var_marks')";
    $run_marks = mysqli_query($con, $marks);
    if ($run_marks) {
        echo "<script>window.location.replace('examresult.php')</script>";
    }
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="container">
                <div class="row mt-3 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Quizzes Result
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Questions</th>
                                <th>Answers</th>
                            </tr>
                            <?php
                            while ($row = mysqli_fetch_assoc($run_sql)) { ?>
                                <tr>
                                    <td><?php echo $row['Quiz'] ?></td>
                                    <td><?php echo $row['answer'] ?></td>
                                </tr>
                            <?php }
                            ?>
                        </table>
                    </div>

                    <?php
                    $check = "SELECT * FROM `exam_grades` WHERE `student_id` = '$var_student_id' AND `teacher_id` = '$teacher_id' AND `exam_id` = '$var_exam_id'";
                    $run_check = mysqli_query($con, $check);
                    $count = mysqli_num_rows($run_check);
                    if ($count == 0) { ?>
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <span style="margin-left: 35px; font-weight:bold;">Obtained Marks</span>
                            </div>
                            <div class="col-md-8">
                                <form action="" method="post">
                                    <input type="text" class="form-control" name="marks">
                                    <input type="hidden" name="studentid" value="<?php echo $var_student_id ?>">
                                    <input type="hidden" name="examid" value="<?php echo $var_exam_id ?>">
                                    <input type="hidden" name="teacherid" value="<?php echo $teacher_id ?>">

                            </div>
                            <div class="col-md-2">
                                <button type="submit" name="exam-marks"><i class="fas fa-upload"></i></button>
                                </form>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="row mb-1">
                            <div class="col-md-4"></div>
                            <div class="col-md-4 text-center text-danger">
                                <span>Already result declared</span>
                            </div>
                            <div class="col-md-4"></div>
                        </div>
                    <?php }
                    ?>


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