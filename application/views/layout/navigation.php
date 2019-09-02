<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <!-- User Profile-->
                <?php /*<li class="sidebar-item selected"> <a class="sidebar-link has-arrow waves-effect waves-dark active" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span class="hide-menu">Dashboard</span></a>
                    <ul aria-expanded="false" class="collapse first-level in">
                        <li class="sidebar-item active"><a href="index.php" class="sidebar-link"><i class="mdi mdi-arrange-bring-to-front"></i> <span class="hide-menu">State Wise</span></a></li>
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-arrange-send-to-back"></i> <span class="hide-menu">District Wise</span></a></li>
                    </ul>
                </li>*/?>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('Cashier/Dashboard');?>" aria-expanded="false"><i class="mdi mdi-chemical-weapon"></i><span class="hide-menu"> Dashboard</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('Cashier/Billing/add');?>" aria-expanded="false"><i class="mdi mdi-menu"></i><span class="hide-menu"> Add Billing</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="<?php echo base_url('Cashier/Billing');?>" aria-expanded="false"><i class="mdi mdi-menu"></i><span class="hide-menu"> Manage Billing</span></a></li>
                <li class="sidebar-item"><a class="sidebar-link waves-effect waves-dark sidebar-link" href="#<?php //echo base_url('Cashier/Billing');?>" aria-expanded="false"><i class="mdi mdi-menu"></i><span class="hide-menu"> Reports</span></a>
                </li>
                <li class="sidebar-item"> <a class="sidebar-link has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="mdi mdi-backup-restore"></i><span class="hide-menu">Settings</span></a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item"><a href="#" class="sidebar-link"><i class="mdi mdi-arrange-bring-to-front"></i> <span class="hide-menu">Update Profile</span></a></li>
                        <li class="sidebar-item"><a href="<?php echo base_url('ChangePassword');?>" class="sidebar-link"><i class="mdi mdi-arrange-send-to-back"></i> <span class="hide-menu">Change Password</span></a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>