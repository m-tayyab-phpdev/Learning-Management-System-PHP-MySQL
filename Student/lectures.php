<?php
include 'format.php';
if (isset($_GET['coursetoken']) && isset($_GET['teachertoken'])) {
    $var_course_token = mysqli_real_escape_string($con, $_GET['coursetoken']);
    $var_teacher_token = mysqli_real_escape_string($con, $_GET['teachertoken']);
}
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="row mt-4">
                <div class="col-md-10"></div>
                <div class="col-md-2">
                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            Lectures No
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="max-height: 200px; overflow-y: auto;">
                            <?php
                            $fetch_lectures = "SELECT * FROM `lectures` WHERE `course_id` = '$var_course_token' AND `teacher_id` = '$var_teacher_token'";
                            $run_fetch_lectures = mysqli_query($con, $fetch_lectures);
                            $num_of_lectures  = mysqli_num_rows($run_fetch_lectures);
                            if ($num_of_lectures > 0) { ?>

                                <?php while ($lec_row = mysqli_fetch_assoc($run_fetch_lectures)) { ?>
                                    <li>
                                        <form action="" method="post">
                                            <input type="hidden" name="id" value="<?php echo $lec_row['lec_id'] ?>">
                                            <button type="submit" class="dropdown-item" name="btn-play"><?php echo $lec_row['lec_title'] ?></button>
                                        </form>
                                    </li>
                                <?php    } ?>

                            <?php  } else { ?>
                                <li><a class="dropdown-item" href="#">No Lecture found</a></li>
                            <?php  }
                            ?>
                        </ul>
                    </div>

                </div>
            </div>

            <?php
            if (isset($_POST['btn-play'])) {
                $lecture_id = $_POST['id'];
                $video_path = "../Teacher/";
                $sql = "SELECT * FROM `lectures` WHERE `lec_id` = '$lecture_id'";
                $run_sql = mysqli_query($con, $sql);
                $row = mysqli_fetch_assoc($run_sql); ?>
                <div class="row">
                    <h4 style="font-family:'Times New Roman', Times, serif; font-weight:bold"><u><?php echo $row['lec_title'] ?></u></h4>
                </div>
                <video width="100%" height="400px" controls>
                    <source src="<?php echo $video_path . $row['lec_path'] ?>">
                </video>
            <?php }
            ?>

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
    document.querySelectorAll('.dropdown-submenu').forEach(function(submenu) {
        submenu.addEventListener('mouseover', function() {
            submenu.querySelector('.dropdown-menu').style.display = 'block';
        });
        submenu.addEventListener('mouseout', function() {
            submenu.querySelector('.dropdown-menu').style.display = 'none';
        });
    });
</script>