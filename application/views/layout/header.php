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

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('global_assets/css/icons/icomoon/styles.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/bootstrap_limitless.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/layout.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/components.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/colors.min.css');?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="<?php echo base_url('global_assets/js/main/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/main/bootstrap.bundle.min.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/plugins/loaders/blockui.min.js');?>"></script>
	<!-- /core JS files -->

	<?php /**/?> <!-- Theme JS files -->
	<script src="<?php echo base_url('global_assets/js/plugins/visualization/d3/d3.min.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/plugins/visualization/d3/d3_tooltip.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/plugins/forms/styling/switchery.min.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/plugins/forms/selects/bootstrap_multiselect.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/plugins/ui/moment/moment.min.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/plugins/pickers/daterangepicker.js');?>"></script><?php /**/?>

	<!-- Theme JS files -->
	<script src="<?php echo base_url('global_assets/js/plugins/tables/datatables/datatables.min.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/plugins/forms/selects/select2.min.js');?>"></script>

	<script src="<?php echo base_url('assets/js/app.js');?>"></script>
	<?php /**/?><script src="<?php echo base_url('global_assets/js/demo_pages/dashboard.js');?>"></script><?php /**/?>
	<script src="<?php echo base_url('global_assets/js/demo_pages/datatables_basic.js');?>"></script>
	<!-- /theme JS files -->
</head>
<body>
	<!-- Main navbar -->
	<div class="navbar navbar-expand-md navbar-dark">
		<div class="navbar-brand">
			<a href="index.html" class="d-inline-block">
            <img title="<?php echo $this->lang->line('project_name'); ?>" src="<?php echo base_url('site_folder/pphcl-white.png'); ?>" class="logo-icon" alt="<?php echo $this->lang->line('project_name'); ?>">
			</a>
		</div>

		<?php /*<div class="d-md-none">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
				<i class="icon-tree5"></i>
			</button>
			<button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
				<i class="icon-paragraph-justify3"></i>
			</button>
		</div>*/?>

		<div class="collapse navbar-collapse" id="navbar-mobile">
         <div class="ml-md-3 mr-md-auto"><span class="badge bg-success" style="display: none">Online</span></div>
         <ul class="navbar-nav pull-right">
            <li class="nav-item"><a href="#" class="navbar-nav-link caret-0">FinYear : <b><?php echo $finyear_info->finyear; ?></b></a></li>
            <?php if ($login_info->department_name != '') { ?>
            <li class="nav-item"><a href="#" class="navbar-nav-link caret-0">Store : <b><?php echo $login_info->department_name; ?></b></a></li>
            <?php } ?>
				<li class="nav-item dropdown dropdown-user">
					<a href="#" class="navbar-nav-link d-flex align-items-center dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url('site_folder/favicon.png'); ?>" class="rounded-circle mr-2" height="34" alt="">
						<span><?php echo $login_info->name;?></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right">
						<a href="<?php echo base_url('ChangeProfile'); ?>" class="dropdown-item"><i class="icon-user"></i> My profile</a>
						<a href="<?php echo base_url('ChangePassword'); ?>" class="dropdown-item"><i class="icon-key"></i> Change Password</a>
						<div class="dropdown-divider"></div>
						<a href="<?php echo base_url('Logout');?>" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
					</div>
				</li>
			</ul><?php /**/?>
		</div>
	</div>
	<!-- /main navbar -->


	<!-- Page content -->
	<div class="page-content">

		<!-- Main sidebar -->
		<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

			<!-- Sidebar mobile toggler -->
			<div class="sidebar-mobile-toggler text-center">
				<a href="#" class="sidebar-mobile-main-toggle">
					<i class="icon-arrow-left8"></i>
				</a>
				Navigation
				<a href="#" class="sidebar-mobile-expand">
					<i class="icon-screen-full"></i>
					<i class="icon-screen-normal"></i>
				</a>
			</div>
			<!-- /sidebar mobile toggler -->


			<!-- Sidebar content -->
			<div class="sidebar-content">

				<?php /*<!-- User menu -->
				<div class="sidebar-user">
					<div class="card-body">
						<div class="media">
							<div class="mr-3">
								<a href="#"><img src="<?php echo base_url('global_assets/images/demo/users/face11.jpg');?>" width="38" height="38" class="rounded-circle" alt=""></a>
							</div>

							<div class="media-body">
								<div class="media-title font-weight-semibold">Victoria Baker</div>
								<div class="font-size-xs opacity-50">
									<i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
								</div>
							</div>

							<div class="ml-3 align-self-center">
								<a href="#" class="text-white"><i class="icon-cog3"></i></a>
							</div>
						</div>
					</div>
				</div>
				<!-- /user menu -->*/?>


				<!-- Main navigation -->
				<div class="card card-sidebar-mobile">
					<ul class="nav nav-sidebar" data-nav-type="accordion">
                  
               <?php $menu_item = $this->UsersPermissionMstModel->get_record('', $login_info->users_type_id);
                     if (!empty($menu_item)) {
                     $i = 0;
                     foreach ($menu_item as $items) {
                        if ($items->is_navigation == '1') { ?>
                           <li><a href="<?php if ($items->url != '') { echo base_url($items->url);} else { echo '#';}?>" class="nav-link active"><?php if ($i == 0) { ?><i class="icon-home4"></i><?php $i++;
                                 } else { ?><i class="icon-list-unordered"></i><?php } ?> <span><?php echo $items->heading; ?></span></a>
                           <?php }
                              }
                     } ?>            
						<li class="nav-item nav-item-submenu">
							<a href="#" class="nav-link"><i class="icon-gear"></i> <span>Settings</span></a>
							<ul class="nav nav-group-sub" data-submenu-title="Layouts">
								<li class="nav-item"><a href="<?php echo base_url('ChangeProfile'); ?>" class="nav-link active"><i class="icon-user"></i> Update Profile</a></li>
								<li class="nav-item"><a href="<?php echo base_url('ChangePassword'); ?>" class="nav-link"><i class="icon-key"></i> Change Password</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<!-- /main navigation -->
			</div>
			<!-- /sidebar content -->			
		</div>
		<!-- /main sidebar -->
		<!-- Main content -->
		<div class="content-wrapper">