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
            <?php if($load_permission->is_add == '1') {?><a href="<?php echo base_url('Admin/FundsReceived/add');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?>
            <?php if($load_permission->is_edit == '1') {?><a href="<?php echo base_url('Admin/FundsReceived/edit/'.base64_encode($fund_received_info->fund_received_id));?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Edit</a><?php }?>
            <?php if($load_permission->is_edit == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/FundsReceived/del/'.base64_encode($fund_received_info->fund_received_id));?>" class="btn btn-danger btn-sm waves-effect waves-light m-1">Delete</a><?php }?>
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
               <form action="<?php echo base_url('Admin/FundsReceived/edit/'.base64_encode($fund_received_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
                  <div class="row">     
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Description of Bills</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $fund_received_info->bill_no;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $this->customlib->get_DDMMYYYY($fund_received_info->date);?>
                           </div>
                        </div>
                     </div>                      
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Scheme Name</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <a href="<?php echo base_url('Admin/Projects/view/'.base64_encode($fund_received_info->project_id));?>"><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $fund_received_info->project_id);
                                    if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></a>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12" style="display: none;">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Projects</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $fund_received_info->project_activity_id);
                                    if(!empty($project_activity_info)) { echo $project_activity_info['0']->activity_name;}?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Gross Amount</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo  $this->customlib->inr_format($fund_received_info->gross_amount);?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Net Amount Released</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo  $this->customlib->inr_format($fund_received_info->net_amount_released);?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Payment Mode</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $payment_mode_info = $this->PaymentModeMstModel->get_record($fund_received_info->payment_mode_id);
                                    if (!empty($payment_mode_info)) { echo $payment_mode_info['0']->payment_mode;} ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Bank Name</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php $bank_info = $this->BankMstModel->get_record($fund_received_info->bank_id);
                                    if (!empty($bank_info)) { echo $bank_info['0']->bank;} ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Transaction / Cheque No.</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $fund_received_info->transaction_no; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Transaction / Cheque Date</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $this->customlib->get_DDMMYYYY($fund_received_info->transaction_date); ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Branch</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $fund_received_info->branch; ?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Remarks</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $fund_received_info->remarks;?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <hr />
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Status</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php if($fund_received_info->status_id == 'Pending') {?>
                                    <span class="badge bg-grey-400"><?php echo $fund_received_info->status_id;?></span>
                                 <?php } else if($fund_received_info->status_id == 'In-Progress') {?>
                                    <span class="badge badge-info"><?php echo $fund_received_info->status_id;?></span>
                                 <?php } else if($fund_received_info->status_id == 'Accepted') {?>
                                    <span class="badge badge-primary"><?php echo $fund_received_info->status_id;?></span>
                                 <?php } else if($fund_received_info->status_id == 'Rejected') {?>
                                    <span class="badge badge-danger"><?php echo $fund_received_info->status_id;?></span>
                                 <?php }?>  
                              </div>
                           </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php echo $this->customlib->get_DDMMYYYY($fund_received_info->status_date); ?>
                              </div>
                           </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Remarks</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php echo $fund_received_info->status_remarks; ?>
                              </div>
                           </div>
                     </div>
                  </div>
                  <hr />
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Cancel Status</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php if ($fund_received_info->is_cancel == 'Yes') { ?><span class="badge badge-danger m-1">Yes</span><?php } else if ($fund_received_info->is_cancel == 'No') { ?><span class="badge badge-primary m-1">No</span><?php } ?>
                              </div>
                           </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php echo $this->customlib->get_DDMMYYYY($fund_received_info->cancel_date); ?>
                              </div>
                           </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Reason</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php echo $fund_received_info->cancel_reason; ?>
                              </div>
                           </div>
                     </div>
                  </div>
                  <?php /*
                  <div class="row">
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
</div>