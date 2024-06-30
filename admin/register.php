<?php
include_once '../classes/Register.php';
$register = new Register();
// <!-- ---------------------------------------------------- -->

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addUser = $register->addUser($_POST);
}
// <!-- ---------------------------------------------------- -->
?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | Minible - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    <style>
        * {
            font-family: 'Jost', sans-serif !important;
        }
    </style>

</head>

<body class="authentication-bg">
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-7">

                    <!-- ---------------------------------------------------- -->
                    <?php
                    if (isset($addUser)) {
                    ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong><?= $addUser ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php
                    }
                    ?>
                    <!-- ---------------------------------------------------- -->

                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">SIGN UP !</h5>
                            </div>
                            <div class="p-2 mt-4">

                                <form method="post">
                                    <div class="mb-3">
                                        <label class="form-label" for="username">NAME*</label>
                                        <input name="name" type="text" class="form-control" id="username" placeholder="Enter Name">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userphone">PHONE*</label>
                                        <input name="phone" type="phone" class="form-control" id="userphone" placeholder="Enter Phone">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="useremail">EMAIL*</label>
                                        <input name="email" type="email" class="form-control" id="useremail" placeholder="Enter Email">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">PASSWORD*</label>
                                        <input name="password" type="password" class="form-control" id="userpassword" placeholder="Enter Password">
                                    </div>

                                    <div class="mt-3 ">
                                        <button class="btn btn-primary w-sm waves-effect waves-light" type="submit">Log In</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        <p class="mb-0">Have An Account ? <a href="login.php" class="fw-medium text-primary"> Sign In Now </a> </p>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>
    <script src="assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

    <!-- bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <!-- App js -->
    <script src="assets/js/app.js"></script>

</body>

</html>