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
         <a href="<?php echo base_url('Admin/Supervisor');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
            <form action="<?php echo base_url('Admin/Supervisor/add'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Name <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $name_value = '';
                           if ($this->input->post('submit')) {
                              $name_value = $this->input->post('name');
                           } else if (!empty($supplier_info)) {
                              $name_value = $supplier_info->name;
                           } ?>
                           <input type="text" required id="name" name="name" placeholder="Enter supervisor name" class="form-control" maxlength="255" value="<?php echo $name_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('name'); ?></span>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile No. <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $mobile1_value = '';
                           if ($this->input->post('submit')) {
                              $mobile1_value = $this->input->post('mobile1');
                           } else if (!empty($supplier_info)) {
                              $mobile1_value = $supplier_info->mobile1;
                           } ?>
                           <input type="text" required id="mobile1" name="mobile1" placeholder="Enter mobile no. 1" class="form-control" minlength="10" maxlength="10" value="<?php echo $mobile1_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('mobile1'); ?></span>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">E-mail <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $email_value = '';
                           if ($this->input->post('submit')) {
                              $email_value = $this->input->post('email');
                           } else if (!empty($supplier_info)) {
                              $email_value = $supplier_info->email;
                           } ?>
                           <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required id="email" name="email" placeholder="Enter e-mail" maxlength="255" class="form-control" value="<?php echo $email_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('email'); ?></span>
                        </div>
                     </div>
                  </div>
                  
                
               </div>
               
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Designation <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $select_designation_id = '';
                           if ($this->input->post('submit')) {
                              $select_designation_id = $this->input->post('designation_id');
                           } else if (!empty($supplier_info)) {
                              $select_designation_id = $supplier_info->designation_id;
                           } ?>
                           <select class="form-control" id="designation_id" name="designation_id" required>
                              <option value="">Select Designation</option>
                              <?php
                              if (!empty($designation_list)) {
                                 foreach ($designation_list as $value) { ?>
                                    <option <?php if ($select_designation_id == $value->designation_id) echo "selected"; ?> value="<?php echo $value->designation_id; ?>"><?php echo $value->designation; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('designation_id'); ?></span>
                        </div>
                     </div>
                  </div>
                  
                  
               </div>
               
               <hr />
               <div class="form-group row">
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
         document.getElementById(str).value = '';
         return false;
      } else return true;
   }
</script>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
      $('#state_name').on("change", function(event) {
         var data = this.value;
         //alert('<?php echo base_url(); ?>Ajaxloader/get_city/'+data)  ;
         $.get('<?php echo base_url(); ?>Ajaxloader/get_city/' + data, function(resp) {
            $('#city_name').html(resp);
         });
      });
   });
</script>