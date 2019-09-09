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
                     <table id="zero_config_op" class="table table-striped table-bordered">
                        <thead>
                           <tr>
                              <th width="20">Sr.</th> 
                              <th>Name of the Work</th>   
                              <th>Funds Allocated</th>    
                              <th>Technical Sanction Amount</th>    
                              <th>DNIT Amount</th> 
                              <th>Allotment Below / Above</th> 
                              <th>Allotment Amount</th> 
                              <th>Name of Contractor</th>
                              <th>Date of Start</th>
                              <th>Scheduled Date of Completion</th>
                              <th>Extension if any</th>
                              <th>Actual Date of Completion</th>
                              <th>Expenditure / payment released</th>
                              <th>Remarks</th>
                           </tr>
                        </thead>
                        <tbody>
                           
                              
                              <?php $i = 1;
                              foreach ($listdata as $value) {
                              ?>
                              <tr>
                                 <td><?php echo $i;?></td>
                                 <td><?php echo $value->namework;?></td>
                                 <td><?php echo $value->fundsallot;?></td>
                                 <td><?php echo $value->techsan;?></td>
                                 <td><?php echo $value->dnitamt;?></td>
                                 <td><?php echo $value->allotmentba;?></td>
                                 <td><?php echo $value->allotamt;?></td>
                                 <td><?php echo $value->contractorname;?></td>
                                 <td><?php echo $value->datestart;?></td>
                                 <td><?php echo $value->schdatecom;?></td>
                                 <td><?php echo $value->extifany;?></td>     
                                 <td><?php echo $value->actdateofcom;?></td>     
                                 <td><?php echo $value->expend;?></td>     
                                 <td><?php echo $value->remarks;?></td>      
                              </tr>
                              <?php $i++;
                              }?>
                              
                              
                        </tbody>
                       
                     </table>
                  </div>


                </div>
         </div>
      </div>
   </div>
</div>