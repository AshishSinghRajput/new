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
                               <th>Sr.</th>
                               <th>Description of Bills</th>
                               <th>Gross Amount</th>
                               <th>Net Amount Payable</th>
                               <th colspan="3">Mode of Payment    </th>
                               <th colspan="2">Payment released through RTGS / NEFT </th>
                               <th>Amount Released</th>
                               <th>Date of Payment</th>
                               <th>Other contigent Payments/ Expenses</th>
                               <th>Total Expenditure</th>
                               <th>Remarks</th>
                               
                             </tr>
                             
                        </thead>
                        <tbody>
                           
                              <tr>
                              <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td colspan="2">RTGS/NEFT </td>
                               <td>Cheque</td>
                               <td>Name of Bank</td>
                               <td>Account Number</td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               
                             </tr>
                             <tr>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td>Account No.</td>
                               <td>IFSC Code</td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                               <td></td>
                             </tr>
                             <tr>
                               <td>1</td>
                               <td>CONSTRUCTION ACTIVITIES</td>
                               <td align="right">5896213</td>
                               <td align="right">4589632</td>
                               <td>7894561234567890</td>
                               <td>KKBINSD23</td>
                               <td></td>
                               <td>Kotak</td>
                               <td>7412589632145600</td>
                               <td align="right">4589632</td>
                               <td>30/08/2019</td>
                               <td></td>
                               <td align="right">4589632</td>
                               <td></td>
                             </tr>
                             <tr>
                               <td>2</td>
                               <td>CONSTRUCTION ACTIVITIES</td>
                               <td align="right">5896213</td>
                               <td align="right">4589632</td>
                               <td>7894561234567890</td>
                               <td>KKBINSD23</td>
                               <td></td>
                               <td>Kotak</td>
                               <td>7412589632145600</td>
                               <td align="right">4589632</td>
                               <td>30/08/2019</td>
                               <td></td>
                               <td align="right">4589632</td>
                               <td></td>
                             </tr>
                             <tr>
                               <td>3</td>
                               <td>CONSTRUCTION ACTIVITIES</td>
                               <td align="right">5896213</td>
                               <td align="right">4589632</td>
                               <td>7894561234567890</td>
                               <td>KKBINSD23</td>
                               <td></td>
                               <td>Kotak</td>
                               <td>7412589632145600</td>
                               <td align="right">4589632</td>
                               <td>30/08/2019</td>
                               <td></td>
                               <td align="right">4589632</td>
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