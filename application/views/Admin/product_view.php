<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                  <div class="card-title text-uppercase"><?php echo $page_val['topbar'];?></div>
               </div>
               <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                  <?php if($load_permission->is_add == '1') {?><a href="<?php echo base_url('Admin/ManageProduct/add');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Add New</a><?php }?> <?php if($load_permission->is_edit == '1') {?><a href="<?php echo base_url('Admin/ManageProduct/edit/'.base64_encode($product_info->product_id));?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Edit</a><?php }?> <?php if($load_permission->is_edit == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('delete_confirmation');?>')" href="<?php echo base_url('Admin/ManageProduct/del/'.base64_encode($product_info->product_id));?>" class="btn btn-danger btn-sm waves-effect waves-light m-1">Delete</a><?php }?> <a href="<?php echo base_url('Admin/ManageProduct');?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
               </div>
            </div>
            <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('ses_success'))) {?>
            <div id="alert_message" class="alert alert-outline-success alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert">×</button>			
               <div class="alert-message">
                  <span><strong>Success!</strong> <?php echo $this->session->flashdata('ses_success');?></span>
               </div>
            </div>
            <?php }?>
            <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('error_msg'))) {?>
            <div id="alert_message" class="alert alert-outline-warning alert-dismissible" role="alert">
               <button type="button" class="close" data-dismiss="alert">×</button>			
               <div class="alert-message">
                  <span><strong>Error!</strong> <?php echo $this->session->flashdata('error_msg');?></span>
               </div>
            </div>
            <?php }?>
         </div>
         <div class="card-body">
            <form action="<?php echo base_url('Admin/ManageProduct/edit/'.base64_encode($product_id));?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Product code</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->product_code;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Product Name</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->heading;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Image</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php if($product_info->thumbnail2 != '') {?>
                              <?php //echo base_url($this->config->item('product_thumbnail2').$product_info->thumbnail2);?>
                              <img src="<?php echo base_url($this->config->item('product_thumbnail2').$product_info->thumbnail2);?>" style="width: auto; height: 40px;" />
                           <?php }?>                                                  
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Brand</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->brand_heading;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category 1</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->category1_heading;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category 2</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->category2_heading;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category 3</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->category3_heading;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category 4</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->category4_heading;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">EAN/UPC/GTIN Code</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->ean_upc_gtin;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">HSN Code</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->hsn_code;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">MPN Code</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->mpn_code;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">SKU Code</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->sku_code;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Model</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->model;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Product Type</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php if($product_info->is_product_type == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('product_type_confirmation');?>')" href="<?php echo base_url('Admin/ManageProduct/is_product_type/'.base64_encode($product_info->product_id).'/'.base64_encode('0'));?>" class=""><span class="badge badge-primary m-1">Retail</span></a><?php } else if($product_info->is_product_type == '0') {?><a onclick="return confirm('<?php echo $this->lang->line('product_type_confirmation');?>')" href="<?php echo base_url('Admin/ManageProduct/is_product_type/'.base64_encode($product_info->product_id).'/'.base64_encode('1'));?>" class=""><span class="badge badge-warning m-1">Pack</span></a><?php }?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Packing</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->packing_title;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Unit</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->unit_title;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Weight</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->weight;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Weight Unit</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->weight_unit;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Length</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->length;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Width</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->width;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Length</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->height;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Length Unit</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->lwh_unit;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">CGST</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->cgst_taxes_title;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">SGST</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->sgst_taxes_title;?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">IGST</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->igst_taxes_title;?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Store Display</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php if($product_info->is_store == '1') {?><a onclick="return confirm('<?php echo $this->lang->line('hide_confirmation');?>')" href="<?php echo base_url('Admin/ManageProduct/is_store/'.base64_encode($product_info->product_id).'/'.base64_encode('0'));?>" class=""><span class="badge badge-primary m-1">Visible</span></a><?php } else if($product_info->is_store == '0') {?><a onclick="return confirm('<?php echo $this->lang->line('visible_confirmation');?>')" href="<?php echo base_url('Admin/ManageProduct/is_store/'.base64_encode($product_info->product_id).'/'.base64_encode('1'));?>" class=""><span class="badge badge-warning m-1">Hide</span></a><?php }?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Priority</label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php echo $product_info->store_priority;?>
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
               </div>*/?>
            </form>
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
           document.getElementById(str).value='';
           return false;
       }
       else return true;
   }
</script>