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
         <a href="<?php echo base_url('Admin/ActivitesUnderProject');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
               <form action="<?php echo base_url('Admin/ActivitesUnderProject/edit/'.base64_encode($project_activity_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Scheme Name <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" id="project_id" name="project_id" required>
                                 <?php $select_project_id = '';
                                       if($this->input->post('submit')) {
                                          $select_project_id = $this->input->post('project_id');	 
                                       } else if(!empty($project_activity_info)) {
                                          $select_project_id = $project_activity_info->project_id;
                                       }?>
                                 <option <?php if($select_project_id == '') {?>selected="selected"<?php }?> value="">Select Scheme</option>
                                 <?php 
                                 if(!empty($projects_list)) {
                                       foreach ($projects_list as $value) { ?>
                                 <option <?php if($select_project_id == $value->project_id) {?>selected="selected"<?php }?> value="<?php echo $value->project_id;?>"><?php echo $value->project_name;?></option>
                                 <?php }
                                    }?>
                              </select>
                              <span class="badge badge-danger m-1"><?php echo form_error('project_id');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Projects <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $activity_name_value = '';
                                 if($this->input->post('submit')) {
                                 $activity_name_value = $this->input->post('activity_name');	 
                                 } else if(!empty($project_activity_info)) {
                                    $activity_name_value = $project_activity_info->activity_name;
                                 }?>
                              <input type="text" required id="activity_name" name="activity_name" placeholder="Enter your name of the work" class="form-control" maxlength="255" value="<?php echo $activity_name_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('activity_name');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Address <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $address_value = '';
                                 if($this->input->post('submit')) {
                                 $address_value = $this->input->post('address');	 
                                 } else if(!empty($project_activity_info)) {
                                    $address_value = $project_activity_info->address;
                                 }?>
                              <input type="text" required id="address" name="address" placeholder="Enter your address" class="form-control" maxlength="255" value="<?php echo $address_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('address');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Funds allocated <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $funds_allocated_value = '0';
                                    if ($this->input->post('submit')) {
                                       $funds_allocated_value = $this->input->post('funds_allocated');
                                    } else if (!empty($project_activity_info)) {
                                       $funds_allocated_value = $project_activity_info->funds_allocated;
                                    } ?>
                                 <input type="text" name="funds_allocated" id="funds_allocated" class="form-control" value="<?php echo $funds_allocated_value; ?>" maxlength="20" />
                                 <span class="badge badge-danger m-1"><?php echo form_error('funds_allocated'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Technical Sanction Amount <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $sanction_amount_value = '0';
                                    if ($this->input->post('submit')) {
                                       $sanction_amount_value = $this->input->post('sanction_amount');
                                    } else if (!empty($project_activity_info)) {
                                       $sanction_amount_value = $project_activity_info->sanction_amount;
                                    } ?>
                                 <input type="text" name="sanction_amount" id="sanction_amount" class="form-control" value="<?php echo $sanction_amount_value; ?>" maxlength="20" />
                                 <span class="badge badge-danger m-1"><?php echo form_error('sanction_amount'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">DNIT Amount <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $dnit_amount_value = '0';
                                    if ($this->input->post('submit')) {
                                       $dnit_amount_value = $this->input->post('dnit_amount');
                                    } else if (!empty($project_activity_info)) {
                                       $dnit_amount_value = $project_activity_info->dnit_amount;
                                    } ?>
                                 <input type="text" name="dnit_amount" id="dnit_amount" class="form-control" value="<?php echo $dnit_amount_value; ?>" maxlength="20" />
                                 <span class="badge badge-danger m-1"><?php echo form_error('dnit_amount'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Allotment Below / above <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $allotment_below_above_value = '0';
                                    if ($this->input->post('submit')) {
                                       $allotment_below_above_value = $this->input->post('allotment_below_above');
                                    } else if (!empty($project_activity_info)) {
                                       $allotment_below_above_value = $project_activity_info->allotment_below_above;
                                    } ?>
                                 <input type="text" name="allotment_below_above" id="allotment_below_above" class="form-control" value="<?php echo $allotment_below_above_value; ?>" maxlength="20" />
                                 <span class="badge badge-danger m-1"><?php echo form_error('allotment_below_above'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Allotment Amount <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $allotment_amount_value = '0';
                                    if ($this->input->post('submit')) {
                                       $allotment_amount_value = $this->input->post('allotment_amount');
                                    } else if (!empty($project_activity_info)) {
                                       $allotment_amount_value = $project_activity_info->allotment_amount;
                                    } ?>
                                 <input type="text" name="allotment_amount" id="allotment_amount" class="form-control" value="<?php echo $allotment_amount_value; ?>" maxlength="20" />
                                 <span class="badge badge-danger m-1"><?php echo form_error('allotment_amount'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Contractor Name <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" id="contractor_id" name="contractor_id" required>
                                 <?php $select_contractor_id = '';
                                       if($this->input->post('submit')) {
                                          $select_contractor_id = $this->input->post('contractor_id');	 
                                       } else if(!empty($project_activity_info)) {
                                          $select_contractor_id = $project_activity_info->contractor_id;
                                       }?>
                                 <option <?php if($select_contractor_id == '') {?>selected="selected"<?php }?> value="">Select Contractor</option>
                                 <?php 
                                 if(!empty($contractor_list)) {
                                       foreach ($contractor_list as $value) { ?>
                                 <option <?php if($select_contractor_id == $value->users_id) {?>selected="selected"<?php }?> value="<?php echo $value->users_id;?>"><?php echo $value->name;?></option>
                                 <?php }
                                    }?>
                              </select>
                              <span class="badge badge-danger m-1"><?php echo form_error('contractor_id');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12" style="display; none;">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Supervisor Name <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" id="supervisor_id" name="supervisor_id">
                                 <?php $select_supervisor_id = '';
                                       if($this->input->post('submit')) {
                                          $select_supervisor_id = $this->input->post('supervisor_id');	 
                                       } else if(!empty($project_activity_info)) {
                                          $select_supervisor_id = $project_activity_info->supervisor_id;
                                       }?>
                                 <option <?php if($select_supervisor_id == '') {?>selected="selected"<?php }?> value="">Select Supervisor</option>
                                 <?php 
                                 if(!empty($supervisor_list)) {
                                       foreach ($supervisor_list as $value) { ?>
                                 <option <?php if($select_supervisor_id == $value->users_id) {?>selected="selected"<?php }?> value="<?php echo $value->users_id;?>"><?php echo $value->name;?></option>
                                 <?php }
                                    }?>
                              </select>
                              <span class="badge badge-danger m-1"><?php echo form_error('supervisor_id');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date of Start <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $date_start_value = date('Y-m-d');
                              if ($this->input->post('submit')) {
                                 $date_start_value = $this->input->post('date_start');
                              } else if (!empty($sales_mst_info)) {
                                 $date_start_value = $sales_mst_info->date_start;
                              } ?>
                              <input type="date" required id="date_start" name="date_start" placeholder="Enter scheduled date completion" maxlength="50" class="form-control" value="<?php echo $date_start_value; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('date_start'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Scheduled Date of Completion <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $scheduled_date_completion_value = date('Y-m-d');
                              if ($this->input->post('submit')) {
                                 $scheduled_date_completion_value = $this->input->post('scheduled_date_completion');
                              } else if (!empty($sales_mst_info)) {
                                 $scheduled_date_completion_value = $sales_mst_info->scheduled_date_completion;
                              } ?>
                              <input type="date" required id="scheduled_date_completion" name="scheduled_date_completion" placeholder="Enter scheduled date completion" maxlength="50" class="form-control" value="<?php echo $scheduled_date_completion_value; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('scheduled_date_completion'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Extension if any <span class="text-hightlight" style="display: none;">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $extension_value = '';
                                 if($this->input->post('submit')) {
                                 $extension_value = $this->input->post('extension');	 
                                 } else if(!empty($project_activity_info)) {
                                    $extension_value = $project_activity_info->extension;
                                 }?>
                              <input type="text" id="extension" name="extension" placeholder="Enter your extension" class="form-control" maxlength="255" value="<?php echo $extension_value;?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('extension');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Expenditure / payment released <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $expenditure_released_value = '0';
                                    if ($this->input->post('submit')) {
                                       $expenditure_released_value = $this->input->post('expenditure_released');
                                    } else if (!empty($project_activity_info)) {
                                       $expenditure_released_value = $project_activity_info->expenditure_released;
                                    } ?>
                                 <input type="text" name="expenditure_released" id="expenditure_released" class="form-control" value="<?php echo $expenditure_released_value; ?>" maxlength="20" />
                                 <span class="badge badge-danger m-1"><?php echo form_error('expenditure_released'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Actual Date of Completion <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $actual_date_completion_value = date('Y-m-d');
                              if ($this->input->post('submit')) {
                                 $actual_date_completion_value = $this->input->post('actual_date_completion');
                              } else if (!empty($sales_mst_info)) {
                                 $actual_date_completion_value = $sales_mst_info->actual_date_completion;
                              } ?>
                              <input type="date" required id="actual_date_completion" name="actual_date_completion" placeholder="Enter actual date completion" maxlength="50" class="form-control" value="<?php echo $actual_date_completion_value; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('actual_date_completion'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Remarks <span class="text-hightlight" style="display: none;">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $remarks_value = '';
                                    if ($this->input->post('submit')) {
                                       $remarks_value = $this->input->post('remarks');
                                    } else if (!empty($project_activity_info)) {
                                       $remarks_value = $project_activity_info->remarks;
                                    } ?>
                              <input type="text" id="remarks" name="remarks" placeholder="Enter remarks" maxlength="255" class="form-control" value="<?php echo $remarks_value; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('remarks'); ?></span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
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
</div>