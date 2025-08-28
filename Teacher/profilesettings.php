<?php
include 'format.php';
$var_id = mysqli_real_escape_string($con, $_SESSION['ID']);
$sql = "SELECT * FROM `users` WHERE `user_id` = '$var_id'";
$run_sql = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($run_sql);
?>

<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <div class="card mt-4">
            <form action="php/profilesettingsbackend.php" method="post">
              <div class="card-header">
                Profile settings
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
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i>
                      </span>
                      <input type="text" class="form-control" name="name" value="<?php echo $row['user_name'] ?>">
                    </div>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-5">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i>
                      </span>
                      <input type="email" class="form-control" name="email" value="<?php echo $row['user_email'] ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i>
                      </span>
                      <input type="text" class="form-control" name="phone" value="<?php echo $row['user_phone'] ?>">
                    </div>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-5">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-lock"></i>
                      </span>
                      <input type="password" class="form-control" name="password" placeholder="New password">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-5">
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="fas fa-key"></i>
                      </span>
                      <input type="password" class="form-control" name="cpassword" placeholder="Confirm password">
                    </div>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-5">
                  </div>
                </div>
                <div class="row">
                  <button type="submit" name="btn-updprofile" class="btn btn-success"><i class="fas fa-save"></i>
                    &nbsp;Save</button>
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