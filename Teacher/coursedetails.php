<?php
include 'format.php';

if (isset($_GET['draw'])) {
    $var_token = mysqli_real_escape_string($con, $_GET['draw']);
    $ass_grades_withdraw = "DELETE FROM `assignment_grades` WHERE `ass_id` = '$var_token'";
    $run_assgrades_withdraw = mysqli_query($con, $ass_grades_withdraw);
    if ($run_assgrades_withdraw) {
        $ass_sol_withdraw = "DELETE FROM `assignment_solutions` WHERE `ass_id` = '$var_token'";
        $run_asssol_withdraw = mysqli_query($con, $ass_sol_withdraw);
        if ($run_asssol_withdraw) {
            $ass_withdraw = "DELETE FROM `assignments` WHERE `ass_id` = '$var_token'";
            $run_ass_withdraw = mysqli_query($con, $ass_withdraw);
            if ($run_ass_withdraw) {
                echo "<script>window.location.replace('coursedetails.php');</script>";
            } else {
                echo "<script>window.location.replace('coursedetails.php');</script>";
            }
        }
    }
}



if (isset($_GET['with'])) {
    $var_token = mysqli_real_escape_string($con, $_GET['with']);
    $quizgrades = "DELETE FROM `quiz_grades` WHERE `quiz_id` = '$var_token'";
    $run_quizgrades = mysqli_query($con, $quizgrades);
    if ($run_quizgrades) {
        $quiz_answers = "DELETE FROM `quiz_answers` WHERE `quiz_id` = '$var_token'";
        $run_quizanswers = mysqli_query($con, $quiz_answers);
        if ($run_quizanswers) {
            $quizbank_withdraw = "DELETE FROM `quiz_bank` WHERE `quiz_id` = '$var_token'";
            $run_quizbank = mysqli_query($con, $quizbank_withdraw);
            if ($run_quizbank) {
                $quiz_withdraw = "DELETE FROM `quizzes` WHERE `quiz_id` = '$var_token'";
                $run_quiz = mysqli_query($con, $quiz_withdraw);
                if ($run_quiz) {
                    echo "<script>window.location.replace('coursedetails.php');</script>";
                } else {
                    echo "<script>window.location.replace('coursedetails.php');</script>";
                }
            }
        }
    }
}

if (isset($_GET['lec'])) {
    $var_lec_id = mysqli_real_escape_string($con, $_GET['lec']);
    $remove_lec = "DELETE FROM `lectures` WHERE `lec_id` = '$var_lec_id'";
    $run_remove_lec = mysqli_query($con, $remove_lec);
    if ($run_remove_lec) {
        echo "<script>window.location.replace('coursedetails.php');</script>";
    }
}


if (isset($_GET['drawexam'])) {
    $var_exam_id = mysqli_real_escape_string($con, $_GET['drawexam']);
    $exam_grades = "DELETE FROM `exam_grades` WHERE `exam_id` = '$var_exam_id'";
    $run_examgrades = mysqli_query($con, $exam_grades);
    if ($run_examgrades) {
        $exam_answers = "DELETE FROM `exam_answers` WHERE `exam_id` = '$var_exam_id'";
        $run_examasnwer = mysqli_query($con, $exam_answers);
        if ($run_examasnwer) {
            $draw_exam_bank = "DELETE FROM `exam_bank` WHERE `exam_id` = '$var_exam_id'";
            $run_draw_exam = mysqli_query($con, $draw_exam_bank);
            if ($run_draw_exam) {
                $draw_exam = "DELETE FROM `exams` WHERE `exam_id` = '$var_exam_id'";
                $run_draw = mysqli_query($con, $draw_exam);
                if ($run_draw) {
                    echo "<script>window.location.replace('coursedetails.php');</script>";
                }
            }
        }
    }
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="card mb-4 mt-4">
                <div class="card-body">
                    View Course Details
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Your Courses
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Duration</th>
                                <th>More Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $var_id = $_SESSION['ID'];
                            $sql = "SELECT * FROM (courses a, course_category b) WHERE (a.teacher_id = $var_id AND a.course_category = b.cat_id)";
                            $run_sql = mysqli_query($con, $sql);
                            $num_rows = mysqli_num_rows($run_sql);
                            if ($num_rows > 0) {
                                while ($row = mysqli_fetch_assoc($run_sql)) { ?>

                                    <tr>
                                        <td><?php echo $row['course_title'] ?></td>
                                        <td><?php echo $row['cat_title'] ?></td>
                                        <td><?php echo $row['course_price'] ?></td>
                                        <td><?php echo $row['course_duration'] ?></td>
                                        <td><a href="coursedetailsreadmore.php?token=<?php echo $row['course_id'] ?>"><button style="border: 1px solid grey; border-radius: 4px;">Read more</button></a></td>
                                    </tr>

                            <?php  }
                            }
                            ?>
                        </tbody>
                    </table>
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