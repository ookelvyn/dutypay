<?php

 session_start();
 include('../db.php');
 if (!isset($_SESSION['dutypaysession'])) {
  header("Location: ../index.php");
  }
  $query = $DBcon->query("SELECT * FROM tbl_user_details WHERE id =".$_SESSION['dutypaysession']);
        $userRow=$query->fetch_array();

   if ($userRow['duty_mgr']!='y') {
         header("Location: index.php");
         echo "<script>location='index.php'</script>";
        }	



// if (isset($_GET['id'])) {
	$dmgr = $userRow['username'];
    $id = $_GET['id'];
	$approvedate = date('Y-m-d h:i:sa');
$sql = "UPDATE tbl_duty SET duty_status='approved', approve_date='$approvedate' WHERE id=$id AND duty_mgr='$dmgr' ";
 // }

if ($DBcon->query($sql) === TRUE) {
    header("Location: ../dashboard.php");

} else {
    header("Location: ../dashboard.php");

}

$DBcon->close();
?> 