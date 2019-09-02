<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <meta http-equiv="X-UA-Compatible" content="IE=edge" />
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
   <title><?php echo $page_val['title']; ?></title>
   <meta name="author" content="<?php echo $page_val['author']; ?>" />
   <meta name="keyword" content="<?php echo $page_val['keywords']; ?>" />
   <meta name="description" content="<?php echo $page_val['description']; ?>" />
   <link rel="shortcut icon" href="<?php echo base_url('site_folder/favicon.png'); ?>" type="image/x-icon" />
   <!-- simplebar CSS-->
   <link href="<?php echo base_url('assets/plugins/simplebar/css/simplebar.css'); ?>" rel="stylesheet" />
   <!-- Bootstrap core CSS-->
   <link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" />
   <!--Data Tables -->
   <link href="<?php echo base_url('assets/plugins/bootstrap-datatable/css/dataTables.bootstrap4.min.css'); ?>" rel="stylesheet" type="text/css">
   <link href="<?php echo base_url('assets/plugins/bootstrap-datatable/css/buttons.bootstrap4.min.css'); ?>" rel="stylesheet" type="text/css">
   <!--Select Plugins-->
   <link href="<?php echo base_url('assets/plugins/select2/css/select2.min.css'); ?>" rel="stylesheet"/>
   <!--inputtags-->
   <link href="<?php echo base_url('assets/plugins/inputtags/css/bootstrap-tagsinput.css'); ?>" rel="stylesheet" />
   <!--multi select-->
   <link href="<?php echo base_url('assets/plugins/jquery-multi-select/multi-select.css'); ?>" rel="stylesheet" type="text/css">
   <!-- animate CSS-->
   <link href="<?php echo base_url('assets/css/animate.css'); ?>" rel="stylesheet" type="text/css" />
   <!-- Icons CSS-->
   <link href="<?php echo base_url('assets/css/icons.css'); ?>" rel="stylesheet" type="text/css" />
   <!-- Sidebar CSS-->
   <link href="<?php echo base_url('assets/css/sidebar-menu.css'); ?>" rel="stylesheet" />
   <!-- Custom Style-->
   <link href="<?php echo base_url('assets/css/app-style.css'); ?>" rel="stylesheet" />

   <link href="<?php echo base_url('assets/css/jquery-ui.css'); ?>" rel="stylesheet" />

</head>

<body>
   <!-- start loader -->
   <div id="pageloader-overlay" class="visible incoming">
      <div class="loader-wrapper-outer">
         <div class="loader-wrapper-inner">
            <div class="loader"></div>
         </div>
      </div>
   </div>
   <!-- end loader -->
   <!-- Start wrapper-->
   <div id="wrapper">
      <!--Start sidebar-wrapper-->
      <div id="sidebar-wrapper" class="bg-theme bg-theme2" data-simplebar="" data-simplebar-auto-hide="true">
         <div class="brand-logo">
            <a href="#">
               <img title="<?php echo $this->lang->line('project_name'); ?>" src="<?php echo base_url('site_folder/priyadarshini-white.png'); ?>" class="logo-icon" alt="<?php echo $this->lang->line('project_name'); ?>">
               <?php /*<h5 class="logo-text">Bulona Admin</h5>*/ ?>
            </a>
         </div>
         <?php /*<div class="user-details">
               <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
                  <div class="avatar"><img class="mr-3 side-user-img" src="<?php echo base_url('assets/images/avatars/avatar-13.png');?>" alt="user avatar"></div>
                  <div class="media-body">
                     <h6 class="side-user-name"><?php echo $login_info->name;?></h6>
                  </div>
               </div>
               <div id="user-dropdown" class="collapse">
                  <ul class="user-setting-menu">
                     <li><a href="javaScript:void();"><i class="icon-user"></i> My Profile</a></li>
                     <li><a href="javaScript:void();"><i class="icon-settings"></i> Setting</a></li>
                     <li><a href="javaScript:void();"><i class="icon-power"></i> Logout</a></li>
                  </ul>
               </div>
            </div>*/ ?>
         <ul class="sidebar-menu do-nicescrol">
            <?php /*<li class="sidebar-header">MAIN NAVIGATION</li>*/ ?>
            <?php $menu_item = $this->UsersPermissionMstModel->get_record('', $login_info->users_type_id);
            if (!empty($menu_item)) {
               $i = 0;
               foreach ($menu_item as $items) {
                  if ($items->is_navigation == '1') { ?>
                     <li><a href="<?php if ($items->url != '') {
                                       echo base_url($items->url);
                                    } else {
                                       echo '#';
                                    } ?>" class="waves-effect"><?php if ($i == 0) { ?><i class="zmdi zmdi-view-dashboard"></i><?php $i++;
                                                                                                                                       } else { ?><i class="fa fa-bars"></i><?php } ?> <span><?php echo $items->heading; ?></span></a>
                     <?php }
                  }
               } ?>
               <?php /*<li>
                  <a href="javaScript:void();" class="waves-effect">
                  <i class="fa fa-share"></i> <span>Multilevel</span>
                  <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="sidebar-submenu">
                     <li><a href="javaScript:void();"><i class="zmdi zmdi-long-arrow-right"></i> Level One</a></li>
                     <li>
                        <a href="javaScript:void();"><i class="zmdi zmdi-long-arrow-right"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="sidebar-submenu">
                           <li><a href="javaScript:void();"><i class="zmdi zmdi-long-arrow-right"></i> Level Two</a></li>
                           <li>
                              <a href="javaScript:void();"><i class="zmdi zmdi-long-arrow-right"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                              <ul class="sidebar-submenu">
                                 <li><a href="javaScript:void();"><i class="zmdi zmdi-long-arrow-right"></i> Level Three</a></li>
                                 <li><a href="javaScript:void();"><i class="zmdi zmdi-long-arrow-right"></i> Level Three</a></li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <li><a href="javaScript:void();" class="waves-effect"><i class="zmdi zmdi-long-arrow-right"></i> Level One</a></li>
                  </ul>
               </li>*/ ?>
            <li><a href="javaScript:void();" class="waves-effect"><i class="fa fa-cog"></i> <span>Settings</span>
                  <i class="fa fa-angle-left pull-right"></i>
               </a>
               <ul class="sidebar-submenu">
                  <li><a href="<?php echo base_url('ChangeProfile'); ?>"><i class="fa fa-user"></i> Update Profile</a></li>
                  <li><a href="<?php echo base_url('ChangePassword'); ?>"><i class="zmdi zmdi-key"></i> Change Password</a></li>
               </ul>
            </li>
         </ul>
      </div>
      <!--End sidebar-wrapper-->
      <!--Start topbar header-->
      <header class="topbar-nav">
         <nav class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">
               <li class="nav-item">
                  <a class="nav-link toggle-menu" href="javascript:void();">
                     <i class="icon-menu menu-icon"></i>
                  </a>
               </li>
            </ul>
            <ul class="navbar-nav align-items-center right-nav-link">
               <li class="nav-item"><a class="nav-link" href="#"><?php echo $login_info->name; ?></a></li>
               <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Logout'); ?>">FinYear : <b><?php echo $finyear_info->finyear; ?></b></a></li>
               <?php if ($login_info->store_name != '') { ?>
                  <li class="nav-item"><a class="nav-link" href="<?php echo base_url('Logout'); ?>">Store : <b><?php echo $login_info->store_name; ?></b></a></li>
               <?php } ?>
               <li class="nav-item"><a class="nav-link" href="#<?php //echo base_url('Logout');
                                                               ?>">Login Type : <b><?php echo $login_info->users_type; ?></b></a></li>
               <li class="nav-item"><a class="nav-link" style="border-right: 0px solid #dddddd;" href="<?php echo base_url('Logout'); ?>">Logout</a></li>
            </ul>
         </nav>
      </header>
      <!--End topbar header-->
      <div class="clearfix"></div>
      <div class="content-wrapper">
         <div class="container-fluid">
            <?php /*<!-- Breadcrumb-->
                  <div class="row pt-2 pb-2">
                     <div class="col-sm-9">
                        <h4 class="page-title">Form Layouts</h4>
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a href="javaScript:void();">Bulona</a></li>
                           <li class="breadcrumb-item"><a href="javaScript:void();">Forms</a></li>
                           <li class="breadcrumb-item active" aria-current="page">Form Layouts</li>
                        </ol>
                     </div>
                     <div class="col-sm-3">
                        <div class="btn-group float-sm-right">
                           <button type="button" class="btn btn-light waves-effect waves-light"><i class="fa fa-cog mr-1"></i> Setting</button>
                           <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split waves-effect waves-light" data-toggle="dropdown">
                           <span class="caret"></span>
                           </button>
                           <div class="dropdown-menu">
                              <a href="javaScript:void();" class="dropdown-item">Action</a>
                              <a href="javaScript:void();" class="dropdown-item">Another action</a>
                              <a href="javaScript:void();" class="dropdown-item">Something else here</a>
                              <div class="dropdown-divider"></div>
                              <a href="javaScript:void();" class="dropdown-item">Separated link</a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- End Breadcrumb-->*/ ?>