
<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
       	<base href="<?=base_url()?>"/>
    	<meta charset="utf-8" />
		
        <title>Triều Tiến Administrator login</title>

        <meta name="description" content="Triều Tiến Administrator login">
        <meta name="author" content="Had Duy">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
        
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="css/bootstrap.min.css">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="css/plugins.css">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="css/main.css">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="css/themes.css">
        <!-- END Stylesheets -->

        <!-- Modernizr (browser feature detection library) -->
        <script src="js/vendor/modernizr.min.js"></script>
    </head>
    <body style="background-color: #3b3b3b;">
       <div id="clouds">
			<div class="cloud x1"></div>
			<!-- Time for multiple clouds to dance around -->
			<div class="cloud x2"></div>
			<div class="cloud x4"></div>
			<div class="cloud x5"></div>
			<div class="cloud x3"></div>
			<div class="cloud x4"></div>
			<div class="cloud x5"></div>
		</div>
        <!-- Login Full Background -->
        <!-- For best results use an image with a resolution of 1280x1280 pixels (prefer a blurred image for smaller file size) -->
        <img src="img/placeholders/backgrounds/login_full_bg.jpg" alt="Login Full Background" class="full-bg animation-pulseSlow">
        <!-- END Login Full Background -->

        <!-- Login Container -->
        <div id="login-container" class="animation-fadeIn">
            <!-- Login Title -->
            <div class="login-title ">
            <table style="width: 100%;">
            	<tr>
            		<td>
            			<img src="img/logo.jpg" class="logo" style="height: 80px;">
            		</td>
            		<td>
            			
						<h1><strong>TRIỀU TIẾN PORTAL</strong><br>
						<small>Vui lòng đăng nhập hệ thống</small></h1>
						
            		</td>
            	</tr>
            </table>
            </div>
            <!-- END Login Title -->

            <!-- Login Block -->
            <div class="block push-bit">
                <!-- Login Form -->
                

                <form action="admin/manage/loginuser-module-user" 
                      method="post" id="form-login" class="form-horizontal form-bordered form-control-borderless">
                    <?php if (isset($viewData["Failed"])) { ?>
						<div class="container-fluid" style="margin-bottom: 0; margin-top: 10px; padding-left: 20px; padding-right: 20px;">
							<div class="alert alert-danger alert-dismissable" style="margin-bottom: 0;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<div>
									<?php echo $viewData["Failed"]; ?>
								</div>
							</div>
						</div>
					<?php } ?>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-user"></i></span>
                                <input type="text" name="username" class="form-control input-lg" placeholder="Tên đăng nhập">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="gi gi-asterisk"></i></span>
                                <input type="password" name="password" class="form-control input-lg" 
                                	placeholder="Mật khẩu" autocomplete="new-password">
                            </div>
                        </div>
                    </div>
                    <div class="form-group form-actions">
                        
                        <div class="col-xs-12 text-right">
                            <button type="submit" class="btn btn-block btn-primary btn-lg"><i class="fa fa-key"></i> &nbsp;&nbsp;Đăng nhập hệ thống</button>
                        </div>
                    </div>
                </form>
                <!-- END Login Form -->
            </div>
            <!-- END Login Block -->
        </div>
        <!-- END Login Container -->
        <style>
            #login-container .login-title {
                padding: 20px 10px;
                background: #c33131;
            }

            .input-group-addon {
                background-color: #a4a4a4;
                border-width: 2px;
                border-color: #a4a4a4;
                color: #fff;
                padding: 13px 5px !important;
            }

            .btn-info:hover, .btn-info:hover, .btn-info:active:hover, .btn-info, .btn-info, .btn-info:hover, .btn-info:active:hover, .btn-info:focus, .btn-info.focus, .btn-info:active, .btn-info:active:hover, .btn-info:active:focus, .btn-info.active, .btn-info.active:hover, .btn-info.active:focus, .open .btn-info.dropdown-toggle, .open .btn-info.dropdown-toggle:hover, .open .btn-info.dropdown-toggle:focus, .open .btn-info.dropdown-toggle.focus, .btn-primary, .btn-primary:hover, .btn-primary:active:hover, .btn-primary:focus, .btn-primary.focus, .btn-primary:active, .btn-primary:active:hover, .btn-primary:active:focus, .btn-primary.active, .btn-primary.active:hover, .btn-primary.active:focus, .open .btn-primary.dropdown-toggle, .open .btn-primary.dropdown-toggle:hover, .open .btn-primary.dropdown-toggle:focus, .open .btn-primary.dropdown-toggle.focus, .btn-success, .btn-success:hover, .btn-success:active:hover, .btn-success:focus, .btn-success.focus, .btn-success:active, .btn-success:active:hover, .btn-success:active:focus, .btn-success.active, .btn-success.active:hover, .btn-success.active:focus, .open .btn-success.dropdown-toggle, .open .btn-success.dropdown-toggle:hover, .open .btn-success.dropdown-toggle:focus, .open .btn-success.dropdown-toggle.focus
            {
                background-color: #c33131;
                border-color: #c33131;
                color: #ffffff;
            }
			
			.input-group .form-control {
				padding: 22px 8px;
				background-color: #eaeaea;
				font-size: 14px;
				font-weight: bold;
				color: #808080;
			}
			
			@media (max-width: 767px){
				#login-container, #login-alt-container {
					position: absolute;
					width: 90%;
					top: 25px;
					left: 50%;
					margin-left: -45%;
					z-index: 1000;
				}
				
				#login-container .login-title h1, #login-alt-container h1 {
					font-size: 20px;
					color: #ffffff;
				}
			}
			
			body {
				/*To hide the horizontal scroller appearing during the animation*/
				overflow: hidden;
			}

			#clouds{
				padding: 100px 0;
			}

			/*Time to finalise the cloud shape*/
			.cloud {
				width: 200px; height: 60px;
				background: #858585;

				border-radius: 200px;
				-moz-border-radius: 200px;
				-webkit-border-radius: 200px;

				position: relative; 
			}

			.cloud:before, .cloud:after {
				content: '';
				position: absolute; 
				background: #858585;
				width: 100px; height: 80px;
				position: absolute; top: -15px; left: 10px;

				border-radius: 100px;
				-moz-border-radius: 100px;
				-webkit-border-radius: 100px;

				-webkit-transform: rotate(30deg);
				transform: rotate(30deg);
				-moz-transform: rotate(30deg);
			}

			.cloud:after {
				width: 120px; height: 120px;
				top: -55px; left: auto; right: 15px;
			}

			/*Time to animate*/
			.x1 {
				-webkit-animation: moveclouds 35s linear infinite;
				-moz-animation: moveclouds 35s linear infinite;
				-o-animation: moveclouds 35s linear infinite;
			}

			/*variable speed, opacity, and position of clouds for realistic effect*/
			.x2 {
				left: 200px;

				-webkit-transform: scale(0.6);
				-moz-transform: scale(0.6);
				transform: scale(0.6);
				opacity: 0.6; /*opacity proportional to the size*/

				/*Speed will also be proportional to the size and opacity*/
				/*More the speed. Less the time in 's' = seconds*/
				-webkit-animation: moveclouds 80s linear infinite;
				-moz-animation: moveclouds 80s linear infinite;
				-o-animation: moveclouds 80s linear infinite;
				
				-webkit-animation-delay: 2s;
				-moz-animation-delay: 2s;
				-o-animation-delay: 2s;
			}

			.x3 {
				left: -250px; top: -200px;

				-webkit-transform: scale(0.8);
				-moz-transform: scale(0.8);
				transform: scale(0.8);
				opacity: 0.8; /*opacity proportional to the size*/

				-webkit-animation: moveclouds 60s linear infinite;
				-moz-animation: moveclouds 60s linear infinite;
				-o-animation: moveclouds 60s linear infinite;
			}

			.x4 {
				left: 470px; top: -250px;

				-webkit-transform: scale(0.75);
				-moz-transform: scale(0.75);
				transform: scale(0.75);
				opacity: 0.75; /*opacity proportional to the size*/

				-webkit-animation: moveclouds 78s linear infinite;
				-moz-animation: moveclouds 78s linear infinite;
				-o-animation: moveclouds 78s linear infinite;
			}

			.x5 {
				left: -150px; top: -150px;

				-webkit-transform: scale(0.8);
				-moz-transform: scale(0.8);
				transform: scale(0.8);
				opacity: 0.8; /*opacity proportional to the size*/

				-webkit-animation: moveclouds 90s linear infinite;
				-moz-animation: moveclouds 90s linear infinite;
				-o-animation: moveclouds 90s linear infinite;
			}

			@-webkit-keyframes moveclouds {
				0% {margin-left: 1000px;}
				100% {margin-left: -1000px;}
			}
			@-moz-keyframes moveclouds {
				0% {margin-left: 1000px;}
				100% {margin-left: -1000px;}
			}
			@-o-keyframes moveclouds {
				0% {margin-left: 1000px;}
				100% {margin-left: -1000px;}
			}
        </style>

        <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
        <script src="js/vendor/jquery.min.js"></script>
        <script src="js/vendor/bootstrap.min.js"></script>
        <script src="js/plugins.js"></script>
        <script src="js/app.js"></script>
        <script>
			
			function getPathFromUrl() {
			  return window.location.href.split(/[?#]/)[0];
			}
			window.history.pushState("", "Triều Tiến Administrator login", "admin/manage/login-module-user");
			

		</script>
		<?php  if($this->input->get("changepasswordsuccess") != ""){ ?>
		<script>
			$.bootstrapGrowl('<h4>SUCCESS!</h4> <p>Thao tác đổi mật khẩu thực hiện thành công</p>', {
				type: "success",
				delay: 1000,
				allow_dismiss: true,
				offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
				align: 'left', // ('left', 'right', or 'center')
			});
		</script>
		<?php } ?>
    </body>
</html>