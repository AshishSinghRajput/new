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
                  <a href="<?php echo base_url('Admin/ManageCategory');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
            <form action="<?php echo base_url('Admin/ManageCategory/add');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category Name <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $heading_value = '';
                              if($this->input->post('submit')) {
                              $heading_value = $this->input->post('heading');	 
                              } else if(!empty($category_info)) {
                                  $heading_value = $category_info->heading;
                              }?>
                           <input type="text" required id="heading" name="heading" placeholder="Enter your category name" class="form-control" maxlength="255" value="<?php echo $heading_value;?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('heading');?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Images <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <input type="file" name="category_images" class="form-control" id="category_images" accept="image/*" onChange="checkfile(this, 'category_images');">                                
                           <span class="badge badge-danger m-1"><?php echo form_error('category_images');?></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $logo_value = '';
                                 if((!empty($category_info)) && ($category_info->thumbnail2 != '')) {
                                 $logo_value = $category_info->thumbnail2;?>
                          <img src="<?php echo base_url($this->config->item('category_thumbnail2').$logo_value);?>" style="width: auto; height: 40px;" />
                          <?php }?>                                
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Parent</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="master_id" name="master_id">
                              <?php $select_master_id = '';
                                    if($this->input->post('submit')) {
                                        $select_master_id = $this->input->post('master_id');	 
                                    } else if(!empty($category_info)) {
                                        $select_master_id = $category_info->master_id;
                                    }?>
                              <option <?php if($select_master_id == '0') {?>selected="selected"<?php }?> value="0">Select Parent</option>
                              <?php 
                                if(!empty($category_list)) {
                                    foreach ($category_list as $value) { ?>
                              <option <?php if($select_master_id == $value->category_id) {?>selected="selected"<?php }?> value="<?php echo $value->category_id;?>"><?php echo $value->heading;?></option>
                              <?php }
                                 }?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('master_id');?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Store Display <span class="text-hightlight">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                           <?php $is_store_value = '';
                              if($this->input->post('submit')) {
                                 $is_store_value = $this->input->post('is_store');	 
                              } else if(!empty($category_info)) {
                                 $is_store_value = $category_info->is_store;
                              }?>
                           <input type="radio" id="is_store" name="is_store" value="1" <?php if($is_store_value == '1') {?>checked="checked"<?php }?> />
                              <label for="is_store">Visible</label>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <input type="radio" id="is_store" name="is_store" value="0" <?php if($is_store_value == '0') {?>checked="checked"<?php }?> />
                              <label for="is_store">Hide</label>
                           </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <span class="badge badge-danger m-1"><?php echo form_error('is_store');?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Priority <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $store_priority_value = '';
                              if($this->input->post('submit')) {
                              $store_priority_value = $this->input->post('store_priority');	 
                              } else if(!empty($category_info)) {
                                  $store_priority_value = $category_info->store_priority;
                              }?>
                           <input type="text" id="store_priority" name="store_priority" placeholder="Enter priority" minlength="0" maxlength="10" class="form-control" value="<?php echo $store_priority_value;?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('store_priority');?></span>
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