<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8"/>
      <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
      <title><?php echo $page_val['title'];?></title>
      <meta name="author" content="<?php echo $page_val['author'];?>" />
      <meta name="keyword" content="<?php echo $page_val['keywords'];?>" />
      <meta name="description" content="<?php echo $page_val['description'];?>" />
      <link rel="shortcut icon" href="<?php echo base_url('site_folder/favicon.png');?>" type="image/x-icon" />
      <!-- simplebar CSS-->
      <link href="<?php echo base_url('assets/assets/plugins/simplebar/css/simplebar.css');?>" rel="stylesheet"/>
      <!-- Bootstrap core CSS-->
      <link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet"/>
      <!-- animate CSS-->
      <link href="<?php echo base_url('assets/css/animate.css');?>" rel="stylesheet" type="text/css"/>
      <!-- Icons CSS-->
      <link href="<?php echo base_url('assets/css/icons.css');?>" rel="stylesheet" type="text/css"/>
      <!-- Custom Style-->
      <link href="<?php echo base_url('assets/css/app-style.css');?>" rel="stylesheet"/>
   </head>
   <body>
      <!-- start loader -->
      <div id="pageloader-overlay" class="visible incoming">
         <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner" >
               <div class="loader"></div>
            </div>
         </div>
      </div>
      <!-- end loader -->
      <!-- Start wrapper-->
      <div id="wrapper">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="text-center error-pages">
                     <h1 class="error-title text-warning"> 404</h1>
                     <h2 class="error-sub-title text-dark">404 not found</h2>
                     <p class="error-message text-dark text-uppercase">Sorry, an error has occured, Requested page not found!</p>
                     <div class="mt-4">
                        <a href="<?php echo base_url('Login');?>" class="btn btn-dark btn-round m-1">Go To Home </a>
                        <?php /*<a href="javascript:void();" class="btn btn-warning btn-round m-1">Previous Page </a>*/?>
                     </div>
                     <div class="mt-4">
                        <p style="margin-bottom: 0px; font-size: 12px;">Copyright © 2019, All Rights Reserved by <?php echo $this->lang->line('project_short_name');?></p>
                        <p style="margin-bottom: 0px; font-size: 12px;>Powered By <a href="http://cnvg.in/">Converge Infoservices Pvt. Ltd.</a></p>
                     </div>
                     <?php /*<hr class="w-50 border-light">
                        <div class="mt-2">
                           <a href="javascript:void()" class="btn-social btn-facebook btn-social-circle waves-effect waves-light m-1"><i class="fa fa-facebook"></i></a>
                           <a href="javascript:void()" class="btn-social btn-google-plus btn-social-circle waves-effect waves-light m-1"><i class="fa fa-google-plus"></i></a>
                           <a href="javascript:void()" class="btn-social btn-behance btn-social-circle waves-effect waves-light m-1"><i class="fa fa-behance"></i></a>
                           <a href="javascript:void()" class="btn-social btn-dribbble btn-social-circle waves-effect waves-light m-1"><i class="fa fa-dribbble"></i></a>
                        </div>*/?>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--wrapper-->
      <script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
      <script src="<?php echo base_url('assets/js/popper.min.js');?>"></script>
      <script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
      <!-- simplebar js -->
      <script src="<?php echo base_url('assets/plugins/simplebar/js/simplebar.js');?>"></script>
      <!-- sidebar-menu js -->
      <script src="<?php echo base_url('assets/js/sidebar-menu.js');?>"></script>
      <!-- Custom scripts -->
      <script src="<?php echo base_url('assets/js/app-script.js');?>"></script>
   </body>
</html>