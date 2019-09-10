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
                    <form action="<?php echo base_url('Admin/Contractor/edit/'.base64_encode($users_id));?>"
                        method="post" enctype="multipart/form-data" accept-charset="utf-8">
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Firm Name
                                        <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $firm_name_value = '';
                           if ($this->input->post('submit')) {
                              $firm_name_value = $this->input->post('firm_name');
                           } else if (!empty($contractor_info)) {
                              $firm_name_value = $contractor_info->firm_name;
                           } ?>
                                        <input type="text" required id="firm_name" name="firm_name"
                                            placeholder="Enter your firm name" class="form-control" maxlength="255"
                                            value="<?php echo $firm_name_value; ?>" />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('firm_name'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Owner
                                        Name <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $owner_name_value = '';
                           if ($this->input->post('submit')) {
                              $owner_name_value = $this->input->post('owner_name');
                           } else if (!empty($contractor_info)) {
                              $owner_name_value = $contractor_info->owner_name;
                           } ?>
                                        <input type="text" id="owner_name" name="owner_name"
                                            placeholder="Enter your owner name" class="form-control" maxlength="255"
                                            value="<?php echo $owner_name_value; ?>" />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('owner_name'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Firm Type
                                        <span class="text-hightlight">*</span></label>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="">
                                            <?php $firm_type_value = '';
                                                if ($this->input->post('submit')) {
                                                    $firm_type_value = $this->input->post('firm_type');
                                                } else if (!empty($contractor_info)) {
                                                    $firm_type_value = $contractor_info->firm_type;
                                                } ?>
                                            <input type="radio" id="firm_type" name="firm_type" value="Individual"
                                                <?php if ($firm_type_value == 'Individual') { ?>checked="checked" <?php } ?> />
                                            <label for="firm_type_hide">Individual</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="">
                                            <input type="radio" id="firm_type" name="firm_type" value="Partnership"
                                                <?php if ($firm_type_value == 'Partnership') { ?>checked="checked" <?php } ?> />
                                            <label for="firm_type_visible">Partnership</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div class="">
                                            <input type="radio" id="firm_type" name="firm_type" value="Company"
                                                <?php if ($firm_type_value == 'Company') { ?>checked="checked" <?php } ?> />
                                            <label for="firm_type_visible">Company</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('firm_type'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Address
                                        <span class="text-hightlight">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $address_value = '';
                           if ($this->input->post('submit')) {
                              $address_value = $this->input->post('address');
                           } else if (!empty($contractor_info)) {
                              $address_value = $contractor_info->address;
                           } ?>
                                        <input type="text" required id="address" name="address"
                                            placeholder="Enter your address" class="form-control" maxlength="255"
                                            value="<?php echo $address_value; ?>" />
                                        <span class="badge badge-danger m-1"><?php echo form_error('address'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile
                                        No. <span class="text-hightlight" style="display: none;">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $mobile_value = '';
                           if ($this->input->post('submit')) {
                              $mobile_value = $this->input->post('mobile');
                           } else if (!empty($contractor_info)) {
                              $mobile_value = $contractor_info->mobile;
                           } ?>
                                        <input type="text" id="mobile" name="mobile" placeholder="Enter mobile no."
                                            class="form-control" minlength="10" maxlength="10"
                                            value="<?php echo $mobile_value; ?>" />
                                        <span class="badge badge-danger m-1"><?php echo form_error('mobile'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">E-mail
                                        <span class="text-hightlight" style="display: none;">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $email_value = '';
                           if ($this->input->post('submit')) {
                              $email_value = $this->input->post('email');
                           } else if (!empty($contractor_info)) {
                              $email_value = $contractor_info->email;
                           } ?>
                                        <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" id="email"
                                            name="email" placeholder="Enter e-mail" maxlength="255" class="form-control"
                                            value="<?php echo $email_value; ?>" />
                                        <span class="badge badge-danger m-1"><?php echo form_error('email'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Website
                                        <span class="text-hightlight" style="display: none;">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $website_value = '';
                           if ($this->input->post('submit')) {
                              $website_value = $this->input->post('website');
                           } else if (!empty($contractor_info)) {
                              $website_value = $contractor_info->website;
                           } ?>
                                        <input type="text" id="website" name="website" placeholder="Enter website"
                                            maxlength="255" class="form-control"
                                            value="<?php echo $website_value; ?>" />
                                        <span class="badge badge-danger m-1"><?php echo form_error('website'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">GSIN No.
                                        <span class="text-hightlight" style="display: none;">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $gsin_no_value = '';
                           if ($this->input->post('submit')) {
                              $gsin_no_value = $this->input->post('gsin_no');
                           } else if (!empty($contractor_info)) {
                              $gsin_no_value = $contractor_info->gsin_no;
                           } ?>
                                        <input type="text" id="gsin_no" name="gsin_no" placeholder="Enter gsin no."
                                            maxlength="20" class="form-control" value="<?php echo $gsin_no_value; ?>" />
                                        <span class="badge badge-danger m-1"><?php echo form_error('gsin_no'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">PAN No.
                                        <span class="text-hightlight" style="display: none;">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $pan_no_value = '';
                           if ($this->input->post('submit')) {
                              $pan_no_value = $this->input->post('pan_no');
                           } else if (!empty($contractor_info)) {
                              $pan_no_value = $contractor_info->pan_no;
                           } ?>
                                        <input type="text" id="pan_no" name="pan_no" placeholder="Enter pan no."
                                            minlength="10" maxlength="10" class="form-control"
                                            value="<?php echo $pan_no_value; ?>" />
                                        <span class="badge badge-danger m-1"><?php echo form_error('pan_no'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group row">
                                    <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Aadhar
                                        No. <span class="text-hightlight" style="display: none;">*</span></label>
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <?php $aadhar_no_value = '';
                           if ($this->input->post('submit')) {
                              $aadhar_no_value = $this->input->post('aadhar_no');
                           } else if (!empty($contractor_info)) {
                              $aadhar_no_value = $contractor_info->aadhar_no;
                           } ?>
                                        <input type="text" id="aadhar_no" name="aadhar_no"
                                            placeholder="Enter aadhar no." minlength="12" maxlength="12"
                                            class="form-control" value="<?php echo $aadhar_no_value; ?>" />
                                        <span
                                            class="badge badge-danger m-1"><?php echo form_error('aadhar_no'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <table class="table datatable-basic" cellpadding="10">
                                    <thead>
                                        <tr>
                                            <th class="text-center" style="padding: 5px;">Bank Name</th>
                                            <th class="text-center" style="padding: 5px;">Account No.</th>
                                            <th class="text-center" style="padding: 5px;">IFSC Code</th>
                                            <th class="text-center" style="padding: 5px;">Branch</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($contractor_bank_info)) {
                                                $row = 0;
                                                foreach($contractor_bank_info as $value) { $row++;?>
                                        <tr>
                                            <td style="padding: 5px;">
                                                <?php $contractor_bank_id = '';
                                                   if ($this->input->post('submit')) {
                                                      $contractor_bank_id = $this->input->post('contractor_bank_id_'.$row);
                                                   } else {
                                                      $contractor_bank_id = $value->contractor_bank_id;
                                                   } ?>
                                                <input type="hidden" id="contractor_bank_id_<?php echo $row;?>"
                                                    name="contractor_bank_id_<?php echo $row;?>"
                                                    placeholder="Enter Bank Id" class="form-control"
                                                    value="<?php echo $contractor_bank_id; ?>" maxlength="20" />

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
                                        </tr>
                                        <?php }
                                             } else {
                                                for($row = 0; $row < 5; $row++) {?>
                                        <tr>
                                            <td style="padding: 5px;">
                                                <?php $contractor_bank_id = '';
                                                      if ($this->input->post('submit')) {
                                                         $contractor_bank_id = $this->input->post('contractor_bank_id_'.$row);
                                                      } else if (!empty($contractor_bank_info)) {
                                                         $contractor_bank_id = $contractor_bank_info->contractor_bank_id;
                                                      } ?>
                                                <input type="text" id="contractor_bank_id_<?php echo $row;?>"
                                                    name="contractor_bank_id_<?php echo $row;?>"
                                                    placeholder="Enter Bank Id" class="form-control"
                                                    value="<?php echo $contractor_bank_id; ?>" maxlength="20" />
                                                <?php $select_bank_id = '';
                                                      if ($this->input->post('submit')) {
                                                         $select_bank_id = $this->input->post('bank_id_'.$row);
                                                      } else if (!empty($contractor_bank_info)) {
                                                         $select_bank_id = $contractor_bank_info->bank_id;
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
                                                      } else if (!empty($contractor_bank_info)) {
                                                         $account_no = $contractor_bank_info->account_no;
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
                                                      } else if (!empty($contractor_bank_info)) {
                                                         $ifsc_code = $contractor_bank_info->ifsc_code;
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
                                                      } else if (!empty($contractor_bank_info)) {
                                                         $branch = $contractor_bank_info->branch;
                                                      } ?>
                                                <input type="text" id="branch_<?php echo $row;?>"
                                                    name="branch_<?php echo $row;?>" placeholder="Enter branch"
                                                    class="form-control" value="<?php echo $branch; ?>"
                                                    maxlength="255" />
                                                <span
                                                    class="badge badge-danger m-1"><?php echo form_error('branch_'.$row); ?></span>
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