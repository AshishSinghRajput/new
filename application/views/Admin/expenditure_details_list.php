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
                    href="<?php echo base_url('Admin/ExpenditureDetails/add');?>"
                    class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New Bill</a><?php }?>
            </div>
        </div>
    </div>l

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
<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header header-elements-sm-inline">
                    <div class="ml-12" style="width: 100%; margin-top: 10px;">
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
                    <form action="<?php echo base_url('Admin/ExpenditureDetails/index');?>" method="post"
                        enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Scheme
                                        Name <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" id="project_id" name="project_id"
                                            onchange="changeUrl(this.value)">
                                            <?php $select_project_id = '';
                                       if($this->input->post('submit')) {
                                          $select_project_id = $this->input->post('project_id');	 
                                       } else {
                                          $select_project_id = $current_project_id;
                                       }?>
                                            <option <?php if($select_project_id == '') {?>selected="selected" <?php }?>
                                                value="">Select Scheme</option>
                                            <?php 
                                 if(!empty($projects_list)) {
                                       foreach ($projects_list as $value) { ?>
                                            <option
                                                <?php if($select_project_id == $value->project_id) {?>selected="selected"
                                                <?php }?> value="<?php echo $value->project_id;?>">
                                                <?php echo $value->project_name;?></option>
                                            <?php }
                                    }?>
                                        </select>
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('project_id');?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Select
                                        Projects <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" id="project_activity_id" name="project_activity_id"
                                            onchange="changeUrl(<?php echo $current_project_id;?>, this.value)">
                                            <?php $select_project_activity_id = '';
                                       if($this->input->post('submit')) {
                                          $select_project_activity_id = $this->input->post('project_activity_id');	 
                                       } else {
                                          $select_project_activity_id = $current_project_activity_id;
                                       }?>
                                            <option <?php if($select_project_activity_id == '') {?>selected="selected"
                                                <?php }?> value="">Select Projects</option>
                                            <?php 
                                 if(!empty($project_activity_list)) {
                                       foreach ($project_activity_list as $value) { ?>
                                            <option
                                                <?php if($select_project_activity_id == $value->project_activity_id) {?>selected="selected"
                                                <?php }?> value="<?php echo $value->project_activity_id;?>">
                                                <?php echo $value->activity_name;?></option>
                                            <?php }
                                    }?>
                                        </select>
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('project_activity_id');?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
base_url = '<?= base_url() ?>';

function changeUrl(project_id, project_activity_id) {
    window.location.href = base_url + "Admin/ExpenditureDetails/index/" + project_id + "/" + project_activity_id;
}
</script>
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
                    <form action="<?php echo base_url('Admin/ExpenditureDetails');?>" method="post"
                        enctype="multipart/form-data" accept-charset="utf-8">
                        <?php if(!empty($expenditure_details_info)) {?>
                        <div class="table-responsive">
                            <table class="table datatable-basic table-bordered">
                                <thead>
                                    <tr>
                                        <?php /*<th class="text-center">Sr.No.</th>*/?>
                                        <th class="text-center" style="width: 200px;">Scheme_Name</th>
                                        <th class="text-center" style="width: 200px;">Projects</th>
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
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sr = 1;
                                          foreach($expenditure_details_info as $value) {?>
                                    <tr>
                                        <?php /*<td><?php echo $sr; $sr++; //$value->expenditure_id;?></td>*/?>
                                        <td><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                       if(!empty($projects_info)) {?><a target="_blank"
                                                href="<?php echo base_url('Admin/Projects/view/'.base64_encode($value->project_id));?>"><?php echo $projects_info['0']->project_name;?></a><?php }?>
                                        </td>
                                        <td><?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $value->project_activity_id);
                                       if(!empty($project_activity_info)) {?><a target="_blank"
                                                href="<?php echo base_url('Admin/ActivitesUnderProject/view/'.base64_encode($value->project_activity_id));?>"><?php echo $project_activity_info['0']->activity_name;?></a><?php }?></a>
                                        </td>
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
                                        <td class="text-center">
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
                                        </td>
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