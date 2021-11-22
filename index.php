<?php

session_start();
require_once 'db.php';

if (isset($_SESSION['dutypaysession'])!="") {
 header("Location: dashboard.php");
 exit;
}

if (isset($_POST['btn-login'])) {
 
 $username = strip_tags($_POST['username']);
 $password = strip_tags($_POST['password']);
 
 $username = $DBcon->real_escape_string($username);
 $password = $DBcon->real_escape_string($password);
 
$query = $DBcon->query("SELECT id, username,email, password FROM tbl_login WHERE username='$username' OR email='$username' ");

 $row=$query->fetch_array();
 
 $count = $query->num_rows; // if email/password are correct returns must be 1 row
 
 if (password_verify($password, $row['password']) && $count==1) {
  $_SESSION['dutypaysession'] = $row['id'];
  header("Location: dashboard.php");
 } else {
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Invalid Username or Password !
    </div>";
 }
 $DBcon->close();
}
?>

<!DOCTYPE html>
<html dir="ltr">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>Duty Pay | Union Bank of Nigeria</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <style type="text/css">
        .auth-box {
            background: 
            #fff;
            padding: 20px;
            box-shadow: 1px 0 20px
            rgba(0,0,0,.08);
            max-width: 440px;
            width: 90%;
            margin: 10% 0;
            }

            .logo {
                text-align: center;
            }
}
    </style>
</head>

<body data-gr-c-s-loaded="true">
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader" style="display: none;">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center" style="background:url(assets/images/big/auth-bg.jpg) no-repeat center center;">
            <div class="auth-box" >
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="assets/images/logo-icon.png" alt="logo" class="center"></span>
                        <h5 class="font-medium mb-3">Sign In</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        <div class="col-12">
                            <form class="form-horizontal mt-3" id="loginform" method="post">
                                <?php if(isset($msg)){ echo $msg; }?>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="ti-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control form-control-lg" name="username" placeholder="Username" aria-label="" aria-describedby="basic-addon1">
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon2"><i class="ti-pencil"></i></span>
                                    </div>
                                    <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" aria-label="" aria-describedby="basic-addon1">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox d-flex align-items-center">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                                            <label class="custom-control-label" for="customCheck1">Remember me</label>
     
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group text-center">
                                    <div class="col-xs-12 pb-3">
                                        <button class="btn btn-block btn-lg btn-info" type="submit" name="btn-login">Log In</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
     
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->

        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.js"></script>
    <script type="text/javascript"></script>

</body></html>