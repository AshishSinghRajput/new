<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page header -->
<div class="page-header page-header-light">
   <div class="page-header-content header-elements-md-inline">
      <div class="page-title d-flex">
         <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $page_val['topbar'];?></span></h4>
         <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
      </div>

      <div class="header-elements d-none">
         <div class="d-flex justify-content-center">
            <a href="<?php echo base_url('Admin/ManageUsers');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
         </div>
      </div>
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
               <form action="<?php echo base_url('Admin/ManageUsers/add');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Department Name <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" id="department_id" name="department_id" required>
                                 <?php $select_department_id = '';
                                       if($this->input->post('submit')) {
                                          $select_department_id = $this->input->post('department_id');	 
                                       } else if(!empty($users_info)) {
                                          $select_department_id = $users_info->department_id;
                                       }?>
                                 <option <?php if($select_department_id == '') {?>selected="selected"<?php }?> value="">Select Department</option>
                                 <?php 
                                 if(!empty($department_list)) {
                                       foreach ($department_list as $value) { ?>
                                 <option <?php if($select_department_id == $value->department_id) {?>selected="selected"<?php }?> value="<?php echo $value->department_id;?>"><?php echo $value->department_name;?></option>
                                 <?php }
                                    }?>
                              </select>
                              <span class="badge badge-danger m-1"><?php echo form_error('department_id');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Name <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $name_value = ''; 
                                 if($this->input->post('submit')) {
                                    $name_value = $this->input->post('name');	 
                                 } else if(!empty($users_info)) {
                                    $name_value = $users_info->name;
                                 }?>
                              <input type="text" required id="name" name="name" placeholder="Enter your name" class="form-control" minlength="6" maxlength="255" value="<?php echo $name_value;?>" autocomplete="off" />
                              <span class="badge badge-danger m-1"><?php echo form_error('name');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Image <span class="text-hightlight" style="display: none;">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <input type="file" name="users_images" class="form-control" id="users_images" accept="image/*" onChange="checkfile(this, 'users_images');">                                
                              <span class="badge badge-danger m-1"><?php echo form_error('users_images');?></span>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $images_value = '';
                                    if((!empty($users_info)) && ($users_info->thumbnail2 != '')) {
                                       $images_value = $users_info->thumbnail2;?>
                           <img src="<?php echo base_url($this->config->item('users_thumbnail2').$images_value);?>" style="width: auto; height: 40px;" />
                           <?php }?>                                
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">                   
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile No. <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $mobile_value = '';
                                 if($this->input->post('submit')) {
                                    $mobile_value = $this->input->post('mobile');	 
                                 } else if(!empty($users_info)) {
                                    $mobile_value = $users_info->mobile;
                                 }?>
                              <input type="text" required id="mobile" name="mobile" placeholder="Enter mobile no." class="form-control" minlength="10" maxlength="10" value="<?php echo $mobile_value;?>" autocomplete="off" />
                              <span class="badge badge-danger m-1"><?php echo form_error('mobile');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">E-mail <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $email_value = '';
                                 if($this->input->post('submit')) {
                                    $email_value = $this->input->post('email');	 
                                 } else if(!empty($users_info)) {
                                    $email_value = $users_info->email;
                                 }?>
                              <input type="email" required id="email" name="email" placeholder="Enter e-mail" maxlength="255" class="form-control" autocomplete="off" value="<?php echo $email_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('email');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Username <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $username_value = '';
                                 if($this->input->post('submit')) {
                                    $username_value = $this->input->post('username');	 
                                 } else if(!empty($users_info)) {
                                    $username_value = $users_info->username;
                                 }?>
                              <input type="text" required id="username" name="username" placeholder="Enter username" minlength="6" maxlength="20" class="form-control" autocomplete="off" value="<?php echo $username_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('username');?></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Users Type <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" id="users_type_id" name="users_type_id" required>
                                 <?php $select_users_type_id = '';
                                       if($this->input->post('submit')) {
                                          $select_users_type_id = $this->input->post('users_type_id');	 
                                       } else if(!empty($users_info)) {
                                          $select_users_type_id = $users_info->users_type_id;
                                       }?>
                                 <option <?php if($select_users_type_id == '') {?>selected="selected"<?php }?> value="">Select Users Type</option>
                                 <?php 
                                 if(!empty($users_type_list)) {
                                       foreach ($users_type_list as $value) { ?>
                                 <option <?php if($select_users_type_id == $value->users_type_id) {?>selected="selected"<?php }?> value="<?php echo $value->users_type_id;?>"><?php echo $value->users_type;?></option>
                                 <?php }
                                    }?>
                              </select>
                              <span class="badge badge-danger m-1"><?php echo form_error('users_type_id');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Activation <span class="text-hightlight">*</span></label>
                           <div class="col-md-6 col-sm-6 col-xs-6">
                              <div class="">
                              <?php $activation_value = '';
                                 if($this->input->post('submit')) {
                                    $activation_value = $this->input->post('activation');	 
                                 } else if(!empty($users_info)) {
                                    $activation_value = $users_info->activation;
                                 }?>
                              <input type="radio" id="activation" name="activation" value="1" <?php if($activation_value == '1') {?>checked="checked"<?php }?> />
                                 <label for="activation">Activate</label>
                              </div>
                           </div>
                           <div class="col-md-6 col-sm-6 col-xs-6">
                              <div class="">
                                 <input type="radio" id="activation" name="activation" value="0" <?php if($activation_value == '0') {?>checked="checked"<?php }?> />
                                 <label for="activation">Deactivate</label>
                              </div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <span class="badge badge-danger m-1"><?php echo form_error('activation');?></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <label class="col-md-12 col-sm-12 col-xs-12 col-form-label"></label>
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="submit" name="submit" class="btn btn-success" value="Add New">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   function checkfile(sender, str) {
       var validExts = new Array('.jpg', '.jpeg', '.png');
       var fileExt = sender.value;
       fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
       if (validExts.indexOf(fileExt) < 0) {
           alert("Invalid file selected, valid files are of " +
                   validExts.toString() + " types.");
           document.getElementById(str).value='';
           return false;
       }
       else return true;
   }
</script>