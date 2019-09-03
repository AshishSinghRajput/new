<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page header -->
<div class="page-header page-header-light">
   <div class="page-header-content header-elements-md-inline">
      <div class="page-title d-flex">
         <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $page_val['topbar'];?></span></h4>
         <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
      </div>

      <?php /*<div class="header-elements d-none">
         <div class="d-flex justify-content-center">
            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
            <a href="#" class="btn btn-link btn-float text-default"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
         </div>
      </div>*/?>
   </div>

   <?php /*<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
      <div class="d-flex">
         <div class="breadcrumb">
            <a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
            <span class="breadcrumb-item active">Dashboard</span>
         </div>

         <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
      </div>

      <div class="header-elements d-none">
         <div class="breadcrumb justify-content-center">
            <a href="#" class="breadcrumb-elements-item">
               <i class="icon-comment-discussion mr-2"></i>
               Support
            </a>

            <div class="breadcrumb-elements-item dropdown p-0">
               <a href="#" class="breadcrumb-elements-item dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-gear mr-2"></i>
                  Settings
               </a>

               <div class="dropdown-menu dropdown-menu-right">
                  <a href="#" class="dropdown-item"><i class="icon-user-lock"></i> Account security</a>
                  <a href="#" class="dropdown-item"><i class="icon-statistics"></i> Analytics</a>
                  <a href="#" class="dropdown-item"><i class="icon-accessibility"></i> Accessibility</a>
                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item"><i class="icon-gear"></i> All settings</a>
               </div>
            </div>
         </div>
      </div>
   </div>*/?>
</div>
<!-- /page header -->
<div class="content">
   <div class="row">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header header-elements-sm-inline">
               <div class="ml-12" style="width: 100%; margin-top: 10px;">
                  <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('ses_success'))) {?>
                     <div id="alert_message" class="alert alert-primary border-0 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Success !</span> <?php echo $this->session->flashdata('ses_success');?>
                        </div>
                  <?php }?>
                  <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('error_msg'))) {?>

                     <div id="alert_message" class="alert alert-danger border-0 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                        <span class="font-weight-semibold">Error !</span> <?php echo $this->session->flashdata('error_msg');?>.
                        </div>
                  <?php }?>
               </div>
            </div>
            <div class="card-body">
               <form action="<?php echo base_url('ChangeProfile');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  <div class="row">
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Name <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $name_value = ''; 
                                 if($this->input->post('submit')) {
                                    $name_value = $this->input->post('name');	 
                                 } else if(!empty($login_info)) {
                                    $name_value = $login_info->name;
                                 }?>
                              <input type="text" required id="name" name="name" placeholder="Enter your name" class="form-control" minlength="6" maxlength="255" value="<?php echo $name_value;?>" autocomplete="off" />
                              <span class="badge badge-danger m-1"><?php echo form_error('name');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile No. <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $mobile_value = '';
                                 if($this->input->post('submit')) {
                                    $mobile_value = $this->input->post('mobile');	 
                                 } else if(!empty($login_info)) {
                                    $mobile_value = $login_info->mobile;
                                 }?>
                              <input type="text" required id="mobile" name="mobile" placeholder="Enter mobile no." class="form-control" minlength="10" maxlength="10" value="<?php echo $mobile_value;?>" autocomplete="off" />
                              <span class="badge badge-danger m-1"><?php echo form_error('mobile');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">E-mail <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $email_value = '';
                                 if($this->input->post('submit')) {
                                    $email_value = $this->input->post('email');	 
                                 } else if(!empty($login_info)) {
                                    $email_value = $login_info->email;
                                 }?>
                              <input type="email" required id="email" name="email" placeholder="Enter e-mail" maxlength="255" class="form-control" autocomplete="off" value="<?php echo $email_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('email');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Username <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $username_value = '';
                                 if($this->input->post('submit')) {
                                    $username_value = $this->input->post('username');	 
                                 } else if(!empty($login_info)) {
                                    $username_value = $login_info->username;
                                 }?>
                              <input type="text" required id="username" name="username" placeholder="Enter username" minlength="6" maxlength="20" class="form-control" autocomplete="off" value="<?php echo $username_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('username');?></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="submit" name="submit" class="btn btn-success" value="Change Profile">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>