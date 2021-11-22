<?php

    session_start();
        include_once 'db.php';

        if (!isset($_SESSION['dutypaysession'])) {
         header("Location: index.php");
         //echo "<script>location='dashboard.php'</script>";
        }

        $query = $DBcon->query("SELECT * FROM tbl_user_details WHERE id =".$_SESSION['dutypaysession']);
        $userRow=$query->fetch_array();


        

if (isset($_POST['submit'])) {
 
        $currentpassword = strip_tags($_POST['currentPassword']);
        $currentpassword = $DBcon->real_escape_string($currentpassword);
        $username =  $userRow["username"];
        $newpassword = strip_tags($_POST['newPassword']);
        $newpassword = $DBcon->real_escape_string($newpassword);
        $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);
        $confirmpassword = strip_tags($_POST['confirmPassword']);

         if($newpassword == $confirmpassword){
 
        $query = $DBcon->query("SELECT * FROM tbl_login WHERE username='$username'");

        $row=$query->fetch_array();
 
        $count = $query->num_rows; // if email/password are correct returns must be 1 row
 
         if (password_verify($currentpassword, $row['password']) && $count==1) {
            

            mysqli_query($DBcon, "UPDATE tbl_login set password='$hashed_password' WHERE username='$username'");
            
             $message = "<div class='alert alert-success'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Password Changed!
            </div>";

         } else {
          $message = "<div class='alert alert-danger'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Current password is incorrect!
            </div>";
       }  }else {
          $message = "<div class='alert alert-danger'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; New passwords does not match!
            </div>";
         }
         $DBcon->close();
        }
?>


<!DOCTYPE html>
<html dir="ltr" lang="en">

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

</head>

<body>

    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full" data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include 'header.php' ?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->

        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
       <?php include 'aside.php' ?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
 
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row align-items-center">
                    <div class="col-5">
                        <h4 class="page-title">Change password</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Password</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <div class="col-lg-6 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <form class="form-horizontal form-material" method='post'>
                                     <?php if(isset($message)){ echo $message;} ?>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name='currentPassword' minlength="5" class="form-control form-control-line" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12"> New Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name='newPassword' minlength="5" class="form-control form-control-line" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Re-enter Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name='confirmPassword' minlength="5" class="form-control form-control-line" required>
                                        </div>
                                    </div>
                                    
                 
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" name="submit">Change password</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->

                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <?php include 'footer.php' ?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
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
</body>

</html>