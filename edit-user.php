<?php

    session_start();
        include_once 'db.php';

        if (!isset($_SESSION['dutypaysession'])) {
         header("Location: index.php");
         //echo "<script>location='dashboard.php'</script>";
        }

        $query = $DBcon->query("SELECT * FROM tbl_user_details WHERE id =".$_SESSION['dutypaysession']);
        $userRow=$query->fetch_array();


        if ($userRow['admin']!='y') {
         header("Location: index.php");
         //echo "<script>location='dashboard.php'</script>";
        }

if(isset($_POST['btn-signup'])) {

     
 //$email = strip_tags($_POST['email']);

 $uname = strip_tags($_POST['username']);
 $upass = strip_tags($_POST['password']);
 $upass1 = strip_tags($_POST['password1']);

$emailext = '@unionbankng.com';
$email = $uname.$emailext;
$staffid = mysqli_real_escape_string($DBcon, $_REQUEST['staffID']);
$fullname = mysqli_real_escape_string($DBcon, $_REQUEST['fullname']);
$accnumber = mysqli_real_escape_string($DBcon, $_REQUEST['accnumber']);
$mobile = mysqli_real_escape_string($DBcon, $_REQUEST['mobile']);
$dutymgr = mysqli_real_escape_string($DBcon, $_REQUEST['dutymgr']);
$admin = mysqli_real_escape_string($DBcon, $_REQUEST['admin']);
$active = mysqli_real_escape_string($DBcon, $_REQUEST['active']);
 
 if($upass == $upass1){

// $email = $DBcon->real_escape_string($email); 
 $username = $DBcon->real_escape_string($uname);
 $upass = $DBcon->real_escape_string($upass);
 $upass1 = $DBcon->real_escape_string($upass);
 
$username = mysqli_real_escape_string($DBcon, $_REQUEST['username']);


 $hashed_password = password_hash($upass, PASSWORD_DEFAULT); // this function works only in PHP 5.5 or latest version
 
 $check_username = $DBcon->query("SELECT username FROM tbl_login WHERE username='$username'");
 $count=$check_username->num_rows;

 if ($count==0) {

    $query = "INSERT INTO tbl_login (username,email,password) VALUES('$uname','$email','$hashed_password')";

    if ($DBcon->query($query)) {

$query1 = "INSERT INTO tbl_user_details (staff_id, username, names, acc_no, mobile, duty_mgr, admin, active) VALUES ('$staffid','$username', '$fullname', '$accnumber', '$mobile', '$dutymgr', '$admin', '$active')";

if ($DBcon->query($query1)) {
    
    $msg = "<div class='alert alert-success'>
      Successfully registered!</a>
     </div>";    

   }else{
    $msg = "<div class='alert alert-danger'>Error while registering!</div>";
}
}




 }else{$msg = "<div class='alert alert-danger'> Sorry, the username already exist! </div>";}



} else {$msg = "<div class='alert alert-danger'> Password do not match </div>";}

}

  //$DBcon->close();

// ================//

 if(isset($_POST['btn-details'])) {

$staffid = mysqli_real_escape_string($DBcon, $_REQUEST['staffID']);
$username = mysqli_real_escape_string($DBcon, $_REQUEST['username']);
$fullname = mysqli_real_escape_string($DBcon, $_REQUEST['fullname']);
$accnumber = mysqli_real_escape_string($DBcon, $_REQUEST['accnumber']);
$mobile = mysqli_real_escape_string($DBcon, $_REQUEST['mobile']);
$dutymgr = mysqli_real_escape_string($DBcon, $_REQUEST['dutymgr']);
$admin = mysqli_real_escape_string($DBcon, $_REQUEST['admin']);



// if ($DBcon->query($query)) {
   $query1 = "INSERT INTO tbl_user_details (staff_id, username, names, acc_no, mobile, duty_mgr, admin) VALUES ('$staffid','$username', '$fullname', '$accnumber', '$mobile', '$dutymgr', '$admin')";
   if ($DBcon->query($query1)) {
    $msg2 = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully registered! </div>";    

   }else{$msg2 = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
     </div>";}
  }
 $DBcon->close();
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
    <title>Xtreme Admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <!-- <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div> -->
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
                        <h4 class="page-title">Edit Users</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="edit-user.php">Edit</a></li>
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
                                <!-- <form class="form-horizontal form-material" method='post'>
                                     <?php //if(isset($msg)){ echo $msg;} ?>
                                    
                                    <div class="form-group">
                                        <label class="col-md-12">Userame</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" name='username' class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name='password' class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Re-enter Password</label>
                                        <div class="col-md-12">
                                            <input type="password" name='password1' class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Staff ID</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" name='staffID' class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Full Name</label>
                                        <div class="col-md-12">
                                            <input type="text" placeholder="" name='fullname' class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Account Number</label>
                                        <div class="col-md-12">
                                            <input type="number" min="0" placeholder="" name='accnumber' class="form-control form-control-line">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12">Mobile Number</label>
                                        <div class="col-md-12">
                                            <input type="number" min="0" placeholder="" name='mobile' class="form-control form-control-line">
                                        </div>
                                    </div>
                                 
                                    <div class="form-group">
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                              <input type="hidden" name="dutymgr" value="" />
                                              <input type="checkbox" class="form-check-input" value="y" name="dutymgr">
                                              Duty Manager
                                            </label>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                              <input type="hidden" name="admin" value="" />
                                              <input type="checkbox" class="form-check-input" value="y" name="admin">
                                              Admin
                                            </label>
                                         </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="form-check form-check-success">
                                            <label class="form-check-label">
                                              <input type="hidden" name="active" value="" />
                                              <input type="checkbox" class="form-check-input" value="y" name="active" checked>
                                              Active
                                            </label>
                                         </div>
                                      </div>
                 
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-success" name="btn-signup">Submit</button>
                                        </div>
                                    </div>
                                </form> -->
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
            <footer class="footer text-center">
                All Rights Reserved by Xtreme Admin. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.
            </footer>
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