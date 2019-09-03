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
            <?php if($load_permission->is_add == '1') {?><a href="<?php echo base_url('Admin/ManageUsers/add');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?>
            <?php if($load_permission->is_edit == '1') {?><a href="<?php echo base_url('Admin/ManageUsers/edit/'.base64_encode($users_info->users_id));?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Edit</a><?php }?>
            <?php if($load_permission->is_edit == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/ManageUsers/del/'.base64_encode($users_info->users_id));?>" class="btn btn-danger btn-sm waves-effect waves-light m-1">Delete</a><?php }?>
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
               <form action="<?php echo base_url('Admin/ManageUsers/edit/'.base64_encode($users_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Department Name</label>
                           <div class="col-md-12 col-sm-12 col-xs-12"><?php echo $users_info->department_name;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Name</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $users_info->name;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Image <span class="text-hightlight" style="display: none;">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php if($users_info->thumbnail2 != '') {?>
                                 <?php //echo base_url($this->config->item('brand_thumbnail2').$users_info->thumbnail2);?>
                                 <img src="<?php echo base_url($this->config->item('users_thumbnail2').$users_info->thumbnail2);?>" style="width: auto; height: 40px;" />
                              <?php }?>  
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">                   
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile No.</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $users_info->mobile;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">E-mail</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $users_info->email;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Username</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $users_info->username;?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Password</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $users_info->forgot_psw;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Users Type</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $users_info->users_type;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Activation</label>
                           <div class="col-md-12 col-sm-12 col-xs-12"><?php if($users_info->activation == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('hide_confirmation');?>')" href="<?php echo base_url('Admin/ManageUsers/is_activation/'.base64_encode($users_info->users_id).'/'.base64_encode('0'));?>" class=""><span class="badge badge-primary m-1">Activate</span></a><?php } else if($users_info->activation == '0') {?><a onclick="return confirm('<?php echo $this->lang->line('visible_confirmation');?>')" href="<?php echo base_url('Admin/ManageUsers/is_activation/'.base64_encode($users_info->users_id).'/'.base64_encode('1'));?>" class=""><span class="badge badge-warning m-1">Deactivate</span></a><?php }?></div>
                        </div>
                     </div>
                  </div>
                  <?php /*
                  <div class="row">
                     <label class="col-md-12 col-sm-12 col-xs-12 col-form-label"></label>
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="submit" name="submit" class="btn btn-success" value="Update">
                     </div>
                  </div>*/?>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>