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
                <?php if($load_permission->is_add == '1') {?><a href="<?php echo base_url('Admin/FundsReceived/add');?>"
                    class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?>
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
                    <form action="<?php echo base_url('Admin/FundsReceived');?>" method="post"
                        enctype="multipart/form-data" accept-charset="utf-8">
                        <?php if(!empty($fund_received_info)) {?>
                        <div class="table-responsive">
                            <table class="table datatable-basic table-bordered">
                                <thead>
                                    <tr>
                                        <?php /*<th class="text-center">Sr.No.</th>
                                       <th class="text-center">Description of Bills</th>*/?>
                                        <th class="text-center">Scheme Name</th>
                                        <?php /*<th class="text-center">Projects</th>*/?>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Gross Amount</th>
                                        <th class="text-center">Net Amount Released</th>
                                        <th class="text-center">Payment Mode</th>
                                        <th class="text-center">Bank Name</th>
                                        <?php /*<th class="text-center">Transaction / Cheque No.</th>
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
                              foreach($fund_received_info as $value) {?>
                                    <tr>
                                        <?php /*<td><?php echo $sr; $sr++; //$value->fund_received_id;?></td>
                                        <td><?php echo $value->bill_no;?></td>*/?>
                                        <td><a href="<?php echo base_url('Admin/Projects/view/'.base64_encode($value->project_id));?>"><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                        if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></a></td>
                                        <td><?php echo $this->customlib->get_DDMMYYYY($value->date);?></td>
                                        <?php /*<td><?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $value->project_activity_id);
                                        if(!empty($project_activity_info)) { echo $project_activity_info['0']->activity_name;}?>
                                        </td>*/?>
                                        <td class="text-right">
                                            <?php echo $this->customlib->inr_format($value->gross_amount);?></td>
                                        <td class="text-right">
                                            <?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                        <td><?php $payment_mode_info = $this->PaymentModeMstModel->get_record($value->payment_mode_id);
                                       if (!empty($payment_mode_info)) { echo $payment_mode_info['0']->payment_mode;} ?>
                                        </td>
                                        <td><?php $bank_info = $this->BankMstModel->get_record($value->bank_id);
                                        if (!empty($bank_info)) { echo $bank_info['0']->bank;} ?></td>
                                        <?php /*<td><?php echo $value->transaction_no; ?></td>
                                        <td><?php echo $this->customlib->get_DDMMYYYY($value->transaction_date); ?>
                                        </td>
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
                                                        <a href="<?php echo base_url('Admin/FundsReceived/edit/'.base64_encode($value->fund_received_id));?>"
                                                            class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                        <?php }?>
                                                        <?php if($load_permission->is_delete == '1') {?>
                                                        <a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')"
                                                            href="<?php echo base_url('Admin/FundsReceived/del/'.base64_encode($value->fund_received_id));?>"
                                                            class="dropdown-item"><i class="icon-trash-alt"></i>
                                                            Delete</a>
                                                        <?php }?>
                                                        <?php if($load_permission->is_view == '1') {?>
                                                        <a href="<?php echo base_url('Admin/FundsReceived/view/'.base64_encode($value->fund_received_id));?>"
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