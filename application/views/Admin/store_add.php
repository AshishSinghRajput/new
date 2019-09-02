<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                  <div class="card-title text-uppercase"><?php echo $page_val['topbar']; ?></div>
               </div>
               <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                  <a href="<?php echo base_url('Admin/ManageStore'); ?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
               </div>
            </div>
            <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('ses_success'))) { ?>
               <div id="alert_message" class="alert alert-outline-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <div class="alert-message">
                     <span><strong>Success!</strong> <?php echo $this->session->flashdata('ses_success'); ?></span>
                  </div>
               </div>
            <?php } ?>
            <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('error_msg'))) { ?>
               <div id="alert_message" class="alert alert-outline-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <div class="alert-message">
                     <span><strong>Error!</strong> <?php echo $this->session->flashdata('error_msg'); ?></span>
                  </div>
               </div>
            <?php } ?>
         </div>
         <div class="card-body">
            <form action="<?php echo base_url('Admin/ManageStore/add'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Store Name <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $store_name_value = '';
                           if ($this->input->post('submit')) {
                              $store_name_value = $this->input->post('store_name');
                           } else if (!empty($store_info)) {
                              $store_name_value = $store_info->store_name;
                           } ?>
                           <input type="text" required id="store_name" name="store_name" placeholder="Enter your store name" class="form-control" maxlength="255" value="<?php echo $store_name_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('store_name'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Owner Name <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $owner_name_value = '';
                           if ($this->input->post('submit')) {
                              $owner_name_value = $this->input->post('owner_name');
                           } else if (!empty($store_info)) {
                              $owner_name_value = $store_info->owner_name;
                           } ?>
                           <input type="text" required id="owner_name" name="owner_name" placeholder="Enter your owner name" class="form-control" maxlength="255" value="<?php echo $owner_name_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('owner_name'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Logo <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <input type="file" name="store_images" class="form-control" id="store_images" accept="image/*" onChange="checkfile(this, 'store_images');">
                           <span class="badge badge-danger m-1"><?php echo form_error('store_images'); ?></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $logo_value = '';
                           if ((!empty($store_info)) && ($store_info->thumbnail2 != '')) {
                              $logo_value = $store_info->thumbnail2; ?>
                              <img src="<?php echo base_url($this->config->item('store_thumbnail2') . $logo_value); ?>" style="width: auto; height: 40px;" />
                           <?php } ?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Address <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $address_value = '';
                           if ($this->input->post('submit')) {
                              $address_value = $this->input->post('address');
                           } else if (!empty($store_info)) {
                              $address_value = $store_info->address;
                           } ?>
                           <input type="text" required id="address" name="address" placeholder="Enter your address" class="form-control" maxlength="255" value="<?php echo $address_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('address'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">State <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="state_name" name="state_name" required>
                              <?php $select_state = '';
                              if ($this->input->post('submit')) {
                                 $select_state = $this->input->post('state_name');
                              } else if (!empty($store_info)) {
                                 $select_state = $store_info->state_name;
                              } ?>
                              <option <?php if ($select_state == '') { ?>selected="selected" <?php } ?> value="">Select State</option>
                              <?php
                              if (!empty($state_list)) {
                                 foreach ($state_list as $value) { ?>
                                    <option <?php if ($select_state == $value->state_name) { ?>selected="selected" <?php } ?> value="<?php echo $value->state_name; ?>"><?php echo $value->state_name; ?></option>
                                 <?php }
                              } ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">City <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="city_name" name="city_name" required>
                              <?php $select_city = '';
                              if ($this->input->post('submit')) {
                                 $select_city = $this->input->post('city_name');
                              } else if (!empty($store_info)) {
                                 $select_city = $store_info->city_name;
                              } ?>
                              <option <?php if ($select_city == '') { ?>selected="selected" <?php } ?> value="">Select City</option>
                              <?php
                              if (!empty($city_list)) {
                                 foreach ($city_list as $value) { ?>
                                    <option <?php if ($select_city == $value->city_name) { ?>selected="selected" <?php } ?> value="<?php echo $value->city_name; ?>"><?php echo $value->city_name; ?></option>
                                 <?php }
                              } ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Zip code <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $zip_code_value = '';
                           if ($this->input->post('submit')) {
                              $zip_code_value = $this->input->post('zip_code');
                           } else if (!empty($store_info)) {
                              $zip_code_value = $store_info->zip_code;
                           } ?>
                           <input type="text" id="zip_code" name="zip_code" placeholder="Enter zip code" class="form-control" minlength="6" maxlength="6" value="<?php echo $zip_code_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('zip_code'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile No. 1 <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $mobile1_value = '';
                           if ($this->input->post('submit')) {
                              $mobile1_value = $this->input->post('mobile1');
                           } else if (!empty($store_info)) {
                              $mobile1_value = $store_info->mobile1;
                           } ?>
                           <input type="text" required id="mobile1" name="mobile1" placeholder="Enter mobile no. 1" class="form-control" minlength="10" maxlength="10" value="<?php echo $mobile1_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('mobile1'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile No. 2 <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $mobile2_value = '';
                           if ($this->input->post('submit')) {
                              $mobile2_value = $this->input->post('mobile2');
                           } else if (!empty($store_info)) {
                              $mobile2_value = $store_info->mobile2;
                           } ?>
                           <input type="text" id="mobile2" name="mobile2" placeholder="Enter mobile no. 2" class="form-control" minlength="10" maxlength="10" value="<?php echo $mobile2_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('mobile2'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">E-mail <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $email_value = '';
                           if ($this->input->post('submit')) {
                              $email_value = $this->input->post('email');
                           } else if (!empty($store_info)) {
                              $email_value = $store_info->email;
                           } ?>
                           <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" required id="email" name="email" placeholder="Enter e-mail" maxlength="255" class="form-control" value="<?php echo $email_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('email'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Website <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $website_value = '';
                           if ($this->input->post('submit')) {
                              $website_value = $this->input->post('website');
                           } else if (!empty($store_info)) {
                              $website_value = $store_info->website;
                           } ?>
                           <input type="text" id="website" name="website" placeholder="Enter website" maxlength="255" class="form-control" value="<?php echo $website_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('website'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <hr />
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">GSIN No. <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $gsin_no_value = '';
                           if ($this->input->post('submit')) {
                              $gsin_no_value = $this->input->post('gsin_no');
                           } else if (!empty($store_info)) {
                              $gsin_no_value = $store_info->gsin_no;
                           } ?>
                           <input type="text" id="gsin_no" name="gsin_no" placeholder="Enter gsin no." maxlength="20" class="form-control" value="<?php echo $gsin_no_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('gsin_no'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">PAN No. <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $pan_no_value = '';
                           if ($this->input->post('submit')) {
                              $pan_no_value = $this->input->post('pan_no');
                           } else if (!empty($store_info)) {
                              $pan_no_value = $store_info->pan_no;
                           } ?>
                           <input type="text" id="pan_no" name="pan_no" placeholder="Enter pan no." minlength="10" maxlength="10" class="form-control" value="<?php echo $pan_no_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('pan_no'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Aadhar No. <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $aadhar_no_value = '';
                           if ($this->input->post('submit')) {
                              $aadhar_no_value = $this->input->post('aadhar_no');
                           } else if (!empty($store_info)) {
                              $aadhar_no_value = $store_info->aadhar_no;
                           } ?>
                           <input type="text" id="aadhar_no" name="aadhar_no" placeholder="Enter aadhar no." minlength="12" maxlength="12" class="form-control" value="<?php echo $aadhar_no_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('aadhar_no'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Display <span class="text-hightlight">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <?php $display_value = '';
                              if ($this->input->post('submit')) {
                                 $display_value = $this->input->post('display');
                              } else if (!empty($store_info)) {
                                 $display_value = $store_info->display;
                              } ?>
                              <input type="radio" id="display" name="display" value="1" <?php if ($display_value == '1') { ?>checked="checked" <?php } ?> />
                              <label for="display">Visible</label>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <input type="radio" id="display" name="display" value="0" <?php if ($display_value == '0') { ?>checked="checked" <?php } ?> />
                              <label for="display">Hide</label>
                           </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <span class="badge badge-danger m-1"><?php echo form_error('display'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Priority <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $priority_value = '';
                           if ($this->input->post('submit')) {
                              $priority_value = $this->input->post('priority');
                           } else if (!empty($store_info)) {
                              $priority_value = $store_info->priority;
                           } ?>
                           <input type="text" id="priority" name="priority" placeholder="Enter priority" minlength="10" maxlength="0" class="form-control" value="<?php echo $priority_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('priority'); ?></span>
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
         //alert('<?php echo base_url(); ?>Ajaxloader/get_city/'+data)	;
         $.get('<?php echo base_url(); ?>Ajaxloader/get_city/' + data, function(resp) {
            $('#city_name').html(resp);
         });
      });
   });
</script>