<?php
include 'format.php';
if (isset($_GET['token'])) {
    $var_course_id = mysqli_real_escape_string($con, $_GET['token']);
    $sql = "SELECT * FROM (courses a, course_category b) WHERE (a.course_id = $var_course_id AND a.course_category = b.cat_id)";
    $run_sql = mysqli_query($con, $sql);
    $row = mysqli_fetch_assoc($run_sql);
}

if (isset($_POST['btn-upload'])) {
    $teacher = $_SESSION['ID'];
    $var_ass_title = mysqli_real_escape_string($con, $_POST['title']);
    $var_ass_start = mysqli_real_escape_string($con, $_POST['starton']);
    $var_ass_expire = mysqli_real_escape_string($con, $_POST['endon']);
    $path = "assets/assignments/" . $_FILES['assfile']['name'];
    $fakepath = $_FILES['assfile']['tmp_name'];
    $add_ass = "INSERT INTO `assignments`(`ass_title`,`ass_file`, `course_id`, `ass_start`, `ass_expire`, `teacher_id`) VALUES ('$var_ass_title', '$path', '$var_course_id', '$var_ass_start', '$var_ass_expire', '$teacher')";
    $run_add_ass = mysqli_query($con, $add_ass);
    if ($run_add_ass) {
        echo "<script>window.location.replace('coursedetails.php');</script>";
    } else {
        echo "<script>window.location.replace('coursedetails.php');</script>";
    }
}


if (isset($_POST['upload-quiz'])) {

    $title = mysqli_real_escape_string($con, $_POST['title']);
    $start_date = mysqli_real_escape_string($con, $_POST['start']);
    $end_date = mysqli_real_escape_string($con, $_POST['end']);


    $course_id = $var_course_id;
    $teacher_id = $_SESSION['ID'];


    $insert_quiz = "INSERT INTO quizzes (quiz_title, course_id, teacher_id, start_date, expire_date) VALUES ('$title', '$course_id', '$teacher_id', '$start_date', '$end_date')";
    mysqli_query($con, $insert_quiz);


    $quiz_id = mysqli_insert_id($con);


    for ($number = 0; $number < 5; $number++) {
        $question = mysqli_real_escape_string($con, $_POST['question'][$number]);
        $option_a = mysqli_real_escape_string($con, $_POST['optiona'][$number]);
        $option_b = mysqli_real_escape_string($con, $_POST['optionb'][$number]);
        $option_c = mysqli_real_escape_string($con, $_POST['optionc'][$number]);
        $option_d = mysqli_real_escape_string($con, $_POST['optiond'][$number]);


        $insert_question = "INSERT INTO quiz_bank (course_id, teacher_id, question, option_a, option_b, option_c, option_d, quiz_id) 
                            VALUES ('$course_id', '$teacher_id', '$question', '$option_a', '$option_b', '$option_c', '$option_d', '$quiz_id')";
        mysqli_query($con, $insert_question);
    }


    echo "<script>window.location.replace('coursedetails.php')</script>";
}




if (isset($_POST['btn-midterm'])) {

    $teacher_id = $_SESSION['ID'];
    $course_id = $var_course_id;

    $insert_exam = "INSERT INTO exams (course_id, teacher_id) 
                    VALUES ('$course_id', '$teacher_id')";
    mysqli_query($con, $insert_exam);


    $exam_id = mysqli_insert_id($con);


    for ($i = 0; $i < 20; $i++) {
        $quiz = mysqli_real_escape_string($con, $_POST['quizquestion'][$i]);
        $option_a = mysqli_real_escape_string($con, $_POST['quizoptiona'][$i]);
        $option_b = mysqli_real_escape_string($con, $_POST['quizoptionb'][$i]);
        $option_c = mysqli_real_escape_string($con, $_POST['quizoptionc'][$i]);
        $option_d = mysqli_real_escape_string($con, $_POST['quizoptiond'][$i]);

        $insert_mcq = "INSERT INTO exam_bank (Quiz, option_a, option_b, option_c, option_d, course_id, teacher_id, exam_id)
                       VALUES ('$quiz', '$option_a', '$option_b', '$option_c', '$option_d', '$course_id', '$teacher_id', '$exam_id')";
        mysqli_query($con, $insert_mcq);
    }


    echo "<script>window.location.replace('coursedetails.php');</script>";
}


if (isset($_POST['upload-lecture'])) {
    $var_title = mysqli_real_escape_string($con, $_POST['title']);
    $path = "assets/lectures/" . $_FILES['lecturevideo']['name'];
    $fakepath = $_FILES['lecturevideo']['tmp_name'];
    $teacher_id = $_SESSION['ID'];
    $course_id = $var_course_id;
    $upload_lecture = "INSERT INTO `lectures`(`teacher_id`, `course_id`, `lec_path`, `lec_title`) VALUES ('$teacher_id','$course_id','$path','$var_title')";
    $run_upload_lecture = mysqli_query($con, $upload_lecture);
    echo "<script>window.location.replace('coursedetails.php');</script>";
}


?>


<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">


            <div class="row mt-5">
                <div class="col-md-3">
                    <div class="card" style="box-shadow: 7px 2px 25px 5px grey;">
                        <div class="card-body" style="margin: auto;">
                            <img src="<?php echo $row['course_thumbnail'] ?>" style="height: 8rem; width: 14rem; border: 1px solid white; border-radius: 3px;">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="button" class="btn btn-primary form-control" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fas fa-edit"></i>
                                Make changes
                            </button>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['msg']) && isset($_SESSION['color'])) {
                        echo '<div id="alert" class="mt-3 alert alert-' . $_SESSION['color'] . '">';
                        echo '<div class="text-center">' . $_SESSION['msg'] . '</div>';
                        echo '</div>';
                        unset($_SESSION['msg']);
                        unset($_SESSION['color']);
                    }
                    ?>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card bg-danger text-light">
                                <div class="card-body">
                                    <h5 class="card-title">No. of Enrollments</h5>
                                    <p class="card-text">
                                        <?php
                                        $fetch_enrollment = "SELECT * FROM `course_enrollments` WHERE `course_id` = '$var_course_id'";
                                        $run_fetch = mysqli_query($con, $fetch_enrollment);
                                        $no_of_enrollment = mysqli_num_rows($run_fetch);
                                        echo $no_of_enrollment;
                                        ?>
                                        + Students
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h6 style="color: green;">Details</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width: 9rem;">Course Title</th>
                                    <td><?php echo $row['course_title'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 9rem;">Course Details</th>
                                    <td><?php echo $row['course_detail'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 9rem;">Course Duration</th>
                                    <td><?php echo $row['course_duration'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 9rem;">Course Price</th>
                                    <td><?php echo $row['course_price'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 9rem;">Course Category</th>
                                    <td><?php echo $row['cat_title'] ?></td>
                                </tr>
                                <tr>
                                    <th style="width: 9rem;">Course Exams</th>
                                    <td><?php echo $row['course_exams'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container-fluid mt-3">

                <div class="card">
                    <div class="card-header text-secondary">
                        Upload Video lectures
                    </div>
                    <div class="card-body">
                        <?php
                        $myid = $_SESSION['ID'];
                        $fetch_videos = "SELECT * FROM `lectures` WHERE `course_id` = '$var_course_id' AND `teacher_id` = '$myid'";
                        $run_fetch_videos = mysqli_query($con, $fetch_videos);
                        $count_video = mysqli_num_rows($run_fetch_videos);
                        if ($count_video == 0) { ?>
                            <form action="" method="post">
                                <button type="submit" name="btn-lecture" class="btn btn-success">Upload Lecture</button>
                            </form>
                            <?php
                            if (isset($_POST['btn-lecture'])) { ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered mt-2">
                                        <tr>
                                            <th>
                                                Lecture # 1
                                            </th>
                                            <input type="hidden" name="title" value="Lecture-1">
                                            <td>
                                                <input type="file" name="lecturevideo" class="form-control">
                                            </td>
                                            <td>
                                                <button type="submit" name="upload-lecture"><i class="fas fa-upload"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                            <?php }
                            ?>
                        <?php  } else { ?>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Title</th>
                                    <th>Withdraw Lecture</th>
                                </tr>
                                <?php
                                while ($lec_row = mysqli_fetch_assoc($run_fetch_videos)) { ?>
                                    <tr>
                                        <td><?php echo $lec_row['lec_title'] ?></td>
                                        <td><a href="coursedetails.php?lec=<?php echo $lec_row['lec_id'] ?>" class="btn btn-danger">Withdraw</a></td>
                                    </tr>
                                <?php }
                                ?>
                            </table>
                            <?php $serial = $count_video;
                            $serial++; ?>
                            <form action="" method="post">
                                <button type="submit" name="btn-newlecture" class="btn btn-success">Uplaod Lecture</button>
                            </form>
                            <?php
                            if (isset($_POST['btn-newlecture'])) { ?>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <table class="table table-bordered mt-2">
                                        <tr>
                                            <th>
                                                Lecture # <?php echo $serial ?>
                                            </th>
                                            <?php
                                            $title = "Lecture-" . $serial;
                                            ?>
                                            <input type="hidden" name="title" value="<?php echo $title ?>">
                                            <td>
                                                <input type="file" name="lecturevideo" class="form-control">
                                            </td>
                                            <td>
                                                <button type="submit" name="upload-lecture"><i class="fas fa-upload"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </table>
                                </form>
                        <?php  }
                        }
                        ?>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-success">
                                Assignments
                            </div>
                            <div class="card-body">
                                <?php
                                $check = "SELECT * FROM `assignments` WHERE `course_id` = $var_course_id";
                                $run_check = mysqli_query($con, $check);
                                $num_of_rows = mysqli_num_rows($run_check);
                                if ($num_of_rows > 0) { ?>

                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Start date</th>
                                                <th>End date</th>
                                                <th>Download file</th>
                                                <th>Withdraw assignment</th>
                                            </tr>

                                            <?php while ($ass_row = mysqli_fetch_assoc($run_check)) { ?>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $ass_row['ass_title'] ?></td>
                                                <td><?php echo $ass_row['ass_start'] ?></td>
                                                <td><?php echo $ass_row['ass_expire'] ?></td>
                                                <td><a href="<?php echo $ass_row['ass_file'] ?>"><button class="btn btn-warning">Download</button></a></td>
                                                <td><a href="coursedetails.php?draw=<?php echo $ass_row['ass_id'] ?>"><button class="btn btn-danger">Withdraw</button></a></td>
                                            </tr>
                                        </tbody>

                                    <?php } ?>
                                    </table>
                                    <form action="" method="post">
                                        <button type="submit" name="btn-newass" class="btn btn-success">New Assignment</button>
                                    </form>

                                    <?php
                                    if (isset($_POST['btn-newass'])) {
                                        $next = $num_of_rows;
                                        $next++;
                                        $word = "Assignment # "; ?>
                                        <table class="table table-bordered mt-2">
                                            <tr>
                                                <th><?php echo $word . $next; ?></th>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <td><input type="file" class="form-control" name="assfile"></td>
                                                    <td><input type="hidden" name="title" value="<?php echo $word . $next ?>" required=""></td>
                                                    <td>Starts on: <input type="date" name="starton" class="form-control" required=""></td>
                                                    <td>Expires on: <input type="date" name="endon" class="form-control" required=""></td>
                                                    <td><button type="submit" name="btn-upload"><i class="fas fa-upload"></i></button></td>
                                                </form>
                                            </tr>
                                        </table>
                                    <?php    }
                                } else { ?>
                                    <form action="" method="post">
                                        <button type="submit" name="btn-ass" class="btn btn-success">New Assignment</button>
                                    </form>
                                    <?php
                                    if (isset($_POST['btn-ass'])) {
                                        $serial = 1;
                                        $word = "Assignment # ";
                                    ?>
                                        <table class="table table-bordered mt-2">
                                            <tr>
                                                <th><?php echo $word . $serial; ?></th>
                                                <form action="" method="post" enctype="multipart/form-data">
                                                    <td><input type="file" class="form-control" name="assfile"></td>
                                                    <td><input type="hidden" name="title" value="<?php echo $word . $serial ?>" required=""></td>
                                                    <td>Starts on: <input type="date" name="starton" class="form-control" required=""></td>
                                                    <td>Expires on: <input type="date" name="endon" class="form-control" required=""></td>
                                                    <td><button type="submit" name="btn-upload"><i class="fas fa-upload"></i></button></td>
                                                </form>
                                            </tr>
                                        </table>
                                <?php }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-primary">
                                Quizzes
                            </div>
                            <div class="card-body">
                                <?php
                                $var_user_id = $_SESSION['ID'];
                                $quiz = "SELECT * FROM `quizzes` WHERE `course_id` = '$var_course_id' AND `teacher_id` = '$var_user_id'";
                                $run_quiz = mysqli_query($con, $quiz);
                                $num_of_quiz_rows = mysqli_num_rows($run_quiz);
                                if ($num_of_quiz_rows > 0) { ?>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th>Title</th>
                                            <th>Start date</th>
                                            <th>End date</th>
                                            <th>Widthdraw</th>
                                        </tr>
                                        <?php
                                        while ($quiz_row = mysqli_fetch_assoc($run_quiz)) { ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $quiz_row['quiz_title'] ?></td>
                                                    <td><?php echo $quiz_row['start_date'] ?></td>
                                                    <td><?php echo $quiz_row['expire_date'] ?></td>
                                                    <td><a href="coursedetails.php?with=<?php echo $quiz_row['quiz_id'] ?>"><button class="btn btn-danger">Withdraw</button></a></td>
                                                </tr>
                                            </tbody>
                                        <?php  } ?>

                                    </table>
                                    <form action="" method="post">
                                        <button type="submit" name="newquiz" class="btn btn-success">New Quiz</button>
                                    </form>
                                    <?php
                                    if (isset($_POST['newquiz'])) {
                                        $num = $num_of_quiz_rows;
                                        $num++;
                                        $quiz_name = "Quiz # " . $num;
                                        $numbering = 1; ?>

                                        <form action="" method="post">
                                            <table>
                                                <tr>
                                                    <th><?php echo $quiz_name ?></th>
                                                    <?php
                                                    for ($number = 1; $number <= 5; $number++) { ?>
                                                <tr>
                                                    <td>Question # <?php echo $numbering ?> <textarea name="question[]" class="form-control"></textarea></td>
                                                    <td>Option <textarea name="optiona[]" class="form-control"></textarea></td>
                                                    <td>Option <textarea name="optionb[]" class="form-control"></textarea></td>
                                                    <td>Option <textarea name="optionc[]" class="form-control"></textarea></td>
                                                    <td>Option <textarea name="optiond[]" class="form-control"></textarea></td>
                                                </tr>
                                            <?php
                                                        $numbering++;
                                                    }
                                            ?>
                                            <td>Title: <input type="text" name="title" class="form-control"></td>
                                            <th>Start date <input type="date" name="start" class="form-control"></th>
                                            <th>Expire date <input type="date" name="end" class="form-control"></th>
                                            <th><button type="submit" name="upload-quiz"><i class="fas fa-upload"></i></button></th>
                                            </tr>

                                            </table>
                                        </form>


                                    <?php }
                                    ?>

                                <?php } else { ?>
                                    <form action="" method="post">
                                        <button type="submit" name="btn-quiz" class="btn btn-success">New Quiz</button>
                                    </form>
                                    <?php
                                    if (isset($_POST['btn-quiz'])) {
                                        $quiz_name = "Quiz # 1";
                                        $numbering = 1;
                                    ?>
                                        <form action="" method="post">
                                            <table>
                                                <tr>
                                                    <th><?php echo $quiz_name ?></th>
                                                    <?php
                                                    for ($number = 1; $number <= 5; $number++) { ?>
                                                <tr>
                                                    <td>Question # <?php echo $numbering ?> <textarea name="question[]"></textarea></td>
                                                    <td>Option <textarea name="optiona[]" class="form-control"></textarea></td>
                                                    <td>Option <textarea name="optionb[]" class="form-control"></textarea></td>
                                                    <td>Option <textarea name="optionc[]" class="form-control"></textarea></td>
                                                    <td>Option <textarea name="optiond[]" class="form-control"></textarea></td>
                                                </tr>
                                            <?php
                                                        $numbering++;
                                                    }
                                            ?>
                                            <td>Title: <input type="text" name="title" class="form-control"></td>
                                            <th>Start date <input type="date" name="start" class="form-control"></th>
                                            <th>Expire date <input type="date" name="end" class="form-control"></th>
                                            <th><button type="submit" name="upload-quiz"><i class="fas fa-upload"></i></button></th>
                                            </tr>

                                            </table>
                                        </form>
                                    <?php  }
                                    ?>

                                <?php  }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3 mb-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header text-danger">
                                Exams
                            </div>
                            <div class="card-body">
                                <?php

                                $current_teacher_id = $_SESSION['ID'];
                                $fetch_exam_exist = "SELECT * FROM `exams` WHERE `course_id` = '$var_course_id' AND `teacher_id` = '$current_teacher_id'";
                                $run_fetch_exam_exist = mysqli_query($con, $fetch_exam_exist);
                                $exam_row = mysqli_num_rows($run_fetch_exam_exist);
                                $exam_array = mysqli_fetch_assoc($run_fetch_exam_exist);

                                if ($exam_row > 0) {

                                ?>
                                    <a href="coursedetails.php?drawexam=<?php echo $exam_array['exam_id'] ?>" class="btn btn-danger">Withdraw Exam</a>
                                <?php
                                } else {

                                ?>
                                    <form action="" method="post">
                                        <button type="submit" class="btn btn-success" name="btn-exam">Make Exam</button>
                                    </form>

                                    <?php

                                    if (isset($_POST['btn-exam'])) {
                                    ?>
                                        <form action="" method="post">
                                            <table class="table table-bordered mt-2">

                                                <?php

                                                for ($i = 1; $i <= 20; $i++) { ?>
                                                    <tr>
                                                        <th><span>Quiz:</span><span><?php echo $i; ?></span></th>
                                                        <td>Question<textarea name="quizquestion[]" class="form-control"></textarea></td>
                                                        <td>Option A<textarea name="quizoptiona[]" class="form-control"></textarea></td>
                                                        <td>Option B<textarea name="quizoptionb[]" class="form-control"></textarea></td>
                                                        <td>Option C<textarea name="quizoptionc[]" class="form-control"></textarea></td>
                                                        <td>Option D<textarea name="quizoptiond[]" class="form-control"></textarea></td>
                                                    </tr>
                                                <?php } ?>
                                            </table>

                                            <button type="submit" class="btn btn-success" name="btn-midterm">Launch exam</button>
                                        </form>
                                    <?php
                                    }
                                    ?>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <form action="php/updatecoursedetail.php" method="post" enctype="multipart/form-data">
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update your course</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i></span>
                                            <input type="text" class="form-control" name="cname" value="<?php echo $row['course_title'] ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i></span>
                                            <input type="number" class="form-control" name="cprice" value="<?php echo $row['course_price'] ?>" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-list"></i>
                                            </span>
                                            <select name="ccategory" class="form-control" required="">
                                                <option value="">Select Course Category</option>
                                                <?php
                                                $sqli = "SELECT * FROM `course_category`";
                                                $run_sqli = mysqli_query($con, $sqli);
                                                $num_rows = mysqli_num_rows($run_sqli);
                                                if ($num_rows > 0) {
                                                    while ($rows = mysqli_fetch_assoc($run_sqli)) { ?>
                                                        <option value="<?php echo $rows['cat_id'] ?>"><?php echo $rows['cat_title'] ?></option>
                                                    <?php   }
                                                } else { ?>
                                                    <option value="">No record found</option>
                                                <?php }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-clipboard"></i>
                                            </span>
                                            <select name="cexam" class="form-control" required="">
                                                <option value="">Select Exams type</option>
                                                <option value="Midterm & Final term both">Midterm & Finalterm both</option>
                                                <option value="Finalterm only">Finalterm only</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-hourglass-half"></i></span>
                                            <input type="number" class="form-control" name="cdurationint" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-group mb-3">
                                            <select name="cdurationvar" class="form-control" required="">
                                                <option value="">Select duration</option>
                                                <option value="Days">Days</option>
                                                <option value="Weeks">Weeks</option>
                                                <option value="Months">Months</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea name="cdetail" class="form-control" rows="5" required=""><?php echo $row['course_detail'] ?></textarea>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <input type="file" class="form-control" name="cthumbnail" required="">
                                    </div>
                                </div>
                                <input type="hidden" name="token" value="<?php echo $row['course_id'] ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btn-upd"><i class="fas fa-save"></i>
                                    Save</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

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



<script>
    window.onload = function() {
        const alertElement = document.getElementById('alert');
        if (alertElement) {
            setTimeout(function() {
                alertElement.style.display = 'none';
            }, 1500);
        }
    };
</script>