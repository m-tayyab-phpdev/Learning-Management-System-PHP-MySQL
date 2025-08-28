<?php
include 'format.php';
if (isset($_POST['btn-marks'])) {
    $var_marks = mysqli_real_escape_string($con, $_POST['marks']);
    $var_solution = mysqli_real_escape_string($con, $_POST['solutionid']);
    $var_ass = mysqli_real_escape_string($con, $_POST['assid']);
    $announce  = "INSERT INTO `assignment_grades` (`marks`, `sol_id`, `ass_id`)  VALUES ('$var_marks', '$var_solution', '$var_ass')";
    $run_announce = mysqli_query($con, $announce);
    if ($run_announce) {
        $status = "checked";
        $change_status = "UPDATE `assignment_solutions` SET `result_status` = '$status' WHERE `sol_id` = '$var_solution'";
        $run_change_status = mysqli_query($con, $change_status);
    }
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="container">
                <div class="row mt-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Assignments Result
                        </div>
                    </div>
                </div>


                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Student</th>
                            <th>Start date</th>
                            <th>End date</th>
                            <th>Solution file</th>
                            <th>Marks</th>
                            <th>Go</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $teacher = $_SESSION['ID'];
                        $sql = "SELECT * FROM (users a, assignments b, assignment_solutions c) WHERE a.user_id = '$teacher' AND b.teacher_id = '$teacher' AND c.teacher_id = '$teacher'";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_assoc($run)) { ?>
                            <tr>
                                <td><?php echo $row['ass_title'] ?></td>
                                <td><?php
                                    $name =  $row['student_id'];
                                    $name_sql = "SELECT `user_name` FROM `users` WHERE `user_id` = '$name'";
                                    $run_sql = mysqli_query($con, $name_sql);
                                    $var_name = mysqli_fetch_assoc($run_sql);
                                    echo $var_name['user_name'];
                                    ?></td>
                                <td><?php echo $row['ass_start'] ?></td>
                                <td><?php echo $row['ass_expire'] ?></td>
                                <td><a href="<?php
                                                $path = "../Student/";
                                                echo $path . $row['file_path']
                                                ?>">Download file</a></td>
                                <?php
                                $status = $row['result_status'];
                                if ($status == "unchecked") { ?>
                                    <td>
                                        <form action="" method="post">
                                            <input type="text" name="marks">
                                            <input type="hidden" name="solutionid" value="<?php echo $row['sol_id'] ?>">
                                            <input type="hidden" name="assid" value="<?php echo $row['ass_id'] ?>">
                                    </td>
                                    <td><button type="submit" name="btn-marks" class="btn btn-warning">Announce</button></form>
                                    </td>
                                <?php } else { ?>
                                    <td class="text-center text-success">Done</td>
                                    <td></td>
                                <?php }
                                ?>
                            </tr>
                        <?php }
                        ?>
                    </tbody>
                </table>

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