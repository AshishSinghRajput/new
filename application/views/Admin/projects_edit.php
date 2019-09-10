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
                <a href="<?php echo base_url('Admin/Projects');?>"
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
                    <form action="<?php echo base_url('Admin/Projects/edit/'.base64_encode($project_id));?>"
                        method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Scheme
                                        Name <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $project_name_value = '';
                                 if($this->input->post('submit')) {
                                 $project_name_value = $this->input->post('project_name');	 
                                 } else if(!empty($projects_info)) {
                                    $project_name_value = $projects_info->project_name;
                                 }?>
                                        <input type="text" required id="project_name" name="project_name"
                                            placeholder="Enter your project name" class="form-control" maxlength="255"
                                            value="<?php echo $project_name_value;?>" />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('project_name');?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21"
                                        class="col-md-12 col-sm-12 col-xs-12 col-form-label">Sanctioned funds <span
                                            class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $sanctioned_funds_value = '0';
                                    if ($this->input->post('submit')) {
                                       $sanctioned_funds_value = $this->input->post('sanctioned_funds');
                                    } else if (!empty($projects_info)) {
                                       $sanctioned_funds_value = $projects_info->sanctioned_funds;
                                    } ?>
                                        <input type="text" name="sanctioned_funds" id="sanctioned_funds"
                                            class="form-control" value="<?php echo $sanctioned_funds_value; ?>"
                                            maxlength="20" readonly />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('sanctioned_funds'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Funds
                                        Received <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $funds_received_value = '0';
                                    if ($this->input->post('submit')) {
                                       $funds_received_value = $this->input->post('funds_received');
                                    } else if (!empty($projects_info)) {
                                       $funds_received_value = $projects_info->funds_received;
                                    } ?>
                                        <input type="text" name="funds_received" id="funds_received"
                                            class="form-control" value="<?php echo $funds_received_value; ?>"
                                            maxlength="20" readonly />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('funds_received'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Interest
                                        <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $interest_value = '0';
                                    if ($this->input->post('submit')) {
                                       $interest_value = $this->input->post('interest');
                                    } else if (!empty($projects_info)) {
                                       $interest_value = $projects_info->interest;
                                    } ?>
                                        <input type="text" name="interest" id="interest" class="form-control"
                                            value="<?php echo $interest_value; ?>" maxlength="20" readonly />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('interest'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21"
                                        class="col-md-12 col-sm-12 col-xs-12 col-form-label">Expenditure Incurred <span
                                            class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $expenditure_value = '0';
                                    if ($this->input->post('submit')) {
                                       $expenditure_value = $this->input->post('expenditure');
                                    } else if (!empty($projects_info)) {
                                       $expenditure_value = $projects_info->expenditure;
                                    } ?>
                                        <input type="text" name="expenditure" id="expenditure" class="form-control"
                                            value="<?php echo $expenditure_value; ?>" maxlength="20" readonly />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('expenditure'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Funds
                                        available <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $funds_available_value = '0';
                                    if ($this->input->post('submit')) {
                                       $funds_available_value = $this->input->post('funds_available');
                                    } else if (!empty($projects_info)) {
                                       $funds_available_value = $projects_info->funds_available;
                                    } ?>
                                        <input type="text" name="funds_available" id="funds_available"
                                            class="form-control" value="<?php echo $funds_available_value; ?>"
                                            maxlength="20" readonly />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('funds_available'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Remarks
                                        <span class="text-hightlight" style="display: none;">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $remarks_value = '';
                                    if ($this->input->post('submit')) {
                                       $remarks_value = $this->input->post('remarks');
                                    } else if (!empty($projects_info)) {
                                       $remarks_value = $projects_info->remarks;
                                    } ?>
                                        <input type="text" id="remarks" name="remarks" placeholder="Enter remarks"
                                            maxlength="255" class="form-control"
                                            value="<?php echo $remarks_value; ?>" />
                                        <span class="badge badge-danger m-1"><?php echo form_error('remarks'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table class="table datatable-basic" cellpadding="10">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding: 5px;">Bank Name</th>
                                            <th class="text-center" style="padding: 5px;">Account No.</th>
                                            <th class="text-center" style="padding: 5px;">IFSC Code</th>
                                            <th class="text-center" style="padding: 5px;">Branch</th>
                                            <th class="text-center" style="padding: 5px;">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($projects_bank_info)) {
                                                $row = 0;
                                                foreach($projects_bank_info as $value) { $row++;?>                                           
                                                <tr>
                                                   <td style="padding: 5px;">
                                                   <?php $projects_bank_id = '';
                                                   if ($this->input->post('submit')) {
                                                      $projects_bank_id = $this->input->post('projects_bank_id_'.$row);
                                                   } else {
                                                      $projects_bank_id = $value->projects_bank_id;
                                                   } ?>
                                                         <input type="hidden" id="projects_bank_id_<?php echo $row;?>"
                                                            name="projects_bank_id_<?php echo $row;?>" placeholder="Enter Bank Id"
                                                            class="form-control" value="<?php echo $projects_bank_id; ?>"
                                                            maxlength="20" />                                                  
                                                   
                                                   <?php $select_bank_id = '';
                                                   if ($this->input->post('submit')) {
                                                      $select_bank_id = $this->input->post('bank_id_'.$row);
                                                   } else {
                                                      $select_bank_id = $value->bank_id;
                                                   } ?>
                                                         <select class="form-control" id="bank_id_<?php echo $row;?>"
                                                            name="bank_id_<?php echo $row;?>">
                                                            <option value="">Select Bank</option>
                                                            <?php
                                                      if (!empty($bank_list)) {
                                                         foreach ($bank_list as $bank_value) { ?>
                                                            <option
                                                               <?php if ($select_bank_id == $bank_value->bank_id) echo "selected"; ?>
                                                               value="<?php echo $bank_value->bank_id; ?>">
                                                               <?php echo $bank_value->bank; ?></option>
                                                            <?php }
                                                      } ?>
                                                         </select>
                                                         <span
                                                            class="badge badge-danger m-1"><?php echo form_error('bank_id_'.$row); ?></span>
                                                   </td>
                                                   <td style="padding: 5px;"><?php $account_no = '';
                                                   if ($this->input->post('submit')) {
                                                      $account_no = $this->input->post('account_no_'.$row);
                                                   } else {
                                                      $account_no = $value->account_no;
                                                   } ?>
                                                         <input type="text" id="account_no_<?php echo $row;?>"
                                                            name="account_no_<?php echo $row;?>" placeholder="Enter Account No."
                                                            class="form-control" value="<?php echo $account_no; ?>"
                                                            maxlength="25" />
                                                         <span
                                                            class="badge badge-danger m-1"><?php echo form_error('account_no_'.$row); ?></span>
                                                   </td>
                                                   <td style="padding: 5px;"><?php $ifsc_code = '';
                                                   if ($this->input->post('submit')) {
                                                      $ifsc_code = $this->input->post('ifsc_code_'.$row);
                                                   } else {
                                                      $ifsc_code = $value->ifsc_code;
                                                   } ?>
                                                         <input type="text" id="ifsc_code_<?php echo $row;?>"
                                                            name="ifsc_code_<?php echo $row;?>" placeholder="Enter IFSC Code"
                                                            class="form-control" value="<?php echo $ifsc_code; ?>"
                                                            maxlength="20" />
                                                         <span
                                                            class="badge badge-danger m-1"><?php echo form_error('ifsc_code_'.$row); ?></span>
                                                   </td>
                                                   <td style="padding: 5px;"><?php $branch = '';
                                                   if ($this->input->post('submit')) {
                                                      $branch = $this->input->post('branch_'.$row);
                                                   } else {
                                                      $branch = $value->branch;
                                                   } ?>
                                                         <input type="text" id="branch_<?php echo $row;?>"
                                                            name="branch_<?php echo $row;?>" placeholder="Enter branch"
                                                            class="form-control" value="<?php echo $branch; ?>"
                                                            maxlength="255" />
                                                         <span
                                                            class="badge badge-danger m-1"><?php echo form_error('branch_'.$row); ?></span>
                                                   </td>
                                                   <td style="padding: 5px;"><?php $balance = '';
                                                         if ($this->input->post('submit')) {
                                                            $balance = $this->input->post('balance_'.$row);
                                                         } else {
                                                            $balance = $value->balance;
                                                         } ?>
                                                         <input type="text" id="balance_<?php echo $row;?>"
                                                            name="balance_<?php echo $row;?>" placeholder="Enter balance"
                                                            class="form-control" value="<?php echo $balance; ?>"
                                                            maxlength="20" />
                                                         <span
                                                            class="badge badge-danger m-1"><?php echo form_error('balance_'.$row); ?></span>
                                                   </td>
                                                </tr>
                                             <?php }
                                             } else {
                                                for($row = 0; $row < 5; $row++) {?>                                           
                                                   <tr>
                                                      <td style="padding: 5px;">
                                                      <?php $projects_bank_id = '';
                                                      if ($this->input->post('submit')) {
                                                         $projects_bank_id = $this->input->post('projects_bank_id_'.$row);
                                                      } else if (!empty($projects_bank_info)) {
                                                         $projects_bank_id = $projects_bank_info->projects_bank_id;
                                                      } ?>
                                                            <input type="text" id="projects_bank_id_<?php echo $row;?>"
                                                               name="projects_bank_id_<?php echo $row;?>" placeholder="Enter Bank Id"
                                                               class="form-control" value="<?php echo $projects_bank_id; ?>"
                                                               maxlength="20" />
                                                      
                                                      
                                                      <?php $select_bank_id = '';
                                                      if ($this->input->post('submit')) {
                                                         $select_bank_id = $this->input->post('bank_id_'.$row);
                                                      } else if (!empty($projects_bank_info)) {
                                                         $select_bank_id = $projects_bank_info->bank_id;
                                                      } ?>
                                                            <select class="form-control" id="bank_id_<?php echo $row;?>"
                                                               name="bank_id_<?php echo $row;?>">
                                                               <option value="">Select Bank</option>
                                                               <?php
                                                         if (!empty($bank_list)) {
                                                            foreach ($bank_list as $value) { ?>
                                                               <option
                                                                  <?php if ($select_bank_id == $value->bank_id) echo "selected"; ?>
                                                                  value="<?php echo $value->bank_id; ?>">
                                                                  <?php echo $value->bank; ?></option>
                                                               <?php }
                                                         } ?>
                                                            </select>
                                                            <span
                                                               class="badge badge-danger m-1"><?php echo form_error('bank_id_'.$row); ?></span>
                                                      </td>
                                                      <td style="padding: 5px;"><?php $account_no = '';
                                                      if ($this->input->post('submit')) {
                                                         $account_no = $this->input->post('account_no_'.$row);
                                                      } else if (!empty($projects_bank_info)) {
                                                         $account_no = $projects_bank_info->account_no;
                                                      } ?>
                                                            <input type="text" id="account_no_<?php echo $row;?>"
                                                               name="account_no_<?php echo $row;?>" placeholder="Enter Account No."
                                                               class="form-control" value="<?php echo $account_no; ?>"
                                                               maxlength="25" />
                                                            <span
                                                               class="badge badge-danger m-1"><?php echo form_error('account_no_'.$row); ?></span>
                                                      </td>
                                                      <td style="padding: 5px;"><?php $ifsc_code = '';
                                                      if ($this->input->post('submit')) {
                                                         $ifsc_code = $this->input->post('ifsc_code_'.$row);
                                                      } else if (!empty($projects_bank_info)) {
                                                         $ifsc_code = $projects_bank_info->ifsc_code;
                                                      } ?>
                                                            <input type="text" id="ifsc_code_<?php echo $row;?>"
                                                               name="ifsc_code_<?php echo $row;?>" placeholder="Enter IFSC Code"
                                                               class="form-control" value="<?php echo $ifsc_code; ?>"
                                                               maxlength="20" />
                                                            <span
                                                               class="badge badge-danger m-1"><?php echo form_error('ifsc_code_'.$row); ?></span>
                                                      </td>
                                                      <td style="padding: 5px;"><?php $branch = '';
                                                      if ($this->input->post('submit')) {
                                                         $branch = $this->input->post('branch_'.$row);
                                                      } else if (!empty($projects_bank_info)) {
                                                         $branch = $projects_bank_info->branch;
                                                      } ?>
                                                            <input type="text" id="branch_<?php echo $row;?>"
                                                               name="branch_<?php echo $row;?>" placeholder="Enter branch"
                                                               class="form-control" value="<?php echo $branch; ?>"
                                                               maxlength="255" />
                                                            <span
                                                               class="badge badge-danger m-1"><?php echo form_error('branch_'.$row); ?></span>
                                                      </td>
                                                      <td style="padding: 5px;"><?php $balance = '';
                                                            if ($this->input->post('submit')) {
                                                               $balance = $this->input->post('balance_'.$row);
                                                            } else if (!empty($projects_bank_info)) {
                                                               $balance = $projects_bank_info->balance;
                                                            } ?>
                                                            <input type="text" id="balance_<?php echo $row;?>"
                                                               name="balance_<?php echo $row;?>" placeholder="Enter balance"
                                                               class="form-control" value="<?php echo $balance; ?>"
                                                               maxlength="20" readonly />
                                                            <span
                                                               class="badge badge-danger m-1"><?php echo form_error('balance_'.$row); ?></span>
                                                      </td>
                                                   </tr>
                                                <?php }
                                             }?>
                                    </tbody>
                                </table>
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