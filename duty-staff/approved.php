<!-- Pending Request -->
                <!-- ============================================================== -->
                <?php 
                    include_once 'db.php';
                    if(isset($_POST['btn-duty'])) {

                    $dutystaff = mysqli_real_escape_string($DBcon, $_REQUEST['dutystaff']);
                    $dutymanager = mysqli_real_escape_string($DBcon, $_REQUEST['dutymanager']);
                    $dutydate = mysqli_real_escape_string($DBcon, $_REQUEST['dutydate']);
                    $requestdate = date('Y-m-d h:i:sa');

                    $check_duty = $DBcon->query("SELECT * FROM tbl_duty WHERE duty_staff='$dutystaff' AND duty_date='$dutydate'");
                    $count=$check_duty->num_rows;

                      if ($count==0) {

                       $query1 = "INSERT INTO tbl_duty (duty_staff, duty_date, duty_mgr, request_date) VALUES ('$dutystaff','$dutydate', '$dutymanager','$requestdate')";
                       if ($DBcon->query($query1)) {
                        $msg = "<div class='alert alert-success'><span class='glyphicon glyphicon-info-sign'></span> You request is pending with your duty manager for approval </div>"; 

                       }else{$msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> Error while registering ! </div>";}
                      
                      }else{
                        $msg = "<div class='alert alert-danger'><span class='glyphicon glyphicon-info-sign'></span> Request already exist! </div>";

                      }
                  }
                  
                 ?>
                 <?php if(isset($msg)){ echo $msg;} ?>
                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Approved Request</h4>
                                        <!-- <h5 class="card-subtitle">Overview of Top Selling Items</h5> -->
                                    </div>
                 
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0">#</th>
                                            <th class="border-top-0">Request Date</th>
                                            <th class="border-top-0">Duty Staff</th>
                                            <th class="border-top-0">Duty Date</th>
                                            <th class="border-top-0">Duty manager</th>
                                            <th class="border-top-0">Request Status</th>
                                            <th class="border-top-0">Date Approved</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                          require_once("db.php");
                                          $x=1;
                                          $dutystaff= $userRow['username'];        
                                          $sql="select * from tbl_duty where duty_staff='$dutystaff' and duty_status='approved' order by duty_date desc limit 20";
                                          $qry=mysqli_query($DBcon,$sql) or die(mysqli_error($DBcon));
                                          while($row=mysqli_fetch_array($qry))

                                          {

                                          echo '<tr class="even pointer">';
                                          do{
                                            echo "<td>"; {echo $x++; }echo "</td>"; } while ($x <= 1);
                                            echo "<td>"; echo $row["request_date"]; echo "</td>";

                                            echo "<td>"; 
                                            $dstaffname=$row["duty_staff"];
                                            $sql2 = "SELECT * FROM tbl_user_details where username='$dstaffname'" ;
                                            $result2 = mysqli_query($DBcon,$sql2);
                                            while ($rowdutystaff = mysqli_fetch_array($result2)){
                                            echo ucwords($rowdutystaff['names']); }
                                            echo "</td>";

                                            echo "<td>"; echo $row["duty_date"]; echo "</td>";

                                            echo "<td>"; 
                                            $dmgrname=$row["duty_mgr"];
                                            $sql3 = "SELECT * FROM tbl_user_details where username='$dmgrname'" ;
                                            $result3 = mysqli_query($DBcon,$sql3);
                                            while ($rowdutymgr3 = mysqli_fetch_array($result3)){
                                            echo ucwords($rowdutymgr3['names']);
                                            }
                                            echo "</td>";

                                            echo "<td>"; echo ucwords($row["duty_status"]); echo "</td>";
                                            echo "<td>"; echo ucwords($row["approve_date"]); echo "</td>";

                                          echo "</tr>";
                                          }
                                         
                                         ?>
                           
                                  
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- =================End Pending request============================ -->


                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New request</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form method="POST" enctype="multipart/form-data">
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Duty staff:</label>
                            <input type="text" class="form-control" id="readonly"  value="<?php echo $userRow['names']; ?>" readonly="">
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Username:</label>
                            <input type="text" class="form-control" id="readonly" name="dutystaff" value="<?php echo $userRow['username']; ?>" readonly="">
                          </div>
                          
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Duty manager:</label>
                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="dutymanager" required>
                                <option value="">Select manager</option>  
                                  <?php  
                                    $sql2 = "SELECT * FROM tbl_user_details where duty_mgr='y' ORDER BY username";
                                    $result = mysqli_query($DBcon,$sql2);
                                    while ($rowdutymgr = mysqli_fetch_array($result)){
                                    echo "<option value='".$rowdutymgr['username']."'>".$rowdutymgr['names'].'</option>';

                                    }
                                  ?>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Duty date:</label>
                            <input type="date" class="form-control" name="dutydate" required>
                          </div>                         
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" name="btn-duty">Submit</button>
                      </div>
                      </form>
                      </div>
                      
                    </div>
                  </div>
                </div>