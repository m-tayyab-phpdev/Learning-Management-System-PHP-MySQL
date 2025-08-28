<?php
include 'format.php';

?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">

            <div class="container">
                <div class="row mt-3 mb-3">
                    <div class="card">
                        <div class="card-header">
                            Exams Result
                        </div>
                        <div class="card-body">

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Student name</th>
                                    <th>Declare result</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $teacher = $_SESSION['ID'];
                                $sql = "SELECT * FROM (exam_answers a, exams b, users c) WHERE (a.teacher_id = '$teacher' AND a.student_id = c.user_id AND a.exam_id = b.exam_id)";
                                $run_sql = mysqli_query($con, $sql);

                                $counter = 0;

                                while ($row = mysqli_fetch_assoc($run_sql)) {
                                    $counter++;


                                    if ($counter % 20 == 1) {
                                ?>
                                        <tr>
                                            <td>Exams</td>
                                            <td><?php echo $row['user_name'] ?></td>
                                            <td><a href="declareexamresult.php?examid=<?php echo $row['exam_id'] ?>&studentid=<?php echo $row['student_id'] ?>">Declare result</a></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
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