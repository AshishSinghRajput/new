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

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('global_assets/css/icons/icomoon/styles.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/bootstrap_limitless.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/layout.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/components.min.css');?>" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url('assets/css/colors.min.css');?>" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

</head>

<body class="bg-slate-800" style="background: url(<?php echo base_url('site_folder/background.jpg');?>) no-repeat bottom center;">

	<!-- Page content -->
	<div class="page-content">

		<!-- Main content -->
		<div class="content-wrapper">

			<!-- Content area -->
			<div class="content d-flex justify-content-center align-items-center">

				<!-- Login card -->
				<form class="login-form" action="<?php echo base_url('Login');?>" method="post" enctype="multipart/form-data" accept-charset="utf-8">
					<div class="card mb-0">
						<div class="card-body">
							<div class="text-center mb-3">
								<p style="text-align: center;"><img src="<?php echo base_url('site_folder/pphcl.png');?>" style="width: auto; height: 40px;" alt="logo" /></p>
								<?php /*<h5 class="mb-0">Login to your account</h5>
								<span class="d-block text-muted">Your credentials</span>*/?>
							</div>
							<hr />
							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="text" id="username" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>" autocomplete="off" />
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
                                <span class="badge badge-danger m-1"><?php echo form_error('username');?></span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<input type="password" id="password" name="password" class="form-control" placeholder="Password" required="" autocomplete="off" />
								<div class="form-control-feedback">
									<i class="icon-lock2 text-muted"></i>
								</div>
								<span class="badge badge-danger m-1"><?php echo form_error('password');?></span>
							</div>

							<div class="form-group form-group-feedback form-group-feedback-left">
								<p id="captImg"><?php echo $captchaImg; ?></p>
								<label class="small">Can't read the image? click <a href="javascript:void(0);" class="refreshCaptcha">here</a> to refresh.</label>
								<input type="hidden" id="base_url_captcha" value="<?= base_url('Login/refresh') ?>">
								<input required="" autocomplete="off" type="text" class="form-control" name="captcha" placeholder="Type the characters you see in image">
								<?= ($captcha_error ? "<lable class=\"small\"><p>You have mistyped the captcha.</p></lable>" : "") ?>
							</div>

							<div class="form-group">
								<input type="submit" name="submit" value="Sign in" id="submit" class="btn btn-primary btn-block"  />
							</div>

							<?php /*<div class="form-group d-flex align-items-center">
								<div class="form-check mb-0">
									<label class="form-check-label">
										<input type="checkbox" name="remember" class="form-input-styled" checked data-fouc>
										Remember
									</label>
								</div>

								<a href="login_password_recover.html" class="ml-auto">Forgot password?</a>
							</div>*/?>
						</div>
					</div>
				</form>
				<!-- /login card -->
			</div>
			<!-- /content area -->
		</div>
		<!-- /main content -->
	</div>
	<!-- /page content -->

	<!-- Core JS files -->
	<script src="<?php echo base_url('global_assets/js/main/jquery.min.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/main/bootstrap.bundle.min.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/plugins/loaders/blockui.min.js');?>"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="<?php echo base_url('global_assets/js/plugins/forms/styling/uniform.min.js');?>"></script>

	<script src="<?php echo base_url('assets/js/app.js');?>"></script>
	<script src="<?php echo base_url('global_assets/js/demo_pages/login.js');?>"></script>
	<!-- /theme JS files -->

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
