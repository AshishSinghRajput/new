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
			
	<!-- Bootstrap core CSS-->
	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet"/>
	<!-- animate CSS-->
	<link href="<?php echo base_url('assets/css/animate.css');?>" rel="stylesheet" type="text/css"/>
	<!-- Icons CSS-->
	<link href="<?php echo base_url('assets/css/icons.css');?>" rel="stylesheet" type="text/css"/>
	<!-- Custom Style-->
	<link href="<?php echo base_url('assets/css/app-style.css');?>" rel="stylesheet"/>  
</head>

<body style="background: url(<?php echo base_url('site_folder/priyadarshini-background.jpg');?>) no-repeat bottom center;">
<!-- start loader -->
<div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner" ><div class="loader"></div></div></div></div>
<!-- end loader -->

<!-- Start wrapper-->
<div id="wrapper">
	<div class="card-authentication2 mx-auto my-5">
	    <div class="card-group">
	    	<div class="card mb-0">
	    	   	<div class="bg-signin2"></div>
	    		<div class="card-img-overlay rounded-left my-5">
                	<p class="card-text text-white pt-3" style="text-align: center;"><img src="<?php echo base_url('site_folder/priyadarshini.png');?>" style="width: auto; height: 110px;" alt="logo" /></p>
            	</div>
	    	</div>
	    	<div class="card mb-0 ">
	    		<div class="card-body">
	    			<div class="card-content p-3">
	    				<?php /*<div class="text-center">
					 		<img src="assets/images/logo-icon.png" alt="logo icon">
					 	</div>
						<div class="card-title text-uppercase text-center py-3">Sign In</div>*/?>
						<form action="<?php echo base_url('Login');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
							<div class="form-group">
								<div class="position-relative has-icon-left">
									<label for="username" class="sr-only">Username <span class="text-hightlight">*</span></label>
									<input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>" autocomplete="off" />
									<div class="form-control-position">
										<i class="icon-user"></i>
									</div>
                                	<span class="badge badge-danger m-1"><?php echo form_error('username');?></span>
								</div>
							</div>
							<div class="form-group">
								<div class="position-relative has-icon-left">
									<label for="password" class="sr-only">Password <span class="text-hightlight">*</span></label>
									<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" autocomplete="off" />
									<div class="form-control-position">
										<i class="icon-lock"></i>
									</div>
                                	<span class="badge badge-danger m-1"><?php echo form_error('password');?></span>
								</div>
							</div>
							<div class="form-group">
								<div class="position-relative has-icon-left">
									<p id="captImg"><?php echo $captchaImg; ?></p>
									<label class="small">Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</label>
									<input type="hidden" id="base_url_captcha" value="<?= base_url('Login/refresh') ?>">
									<input required="" autocomplete="off" type="text" class="form-control" name="captcha" placeholder="Type the characters you see in image">
									<?= ($captcha_error ? "<lable class=\"small\"><p>You have mistyped the captcha.</p></lable>" : "") ?>
								</div>
							</div>
							<?php /*<div class="form-row mr-0 ml-0">
								<div class="form-group col-6">
									<div class="">
										<input type="checkbox" id="user-checkbox" checked="" />
										<label for="user-checkbox">Remember me</label>
									</div>
								</div>
								<div class="form-group col-6 text-right">
									<a href="authentication-reset-password2.html">Reset Password</a>
								</div>
							</div>*/?>
							<?php $submit = array('name'=>'submit', 'id'=>'submit', 'value'=>'Sign In', 'class'=>'btn btn-primary btn-block waves-effect waves-light');
							  echo form_submit($submit);?>						
							<?php /*<div class="text-center pt-3">
							<p>or Sign in with</p>
							<div class="form-row mt-4">
								<div class="form-group mb-0 col-6">
									<button type="button" class="btn bg-facebook text-white btn-block"><i class="fa fa-facebook-square"></i> Facebook</button>
								</div>
								<div class="form-group mb-0 col-6 text-right">
									<button type="button" class="btn bg-twitter text-white btn-block"><i class="fa fa-twitter-square"></i> Twitter</button>
								</div>
							</div>
							<hr>
							<p class="text-dark">Do not have an account? <a href="authentication-signup2.html"> Sign Up here</a></p>
						</div>*/?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>    
<!--Start Back To Top Button-->
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<!--End Back To Top Button-->
</div><!--wrapper-->

<script src="<?php echo base_url('assets/js/jquery.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js');?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>

<!-- sidebar-menu js -->
<script src="<?php echo base_url('assets/js/sidebar-menu.js');?>"></script>

<!-- Custom scripts -->
<script src="<?php echo base_url('assets/js/app-script.js');?>"></script>

<script type="text/javascript">
	$(document).ready(function () {
		$('.refreshCaptcha').on('click', function () {
			var base_url = $('#base_url_captcha').val();
			$.get(base_url, function (data) {
				$('#captImg').html(data);
			});
		});
	})
</script>
</body>
</html>
