   <?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
   <!-- Page header -->
   <div class="page-header page-header-light">
      <div class="page-header-content header-elements-md-inline">
         <div class="page-title d-flex">
            <h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold"><?php echo $page_val['topbar'];?></span></h4>
            <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
         </div>

         
      </div>

      
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
                  <div class="table-responsive">
                     <table class="table datatable-basic">
                     <tbody>
                        <tr>
                           <td><a href="<?php echo base_url('Dashboard/projectreport');?>" class="btn btn-primary btn-md waves-effect waves-light m-1" style="display: block; font-size: 14px;">Projects Report</a><td>
                           <td><a href="<?php echo base_url('Dashboard/projectacctivity');?>" class="btn btn-primary btn-md waves-effect waves-light m-1" style="display: block; font-size: 14px;">Activites Under Project</a><td>
                           <td><a href="<?php echo base_url('Dashboard/fndreceived');?>" class="btn btn-primary btn-md waves-effect waves-light m-1" style="display: block; font-size: 14px;">Funds Received Details</a><td>
                        </tr>
                        <tr>
                           <td><a href="<?php echo base_url('Dashboard/fundexpenditure');?>" class="btn btn-primary btn-md waves-effect waves-light m-1" style="display: block; font-size: 14px;">Expenditure Details</a><td>
                           <td><a href="<?php echo base_url('Dashboard/schemfund');?>" class="btn btn-primary btn-md waves-effect waves-light m-1" style="display: block; font-size: 14px;">Scheme Wise Funds</a><td>
                           <td><a href="<?php echo base_url('Dashboard/contractordetails');?>" class="btn btn-primary btn-md waves-effect waves-light m-1" style="display: block; font-size: 14px;">Details of Contractor</a><td>
                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>