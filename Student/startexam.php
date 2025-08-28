<?php
include 'format.php';

function alert()
{
    echo "<script>alert('Thank you for attempting quiz')</script>";
}

$var_quiz_id = isset($_GET['quiz']) ? mysqli_real_escape_string($con, $_GET['quiz']) : 0;
$var_teacher_id = isset($_GET['teacher']) ? mysqli_real_escape_string($con, $_GET['teacher']) : 0;
$var_course_id = isset($_GET['course']) ? mysqli_real_escape_string($con, $_GET['course']) : 0;

$sql_total_questions = "SELECT COUNT(*) as total FROM `exam_bank` WHERE `exam_id` = '$var_quiz_id'";
$result_total = mysqli_query($con, $sql_total_questions);
$total_questions = mysqli_fetch_assoc($result_total)['total'];

if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
} elseif (isset($_POST['btn-saveandnext'])) {
    $_SESSION['current_question']++;
}


if ($_SESSION['current_question'] >= $total_questions) {
    if (isset($_POST['btn-saveandnext'])) {

        $quiz_id = $var_quiz_id;
        $teacher_id = $var_teacher_id;
        $student_id = $_SESSION['ID'];
        $answer = mysqli_real_escape_string($con, $_POST['answer']);
        $bank_id = mysqli_real_escape_string($con, $_POST['bankid']);

        $sqlsave = "INSERT INTO `exam_answers`(`exam_id`, `exam_bank_id`, `teacher_id`, `student_id`, `answer`) 
                    VALUES ('$quiz_id','$bank_id','$teacher_id','$student_id','$answer')";
        $run_sql_save = mysqli_query($con, $sqlsave);
    }

    alert();

    exit;
}


$current_question_index = $_SESSION['current_question'];
$sql_question = "SELECT * FROM `exam_bank` WHERE `exam_id` = '$var_quiz_id' LIMIT $current_question_index, 1";
$result_question = mysqli_query($con, $sql_question);
$question_data = mysqli_fetch_assoc($result_question);

if (isset($_POST['btn-saveandnext'])) {
    $quiz_id = $var_quiz_id;
    $teacher_id = $var_teacher_id;
    $student_id = $_SESSION['ID'];
    $answer = mysqli_real_escape_string($con, $_POST['answer']);
    $bank_id = mysqli_real_escape_string($con, $_POST['bankid']);

    $sqlsave = "INSERT INTO `exam_answers`(`exam_id`, `exam_bank_id`, `teacher_id`, `student_id`, `answer`) 
                VALUES ('$quiz_id','$bank_id','$teacher_id','$student_id','$answer')";
    $run_sql_save = mysqli_query($con, $sqlsave);
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="container-fluid px-4">
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <div class="col-md-8">

                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="text-dark">Question No: <?php echo $current_question_index + 1; ?> of <?php echo $total_questions; ?></h4>
                            </div>

                            <div class="question-container" style="background-color: #6a1b9a; padding: 20px; border-radius: 8px; color: white; margin-top: 50px;">
                                <h5><?php echo $question_data['Quiz']; ?></h5>
                            </div>

                            <div class="answer-section" style="background-color: white; border-radius: 8px; padding: 20px; margin-top: 20px; border: #0d6efd 1px solid;">
                                <form method="post" action="">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="answer" value="<?php echo $question_data['option_a']; ?>" id="answer1" required>
                                        <label class="form-check-label" for="answer1">
                                            <?php echo $question_data['option_a']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="answer" value="<?php echo $question_data['option_b']; ?>" id="answer2">
                                        <label class="form-check-label" for="answer2">
                                            <?php echo $question_data['option_b']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="answer" value="<?php echo $question_data['option_c']; ?>" id="answer3">
                                        <label class="form-check-label" for="answer3">
                                            <?php echo $question_data['option_c']; ?>
                                        </label>
                                    </div>
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="answer" value="<?php echo $question_data['option_d']; ?>" id="answer4">
                                        <label class="form-check-label" for="answer4">
                                            <?php echo $question_data['option_d']; ?>
                                        </label>
                                    </div>
                                    <input type="hidden" name="bankid" value="<?php echo $question_data['exam_bank_id']; ?>">
                                    <div class="row">
                                        <div class="col-md-9"></div>
                                        <div class="col-md-3">
                                            <button type="submit" name="btn-saveandnext" class="btn btn-success form-control">Save and Next</button>
                                        </div>
                                    </div>
                                </form>
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
                <div class="text-muted">Copyright &copy; Virtual University of Pakistan </div>
            </div>
        </div>
    </footer>
</div>