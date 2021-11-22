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


  //$DBcon->close();

// ================//

//  if(isset($_POST['btn-details'])) {

// $staffid = mysqli_real_escape_string($DBcon, $_REQUEST['staffID']);
// $username = mysqli_real_escape_string($DBcon, $_REQUEST['username']);
// $fullname = mysqli_real_escape_string($DBcon, $_REQUEST['fullname']);
// $accnumber = mysqli_real_escape_string($DBcon, $_REQUEST['accnumber']);
// $mobile = mysqli_real_escape_string($DBcon, $_REQUEST['mobile']);
// $dutymgr = mysqli_real_escape_string($DBcon, $_REQUEST['dutymgr']);
// $admin = mysqli_real_escape_string($DBcon, $_REQUEST['admin']);



// // if ($DBcon->query($query)) {
//    $query1 = "INSERT INTO tbl_user_details (staff_id, username, names, acc_no, mobile, duty_mgr, admin) VALUES ('$staffid','$username', '$fullname', '$accnumber', '$mobile', '$dutymgr', '$admin')";
//    if ($DBcon->query($query1)) {
//     $msg2 = "<div class='alert alert-success'>
//       <span class='glyphicon glyphicon-info-sign'></span> &nbsp; Successfully registered! </div>";    

//    }else{$msg2 = "<div class='alert alert-danger'>
//       <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
//      </div>";}
//   }
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
                        <h4 class="page-title">Report</h4>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Report</li>
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
                <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Generate report</h4>
                                <form class="form-horizontal " method='get'>
                              
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12">Start date:</label>
                                                <input type="date" class="form-control" placeholder="col-md-6" name='date1' required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12">End date:</label>
                                                <input type="date" class="form-control" placeholder="col-md-6" name='date2' required>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="col-md-12">Approval status:</label>
                                                <select class="custom-select mr-sm-2"  name='dutystatus'>
                                                      <option value="">All</option>
                                                      <option value="approved">Approved</option>
                                                      <option value="rejected">Rejected</option>
                                                      <option value="">Pending</option>
                                                </select>
                                            </div>
                                        </div> -->

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="col-sm-12">
                                                    <button class="btn btn-success" type="submit" >Submit</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    
                                </form>
                            </div>
                            <div class="btn-group pull-right">  
                                    <button class="btn btn-success" onclick="exportTableToExcel('tblData')">Export To Excel</button> 
                            </div>

                            <div class="table-responsive">
                                <table class="table" id="tblData">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">S/N</th>
                                            <th scope="col">Request Date</th>
                                            <th scope="col">Duty Staff</th>
                                            <th scope="col">Duty Staff Acc</th>
                                            <th scope="col">Duty Date</th>
                                            <th scope="col">Duty Manager</th>
                                            <th scope="col">Approval Status</th>
                                            <th scope="col">Approved Date</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                      <?php 
                                        if (isset($_GET['date1']) && isset($_GET['date2'])) {

                                            include('db.php');
                                            $date1 = $_GET["date1"];
                                            $date2 = $_GET["date2"];
                                            // $stat = $_GET["dutystatus"];

                                            $x=1;
                                           // $date2 = $_GET["date2"];

                                        $sql = "SELECT * FROM tbl_duty WHERE  duty_date BETWEEN '$date1' AND '$date2'" ;  
                                        $qry=mysqli_query($DBcon,$sql) or die(mysqli_error($DBcon));
                                        while($row=mysqli_fetch_array($qry))

                                        {
                                        // echo '<div class="table-responsive">';
                                        // echo '<table class="table" id="tblData">';
                                        // echo '<thead class="thead-light">';
                                        // echo '<tr>';
                                        // echo '<th scope="col">'; echo 'S/N'; echo '</th>';
                                        // echo '<th scope="col">'; echo 'Request Date'; echo '</th>';
                                        // echo '<th scope="col">'; echo 'Duty Staff'; echo '</th>';
                                        // echo '<th scope="col">'; echo 'Duty Staff Acc'; echo '</th>';
                                        // echo '<th scope="col">'; echo 'Duty Date'; echo '</th>';
                                        // echo '<th scope="col">'; echo 'Duty Manager'; echo '</th>';
                                        // echo '<th scope="col">'; echo 'Approval Status'; echo '</th>';
                                        // echo '<th scope="col">'; echo 'Approved Date'; echo '</th>';

                                        // echo '</tr>';
                                        // echo '</thead>';
                                        // echo '<tbody>';
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
                                        echo "<td>"; echo $rowdutystaff["acc_no"]; echo "</td>";
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
                                        echo "<td>"; echo $row["approve_date"]; echo "</td>";
                                                                
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
    <script type="text/javascript">
    function exportTableToExcel(tableID, filename = ''){
    var downloadLink;
    var dataType = 'application/vnd.ms-excel';
    var tableSelect = document.getElementById(tableID);
    var tableHTML = tableSelect.outerHTML.replace(/ /g, '%20');
    
    // Specify file name
    filename = filename?filename+'.xls':'duty_pay.xls';
    
    // Create download link element
    downloadLink = document.createElement("a");
    
    document.body.appendChild(downloadLink);
    
    if(navigator.msSaveOrOpenBlob){
        var blob = new Blob(['\ufeff', tableHTML], {
            type: dataType
        });
        navigator.msSaveOrOpenBlob( blob, filename);
    }else{
        // Create a link to the file
        downloadLink.href = 'data:' + dataType + ', ' + tableHTML;
    
        // Setting the file name
        downloadLink.download = filename;
        
        //triggering the function
        downloadLink.click();
    }
}
</script>
</body>

</html>