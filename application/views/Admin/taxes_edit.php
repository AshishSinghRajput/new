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
                  <a href="<?php echo base_url('Admin/ManageTaxes');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
            <form action="<?php echo base_url('Admin/ManageTaxes/edit/'.base64_encode($taxes_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Taxes Group <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="taxes_group_id" name="taxes_group_id" required>
                              <?php $select_taxes_group_id = '';
                                    if($this->input->post('submit')) {
                                        $select_taxes_group_id = $this->input->post('taxes_group_id');	 
                                    } else if(!empty($taxes_info)) {
                                        $select_taxes_group_id = $taxes_info->taxes_group_id;
                                    }?>
                              <option <?php if($select_taxes_group_id == '') {?>selected="selected"<?php }?> value="">Select Taxes Group</option>
                              <?php 
                                if(!empty($taxes_group_list)) {
                                    foreach ($taxes_group_list as $value) { ?>
                              <option <?php if($select_taxes_group_id == $value->taxes_group_id) {?>selected="selected"<?php }?> value="<?php echo $value->taxes_group_id;?>"><?php echo $value->taxes_group;?></option>
                              <?php }
                                 }?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('taxes_group_id');?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Taxes Title <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $taxes_title_value = '';
                              if($this->input->post('submit')) {
                              $taxes_title_value = $this->input->post('taxes_title');	 
                              } else if(!empty($taxes_info)) {
                                  $taxes_title_value = $taxes_info->taxes_title;
                              }?>
                           <input type="text" required id="taxes_title" name="taxes_title" placeholder="Enter your taxes title" class="form-control" maxlength="255" value="<?php echo $taxes_title_value;?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('taxes_title');?></span>
                        </div>
                     </div>
                  </div>                   
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Taxes Value <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $taxes_value_value = '';
                              if($this->input->post('submit')) {
                                 $taxes_value_value = $this->input->post('taxes_value');	 
                              } else if(!empty($taxes_info)) {
                                 $taxes_value_value = $taxes_info->taxes_value;
                              }?>
                           <input type="text" required id="taxes_value" name="taxes_value" placeholder="Enter taxes value" class="form-control" minlength="0" maxlength="10" value="<?php echo $taxes_value_value;?>" autocomplete="off" />
                           <span class="badge badge-danger m-1"><?php echo form_error('taxes_value');?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Percent/Fixed <span class="text-hightlight">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                           <?php $is_percent_value = '';
                              if($this->input->post('submit')) {
                                 $is_percent_value = $this->input->post('is_percent');	 
                              } else if(!empty($taxes_info)) {
                                 $is_percent_value = $taxes_info->is_percent;
                              }?>
                           <input type="radio" id="is_percent" name="is_percent" value="1" <?php if($is_percent_value == '1') {?>checked="checked"<?php }?> />
                              <label for="is_percent">%</label>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <input type="radio" id="is_percent" name="is_percent" value="0" <?php if($is_percent_value == '0') {?>checked="checked"<?php }?> />
                              <label for="is_percent">Fixed</label>
                           </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <span class="badge badge-danger m-1"><?php echo form_error('is_percent');?></span>
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
                              } else if(!empty($taxes_info)) {
                                 $display_value = $taxes_info->display;
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
                              } else if(!empty($taxes_info)) {
                                  $priority_value = $taxes_info->priority;
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
                     <input type="submit" name="submit" class="btn btn-success" value="Update">
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