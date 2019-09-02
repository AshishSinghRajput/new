<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                  <div class="card-title text-uppercase"><?php echo $page_val['topbar'];?></div>
               </div>
               <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                  <?php /*<a href="<?php echo base_url('Admin/ManageStore');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>*/?>
               </div>
            </div>
            <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('ses_success'))) {?>
            <div id="alert_message" class="alert alert-outline-success alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert">×</button>			
               <div class="alert-message">
                  <span><strong>Success!</strong> <?php echo $this->session->flashdata('ses_success');?></span>
               </div>
            </div>
            <?php }?>
            <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('error_msg'))) {?>
            <div id="alert_message" class="alert alert-outline-warning alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert">×</button>			
               <div class="alert-message">
                  <span><strong>Error!</strong> <?php echo $this->session->flashdata('error_msg');?></span>
               </div>
            </div>
            <?php }?>
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
               <hr/>
               <div class="form-group row">
                  <label class="col-md-12 col-sm-12 col-xs-12 col-form-label"></label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <input type="submit" name="submit" class="btn btn-success" value="Change Profile">
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>