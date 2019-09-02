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
                <?php if($load_permission->is_add == '1') {?><a href="<?php echo base_url('Admin/ManageTaxes/add');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?> <?php if($load_permission->is_edit == '1') {?><a href="<?php echo base_url('Admin/ManageTaxes/edit/'.base64_encode($taxes_info->taxes_id));?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Edit</a><?php }?> <?php if($load_permission->is_edit == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/ManageTaxes/del/'.base64_encode($taxes_info->taxes_id));?>" class="btn btn-danger btn-sm waves-effect waves-light m-1">Delete</a><?php }?> <a href="<?php echo base_url('Admin/ManageTaxes');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Taxes Group</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $taxes_info->taxes_group;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Taxes Title</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $taxes_info->taxes_title;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Taxes Value</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $taxes_info->taxes_value;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Percent/Fixed</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php if($taxes_info->is_percent == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('fixed_confirmation');?>')" href="<?php echo base_url('Admin/ManageTaxes/is_percent/'.base64_encode($taxes_info->taxes_id).'/'.base64_encode('0'));?>" class=""><span class="badge badge-success m-1">%</span></a><?php } else if($taxes_info->is_percent == '0') {?><a onclick="return confirm('<?php echo $this->lang->line('percent_confirmation');?>')" href="<?php echo base_url('Admin/ManageTaxes/is_percent/'.base64_encode($taxes_info->taxes_id).'/'.base64_encode('1'));?>" class=""><span class="badge badge-primary m-1">Fixed</span></a><?php }?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Display</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <?php if($taxes_info->display == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('hide_confirmation');?>')" href="<?php echo base_url('Admin/ManageTaxes/is_display/'.base64_encode($taxes_info->taxes_id).'/'.base64_encode('0'));?>" class=""><span class="badge badge-primary m-1">Visible</span></a><?php } else if($taxes_info->display == '0') {?><a onclick="return confirm('<?php echo $this->lang->line('visible_confirmation');?>')" href="<?php echo base_url('Admin/ManageTaxes/is_display/'.base64_encode($taxes_info->taxes_id).'/'.base64_encode('1'));?>" class=""><span class="badge badge-warning m-1">Hide</span></a><?php }?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Priority</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $taxes_info->priority;?>
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