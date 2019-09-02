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
                  <a href="<?php echo base_url('Admin/ManageUnit');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
            <form action="<?php echo base_url('Admin/ManageUnit/add');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Unit Group <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="unit_group_id" name="unit_group_id" required>
                              <?php $select_unit_group_id = '';
                                    if($this->input->post('submit')) {
                                        $select_unit_group_id = $this->input->post('unit_group_id');	 
                                    } else if(!empty($unit_info)) {
                                        $select_unit_group_id = $unit_info->unit_group_id;
                                    }?>
                              <option <?php if($select_unit_group_id == '') {?>selected="selected"<?php }?> value="">Select Unit Group</option>
                              <?php 
                                if(!empty($unit_group_list)) {
                                    foreach ($unit_group_list as $value) { ?>
                              <option <?php if($select_unit_group_id == $value->unit_group_id) {?>selected="selected"<?php }?> value="<?php echo $value->unit_group_id;?>"><?php echo $value->unit_group;?></option>
                              <?php }
                                 }?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('unit_group_id');?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Unit Title <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $unit_title_value = '';
                              if($this->input->post('submit')) {
                              $unit_title_value = $this->input->post('unit_title');	 
                              } else if(!empty($unit_info)) {
                                  $unit_title_value = $unit_info->unit_title;
                              }?>
                           <input type="text" required id="unit_title" name="unit_title" placeholder="Enter your unit title" class="form-control" maxlength="255" value="<?php echo $unit_title_value;?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('unit_title');?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Unit Short <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $unit_short_value = '';
                              if($this->input->post('submit')) {
                              $unit_short_value = $this->input->post('unit_short');	 
                              } else if(!empty($unit_info)) {
                                  $unit_short_value = $unit_info->unit_short;
                              }?>
                           <input type="text" required id="unit_short" name="unit_short" placeholder="Enter your unit short" class="form-control" maxlength="10" value="<?php echo $unit_short_value;?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('unit_short');?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Unit Value <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $unit_value_value = '';
                              if($this->input->post('submit')) {
                                 $unit_value_value = $this->input->post('unit_value');	 
                              } else if(!empty($unit_info)) {
                                 $unit_value_value = $unit_info->unit_value;
                              }?>
                           <input type="text" required id="unit_value" name="unit_value" placeholder="Enter unit value" class="form-control" minlength="0" maxlength="10" value="<?php echo $unit_value_value;?>" autocomplete="off" />
                           <span class="badge badge-danger m-1"><?php echo form_error('unit_value');?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Default <span class="text-hightlight">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                           <?php $is_default_value = '';
                              if($this->input->post('submit')) {
                                 $is_default_value = $this->input->post('is_default');	 
                              } else if(!empty($unit_info)) {
                                 $is_default_value = $unit_info->is_default;
                              }?>
                           <input type="radio" id="is_default" name="is_default" value="1" <?php if($is_default_value == '1') {?>checked="checked"<?php }?> />
                              <label for="is_default">Yes</label>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <input type="radio" id="is_default" name="is_default" value="0" <?php if($is_default_value == '0') {?>checked="checked"<?php }?> />
                              <label for="is_default">No</label>
                           </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <span class="badge badge-danger m-1"><?php echo form_error('is_default');?></span>
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
                              } else if(!empty($unit_info)) {
                                 $display_value = $unit_info->display;
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
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Priority <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $priority_value = '';
                              if($this->input->post('submit')) {
                              $priority_value = $this->input->post('priority');	 
                              } else if(!empty($unit_info)) {
                                  $priority_value = $unit_info->priority;
                              }?>
                           <input type="text" id="priority" name="priority" placeholder="Enter priority" minlength="0" maxlength="10" class="form-control" value="<?php echo $priority_value;?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('priority');?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <hr/>
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