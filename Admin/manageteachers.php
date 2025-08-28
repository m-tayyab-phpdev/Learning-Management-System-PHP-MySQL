<?php
include 'format.php';
$type = "Teacher";
$sql = "SELECT * FROM `users` WHERE `user_type` = '$type'";
$run = mysqli_query($con, $sql);

if (isset($_GET['activate'])) {
    $change = "Active";
    $var_id = mysqli_real_escape_string($con, $_GET['activate']);
    $change_sql = "UPDATE `users` SET `user_activity_status` = '$change' WHERE `user_id` = '$var_id'";
    $run_change = mysqli_query($con, $change_sql);
    if ($run_change) {
        echo "<script>window.location.replace('manageteachers.php')</script>";
    }
}

if (isset($_GET['deactivate'])) {
    $change = "Deactive";
    $var_id = mysqli_real_escape_string($con, $_GET['deactivate']);
    $change_sql = "UPDATE `users` SET `user_activity_status` = '$change' WHERE `user_id` = '$var_id'";
    $run_change = mysqli_query($con, $change_sql);
    if ($run_change) {
        echo "<script>window.location.replace('manageteachers.php')</script>";
    }
}

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="card mb-4 mt-4">
                <div class="card-body">
                    View Teachers details
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Teacher management portal
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone no</th>
                                <th>Active courses</th>
                                <th>Active students</th>
                                <th>Profile status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = mysqli_fetch_assoc($run)) { ?>
                                <tr>
                                    <td><?php echo $row['user_name'] ?></td>
                                    <td><?php echo $row['user_email'] ?></td>
                                    <td><?php echo $row['user_phone'] ?></td>
                                    <td><?php
                                        $id = $row['user_id'];
                                        $active_course = "SELECT * FROM `courses` WHERE `teacher_id` = '$id'";
                                        $run_course = mysqli_query($con, $active_course);
                                        $num_course = mysqli_num_rows($run_course);
                                        echo $num_course;
                                        ?></td>
                                    <td>
                                        <?php
                                        $id = $row['user_id'];
                                        $active_students = "SELECT * FROM `course_enrollments` WHERE `teacher_id` = '$id'";
                                        $run_students = mysqli_query($con, $active_students);
                                        $num_students = mysqli_num_rows($run_students);
                                        echo $num_students;
                                        ?>
                                    </td>

                                    <?php
                                    $account = $row['user_activity_status'];
                                    if ($account == "Active") { ?>
                                        <td><a href="manageteachers.php?deactivate=<?php echo $row['user_id'] ?>" class="btn btn-danger">Deactivate</a></td>
                                    <?php } else { ?>
                                        <td><a href="manageteachers.php?activate=<?php echo $row['user_id'] ?>" class="btn btn-success">Activate</a></td>
                                    <?php }
                                    ?>

                                </tr>
                            <?php }
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