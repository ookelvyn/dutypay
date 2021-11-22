<?php 
  require('db.php');
    $id = $_GET['id'];

    $members = $DBcon->query("SELECT * FROM `tbl_duty` WHERE `id`='$id'");
    $row = mysqli_fetch_assoc($members);


    if (isset($_POST['btn-assign'])) {

      $id = $_POST['id'];
      $dutymgr = $_POST['dutymanager'];
 

      $DBcon->query("UPDATE `tbl_duty` SET `duty_mgr` = '$dutymgr' WHERE `id`=$id");
      // header("location:manage-request.php");
        header('Location: ' . $_SERVER['HTTP_REFERER']);
     }
      
 ?>
                    <div class="modal-body">
                        <form method="POST" action="editduty.php"  enctype="multipart/form-data">
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Request ID:</label>
                              <input type="text" class="form-control" id="readonly" name="id" value="<?php echo $row['id'];?>" readonly="">
                            </div>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Duty staff:</label>
                              <input type="text" class="form-control" id="readonly"  value="<?php echo $row['duty_staff'];?>" readonly="">
                            </div>
                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Duty date:</label>
                              <input type="text" class="form-control" id="readonly"  value="<?php echo $row['duty_date'];?>" readonly="">
                            </div>
                            
                            
                            <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Duty manager:</label>
                            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="dutymanager" required>
                                <option value="<?php echo $row['duty_mgr'];?>"><?php echo $row['duty_mgr'];?></option>  
                                  <?php  
                                    $sql2 = "SELECT * FROM tbl_user_details where duty_mgr='y' ORDER BY username";
                                    $result = mysqli_query($DBcon,$sql2);
                                    while ($rowdutymgr = mysqli_fetch_array($result)){
                                    echo "<option value='".$rowdutymgr['username']."'>".$rowdutymgr['username'].'</option>';

                                    }
                                  ?>
                            </select>
                          </div>

                            <div class="form-group">
                              <label for="recipient-name" class="col-form-label">Duty status:</label>
                              <input type="text" class="form-control" id="readonly"  value="<?php echo $row['duty_status'];?>" readonly="">
                            </div>                        
                          <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-success" name="btn-assign">Submit</button>
                        </div>
                        </form>
                      </div>


