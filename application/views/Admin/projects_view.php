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
            <?php if($load_permission->is_add == '1') {?><a href="<?php echo base_url('Admin/Projects/add');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?>
            <?php if($load_permission->is_edit == '1') {?><a href="<?php echo base_url('Admin/Projects/edit/'.base64_encode($projects_info->project_id));?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Edit</a><?php }?>
            <?php if($load_permission->is_edit == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/Projects/del/'.base64_encode($projects_info->project_id));?>" class="btn btn-danger btn-sm waves-effect waves-light m-1">Delete</a><?php }?>
            <a href="<?php echo base_url('Admin/Projects');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
                  <h2><?php echo $projects_info->project_name;?></h2>
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
               <form action="<?php echo base_url('Admin/Projects/edit/'.base64_encode($project_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" style="margin: 0px;">
                  <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group row">
                           <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Remarks</label>
                           <div class="col-md-12 col-sm-12 col-xs-12">
                              <?php echo $projects_info->remarks;?>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="card bg-blue-400">
                           <div class="card-body">
                              <div class="d-flex">
                                 <h3 class="font-weight-semibold mb-0"><?php echo $this->customlib->inr_format($projects_info->sanctioned_funds);?></h3>
                                 <span class=" align-self-center ml-auto">
                                    <img width="20" src="<?php echo base_url('rupee.png');?>">
                                 </span>
                              </div>
                              <div>
                                 <h6>Sanctioned funds</h6>                           
                              </div>
                           </div>                     
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="card bg-blue-400">
                           <div class="card-body">
                              <div class="d-flex">
                                 <h3 class="font-weight-semibold mb-0"><?php echo $this->customlib->inr_format($projects_info->funds_received);?></h3>
                                 <span class=" align-self-center ml-auto">
                                    <img width="20" src="<?php echo base_url('rupee.png');?>">
                                 </span>
                              </div>
                              <div>
                                 <h6>Funds Received</h6>                           
                              </div>
                           </div>                     
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="card bg-blue-400">
                           <div class="card-body">
                              <div class="d-flex">
                                 <h3 class="font-weight-semibold mb-0"><?php echo $this->customlib->inr_format($projects_info->interest);?></h3>
                                 <span class=" align-self-center ml-auto">
                                    <img width="20" src="<?php echo base_url('rupee.png');?>">
                                 </span>
                              </div>
                              <div>
                                 <h6>Interest</h6>                           
                              </div>
                           </div>                     
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="card bg-blue-400">
                           <div class="card-body">
                              <div class="d-flex">
                                 <h3 class="font-weight-semibold mb-0"><?php echo $this->customlib->inr_format($projects_info->expenditure);?></h3>
                                 <span class=" align-self-center ml-auto">
                                    <img width="20" src="<?php echo base_url('rupee.png');?>">
                                 </span>
                              </div>
                              <div>
                                 <h6>Expenditure Incurred</h6>                           
                              </div>
                           </div>                     
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="card bg-blue-400">
                           <div class="card-body">
                              <div class="d-flex">
                                 <h3 class="font-weight-semibold mb-0"><?php echo $this->customlib->inr_format($projects_info->funds_received-$projects_info->expenditure);?></h3>
                                 <span class=" align-self-center ml-auto">
                                    <img width="20" src="<?php echo base_url('rupee.png');?>">
                                 </span>
                              </div>
                              <div>
                                 <h6>Funds available</h6>                           
                              </div>
                           </div>                     
                        </div>
                     </div>
                     <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="card bg-blue-400">
                           <div class="card-body">
                              <a href="#projects" style="color: #ffffff;"><div class="d-flex">
                                 <h3 class="font-weight-semibold mb-0"><?php echo $this->customlib->inr_format(count($project_activity_list));?></h3>
                                 <span class=" align-self-center ml-auto">
                                    <i class="icon-list icon-2x"></i>
                                 </span>
                              </div>
                              <div>
                                 <h6>Total Projects</h6>                           
                              </div></a>
                           </div>                     
                        </div>
                     </div>
                  </div>
                  <?php /*
                  <hr />
                  <div class="row">
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Status</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php if($projects_info->status_id == 'Pending') {?>
                                    <span class="badge bg-grey-400"><?php echo $projects_info->status_id;?></span>
                                 <?php } else if($projects_info->status_id == 'In-Progress') {?>
                                    <span class="badge badge-info"><?php echo $projects_info->status_id;?></span>
                                 <?php } else if($projects_info->status_id == 'Accepted') {?>
                                    <span class="badge badge-primary"><?php echo $projects_info->status_id;?></span>
                                 <?php } else if($projects_info->status_id == 'Rejected') {?>
                                    <span class="badge badge-danger"><?php echo $projects_info->status_id;?></span>
                                 <?php }?>  
                              </div>
                           </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php echo $this->customlib->get_DDMMYYYY_FULL($projects_info->status_date); ?>
                              </div>
                           </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Remarks</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php echo $projects_info->status_remarks; ?>
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
                                 <?php if ($projects_info->is_cancel == 'Yes') { ?><span class="badge badge-danger m-1">Yes</span><?php } else if ($projects_info->is_cancel == 'No') { ?><span class="badge badge-primary m-1">No</span><?php } ?>
                              </div>
                           </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Date</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php echo $this->customlib->get_DDMMYYYY_FULL($projects_info->cancel_date); ?>
                              </div>
                           </div>
                     </div>
                     <div class="col-md-4 col-sm-4 col-xs-12">
                           <div class="form-group row">
                              <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Reason</label>
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                 <?php echo $projects_info->cancel_reason; ?>
                              </div>
                           </div>
                     </div>
                  </div>
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
<div class="content" id="projects">
   <div class="row">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header header-elements-sm-inline">
               <div class="ml-12" style="width: 100%; margin-top: 10px;">
               <h2>Projects Details</h2>
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
               <form action="<?php echo base_url('Admin/Projects/edit/'.base64_encode($project_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">   
                  <?php if(!empty($project_activity_list)) {?>
                  <div class="table-responsive">
                     <table class="table datatable-basic table-bordered">
                        <thead>
                           <tr>
                              <th class="text-center">Sr.</th>
                              <?php /*<th class="text-center">Scheme Name</th>*/?>
                              <th class="text-center" style="width: 40%;">Projects</th>
                              <th class="text-center">Address</th>
                              <th class="text-center">Name of Contractor</th>
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
                              <?php /*<th class="text-center">Status</th>
                              <th class="text-center">Cancel</th>*/?>
                              <th class="text-center">Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php $sr = 1;
                              foreach($project_activity_list as $value) {?>
                           <tr>
                              <td><?php echo $sr; $sr++; //$value->project_activity_id;?></td>
                              <?php /*<td><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                        if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></td>*/?>
                              <td><a href="<?php echo base_url('Admin/ActivitesUnderProject/view/'.base64_encode($value->project_activity_id));?>"><?php echo $value->activity_name;?></a></td>
                              <td><?php echo $value->address;?></td>
                              <td><?php $contractor_info = $this->UsersMstModel->get_record($value->contractor_id);
                                        if(!empty($contractor_info)) {?><a target="_blank" href="<?php echo base_url('Admin/Contractor/view/'.base64_encode($value->contractor_id));?>"><?php echo $contractor_info['0']->name;?></a><?php }?></td>
                              <td><?php $supervisor_info = $this->UsersMstModel->get_record($value->supervisor_id);
                                        if(!empty($supervisor_info)) { echo $supervisor_info['0']->name;}?></td>
                              <td><?php echo $this->customlib->inr_format($value->funds_allocated);?></td>
                              <td><?php echo $this->customlib->inr_format($value->sanction_amount);?></td>
                              <td><?php echo $this->customlib->inr_format($value->dnit_amount);?></td>
                              <td><?php echo $this->customlib->inr_format($value->allotment_below_above);?></td>
                              <td><?php echo $this->customlib->inr_format($value->allotment_amount);?></td>
                              <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->date_start);?></td>
                              <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->scheduled_date_completion);?></td>
                              <td><?php echo $value->extension;?></td>
                              <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->actual_date_completion);?></td>
                              <td><?php echo $this->customlib->inr_format($value->expenditure_released);?></td>
                              <td><?php echo $value->remarks;?></td>
                              <?php /*<td><?php if($value->status_id == 'Pending') {?>
                                    <span class="badge bg-grey-400"><?php echo $value->status_id;?></span>
                                 <?php } else if($value->status_id == 'In-Progress') {?>
                                    <span class="badge badge-info"><?php echo $value->status_id;?></span>
                                 <?php } else if($value->status_id == 'Accepted') {?>
                                    <span class="badge badge-primary"><?php echo $value->status_id;?></span>
                                 <?php } else if($value->status_id == 'Rejected') {?>
                                    <span class="badge badge-danger"><?php echo $value->status_id;?></span>
                                 <?php }?>                              
                              </td>
                              <td class="text-center"><?php if ($value->is_cancel == 'Yes') { ?><span class="badge badge-danger">Yes</span><?php } else if ($value->is_cancel == 'No') { ?><span class="badge badge-primary">No</span><?php } ?></td>*/?>                                     
                              <td class="text-center">
                                 <div class="list-icons">
                                    <div class="list-icons-item dropdown">
                                       <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                       <div class="dropdown-menu dropdown-menu-right">
                                          <?php if($load_permission->is_edit == '1') {?>
                                             <a href="<?php echo base_url('Admin/ActivitesUnderProject/edit/'.base64_encode($value->project_activity_id));?>" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                             <?php }?>
                                          <?php if($load_permission->is_delete == '1') {?>
                                             <a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/ActivitesUnderProject/del/'.base64_encode($value->project_activity_id));?>" class="dropdown-item"><i class="icon-trash-alt"></i> Delete</a>
                                          <?php }?>
                                          <?php if($load_permission->is_view == '1') {?>
                                             <a href="<?php echo base_url('Admin/ActivitesUnderProject/view/'.base64_encode($value->project_activity_id));?>" class="dropdown-item"><i class="icon-three-bars"></i> View</a>
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
               <form action="<?php echo base_url('Admin/Projects/edit/'.base64_encode($project_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">   
               <div class="row">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <ul class="nav nav-tabs nav-tabs-highlight nav-justified">
                           <li class="nav-item"><a href="#highlighted-tab1" class="nav-link active" data-toggle="tab">Ledger</a></li>
                           <li class="nav-item"><a href="#highlighted-tab2" class="nav-link" data-toggle="tab">Fund Received</a></li>
                           <?php /*<li class="nav-item"><a href="#highlighted-tab3" class="nav-link" data-toggle="tab">Expenditure Incurred</a></li>*/?>
                           <li class="nav-item"><a href="#highlighted-tab4" class="nav-link" data-toggle="tab">Interest</a></li>
                        </ul>
                        <div class="tab-content">
                           <div class="tab-pane fade show active" id="highlighted-tab1">
                           <?php if(!empty($fund_received_info)) {?>
                              <div class="table-responsive">
                                 <table class="table datatable-basic table-bordered">
                                    <thead>
                                       <tr>
                                          <th class="text-center">Sr.No.</th>
                                          <?php /*<th class="text-center">Description of Bills</th>*/?>
                                          <th class="text-center">Date</th>
                                          <?php /*<th class="text-center">Scheme Name</th>*/?>
                                          <th class="text-center">Projects</th>
                                          <th class="text-center">Fund Received</th>
                                          <th class="text-center">Expenditure Incurred</th>
                                          <th class="text-center">Balance</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $sr = 1;
                                          foreach($fund_received_info as $value) {?>
                                       <tr>
                                          <td><?php echo $sr; $sr++; //$value->fund_received_id;?></td>
                                          <?php /*<td><?php echo $value->bill_no;?></td>*/?>
                                          <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->date);?></td>
                                          <?php /*<td><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                                   if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></td>*/?>
                                          <td><?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $value->project_activity_id);
                                          if(!empty($project_activity_info)) { echo $project_activity_info['0']->activity_name;}?></td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                          <td class="text-right">0</td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                       </tr>
                                       <?php }?>
                                       <?php foreach($expenditure_details_info as $value) {?>
                                       <tr>
                                          <td><?php echo $sr; $sr++; //$value->expenditure_id;?></td>
                                          <?php /*<td><?php echo $value->bill_no;?></td>*/?>
                                          <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->date);?></td>
                                          <?php /*<td><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                                   if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></td>*/?>
                                          <td><?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $value->project_activity_id);
                                          if(!empty($project_activity_info)) { echo $project_activity_info['0']->activity_name;}?></td>
                                          <td class="text-right">0</td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                       </tr>
                                       <?php }?>
                                    </tbody>
                                 </table>
                              </div>
                              <?php }?>
                           </div>
                           <div class="tab-pane fade" id="highlighted-tab2">                               
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
                                          <td><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                                   if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></td>
                                                   <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->date);?></td>
                                          <?php /*<td><?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $value->project_activity_id);
                                          if(!empty($project_activity_info)) { echo $project_activity_info['0']->activity_name;}?></td>*/?>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->gross_amount);?></td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                          <td><?php $payment_mode_info = $this->PaymentModeMstModel->get_record($value->payment_mode_id);
                                                   if (!empty($payment_mode_info)) { echo $payment_mode_info['0']->payment_mode;} ?></td>
                                          <td><?php $bank_info = $this->BankMstModel->get_record($value->bank_id);
                                                   if (!empty($bank_info)) { echo $bank_info['0']->bank;} ?></td>
                                          <?php /*<td><?php echo $value->transaction_no; ?></td>
                                          <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->transaction_date); ?></td>
                                          <td><?php echo $value->branch; ?></td>*/?>
                                          <td><?php echo $value->remarks;?></td>
                                          <?php /*<td><?php if($value->status_id == 'Pending') {?>
                                                <span class="badge bg-grey-400"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'In-Progress') {?>
                                                <span class="badge badge-info"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'Accepted') {?>
                                                <span class="badge badge-primary"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'Rejected') {?>
                                                <span class="badge badge-danger"><?php echo $value->status_id;?></span>
                                             <?php }?>                              
                                          </td>
                                          <td class="text-center"><?php if ($value->is_cancel == 'Yes') { ?><span class="badge badge-danger">Yes</span><?php } else if ($value->is_cancel == 'No') { ?><span class="badge badge-primary">No</span><?php } ?></td>*/?>
                                          <td class="text-center">
                                             <div class="list-icons">
                                                <div class="list-icons-item dropdown">
                                                   <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <?php if($load_permission->is_edit == '1') {?>
                                                         <a href="<?php echo base_url('Admin/FundsReceived/edit/'.base64_encode($value->fund_received_id));?>" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                         <?php }?>
                                                      <?php if($load_permission->is_delete == '1') {?>
                                                         <a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/FundsReceived/del/'.base64_encode($value->fund_received_id));?>" class="dropdown-item"><i class="icon-trash-alt"></i> Delete</a>
                                                      <?php }?>
                                                      <?php if($load_permission->is_view == '1') {?>
                                                         <a href="<?php echo base_url('Admin/FundsReceived/view/'.base64_encode($value->fund_received_id));?>" class="dropdown-item"><i class="icon-three-bars"></i> View</a>
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
                           </div>
                           <?php /*<div class="tab-pane fade" id="highlighted-tab3">
                              <?php if(!empty($expenditure_details_info)) {?>
                              <div class="table-responsive">
                                 <table class="table datatable-basic table-bordered">
                                    <thead>
                                       <tr>
                                          <?php /*<th class="text-center">Sr.No.</th>
                                          <th class="text-center" style="width: 200px;">Scheme_Name</th>*//*?>
                                          <th class="text-center" style="width: 200px;">Projects</th>
                                          <th class="text-center">Running_Bill</th>
                                          <th class="text-center" style="width: 100px;">Date</th>
                                          <th class="text-center">Description_of_Bills</th>
                                          <th class="text-center">Name_of_Contractor</th>
                                          <th class="text-center">Gross_Amount</th>
                                          <th class="text-center">Net_Amount_Payable</th>
                                          <th class="text-center">Payment_Mode</th>
                                          <?php /*<th class="text-center">Bank Name</th>
                                          <th class="text-center">Transaction / Cheque No.</th>
                                          <th class="text-center">Transaction / Cheque Date</th>
                                          <th class="text-center">Branch</th>*//*?>
                                          <th class="text-center">Remarks</th>
                                          <?php /*<th class="text-center">Status</th>
                                          <th class="text-center">Cancel</th>*//*?>
                                          <th class="text-center">Action</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php $sr = 1;
                                          foreach($expenditure_details_info as $value) {?>
                                       <tr>
                                          <?php /*<td><?php echo $sr; $sr++; //$value->expenditure_id;?></td>
                                          <td><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                                   if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></td>*//*?>
                                          <td><?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $value->project_activity_id);
                                          if(!empty($project_activity_info)) { echo $project_activity_info['0']->activity_name;}?></td>
                                          <td><?php echo $value->running_bill;?></td>
                                          <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->date);?></td>
                                          <td><?php echo $value->bill_no;?></td>
                                          <td><?php $contractor_info = $this->UsersMstModel->get_record($value->contractor_id);
                                                   if(!empty($contractor_info)) {?><a target="_blank" href="<?php echo base_url('Admin/Contractor/view/'.base64_encode($value->contractor_id));?>"><?php echo $contractor_info['0']->name;?></a><?php }?></td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->gross_amount);?></td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                          <td><?php $payment_mode_info = $this->PaymentModeMstModel->get_record($value->payment_mode_id);
                                                   if (!empty($payment_mode_info)) { echo $payment_mode_info['0']->payment_mode;} ?></td>
                                          <?php /*<td><?php $bank_info = $this->BankMstModel->get_record($value->bank_id);
                                                   if (!empty($bank_info)) { echo $bank_info['0']->bank;} ?></td>
                                          <td><?php echo $value->transaction_no; ?></td>
                                          <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->transaction_date); ?></td>
                                          <td><?php echo $value->branch; ?></td>*//*?>
                                          <td><?php echo $value->remarks;?></td>
                                          <?php /*<td><?php if($value->status_id == 'Pending') {?>
                                                <span class="badge bg-grey-400"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'In-Progress') {?>
                                                <span class="badge badge-info"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'Accepted') {?>
                                                <span class="badge badge-primary"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'Rejected') {?>
                                                <span class="badge badge-danger"><?php echo $value->status_id;?></span>
                                             <?php }?>                              
                                          </td>
                                          <td class="text-center"><?php if ($value->is_cancel == 'Yes') { ?><span class="badge badge-danger">Yes</span><?php } else if ($value->is_cancel == 'No') { ?><span class="badge badge-primary">No</span><?php } ?></td>*//*?>
                                          <td class="text-center">
                                             <div class="list-icons">
                                                <div class="list-icons-item dropdown">
                                                   <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <?php if($load_permission->is_edit == '1') {?>
                                                         <a href="<?php echo base_url('Admin/ExpenditureDetails/edit/'.base64_encode($value->expenditure_id));?>" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                         <?php }?>
                                                      <?php if($load_permission->is_delete == '1') {?>
                                                         <a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/ExpenditureDetails/del/'.base64_encode($value->expenditure_id));?>" class="dropdown-item"><i class="icon-trash-alt"></i> Delete</a>
                                                      <?php }?>
                                                      <?php if($load_permission->is_view == '1') {?>
                                                         <a href="<?php echo base_url('Admin/ExpenditureDetails/view/'.base64_encode($value->expenditure_id));?>" class="dropdown-item"><i class="icon-three-bars"></i> View</a>
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
                           </div>*/?>
                           <div class="tab-pane fade" id="highlighted-tab4">
                              <?php if(!empty($interest_info)) {?>
                              <div class="table-responsive">
                                 <table class="table datatable-basic table-bordered">
                                    <thead>
                                       <tr>
                                          <?php /*<th class="text-center">Sr.No.</th>
                                          <th class="text-center">Description of Bills</th>
                                          <th class="text-center">Scheme Name</th>
                                          <?php /*<th class="text-center">Projects</th>*/?>
                                          <th class="text-center">Date</th>
                                          <th class="text-center">Sanctioned funds</th>
                                          <th class="text-center">Interest Amount</th>
                                          <th class="text-center">Final Amount</th>
                                          <?php /*<th class="text-center">Payment Mode</th>
                                          <th class="text-center">Bank Name</th>
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
                                          foreach($interest_info as $value) {?>
                                       <tr>
                                       <?php /*<td><?php echo $sr; $sr++; //$value->interest_id;?></td>
                                          <td><?php echo $value->bill_no;?></td>
                                          <td><?php $projects_info = $this->ProjectsMstModel->get_record($login_info->department_id, $value->project_id);
                                                   if(!empty($projects_info)) { echo $projects_info['0']->project_name;}?></td>
                                          <?php /*<td><?php $project_activity_info = $this->ProjectsActivitesMstModel->get_record($login_info->department_id, '', $value->project_activity_id);
                                                            if(!empty($project_activity_info)) { echo $project_activity_info['0']->activity_name;}?></td>*/?>
                                          <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->date);?></td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->gross_amount);?></td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->net_amount_released);?></td>
                                          <td class="text-right"><?php echo $this->customlib->inr_format($value->gross_amount+$value->net_amount_released);?></td>
                                          <?php /*<td><?php $payment_mode_info = $this->PaymentModeMstModel->get_record($value->payment_mode_id);
                                                   if (!empty($payment_mode_info)) { echo $payment_mode_info['0']->payment_mode;} ?></td>
                                          <td><?php $bank_info = $this->BankMstModel->get_record($value->bank_id);
                                                   if (!empty($bank_info)) { echo $bank_info['0']->bank;} ?></td>
                                          <td><?php echo $value->transaction_no; ?></td>
                                          <td><?php echo $this->customlib->get_DDMMYYYY_FULL($value->transaction_date); ?></td>
                                          <td><?php echo $value->branch; ?></td>*/?>
                                          <td><?php echo $value->remarks;?></td>
                                          <?php /*<td><?php if($value->status_id == 'Pending') {?>
                                                <span class="badge bg-grey-400"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'In-Progress') {?>
                                                <span class="badge badge-info"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'Accepted') {?>
                                                <span class="badge badge-primary"><?php echo $value->status_id;?></span>
                                             <?php } else if($value->status_id == 'Rejected') {?>
                                                <span class="badge badge-danger"><?php echo $value->status_id;?></span>
                                             <?php }?>                              
                                          </td>
                                          <td class="text-center"><?php if ($value->is_cancel == 'Yes') { ?><span class="badge badge-danger">Yes</span><?php } else if ($value->is_cancel == 'No') { ?><span class="badge badge-primary">No</span><?php } ?></td>*/?>
                                          <td class="text-center">
                                             <div class="list-icons">
                                                <div class="list-icons-item dropdown">
                                                   <a href="#" class="list-icons-item dropdown-toggle caret-0" data-toggle="dropdown"><i class="icon-menu7"></i></a>
                                                   <div class="dropdown-menu dropdown-menu-right">
                                                      <?php if($load_permission->is_edit == '1') {?>
                                                         <a href="<?php echo base_url('Admin/Interest/edit/'.base64_encode($value->interest_id));?>" class="dropdown-item"><i class="icon-pencil"></i> Edit</a>
                                                         <?php }?>
                                                      <?php if($load_permission->is_delete == '1') {?>
                                                         <a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/Interest/del/'.base64_encode($value->interest_id));?>" class="dropdown-item"><i class="icon-trash-alt"></i> Delete</a>
                                                      <?php }?>
                                                      <?php if($load_permission->is_view == '1') {?>
                                                         <a href="<?php echo base_url('Admin/Interest/view/'.base64_encode($value->interest_id));?>" class="dropdown-item"><i class="icon-three-bars"></i> View</a>
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
               <form action="<?php echo base_url('Admin/Projects/edit/'.base64_encode($project_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8" style="margin: 0px;">
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
                                    <th class="text-center" style="padding: 5px;">Balance Fund</th>
                                 </tr>
                              </thead>
                              <tbody>
                              <?php if(!empty($projects_bank_info)) {?>
                              <?php $sr = 1;
                                    foreach($projects_bank_info as $value) {?>
                                 <tr>
                                    <td><?php echo $sr; $sr++; //$value->project_id;?></td>
                                    <td style="padding: 5px;">
                                    <?php $bank_info = $this->BankMstModel->get_record($value->bank_id);
                                          if (!empty($bank_info)) { echo $bank_info['0']->bank;} ?></td>
                                    <td style="padding: 5px;"><?php echo $value->account_no;?></td>
                                    <td style="padding: 5px;"><?php echo $value->ifsc_code;?></td>
                                    <td style="padding: 5px;"><?php echo $value->branch;?></td>
                                    <td style="padding: 5px;" class="text-right"><?php echo $this->customlib->inr_format($value->balance);?></td>
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