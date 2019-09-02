<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
         <div class="card-header">
            <div class="row">
               <div class="col-md-6 col-sm-6 col-xs-12 text-left">
                  <div class="card-title text-uppercase"><?php echo $page_val['topbar']; ?></div>
               </div>
               <div class="col-md-6 col-sm-6 col-xs-12 text-right">
                  <a href="<?php echo base_url('Admin/ManageProduct'); ?>" class="btn btn-primary btn-sm waves-effect waves-light m-1">Back</a>
               </div>
            </div>
            <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('ses_success'))) { ?>
               <div id="alert_message" class="alert alert-outline-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <div class="alert-message">
                     <span><strong>Success!</strong> <?php echo $this->session->flashdata('ses_success'); ?></span>
                  </div>
               </div>
            <?php } ?>
            <?php if ((!isset($this->session->flashdata)) && ($this->session->flashdata('error_msg'))) { ?>
               <div id="alert_message" class="alert alert-outline-warning alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <div class="alert-message">
                     <span><strong>Error!</strong> <?php echo $this->session->flashdata('error_msg'); ?></span>
                  </div>
               </div>
            <?php } ?>
         </div>
         <div class="card-body">
            <form action="<?php echo base_url('Admin/ManageProduct/add'); ?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Product code <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $product_code_value = '';
                           if ($this->input->post('submit')) {
                              $product_code_value = $this->input->post('product_code');
                           } else if (!empty($product_info)) {
                              $product_code_value = $product_info->product_code;
                           } ?>
                           <input type="text" required id="product_code" name="product_code" placeholder="Enter your product code" class="form-control" maxlength="50" value="<?php echo $product_code_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('product_code'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Product Name <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $heading_value = '';
                           if ($this->input->post('submit')) {
                              $heading_value = $this->input->post('heading');
                           } else if (!empty($product_info)) {
                              $heading_value = $product_info->heading;
                           } ?>
                           <input type="text" required id="heading" name="heading" placeholder="Enter your product name" class="form-control" maxlength="255" value="<?php echo $heading_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('heading'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Images <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <input type="file" name="product_images" class="form-control" id="product_images" accept="image/*" onChange="checkfile(this, 'product_images');">
                           <span class="badge badge-danger m-1"><?php echo form_error('product_images'); ?></span>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $logo_value = '';
                           if ((!empty($product_info)) && ($product_info->thumbnail2 != '')) {
                              $logo_value = $product_info->thumbnail2; ?>
                              <img src="<?php echo base_url($this->config->item('product_thumbnail2') . $logo_value); ?>" style="width: auto; height: 40px;" />
                           <?php } ?>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Brand <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="brand_id" name="brand_id" required>
                              <?php $select_brand_id = '';
                              if ($this->input->post('submit')) {
                                 $select_brand_id = $this->input->post('brand_id');
                              } else if (!empty($product_info)) {
                                 $select_brand_id = $product_info->brand_id;
                              } ?>
                              <option <?php if ($select_brand_id == '') { ?>selected="selected" <?php } ?> value="">Select Brand</option>
                              <?php
                              if (!empty($brand_list)) {
                                 foreach ($brand_list as $value) { ?>
                                    <option <?php if ($select_brand_id == $value->brand_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->brand_id; ?>"><?php echo $value->heading; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('brand_id'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category 1 <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="category1_id" name="category1_id" required>
                              <?php $select_category1_id = '';
                              if ($this->input->post('submit')) {
                                 $select_category1_id = $this->input->post('category1_id');
                              } else if (!empty($product_info)) {
                                 $select_category1_id = $product_info->category1_id;
                              } ?>
                              <option <?php if ($select_category1_id == '') { ?>selected="selected" <?php } ?> value="">Select Category 1</option>
                              <?php
                              if (!empty($category1_list)) {
                                 foreach ($category1_list as $value) { ?>
                                    <option <?php if ($select_category1_id == $value->category_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->category_id; ?>"><?php echo $value->heading; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('category1_id'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category 2 <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="category2_id" name="category2_id">
                              <?php $select_category2_id = '';
                              if ($this->input->post('submit')) {
                                 $select_category2_id = $this->input->post('category2_id');
                              } else if (!empty($product_info)) {
                                 $select_category2_id = $product_info->category2_id;
                              } ?>
                              <option <?php if ($select_category2_id == '') { ?>selected="selected" <?php } ?> value="">Select Category 2</option>
                              <?php
                              if (!empty($category2_list)) {
                                 foreach ($category2_list as $value) { ?>
                                    <option <?php if ($select_category2_id == $value->category_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->category_id; ?>"><?php echo $value->heading; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('category2_id'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category 3 <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="category3_id" name="category3_id">
                              <?php $select_category3_id = '';
                              if ($this->input->post('submit')) {
                                 $select_category3_id = $this->input->post('category3_id');
                              } else if (!empty($product_info)) {
                                 $select_category3_id = $product_info->category3_id;
                              } ?>
                              <option <?php if ($select_category3_id == '') { ?>selected="selected" <?php } ?> value="">Select Category 3</option>
                              <?php
                              if (!empty($category3_list)) {
                                 foreach ($category3_list as $value) { ?>
                                    <option <?php if ($select_category3_id == $value->category_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->category_id; ?>"><?php echo $value->heading; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('category3_id'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Category 4 <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="category4_id" name="category4_id">
                              <?php $select_category4_id = '';
                              if ($this->input->post('submit')) {
                                 $select_category4_id = $this->input->post('category4_id');
                              } else if (!empty($product_info)) {
                                 $select_category4_id = $product_info->category4_id;
                              } ?>
                              <option <?php if ($select_category4_id == '') { ?>selected="selected" <?php } ?> value="">Select Category 4</option>
                              <?php
                              if (!empty($category4_list)) {
                                 foreach ($category4_list as $value) { ?>
                                    <option <?php if ($select_category4_id == $value->category_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->category_id; ?>"><?php echo $value->heading; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('category4_id'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">EAN/UPC/GTIN Code <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $ean_upc_gtin_value = '';
                           if ($this->input->post('submit')) {
                              $ean_upc_gtin_value = $this->input->post('ean_upc_gtin');
                           } else if (!empty($product_info)) {
                              $ean_upc_gtin_value = $product_info->ean_upc_gtin;
                           } ?>
                           <input type="text" id="ean_upc_gtin" name="ean_upc_gtin" placeholder="Enter your EAN/UPC/GTIN Code" class="form-control" maxlength="50" value="<?php echo $ean_upc_gtin_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('ean_upc_gtin'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">HSN Code <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $hsn_code_value = '';
                           if ($this->input->post('submit')) {
                              $hsn_code_value = $this->input->post('hsn_code');
                           } else if (!empty($product_info)) {
                              $hsn_code_value = $product_info->hsn_code;
                           } ?>
                           <input type="text" id="hsn_code_value" name="hsn_code_value" placeholder="Enter your hsn code" class="form-control" maxlength="50" value="<?php echo $hsn_code_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('hsn_code_value'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">MPN Code <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $mpn_code_value = '';
                           if ($this->input->post('submit')) {
                              $mpn_code_value = $this->input->post('mpn_code');
                           } else if (!empty($product_info)) {
                              $mpn_code_value = $product_info->mpn_code;
                           } ?>
                           <input type="text" id="mpn_code" name="mpn_code" placeholder="Enter your mpn code" class="form-control" maxlength="50" value="<?php echo $mpn_code_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('mpn_code'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">SKU Code <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $sku_code_value = '';
                           if ($this->input->post('submit')) {
                              $sku_code_value = $this->input->post('sku_code');
                           } else if (!empty($product_info)) {
                              $sku_code_value = $product_info->sku_code;
                           } ?>
                           <input type="text" id="sku_code" name="sku_code" placeholder="Enter your sku code" class="form-control" maxlength="50" value="<?php echo $sku_code_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('sku_code'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Model <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $model_value = '';
                           if ($this->input->post('submit')) {
                              $model_value = $this->input->post('model');
                           } else if (!empty($product_info)) {
                              $model_value = $product_info->model;
                           } ?>
                           <input type="text" id="model" name="model" placeholder="Enter your model" class="form-control" maxlength="255" value="<?php echo $model_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('model'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Product Type <span class="text-hightlight">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <?php $is_product_type_value = '';
                              if ($this->input->post('submit')) {
                                 $is_product_type_value = $this->input->post('is_product_type');
                              } else if (!empty($product_info)) {
                                 $is_product_type_value = $product_info->is_product_type;
                              } ?>
                              <input type="radio" id="is_product_type" name="is_product_type" value="1" <?php if ($is_product_type_value == '1') { ?>checked="checked" <?php } ?> />
                              <label for="is_product_type">Retail</label>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <input type="radio" id="is_product_type" name="is_product_type" value="0" <?php if ($is_product_type_value == '0') { ?>checked="checked" <?php } ?> />
                              <label for="is_product_type">Pack</label>
                           </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <span class="badge badge-danger m-1"><?php echo form_error('is_product_type'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Packing <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="packing_id" name="packing_id" required>
                              <?php $select_packing_id = '';
                              if ($this->input->post('submit')) {
                                 $select_packing_id = $this->input->post('packing_id');
                              } else if (!empty($product_info)) {
                                 $select_packing_id = $product_info->packing_id;
                              } ?>
                              <option <?php if ($select_packing_id == '') { ?>selected="selected" <?php } ?> value="">Select Packing</option>
                              <?php
                              if (!empty($packing_list)) {
                                 foreach ($packing_list as $value) { ?>
                                    <option <?php if ($select_packing_id == $value->packing_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->packing_id; ?>"><?php echo $value->packing_title; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('packing_id'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Unit <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="unit_id" name="unit_id" required>
                              <?php $select_unit_id = '';
                              if ($this->input->post('submit')) {
                                 $select_unit_id = $this->input->post('unit_id');
                              } else if (!empty($product_info)) {
                                 $select_unit_id = $product_info->unit_id;
                              } ?>
                              <option <?php if ($select_unit_id == '') { ?>selected="selected" <?php } ?> value="">Select Unit</option>
                              <?php
                              if (!empty($unit_list)) {
                                 foreach ($unit_list as $value) { ?>
                                    <option <?php if ($select_unit_id == $value->unit_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->unit_id; ?>"><?php echo $value->unit_title; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('unit_id'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Weight <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $weight_value = '';
                           if ($this->input->post('submit')) {
                              $weight_value = $this->input->post('weight');
                           } else if (!empty($product_info)) {
                              $weight_value = $product_info->weight;
                           } ?>
                           <input type="text" id="weight" name="weight" placeholder="Enter weight" minlength="0" maxlength="10" class="form-control" value="<?php echo $weight_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('weight'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Weight Unit <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="weight_unit_id" name="weight_unit_id" required>
                              <?php $select_weight_unit_id = '';
                              if ($this->input->post('submit')) {
                                 $select_weight_unit_id = $this->input->post('weight_unit_id');
                              } else if (!empty($product_info)) {
                                 $select_weight_unit_id = $product_info->weight_unit_id;
                              } ?>
                              <option <?php if ($select_weight_unit_id == '') { ?>selected="selected" <?php } ?> value="">Select Weight Unit</option>
                              <?php
                              if (!empty($weight_unit_list)) {
                                 foreach ($weight_unit_list as $value) { ?>
                                    <option <?php if ($select_weight_unit_id == $value->unit_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->unit_id; ?>"><?php echo $value->unit_title; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('weight_unit_id'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Length <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $length_value = '';
                           if ($this->input->post('submit')) {
                              $length_value = $this->input->post('length');
                           } else if (!empty($product_info)) {
                              $length_value = $product_info->length;
                           } ?>
                           <input type="text" id="length" name="length" placeholder="Enter length" minlength="0" maxlength="10" class="form-control" value="<?php echo $length_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('length'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Width <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $width_value = '';
                           if ($this->input->post('submit')) {
                              $width_value = $this->input->post('width');
                           } else if (!empty($product_info)) {
                              $width_value = $product_info->width;
                           } ?>
                           <input type="text" id="width" name="width" placeholder="Enter width" minlength="0" maxlength="10" class="form-control" value="<?php echo $width_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('width'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Length <span class="text-hightlight" style="display: none;">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $height_value = '';
                           if ($this->input->post('submit')) {
                              $height_value = $this->input->post('height');
                           } else if (!empty($product_info)) {
                              $height_value = $product_info->height;
                           } ?>
                           <input type="text" id="height" name="height" placeholder="Enter height" minlength="0" maxlength="10" class="form-control" value="<?php echo $height_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('height'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Length Unit <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="lwh_unit_id" name="lwh_unit_id" required>
                              <?php $select_lwh_unit_id = '';
                              if ($this->input->post('submit')) {
                                 $select_lwh_unit_id = $this->input->post('lwh_unit_id');
                              } else if (!empty($product_info)) {
                                 $select_lwh_unit_id = $product_info->lwh_unit_id;
                              } ?>
                              <option <?php if ($select_lwh_unit_id == '') { ?>selected="selected" <?php } ?> value="">Select Length Unit</option>
                              <?php
                              if (!empty($lwh_unit_list)) {
                                 foreach ($lwh_unit_list as $value) { ?>
                                    <option <?php if ($select_lwh_unit_id == $value->unit_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->unit_id; ?>"><?php echo $value->unit_title; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('lwh_unit_id'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">CGST <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="cgst_taxes_id" name="cgst_taxes_id" required>
                              <?php $select_cgst_taxes_id = '';
                              if ($this->input->post('submit')) {
                                 $select_cgst_taxes_id = $this->input->post('cgst_taxes_id');
                              } else if (!empty($product_info)) {
                                 $select_cgst_taxes_id = $product_info->cgst_taxes_id;
                              } ?>
                              <option <?php if ($select_cgst_taxes_id == '') { ?>selected="selected" <?php } ?> value="">Select CGST</option>
                              <?php
                              if (!empty($cgst_taxes_list)) {
                                 foreach ($cgst_taxes_list as $value) { ?>
                                    <option <?php if ($select_cgst_taxes_id == $value->taxes_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->taxes_id; ?>"><?php echo $value->taxes_title; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('cgst_taxes_id'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">SGST <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="sgst_taxes_id" name="sgst_taxes_id" required>
                              <?php $select_sgst_taxes_id = '';
                              if ($this->input->post('submit')) {
                                 $select_sgst_taxes_id = $this->input->post('sgst_taxes_id');
                              } else if (!empty($product_info)) {
                                 $select_sgst_taxes_id = $product_info->sgst_taxes_id;
                              } ?>
                              <option <?php if ($select_sgst_taxes_id == '') { ?>selected="selected" <?php } ?> value="">Select SGST</option>
                              <?php
                              if (!empty($sgst_taxes_list)) {
                                 foreach ($sgst_taxes_list as $value) { ?>
                                    <option <?php if ($select_sgst_taxes_id == $value->taxes_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->taxes_id; ?>"><?php echo $value->taxes_title; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('sgst_taxes_id'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">IGST <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <select class="form-control" id="igst_taxes_id" name="igst_taxes_id" required>
                              <?php $select_igst_taxes_id = '';
                              if ($this->input->post('submit')) {
                                 $select_igst_taxes_id = $this->input->post('igst_taxes_id');
                              } else if (!empty($product_info)) {
                                 $select_igst_taxes_id = $product_info->igst_taxes_id;
                              } ?>
                              <option <?php if ($select_igst_taxes_id == '') { ?>selected="selected" <?php } ?> value="">Select IGST</option>
                              <?php
                              if (!empty($igst_taxes_list)) {
                                 foreach ($igst_taxes_list as $value) { ?>
                                    <option <?php if ($select_igst_taxes_id == $value->taxes_id) { ?>selected="selected" <?php } ?> value="<?php echo $value->taxes_id; ?>"><?php echo $value->taxes_title; ?></option>
                                 <?php }
                              } ?>
                           </select>
                           <span class="badge badge-danger m-1"><?php echo form_error('igst_taxes_id'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Store Display <span class="text-hightlight">*</span></label>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <?php $is_store_value = '';
                              if ($this->input->post('submit')) {
                                 $is_store_value = $this->input->post('is_store');
                              } else if (!empty($product_info)) {
                                 $is_store_value = $product_info->is_store;
                              } ?>
                              <input type="radio" id="is_store" name="is_store" value="1" <?php if ($is_store_value == '1') { ?>checked="checked" <?php } ?> />
                              <label for="is_store">Visible</label>
                           </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                           <div class="">
                              <input type="radio" id="is_store" name="is_store" value="0" <?php if ($is_store_value == '0') { ?>checked="checked" <?php } ?> />
                              <label for="is_store">Hide</label>
                           </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <span class="badge badge-danger m-1"><?php echo form_error('is_store'); ?></span>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-3 col-sm-3 col-xs-12">
                     <div class="form-group row">
                        <label for="input-21" class="col-md-12 col-sm-12 col-xs-12 col-form-label">Priority <span class="text-hightlight">*</span></label>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                           <?php $store_priority_value = '';
                           if ($this->input->post('submit')) {
                              $store_priority_value = $this->input->post('store_priority');
                           } else if (!empty($product_info)) {
                              $store_priority_value = $product_info->store_priority;
                           } ?>
                           <input type="text" id="store_priority" name="store_priority" placeholder="Enter priority" minlength="0" maxlength="10" class="form-control" value="<?php echo $store_priority_value; ?>" />
                           <span class="badge badge-danger m-1"><?php echo form_error('store_priority'); ?></span>
                        </div>
                     </div>
                  </div>
               </div>
               <hr />
               <div class="form-group row">
                  <label class="col-md-12 col-sm-12 col-xs-12 col-form-label"></label>
                  <div class="col-md-12 col-sm-12 col-xs-12">
                     <input type="submit" name="submit" class="btn btn-success" value="Add New">
                  </div>
               </div>
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
         document.getElementById(str).value = '';
         return false;
      } else return true;
   }
</script>

<script src="<?php echo base_url('assets/js/jquery.min.js'); ?>"></script>

<script type="text/javascript">
   $(document).ready(function() {
      $('#brand_id').on("change", function(event) {
         var data = this.value;
         //alert('<?php echo base_url(); ?>Ajaxloader/get_city/'+data)	;
         $.get('<?php echo base_url(); ?>Ajaxloader/get_brand_product/' + data, function(resp) {
            $('#product_id').html(resp);
         });
      });
   });
</script>

<script type="text/javascript">
   $(document).ready(function() {
      $('#category1_id').on("change", function(event) {
         var data = this.value;
         //alert('<?php echo base_url(); ?>Ajaxloader/get_city/'+data)	;
         $.get('<?php echo base_url(); ?>Ajaxloader/get_category/' + data + '/2', function(resp) {
            $('#category2_id').html(resp);
         });
      });
   });
</script>

<script type="text/javascript">
   $(document).ready(function() {
      $('#category2_id').on("change", function(event) {
         var data = this.value;
         //alert('<?php echo base_url(); ?>Ajaxloader/get_city/'+data)	;
         $.get('<?php echo base_url(); ?>Ajaxloader/get_category/' + data + '/3', function(resp) {
            $('#category3_id').html(resp);
         });
      });
   });
</script>

<script type="text/javascript">
   $(document).ready(function() {
      $('#category3_id').on("change", function(event) {
         var data = this.value;
         //alert('<?php echo base_url(); ?>Ajaxloader/get_city/'+data)	;
         $.get('<?php echo base_url(); ?>Ajaxloader/get_category/' + data + '/4', function(resp) {
            $('#category4_id').html(resp);
         });
      });
   });
</script>