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
         <a href="<?php echo base_url('Admin/ManageUsersType');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
               <form action="<?php echo base_url('Admin/ManageUsersType/add');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Users Type <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $users_type_value = '';
                                 if($this->input->post('submit')) {
                                 $users_type_value = $this->input->post('users_type');	 
                                 } else if(!empty($users_type_info)) {
                                    $users_type_value = $users_type_info->users_type;
                                 }?>
                              <input type="text" required id="users_type" name="users_type" placeholder="Enter your users_type" class="form-control" maxlength="255" value="<?php echo $users_type_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('users_type');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Display <span class="text-hightlight">*</span></label>
                           <div class="col-md-6 col-sm-6 col-xs-6">
                              <div class="">
                              <?php $display_value = '';
                                 if($this->input->post('submit')) {
                                    $display_value = $this->input->post('display');	 
                                 } else if(!empty($users_type_info)) {
                                    $display_value = $users_type_info->display;
                                 }?>
                              <input type="radio" id="display" name="display" value="1" <?php if($display_value == '1') {?>checked="checked"<?php }?> />
                                 <label for="display">Visible</label>
                              </div>
                           </div>
                           <div class="col-md-6 col-sm-6 col-xs-6">
                              <div class="">
                                 <input type="radio" id="display" name="display" value="0" <?php if($display_value == '0') {?>checked="checked"<?php }?> />
                                 <label for="display">Hide</label>
                              </div>
                           </div>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <span class="badge badge-danger m-1"><?php echo form_error('display');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Priority <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $priority_value = '';
                                 if($this->input->post('submit')) {
                                 $priority_value = $this->input->post('priority');	 
                                 } else if(!empty($users_type_info)) {
                                    $priority_value = $users_type_info->priority;
                                 }?>
                              <input type="text" id="priority" name="priority" placeholder="Enter priority" minlength="0" maxlength="10" class="form-control" value="<?php echo $priority_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('priority');?></span>
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