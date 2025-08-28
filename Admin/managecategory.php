<?php
include 'format.php';
?>

<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">


            <div class="row mt-5">

                <div class="col-md-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        New Category
                    </button>
                </div>
                <div class="col-md-9"></div>
            </div>

            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <?php
                    if (isset($_SESSION['msg']) && isset($_SESSION['color'])) {
                        echo '<div id="alert" class="alert alert-' . $_SESSION['color'] . '">';
                        echo '<div class="text-center">' . $_SESSION['msg'] . '</div>';
                        echo '</div>';
                        unset($_SESSION['msg']);
                        unset($_SESSION['color']);
                    }
                    ?>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Manage Categories
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Serial #</th>
                                <th>Category Name</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM `course_category`";
                            $run_sql = mysqli_query($con, $sql);
                            $x = 1;
                            while ($row = mysqli_fetch_assoc($run_sql)) { ?>
                                <tr>
                                    <td><?php echo $x ?></td>
                                    <td><?php echo $row['cat_title'] ?></td>
                                    <td> <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#upd<?php echo $row['cat_id'] ?>">
                                            Update
                                        </button></td>
                                    <td><a href="php/managecategorybackend.php?del=<?php echo $row['cat_id'] ?>" class="btn btn-danger">Delete</a></td>
                                </tr>


                                <div class="modal fade" id="upd<?php echo $row['cat_id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="php/managecategorybackend.php" method="post">
                                                <div class="modal-body">
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">Category Name</span>
                                                        <input type="text" class="form-control" name="cat" value="<?php echo $row['cat_title'] ?>">
                                                        <input type="hidden" name="id" value="<?php echo $row['cat_id'] ?>">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary" name="btn-upd">Save now</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                            <?php
                                $x++;
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






<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Category Info</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="php/managecategorybackend.php" method="post">
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">Category Name</span>
                        <input type="text" class="form-control" name="cat">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="btn-cat">Create now</button>
                </div>
            </form>
        </div>
    </div>
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