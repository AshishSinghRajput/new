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
         <a href="<?php echo base_url('Admin/FundsReceived');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
               <form action="<?php echo base_url('Admin/FundsReceived/add');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Description of Bills <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $bill_no_value = '';
                                    if ($this->input->post('submit')) {
                                       $bill_no_value = $this->input->post('bill_no');
                                    } else if (!empty($fund_received_info)) {
                                       $bill_no_value = $fund_received_info->bill_no;
                                    }?>
                              <input type="text" required id="bill_no" name="bill_no" placeholder="Enter bill no" maxlength="50" class="form-control" value="<?php echo $bill_no_value; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('bill_no'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date<span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $date_value = date('Y-m-d');
                              if ($this->input->post('submit')) {
                                 $date_value = $this->input->post('date');
                              } else if (!empty($fund_received_info)) {
                                 $date_value = $fund_received_info->date;
                              } ?>
                              <input type="date" required id="date" name="date" placeholder="Enter date" maxlength="50" class="form-control" value="<?php echo $date_value; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('date'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Scheme Name <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" id="project_id" name="project_id" required>
                                 <?php $select_project_id = '';
                                       if($this->input->post('submit')) {
                                          $select_project_id = $this->input->post('project_id');	 
                                       } else if(!empty($fund_received_info)) {
                                          $select_project_id = $fund_received_info->project_id;
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
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Select Projects <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" id="project_activity_id" name="project_activity_id">
                                 <?php $select_project_activity_id = '';
                                       if($this->input->post('submit')) {
                                          $select_project_activity_id = $this->input->post('project_activity_id');	 
                                       } else if(!empty($fund_received_info)) {
                                          $select_project_activity_id = $fund_received_info->project_activity_id;
                                       }?>
                                 <option <?php if($select_project_activity_id == '') {?>selected="selected"<?php }?> value="">Select Projects</option>
                                 <?php 
                                 if(!empty($project_activity_list)) {
                                       foreach ($project_activity_list as $value) { ?>
                                 <option <?php if($select_project_activity_id == $value->project_activity_id) {?>selected="selected"<?php }?> value="<?php echo $value->project_activity_id;?>"><?php echo $value->activity_name;?></option>
                                 <?php }
                                    }?>
                              </select>
                              <span class="badge badge-danger m-1"><?php echo form_error('project_activity_id');?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Gross Amount <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $gross_amount_value = '0';
                                    if ($this->input->post('submit')) {
                                       $gross_amount_value = $this->input->post('gross_amount');
                                    } else if (!empty($fund_received_info)) {
                                       $gross_amount_value = $fund_received_info->gross_amount;
                                    } ?>
                                 <input type="text" name="gross_amount" id="gross_amount" class="form-control" value="<?php echo $gross_amount_value; ?>" maxlength="10" />
                                 <span class="badge badge-danger m-1"><?php echo form_error('gross_amount'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Net Amount Released <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $net_amount_released_value = '0';
                                    if ($this->input->post('submit')) {
                                       $net_amount_released_value = $this->input->post('net_amount_released');
                                    } else if (!empty($fund_received_info)) {
                                       $net_amount_released_value = $fund_received_info->net_amount_released;
                                    } ?>
                                 <input type="text" name="net_amount_released" id="net_amount_released" class="form-control" value="<?php echo $net_amount_released_value; ?>" maxlength="10" />
                                 <span class="badge badge-danger m-1"><?php echo form_error('net_amount_released'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Payment Mode <span class="text-hightlight">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <select class="form-control" id="payment_mode_id" name="payment_mode_id" required>
                                 <?php $select_payment_mode_id = '';
                                 if ($this->input->post('submit')) {
                                    $select_payment_mode_id = $this->input->post('payment_mode_id');
                                 } else if (!empty($fund_received_info)) {
                                    $select_payment_mode_id = $fund_received_info->payment_mode_id;
                                 } ?>
                                 <option <?php if ($select_payment_mode_id == '') { ?>selected="selected" <?php } ?> value="">Select Payment Mode</option>
                                 <?php
                                 if (!empty($payment_mode_list)) {
                                    foreach ($payment_mode_list as $value) { ?>
                                       <option <?php if ($select_payment_mode_id == $value->payment_mode_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->payment_mode_id; ?>"><?php echo $value->payment_mode; ?></option>
                                    <?php }
                                 } ?>
                              </select>
                              <span class="badge badge-danger m-1"><?php echo form_error('payment_mode_id'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Bank Name <span class="text-hightlight" style="display: none;">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $select_bank_id = '';
                              if ($this->input->post('submit')) {
                                 $select_bank_id = $this->input->post('bank_id');
                              } else if (!empty($fund_received_info)) {
                                 $select_bank_id = $fund_received_info->bank_id;
                              } ?>
                              <select class="form-control" id="bank_id" name="bank_id">
                                 <option value="">Select Bank</option>
                                 <?php
                                 if (!empty($bank_list)) {
                                    foreach ($bank_list as $value) { ?>
                                       <option <?php if ($select_bank_id == $value->bank_id) echo "selected"; ?> value="<?php echo $value->bank_id; ?>"><?php echo $value->bank; ?></option>
                                    <?php }
                                 } ?>
                              </select>
                              <span class="badge badge-danger m-1"><?php echo form_error('bank_id'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Transaction / Cheque No. <span class="text-hightlight" style="display: none;">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $transaction_no = '';
                              if ($this->input->post('submit')) {
                                 $transaction_no = $this->input->post('transaction_no');
                              } else if (!empty($fund_received_info)) {
                                 $transaction_no = $fund_received_info->transaction_no;
                              } ?>
                              <input type="text" id="transaction_no" name="transaction_no" placeholder="Enter transaction no." maxlength="20" class="form-control" value="<?php echo $transaction_no; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('transaction_no'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Transaction / Cheque Date <span class="text-hightlight" style="display: none;">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $transaction_date_value = date('Y-m-d');
                              if ($this->input->post('submit')) {
                                 $transaction_date_value = $this->input->post('transaction_date');
                              } else if (!empty($fund_received_info)) {
                                 $transaction_date_value = $fund_received_info->transaction_date;
                              } ?>
                              <input type="date" id="transaction_date" name="transaction_date" placeholder="Enter Transaction / Cheque Date" maxlength="50" class="form-control" value="<?php echo $transaction_date_value; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('transaction_date'); ?></span>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Branch <span class="text-hightlight" style="display: none;">*</span></label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $branch = '';
                              if ($this->input->post('submit')) {
                                 $branch = $this->input->post('branch');
                              } else if (!empty($fund_received_info)) {
                                 $branch = $fund_received_info->branch;
                              } ?>
                              <input type="text" id="branch" name="branch" placeholder="Enter branch" maxlength="255" class="form-control" value="<?php echo $branch; ?>" />
                              <span class="badge badge-danger m-1"><?php echo form_error('branch'); ?></span>
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
                                    } else if (!empty($fund_received_info)) {
                                       $remarks_value = $fund_received_info->remarks;
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
                        <input type="submit" name="submit" class="btn btn-success" value="Add New">
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>