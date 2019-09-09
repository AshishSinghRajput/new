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
                              <th>Project</th>    
                              <th>Sanctioned Funds</th>  
                              <th>Funds Received</th>    
                              <th>Expenditure Incurred</th>    
                              <th>Funds Avaiable</th> 
                              <th>Remarks</th> 
                           </tr>
                        </thead>
                        <tbody>
                           
                              <tr>
                                 <td>A</td>
                                 <td>CONSTRUCTION ACTIVITIES</td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <?php $i = 1;
                              foreach ($listdata as $value) {
                              ?>
                              <tr>
                                 <td><?php echo $i;?></td>
                                 <td><?php echo $value->project;?></td>
                                 <td><?php echo $value->sanc_fund;?></td>
                                 <td><?php echo $value->find_rec;?></td>
                                 <td><?php echo $value->expenditure;?></td>
                                 <td><?php echo $value->fund_avail;?></td>
                                 <td><?php echo $value->remarks;?></td>
                              </tr>
                              <?php $i++;
                              }?>
                              
                              <tr>
                                 <td></td>
                                 <td><b>OTHER ACTIVITIES</b></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>1</td>
                                 <td>CCTNS Funds</td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                              <tr>
                                 <td>2</td>
                                 <td>NETS Funds</td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                                 <td></td>
                              </tr>
                        </tbody>
                       
                     </table>
                  </div>


                </div>
         </div>
      </div>
   </div>
</div>