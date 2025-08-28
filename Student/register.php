<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en" xmlns:th="http://www.thymeleaf.org">

<head>
    <title>SkillsHub - Student Registration</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        body {
            background: url('assets/img/registerbackground.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .main-section {
            margin: 0 auto;
            margin-top: 10%;
            padding: 0;
        }

        .modal-content {
            background-color: #3b4652;
            opacity: .85;
            padding: 0 20px;
            box-shadow: 0px 0px 3px #848484;
        }

        .user-img {
            margin-top: -50px;
            margin-bottom: 35px;
        }

        .user-img img {
            width: 100xp;
            height: 100px;
            box-shadow: 0px 0px 3px #848484;
            border-radius: 50%;
        }

        .form-group input {
            height: 42px;
            font-size: 18px;
            border: 0;
            padding-left: 25px;
            border-radius: 5px;
        }

        .form-group::before {
            font-family: "Font Awesome\ 5 Free";
            position: absolute;
            left: 28px;
            font-size: 22px;
            padding-top: 4px;
        }

        button {
            width: 60%;
            margin: 5px 0 25px;
        }

        .forgot {
            padding: 5px 0;
        }

        .forgot a {
            color: white;
        }
    </style>
</head>

<body>
    <div class="modal-dialog text-center">
        <div class="col-sm-8 main-section">
            <div class="modal-content">
                <div class="col-12 user-img">
                    <img src="assets/img/user.png">
                </div>
                <form class="col-12" action="php/registerbackend.php" method="post">

                    <?php
                    if (isset($_SESSION['msg']) && isset($_SESSION['color'])) {
                        echo '<div class="alert alert-' . $_SESSION['color'] . '">';
                        echo '<div class="text-center">' . $_SESSION['msg'] . '</div>';
                        echo '</div>';
                        unset($_SESSION['msg']);
                        unset($_SESSION['color']);
                    }
                    ?>


                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter your name" name="name" required="">
                    </div>

                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="Enter your valid email" name="email" required="">
                    </div>

                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Enter your mobile" name="phone" required="">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Enter your password" name="password" required="">
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Confirm password" name="cpassword" required="">
                    </div>

                    <button type="submit" class="btn btn-primary" name="btn-register"> Register now </button>
                </form>
                <div class="col-12 forgot">
                    <a href="index.php">Login now</a>
                </div>

            </div>
        </div>
    </div>
</body>

</html>