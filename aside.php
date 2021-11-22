<aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li>
                            <!-- User Profile-->
                            <div class="user-profile d-flex no-block dropdown m-t-20">
                                <div class="user-pic"><img src="assets/images/users/1.jpg" alt="users" class="rounded-circle" width="40" /></div>
                                <div class="user-content hide-menu m-l-10">
                                    <a href="javascript:void(0)" class="" id="Userdd" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <h5 class="m-b-0 user-name font-medium"><?php echo ucwords($userRow['names']); ?></h5>
                                        <span class="op-5 user-email"><?php echo $userRow['username']; ?>@unionbankng.com</span>
                                    </a>
                                </div>
                            </div>
                            <!-- End User Profile-->
                        </li>
                        <?php if ($userRow['duty_mgr']=='y' ) { }else{
                        echo '<li class="p-15 m-t-10">'; echo '<a data-toggle="modal" data-target="#exampleModal"class="btn btn-block create-btn text-white no-block d-flex align-items-center">'; echo '<i class="fa fa-plus-square">'; echo '</i>'; echo '<span class="hide-menu m-l-5">'; echo 'Create New'; echo '</span>';  echo '</a>'; echo '</li>';
                        }
                        ?>
                        <!-- User Profile-->   
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="profile.php" aria-expanded="false"><i class="mdi mdi-account-network"></i><span class="hide-menu">Profile</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="approved-request.php" aria-expanded="false"><i class="mdi mdi-check"></i><span class="hide-menu">Approved Request</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="rejected-request.php" aria-expanded="false"><i class="mdi mdi-alert-circle-outline"></i><span class="hide-menu">Rejected Request</span></a></li>
                        
                        <?php 
                        if ($userRow['admin']=='y' && $userRow['active']=='y') {
                        echo '<hr>';
                        echo '<li class="sidebar-item">'; echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="manage-users.php" aria-expanded="false">'; echo '<i class="mdi mdi-account-multiple">'; echo '</i>'; echo '<span class="hide-menu">'; echo 'Manage Users'; echo '</span>'; echo '</a>'; echo '</li>';
                        echo '<li class="sidebar-item">'; echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="manage-request.php" aria-expanded="false">'; echo '<i class="mdi mdi-view-list">'; echo '</i>'; echo '<span class="hide-menu">'; echo 'Manage Request'; echo '</span>'; echo '</a>'; echo '</li>';
                        echo '<li class="sidebar-item">'; echo '<a class="sidebar-link waves-effect waves-dark sidebar-link" href="report.php" aria-expanded="false">'; echo '<i class="mdi mdi-chart-bar">'; echo '</i>'; echo '<span class="hide-menu">'; echo 'Report'; echo '</span>'; echo '</a>'; echo '</li>';
                        echo '<hr>';
                        }

                        ?>

                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link" href="logout.php?logout" aria-expanded="false"><i class="mdi mdi-logout"></i><span class="hide-menu">Logout</span></a></li>

                        
                    </ul>
                    
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>