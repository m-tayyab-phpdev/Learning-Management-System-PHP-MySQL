<?php
include 'format.php';
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="card mt-4">
                        <form action="php/lanchcoursebackend.php" method="post" enctype="multipart/form-data">
                            <div class="card-header">
                                Course Details
                            </div>
                            <?php
                            if (isset($_SESSION['msg']) && isset($_SESSION['color'])) {
                                echo '<div id="alert" class="alert alert-' . $_SESSION['color'] . '">';
                                echo '<div class="text-center">' . $_SESSION['msg'] . '</div>';
                                echo '</div>';
                                unset($_SESSION['msg']);
                                unset($_SESSION['color']);
                            }
                            ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i>
                                            </span>
                                            <input type="text" class="form-control" name="cname" placeholder="Course name" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-3">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-hourglass-half"></i>
                                            </span>
                                            <input type="number" class="form-control" name="cdurationint" placeholder="Course Duration" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
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
                                    <div class="col-md-5">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-dollar-sign"></i>
                                            </span>
                                            <input type="number" class="form-control" name="cprice" placeholder="Course Price" required="">
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" name="cthumbnail" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
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
                                    <div class="col-md-2"></div>
                                    <div class="col-md-5">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-list"></i>
                                            </span>
                                            <select name="ccategory" class="form-control" required="">
                                                <option value="">Select Course Category</option>
                                                <?php
                                                $sql = "SELECT * FROM `course_category`";
                                                $run_sql = mysqli_query($con, $sql);
                                                $num_rows = mysqli_num_rows($run_sql);
                                                if ($num_rows > 0) {
                                                    while ($row = mysqli_fetch_assoc($run_sql)) { ?>
                                                        <option value="<?php echo $row['cat_id'] ?>"><?php echo $row['cat_title'] ?></option>
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
                                            <textarea name="cdetail" class="form-control" placeholder="Course Details" rows="5" required=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <button type="submit" name="btn-lanch" class="btn btn-success"><i class="fas fa-rocket"></i>
                                        &nbsp;Lanch now</button>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
                <div class="col-md-1"></div>
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



<script>
    window.onload = function() {
        const alertElement = document.getElementById('alert');
        if (alertElement) {
            setTimeout(function() {
                alertElement.style.display = 'none';
            }, 1000);
        }
    };
</script>