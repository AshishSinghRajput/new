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
                <a href="<?php echo base_url('Admin/Contractor');?>"
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
                    <form action="<?php echo base_url('Admin/Contractor/view/' . base64_encode($users_id)); ?>"
                        method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Firm
                                        Name</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->firm_name; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Owner
                                        Name</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->owner_name; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Firm
                                        Type</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->firm_type;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21"
                                        class="col-md-12 col-sm-12 col-xs-12 col-form-label">Address</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->address; ?>
                                    </div>
                                </div>
                            </div>



                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile
                                        No.</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->mobile; ?>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21"
                                        class="col-md-12 col-sm-12 col-xs-12 col-form-label">E-mail</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->email; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21"
                                        class="col-md-12 col-sm-12 col-xs-12 col-form-label">Website</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->website; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">GSIN
                                        No.</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->gsin_no; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">PAN
                                        No.</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->pan_no; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Aadhar
                                        No.</label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php echo $contractor_info->aadhar_no; ?>
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
                  </div>*/ ?>
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
                        <h2>Assigned Projects</h2>
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
                    <form action="<?php echo base_url('Admin/Contractor/view/' . base64_encode($users_id)); ?>"
                        method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <?php if(!empty($project_activity_info)) {?>
                        <div class="table-responsive">
                            <table class="table datatable-basic table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Sr.</th>
                                        <th class="text-center">Scheme Name</th>
                                        <th class="text-center" style="width: 40%;">Projects</th>
                                        <th class="text-center">Address</th>
                                        <?php /*<th class="text-center">Name of Contractor</th>*/?>
                                        <th class="text-center">Name of Supervisor</th>
                                        <th class="text-center">Funds allocated</th>
                                        <th class="text-center">Technical Sanction Amount</th>
                                        <th class="text-center">DNIT Amount</th>
                                        <th class="text-center">Allotment Below / above</th>
                                        <th class="text-center">Allotment Amount</th>
                                        <th class="text-center">Date of Start</th>
                                        <th class="text-center">Scheduled Date of Completion</th>
                                        <th class="text-center">Extension if any</th>
                                        <th class="text-center">Actual Date of Completion</th>
                                        <th class="text-center">Expenditure / payment released</th>
                                        <th class="text-center">Remarks</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Cancel</th>
                                        <?php /*<th class="text-center">Action</th>*/?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $sr = 1;
                              foreach($project_activity_info as $value) {?>
                                    <tr>
                                        <td><?php echo $sr; $sr++; //$value->project_activity_id;?></td>
                                        <td><a href="<?php echo base_url('Admin/Projects/view/'.base64_encode($value->project_id));?>"><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                        if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></a></td>
                                        <td><a href="<?php echo base_url('Admin/ActivitesUnderProject/view/'.base64_encode($value->project_activity_id));?>"><?php echo $value->activity_name;?></a></td>
                                        <td><?php echo $value->address;?></td>
                                        <?php /*<td><?php $contractor_info = $this->UsersMstModel->get_record($value->users_id);
                                        if(!empty($contractor_info)) { echo $contractor_info['0']->name;}?></td>*/?>
                                        <td><?php $supervisor_info = $this->UsersMstModel->get_record($value->supervisor_id);
                                        if(!empty($supervisor_info)) { echo $supervisor_info['0']->name;}?></td>
                                        <td><?php echo $this->customlib->inr_format($value->funds_allocated);?></td>
                                        <td><?php echo $this->customlib->inr_format($value->sanction_amount);?></td>
                                        <td><?php echo $this->customlib->inr_format($value->dnit_amount);?></td>
                                        <td><?php echo $this->customlib->inr_format($value->allotment_below_above);?>
                                        </td>
                                        <td><?php echo $this->customlib->inr_format($value->allotment_amount);?></td>
                                        <td><?php echo $this->customlib->get_DDMMYYYY($value->date_start);?></td>
                                        <td><?php echo $this->customlib->get_DDMMYYYY($value->scheduled_date_completion);?>
                                        </td>
                                        <td><?php echo $value->extension;?></td>
                                        <td><?php echo $this->customlib->get_DDMMYYYY($value->actual_date_completion);?>
                                        </td>
                                        <td><?php echo $this->customlib->inr_format($value->expenditure_released);?>
                                        </td>
                                        <td><?php echo $value->remarks;?></td>
                                        <td class="text-center"><?php if($value->status_id == 'Pending') {?>
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
                                                class="badge badge-primary">No</span><?php } ?></td>
                                                <?php /*<td class="text-center">
                                            <div class="list-icons">
                                                <div class="list-icons-item dropdown">
                                                    <a href="#" class="list-icons-item dropdown-toggle caret-0"
                                                        data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <?php if($load_permission->is_edit == '1') {?>
                                                        <a href="<?php echo base_url('Admin/ActivitesUnderProject/edit/'.base64_encode($value->project_activity_id));?>"
                                                            class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                        <?php }?>
                                                        <?php if($load_permission->is_delete == '1') {?>
                                                        <a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')"
                                                            href="<?php echo base_url('Admin/ActivitesUnderProject/del/'.base64_encode($value->project_activity_id));?>"
                                                            class="dropdown-item"><i class="icon-trash-alt"></i>
                                                            Delete</a>
                                                        <?php }?>
                                                        <?php if($load_permission->is_view == '1') {?>
                                                        <a href="<?php echo base_url('Admin/ActivitesUnderProject/view/'.base64_encode($value->project_activity_id));?>"
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
<div class="content">
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header header-elements-sm-inline">
                    <div class="ml-12" style="width: 100%; margin-top: 10px;">
                        <h2>Bank Details</h2>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo base_url('Admin/Contractor/view/' . base64_encode($users_id));?>"
                        method="post" enctype="multipart/form-data" accept-charset="utf-8" style="margin: 0px;">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table datatable-basic">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width: 5%;">Sr.</th>
                                                <th class="text-center" style="padding: 5px;">Bank Name</th>
                                                <th class="text-center" style="padding: 5px;">Account No.</th>
                                                <th class="text-center" style="padding: 5px;">IFSC Code</th>
                                                <th class="text-center" style="padding: 5px;">Branch</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(!empty($contractor_bank_info)) {?>
                                            <?php $sr = 1;
                                                  foreach($contractor_bank_info as $value) {?>
                                            <tr>
                                                <td><?php echo $sr; $sr++; //$value->project_id;?></td>
                                                <td style="padding: 5px;">
                                                    <?php $bank_info = $this->BankMstModel->get_record($value->bank_id);
                                                          if (!empty($bank_info)) { echo $bank_info['0']->bank;} ?>
                                                </td>
                                                <td style="padding: 5px;"><?php echo $value->account_no;?></td>
                                                <td style="padding: 5px;"><?php echo $value->ifsc_code;?></td>
                                                <td style="padding: 5px;"><?php echo $value->branch;?></td>
                                            </tr>
                                            <?php }?>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>