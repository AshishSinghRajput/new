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
         <a href="<?php echo base_url('Admin/Contractor');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
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
            <form action="<?php echo base_url('Admin/ManageStore/view/' . base64_encode($supplier_id)); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Firm Name</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->firm_name; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Owner Name</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->owner_name; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Supplier Type</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->firm_type;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Address</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->address; ?>
                        </div>
                     </div>
                  </div>
                  
               
                  
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Mobile No. 1</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->mobile; ?>
                        </div>
                     </div>
                  </div>
                  
               
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">E-mail</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->email; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Website</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->website; ?>
                        </div>
                     </div>
                  </div>
               </div>
               <hr />
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">GSIN No.</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->gsin_no; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">PAN No.</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->pan_no; ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Aadhar No.</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $supplier_info->aadhar_no; ?>
                        </div>
                     </div>
                  </div>
               </div>
               <hr />
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <?php $bank_info = $this->BankMstModel->get_record($supplier_info->bank_id); ?>
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Bank Name <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><?php if (!empty($bank_info)) {
                                                                        echo $bank_info['0']->bank;
                                                                     } ?></div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Account No. <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><?php echo $supplier_info->account_no; ?></div>
                     </div>
                  </div>
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">IFSC Code <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><?php echo $supplier_info->ifsc_code; ?></div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-4 col-sm-4 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Branch <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12"><?php echo $supplier_info->branch; ?></div>
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

<script type="text/javascript">
   function checkfile(sender, str) {
      var validExts = new Array('.jpg', '.jpeg', '.png');
      var fileExt = sender.value;
      fileExt = fileExt.substring(fileExt.lastIndexOf('.'));
      if (validExts.indexOf(fileExt) < 0) {
         alert("Invalid file selected, valid files are of " +
            validExts.toString() + " types.");
         document.getElementById(str).value = '';
         return false;
      } else return true;
   }
</script>
<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>
<script type="text/javascript">
   $(document).ready(function() {
      $('#state_name').on("change", function(event) {
         var data = this.value;
         //alert('<?php echo base_url(); ?>Ajaxloader/get_city/'+data)  ;
         $.get('<?php echo base_url(); ?>Ajaxloader/get_city/' + data, function(resp) {
            $('#city_name').html(resp);
         });
      });
   });
</script>