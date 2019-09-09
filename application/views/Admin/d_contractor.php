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
         <a href="<?php echo base_url('Admin/Reports');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
               <form action="<?php echo base_url('Admin/Contractor');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">   
                  <?php if(!empty($contractor_info)) {?>
                  <div class="table-responsive">
                           <table class="table datatable-basic table-bordered">
                              <thead>
                                 <tr>
                                    <th class="text-center">Sr.No.</th>
                                    <th class="text-center">Firm Type</th>


                                    <th class="text-center">Firm Name</th>
                                    <th class="text-center">Owner Name</th>

                                    <th class="text-center">Address</th>
                                    <th class="text-center">Mobile</th>
                                    <th class="text-center">E-mail</th>
                                    
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php $sr = 1;
                                 foreach ($contractor_info as $value) { ?>
                                    <tr>
                                       <td><?php echo $sr;
                                             $sr++; //$value->store_id;
                                             ?></td>
                                       <td><?php echo $value->firm_type; ?></td>

                                       <td><?php echo $value->firm_name; ?></td>
                                       <td><?php echo $value->owner_name; ?></td>

                                       <td><?php echo $value->address; ?></td>
                                       <td><?php echo $value->mobile; ?></td>
                                       <td><?php echo $value->email; ?></td>
                                       

                                       
                                    </tr>
                                 <?php } ?>
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