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
    <title>Duty Pay | Union Bank of Nigeria</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

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
                        <h4 class="page-title">Manager Request</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="reset-user.php">Reset users</a></li> 
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
                    <div class="col-lg-12 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                                
                                <h4 class="card-title">Generate report</h4>
                                <form class="form-horizontal " method='get'>
                              
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <!-- <label class="col-md-12">Start date</label> -->
                                                <input type="text" class="form-control" placeholder="Enter username" name='username' required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success" type="submit" >Submit</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    
                                </form>

                                <div class="table-responsive">
                                <table class="table" id="tblData">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Request Date</th>
                                            <th scope="col">Duty Staff</th>
                                            <th scope="col">Duty Date</th>
                                            <th scope="col">Duty Manager</th>
                                            <th scope="col">Approval Status</th>
                                            <th scope="col">Reassign</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        if (isset($_GET['username'])) {

                                            include('db.php');
                                            $username = $_GET["username"];
                                      
                                            $x=1;

                                        $sql = "SELECT * FROM tbl_duty WHERE duty_staff='$username' AND duty_status='' ORDER BY duty_date DESC LIMIT 5" ;  
                                        $qry=mysqli_query($DBcon,$sql) or die(mysqli_error($DBcon));
                                        while($row=mysqli_fetch_array($qry))

                                        {
                      
                                        do{

                                        echo '<tr>'; 
                                        echo "<td>"; {echo $x++; }echo "</td>"; } while ($x <= 1);
                                        echo "<td>"; echo $row["request_date"]; echo "</td>";
                                        echo "<td>"; 
                                        $dstaffname=$row["duty_staff"];
                                        $sql2 = "SELECT * FROM tbl_user_details where username='$dstaffname'" ;
                                        $result2 = mysqli_query($DBcon,$sql2);
                                        while ($rowdutystaff = mysqli_fetch_array($result2)){
                                        echo ucwords($rowdutystaff['names']); 
                                        echo "</td>";
                                        }
                                            
                                        echo "<td>"; echo $row["duty_date"]; echo "</td>";
                                        echo "<td>"; 
                                        $dmgrname=$row["duty_mgr"];
                                        $sql3 = "SELECT * FROM tbl_user_details where username='$dmgrname'" ;
                                        $result3 = mysqli_query($DBcon,$sql3);
                                        while ($rowdutymgr = mysqli_fetch_array($result3)){
                                        echo ucwords($rowdutymgr['names']); 
                                        echo "</td>";}
                                        echo "<td>"; echo ucwords($row["duty_status"]); echo "</td>";
                                        echo "<td>"; echo '<a class="btn btn-success"  data-target="#exampleModal" data-toggle="modal" data-whatever="'.$row['id'].'">'; echo '<i class="mdi mdi-pencil">'; echo '</i>';echo "</td>";
                                        echo "</tr>";
                                    }  
                                                                               
                                               }
                                        echo '</table>';
                                        echo '</div>';
                                        // mysqli_close($DBcon);
                                       ?>
                                    <!-- </tbody> -->
                                <!-- </table>
                                
                            </div> -->
                        </div>

                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Reassign Request</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>

                              <div class="dash">
                              </div>
                                                                                          
                            </div>
                          </div>
                        </div>

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

    <script>
    $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "editduty.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });
    })
</script>

</body>

</html>