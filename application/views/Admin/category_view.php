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
                  <?php if($load_permission->is_add == '1') {?><a href="<?php echo base_url('Admin/ManageCategory/add');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?> <?php if($load_permission->is_edit == '1') {?><a href="<?php echo base_url('Admin/ManageCategory/edit/'.base64_encode($category_info->category_id));?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Edit</a><?php }?> <?php if($load_permission->is_edit == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/ManageCategory/del/'.base64_encode($category_info->category_id));?>" class="btn btn-danger btn-sm waves-effect waves-light m-1">Delete</a><?php }?> <a href="<?php echo base_url('Admin/ManageCategory');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
            <form action="<?php echo base_url('Admin/ManageCategory/edit/'.base64_encode($category_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category Name</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $category_info->heading;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Images</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php if($category_info->thumbnail2 != '') {?>
                              <?php //echo base_url($this->config->item('category_thumbnail2').$category_info->thumbnail2);?>
                              <img src="<?php echo base_url($this->config->item('category_thumbnail2').$category_info->thumbnail2);?>" style="width: auto; height: 40px;" />
                           <?php }?>                                                  
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Parent</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php 
                              $parent_info = $this->CategoryMstModel->get_record($category_info->master_id);
                              if(!empty($parent_info)) { echo $parent_info['0']->heading;}?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Store Display</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php if($category_info->is_store == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('hide_confirmation');?>')" href="<?php echo base_url('Admin/ManageCategory/is_store/'.base64_encode($category_info->category_id).'/'.base64_encode('0'));?>" class=""><span class="badge badge-primary m-1">Visible</span></a><?php } else if($category_info->is_store == '0') {?><a onclick="return confirm('<?php echo $this->lang->line('visible_confirmation');?>')" href="<?php echo base_url('Admin/ManageCategory/is_store/'.base64_encode($category_info->category_id).'/'.base64_encode('1'));?>" class=""><span class="badge badge-warning m-1">Hide</span></a><?php }?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Priority</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $category_info->store_priority;?>
                        </div>
                     </div>
                  </div>
               </div>
               <?php /*<hr/>
               <div class="form-group row">
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