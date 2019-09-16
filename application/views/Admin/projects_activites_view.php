<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!-- Page header -->
<div class="page-header page-header-light">
    <div class="page-header-content header-elements-md-inline">
        <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span
                    class="font-weight-semibold"><?php echo $page_val['topbar'];?></span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
        </div>

        <div class="header-elements d-none">
            <div class="d-flex justify-content-center">
                <?php if($load_permission->is_add == '1') {?><a
                    href="<?php echo base_url('Admin/ActivitesUnderProject/add');?>"
                    class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?>
                <?php if($load_permission->is_edit == '1') {?><a
                    href="<?php echo base_url('Admin/ActivitesUnderProject/edit/'.base64_encode($project_activity_info->project_activity_id));?>"
                    class="btn btn-primary btn-sm waves-effect waves-light m-1">Edit</a><?php }?>
                <?php if($load_permission->is_edit == '1') {?><a
                    onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')"
                    href="<?php echo base_url('Admin/ActivitesUnderProject/del/'.base64_encode($project_activity_info->project_activity_id));?>"
                    class="btn btn-danger btn-sm waves-effect waves-light m-1">Delete</a><?php }?>
                <a href="<?php echo base_url('Admin/ActivitesUnderProject');?>"
                    class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
                        <h2><?php echo $project_activity_info->activity_name;?></h2>
                        <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('ses_success'))) {?>
                        <div id="alert_message" class="alert alert-primary border-0 alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Success !</span>
                            <?php echo $this->session->flashdata('ses_success');?>
                        </div>
                        <?php }?>
                        <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('error_msg'))) {?>

                        <div id="alert_message" class="alert alert-danger border-0 alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Error !</span>
                            <?php echo $this->session->flashdata('error_msg');?>.
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="card-body">
                    <form
                        action="<?php echo base_url('Admin/ActivitesUnderProject/edit/'.base64_encode($project_activity_id));?>"
                        method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Scheme
                                        Name</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                    <a href="<?php echo base_url('Admin/Projects/view/'.base64_encode($project_activity_info->project_id));?>"><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $project_activity_info->project_id);
                                    if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21"
                                        class="col-md-12 col-sm-12 col-xs-12 col-form-label">Address</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $project_activity_info->address;?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Funds
                                        allocated</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->inr_format($project_activity_info->funds_allocated);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Technical
                                        Sanction Amount</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->inr_format($project_activity_info->sanction_amount);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">DNIT
                                        Amount</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->inr_format($project_activity_info->dnit_amount);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Allotment
                                        Below / above</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->inr_format($project_activity_info->allotment_below_above);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Allotment
                                        Amount</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->inr_format($project_activity_info->allotment_amount);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Name of
                                        Contractor</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $contractor_info = $this->UsersMstModel->get_record($project_activity_info->contractor_id);
                                    if(!empty($contractor_info)) {?><a target="_blank"
                                            href="<?php echo base_url('Admin/Contractor/view/'.base64_encode($project_activity_info->contractor_id));?>"><?php echo $contractor_info['0']->name;?></a><?php }?>
                                    </div>
                                </div>
                            </div>
                            <?php /*<div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Name of
                                        Supervisor</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $supervisor_info = $this->UsersMstModel->get_record($project_activity_info->supervisor_id);
                              if(!empty($supervisor_info)) { echo $supervisor_info['0']->name;}?>
                                    </div>
                                </div>
                            </div>*/?>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date of
                                        Start</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->get_DDMMYYYY($project_activity_info->date_start);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Scheduled
                                        Date of Completion</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->get_DDMMYYYY($project_activity_info->scheduled_date_completion);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Extension
                                        if any</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $project_activity_info->extension;?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Actual
                                        Date of Completion</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->get_DDMMYYYY($project_activity_info->actual_date_completion);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21"
                                        class="col-md-12 col-sm-12 col-xs-12 col-form-label">Expenditure / payment
                                        released</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $this->customlib->inr_format($project_activity_info->expenditure_released);?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21"
                                        class="col-md-12 col-sm-12 col-xs-12 col-form-label">Remarks</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $project_activity_info->remarks;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php /*<hr />
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Status</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php if($project_activity_info->status_id == 'Pending') {?>
                        <span class="badge bg-grey-400"><?php echo $project_activity_info->status_id;?></span>
                        <?php } else if($project_activity_info->status_id == 'In-Progress') {?>
                        <span class="badge badge-info"><?php echo $project_activity_info->status_id;?></span>
                        <?php } else if($project_activity_info->status_id == 'Accepted') {?>
                        <span class="badge badge-primary"><?php echo $project_activity_info->status_id;?></span>
                        <?php } else if($project_activity_info->status_id == 'Rejected') {?>
                        <span class="badge badge-danger"><?php echo $project_activity_info->status_id;?></span>
                        <?php }?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group row">
                <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo $this->customlib->get_DDMMYYYY($project_activity_info->status_date); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group row">
                <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Remarks</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo $project_activity_info->status_remarks; ?>
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
                    <?php if ($project_activity_info->is_cancel == 'Yes') { ?><span
                        class="badge badge-danger m-1">Yes</span><?php } else if ($project_activity_info->is_cancel == 'No') { ?><span
                        class="badge badge-primary m-1">No</span><?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group row">
                <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo $this->customlib->get_DDMMYYYY($project_activity_info->cancel_date); ?>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="form-group row">
                <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Reason</label>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php echo $project_activity_info->cancel_reason; ?>
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

<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header header-elements-sm-inline">
                    <div class="ml-12" style="width: 100%; margin-top: 10px;">
                        <h2>Expenditure Details</h2>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('Admin/ExpenditureDetails');?>" method="post"
                        enctype="multipart/form-data" accept-charset="utf-8">
                        <?php if(!empty($expenditure_details_info)) {?>
                        <div class="table-responsive">
                            <table class="table datatable-basic table-bordered">
                                <thead>
                                    <tr>
                                        <?php /*<th class="text-center">Sr.No.</th>*/?>
                                        <?php /*<th class="text-center" style="width: 200px;">Scheme_Name</th>
                                        <th class="text-center" style="width: 200px;">Projects</th>*/?>
                                        <th class="text-center">Running_Bill</th>
                                        <th class="text-center" style="width: 100px;">Date_of_Submit_Bill</th>
                                        <th class="text-center" style="width: 100px;">Date_of_payment</th>
                                        <th class="text-center">Description_of_Bills</th>
                                        <th class="text-center">Name_of_Contractor</th>
                                        <th class="text-center">Payment_Mode</th>
                                        <th class="text-center">Gross_Amount</th>
                                        <th class="text-center">Net_Amount_Payable</th>
                                        <th class="text-center">Amount_Released</th>
                                        <th class="text-center">Other_contigent_Payments/Expenses</th>
                                        <th class="text-center">Tota_Expenditure</th>
                                        <?php /*<th class="text-center">Bank Name</th>
                              <th class="text-center">Transaction / Cheque No.</th>
                              <th class="text-center">Transaction / Cheque Date</th>
                              <th class="text-center">Branch</th>*/?>
                                        <th class="text-center">Remarks</th>
                                        <?php /*<th class="text-center">Status</th>
                              <th class="text-center">Cancel</th>*/?>
                                        <?php /*<th class="text-center">Action</th>*/?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sr = 1;
                                          foreach($expenditure_details_info as $value) {?>
                                    <tr>
                                        <?php /*<td><?php echo $sr; $sr++; //$value->expenditure_id;?></td>*/?>
                                        <?php /*<td><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                       if(!empty($projects_info)) {?><a target="_blank"
                                                href="<?php echo base_url('Admin/Projects/view/'.base64_encode($value->project_id));?>"><?php echo $projects_info['0']->project_name;?></a><?php }?>
                                        </td>
                                        <td><?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $value->project_activity_id);
                                       if(!empty($project_activity_info)) {?><a target="_blank"
                                                href="<?php echo base_url('Admin/ActivitesUnderProject/view/'.base64_encode($value->project_activity_id));?>"><?php echo $project_activity_info['0']->activity_name;?></a><?php }?></a>
                                        </td>*/?>
                                        <td><a href="<?php echo base_url('Admin/ExpenditureDetails/view/'.base64_encode($value->expenditure_id));?>"><?php echo $value->running_bill;?></a></td>
                                        <td><?php echo $this->customlib->get_DDMMYYYY($value->date_of_submit_bill);?>
                                        </td>
                                        <td><?php echo $this->customlib->get_DDMMYYYY($value->date_of_payment);?></td>
                                        <td><?php echo $value->bill_no;?></td>
                                        <td><?php $contractor_info = $this->UsersMstModel->get_record($value->contractor_id);
                                        if(!empty($contractor_info)) {?><a target="_blank"
                                                href="<?php echo base_url('Admin/Contractor/view/'.base64_encode($value->contractor_id));?>"><?php echo $contractor_info['0']->name;?></a><?php }?>
                                        </td>
                                        <td><?php $payment_mode_info = $this->PaymentModeMstModel->get_record($value->payment_mode_id);
                                       if (!empty($payment_mode_info)) { echo $payment_mode_info['0']->payment_mode;} ?>
                                        </td>
                                        <td class="text-right">
                                            <?php echo $this->customlib->inr_format($value->gross_amount);?></td>
                                        <td class="text-right">
                                            <?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                        <td class="text-right">
                                            <?php echo $this->customlib->inr_format($value->amount_released);?></td>
                                        <td class="text-right">
                                            <?php echo $this->customlib->inr_format($value->other_expenses);?></td>
                                        <td class="text-right">
                                            <?php echo $this->customlib->inr_format($value->total_expenditure);?></td>
                                        <?php /*<td><?php $bank_info = $this->BankMstModel->get_record($value->bank_id);
                                        if (!empty($bank_info)) { echo $bank_info['0']->bank;} ?></td>
                                        <td><?php echo $value->transaction_no; ?></td>
                                        <td><?php echo $this->customlib->get_DDMMYYYY($value->transaction_date); ?></td>
                                        <td><?php echo $value->branch; ?></td>*/?>
                                        <td><?php echo $value->remarks;?></td>
                                        <?php /*<td class="text-center"><?php if($value->status_id == 'Pending') {?>
                                        <span class="badge bg-grey-400"><?php echo $value->status_id;?></span>
                                        <?php } else if($value->status_id == 'In-Progress') {?>
                                        <span class="badge badge-info"><?php echo $value->status_id;?></span>
                                        <?php } else if($value->status_id == 'Accepted') {?>
                                        <span class="badge badge-primary"><?php echo $value->status_id;?></span>
                                        <?php } else if($value->status_id == 'Rejected') {?>
                                        <span class="badge badge-danger"><?php echo $value->status_id;?></span>
                                        <?php }?>
                                        </td>
                                        <td class="text-center"><?php if ($value->is_cancel == 'Yes') { ?><span
                                                class="badge badge-danger">Yes</span><?php } else if ($value->is_cancel == 'No') { ?><span
                                                class="badge badge-primary">No</span><?php } ?></td>*/?>
                                        <?php /*<td class="text-center">
                                            <div class="list-icons">
                                                <div class="list-icons-item dropdown">
                                                    <a href="#" class="list-icons-item dropdown-toggle caret-0"
                                                        data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if($load_permission->is_edit == '1') {?>
                                                        <a href="<?php echo base_url('Admin/ExpenditureDetails/edit/'.base64_encode($value->expenditure_id));?>"
                                                            class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                        <?php }?>
                                                        <?php if($load_permission->is_delete == '1') {?>
                                                        <a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')"
                                                            href="<?php echo base_url('Admin/ExpenditureDetails/del/'.base64_encode($value->expenditure_id));?>"
                                                            class="dropdown-item"><i class="icon-trash-alt"></i>
                                                            Delete</a>
                                                        <?php }?>
                                                        <?php if($load_permission->is_view == '1') {?>
                                                        <a href="<?php echo base_url('Admin/ExpenditureDetails/view/'.base64_encode($value->expenditure_id));?>"
                                                            class="dropdown-item"><i class="icon-three-bars"></i>
                                                            View</a>
                                                        <?php }?>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>*/?>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <?php } else {?>
                        <p><?php echo $this->lang->line('no_record_found');?></p>
                        <?php }?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>