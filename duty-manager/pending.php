<!-- Pending Request -->
                <!-- ============================================================== -->

                <div class="row">
                    <!-- column -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- title -->
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title">Pending Request</h4>
                                    </div>
                 
                                </div>
                                <!-- title -->
                            </div>
                            <div class="table-responsive">
                                <table class="table v-middle">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="border-top-0"># </th>
                                            <th class="border-top-0">Request Date</th>
                                            <th class="border-top-0">Duty Staff</th>
                                            <th class="border-top-0">Duty Date</th>
                                            <th class="border-top-0">Duty manager</th>
                                            <th class="border-top-0">Approve</th>
                                            <th class="border-top-0">Reject</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                          require_once("db.php");
                                          $x=1;
                                          $dutymgr= $userRow['username'];        
                                          $sql="select * from tbl_duty where duty_mgr='$dutymgr' and duty_status='' ";
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
                                            while ($rowdutymgr = mysqli_fetch_array($result3)){
                                            echo ucwords($rowdutymgr['names']);}
                                            echo "</td>";

                                            echo "<td>"; echo '<a href="duty-manager/approve-duty.php?id='.$row['id'].'">'; echo '<button type="button" onclick="return confirm(\'You are about to approve a duty request. Do you want to continue?\');"  class="btn btn-success" >'; echo 'Approve'; echo '</button>'; echo '</a>'; echo "</td>";
                                            echo "<td>"; echo '<a href="duty-manager/reject-duty.php?id='.$row['id'].'">'; echo '<button type="button" onclick="return confirm(\'You are about to reject a duty request. Do you want to continue??\');"  class="btn btn-danger" >'; echo 'Reject'; echo '</button>'; echo '</a>'; echo "</td>";
                                          
                          
                                            
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
