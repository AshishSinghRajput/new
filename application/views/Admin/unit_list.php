<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
   <div class="col-lg-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                  <div class="card-title text-uppercase"><?php echo $page_val['topbar'];?></div>
               </div>
               <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                  <?php if($load_permission->is_add == '1') {?><a href="<?php echo base_url('Admin/ManageUnit/add');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?>
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
            <form action="<?php echo base_url('Admin/ManageUnit');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <?php if(!empty($unit_info)) {?>
                     <div class="table-responsive">
                        <table id="example" class="table table-bordered">
                           <thead>
                              <tr>
                                 <th class="text-center">Sr.No.</th>
                                 <th class="text-center">Unit Group</th>
                                 <th class="text-center">Unit Title</th>
                                 <th class="text-center">Unit Short</th>
                                 <th class="text-center">Unit Value</th>
                                 <th class="text-center">Default</th>
                                 <th class="text-center">Display</th>
                                 <th class="text-center">Priority</th>
                                 <th class="text-center"><label>Action</label></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php $sr = 1;
                                 foreach($unit_info as $value) {?>
                              <tr>
                                 <td><?php echo $sr; $sr++; //$value->unit_id;?></td>
                                 <td><?php echo $value->unit_group;?></td>
                                 <td><?php echo $value->unit_title;?></td>
                                 <td class="text-right"><?php echo $value->unit_short;?></td>
                                 <td class="text-right"><?php echo $value->unit_value;?></td>
                                 <td class="text-center"><?php if($value->is_default == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('default_yes_no_confirmation');?>')" href="<?php echo base_url('Admin/ManageUnit/is_default/'.base64_encode($value->unit_id).'/'.base64_encode('0'));?>" class=""><span class="badge badge-success m-1">Yes</span></a><?php } else if($value->is_default == '0') {?><a onclick="return confirm('<?php echo $this->lang->line('default_yes_no_confirmation');?>')" href="<?php echo base_url('Admin/ManageUnit/is_default/'.base64_encode($value->unit_id).'/'.base64_encode('1'));?>" class=""><span class="badge badge-primary m-1">No</span></a><?php }?></td>
                                 <td class="text-center"><?php if($value->display == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('hide_confirmation');?>')" href="<?php echo base_url('Admin/ManageUnit/is_display/'.base64_encode($value->unit_id).'/'.base64_encode('0'));?>" class=""><span class="badge badge-primary m-1">Visible</span></a><?php } else if($value->display == '0') {?><a onclick="return confirm('<?php echo $this->lang->line('visible_confirmation');?>')" href="<?php echo base_url('Admin/ManageUnit/is_display/'.base64_encode($value->unit_id).'/'.base64_encode('1'));?>" class=""><span class="badge badge-warning m-1">Hide</span></a><?php }?></td>
                                 <td class="text-right"><?php echo $value->priority;?></td>
                                 <td class="text-center"><?php if($load_permission->is_edit == '1') {?><a href="<?php echo base_url('Admin/ManageUnit/edit/'.base64_encode($value->unit_id));?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Edit</a><?php }?> <?php if($load_permission->is_delete == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/ManageUnit/del/'.base64_encode($value->unit_id));?>" class="btn btn-danger btn-sm waves-effect waves-light m-1">Delete</a><?php }?> <?php if($load_permission->is_view == '1') {?><a href="<?php echo base_url('Admin/ManageUnit/view/'.base64_encode($value->unit_id));?>" class="btn btn-info btn-sm waves-effect waves-light m-1">View</a><?php }?></td>
                              </tr>
                              <?php }?>
                           </tbody>
                        </table>
                     </div>
                     <?php } else {?>
                        <p><?php echo $this->lang->line('no_record_found');?></p>
                     <?php }?>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>