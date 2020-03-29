<?php
    defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );
    
    if(get_cookie("admin-language") == "En-US") { require 'lang-en.php'; }
    else { require 'lang-vi.php'; }
    $langQuery = get_cookie("admin-language"); 
?>


<!DOCTYPE html>

<html>
<head>    
   	<base href="<?=base_url()?>"/>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrators Trieu Tien Portal</title>
    <meta name="description" content="Triều Tiến">
    <meta name="author" content="Triều Tiến">
    <meta name="robots" content="noindex, nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <!-- Stylesheets -->
    <!-- Bootstrap is included in its original form, unaltered -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Related styles of various icon packs and plugins -->
    <link rel="stylesheet" href="css/plugins.css">
    <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
    <link rel="stylesheet" href="css/main.css">
    <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
    <link rel="stylesheet" href="css/themes.css">
    <link rel="stylesheet" href="css/cropper.css">
    <link rel="stylesheet" href="css/lightbox.min.css">
    <!-- END Stylesheets -->
    <!-- Modernizr (browser feature detection library) -->
    <link rel="stylesheet" href="css/bootstrap-dialog.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>


    <!-- jQuery, Bootstrap.js, jQuery plugins and Custom JS code -->
    <script src="js/jquery-1.10.2.js"></script>
    <script src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/bootstrap-dialog.min.js"></script>
    
    <script src="js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="js/jquery.tmpl.js"></script>
    <script type="text/javascript" src="js/ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="js/ckfinder/ckfinder.js"></script>
    <script type="text/javascript" src="js/plugins.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    
    
    <script src="js/dropzone.js"></script>
    <script src="js/jquery.ellipsis.min.js"></script>
    <script src="js/lightbox.min.js"></script>
    <script src="js/jquery.number.min.js"></script>
    <script type="text/javascript" src="js/cropper.js"></script>

    
    <script src="js/ModuleViewJs.js"></script>
</head>
<body>
    <div id="page-wrapper">
        <div id="page-container" class="sidebar-partial sidebar-visible-lg sidebar-no-animations">
            <!-- Alternative Sidebar -->
            <div id="sidebar-alt">
                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-alt-scroll">
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Alternative Sidebar -->

            <!-- Main Sidebar -->
            <div id="sidebar">
                <!-- Wrapper for scrolling functionality -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <div class="sidebar-content">
                        <!-- Brand -->
                        <a href="admin" class="sidebar-brand">
                            <span class="sidebar-nav-mini-hide"><strong class="text-nowrap"><?php echo $language_dict['cmsTrieuTien']; ?></strong></span>
                        </a>
                        <!-- END Brand -->

                        <!-- User Info -->
                        <div class="sidebar-section sidebar-user clearfix sidebar-nav-mini-hide">
                            <div class="sidebar-user-avatar">
                                <a href="admin"> <img src="img/no-user-image.png" alt="avatar">
                          </a>

                      </div>

						  <div class="sidebar-user-name text-nowrap" style="overflow: hidden;">
							   <div><?php echo $this->session->fullname; ?></div>
						   </div>
                            <div class="sidebar-user-links">
                           		&nbsp;&nbsp;
                            	<a href="javascript:void(0)" title="Thay đổi mật khẩu" 
                            		onclick="$('#modal-user-settings').modal('show');" data-original-title="Settings">
                            		<i class="fa fa-key"></i>
								</a>&nbsp;
                                <a href="javascript:void(0);" onClick="logoutConfirm();"
                                	title="Đăng xuất"><i class="gi gi-exit"></i>
								</a>
                            </div>
                        </div>
                        <!-- END User Info -->


                        <!-- Sidebar Navigation -->
                        <ul class="sidebar-nav">
                            
                            <li>
                                <a href="admin">
                                    <i class="gi gi-home sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Dashboard</span>
                                </a>
                            </li>
                            <?php if($this->session->isadmin == true) { ?>
                            <li>
                                <a href="admin/manage/listuser-module-user.html">
                                    <i class="gi gi-user sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Quản lý người dùng</span>
                                </a>
                            </li>
                            <?php 
								}
							?> 
                            <li class="sidebar-header">
                                <span class="sidebar-header-title">Quản trị nội dung</span>
                            </li>
                            <?php 
								$query = $this->db->query("SELECT * FROM hd_modules ORDER BY SORT_INDEX ASC");
								foreach ($query->result() as $row)
								{
								?>
									<li>
                                        <a href="admin/manage/elements-module-<?php echo $row->ID_MODULE; ?>.html">
                                            <i class="fa fa-list sidebar-nav-icon"></i>
                                            <span class="sidebar-nav-mini-hide">
                                                <?php 
                                                    if(get_cookie("admin-language") == "En-US") echo $row->En_US; 
                                                    else echo $row->Vi_VN; 
                                                ?>
                                            </span>
                                        </a>
                                    </li>
								<?php 
								}
							?> 
                            
                            <li class="sidebar-header">
                                <span class="sidebar-header-title">Khác</span>
                            </li>
                            <li>
                                <a href="admin/manage/infomations-module-info.html">
                                    <i class="fa fa-envelope-o sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Thông tin chung</span>
                                </a>
                            </li>
                            <li>
                                <a href="admin/manage/customcontact-module-contact.html">
                                    <i class="fa fa-envelope-o sidebar-nav-icon"></i>
                                    <span class="sidebar-nav-mini-hide">Liên hệ/góp ý</span>
                                </a>
                            </li>
                        </ul>
                        <!-- END Sidebar Navigation -->

                        
                        <!-- END Sidebar Notifications -->
                    </div>
                    <!-- END Sidebar Content -->
                </div>
                <!-- END Wrapper for scrolling functionality -->
            </div>
            <!-- END Main Sidebar -->

            <!-- Main Container -->
            <div id="main-container">
                <header class="navbar navbar-default">
                    <!-- Left Header Navigation -->
                    <ul class="nav navbar-nav-custom">
                        <!-- Main Sidebar Toggle Button -->
                        <li>
                            <a href="javascript:void(0)" onclick="App.sidebar('toggle-sidebar');this.blur();">
                                <i class="fa fa-bars fa-fw"></i>
                            </a>
                        </li>
                        <!-- END Main Sidebar Toggle Button -->
                    </ul>
                    <!-- END Left Header Navigation -->

                    <!-- Search Form -->
                    <div class="navbar-form-custom">
                        
                    </div>
                    <!-- END Search Form -->

                    <!-- Right Header Navigation -->
                    <ul class="nav navbar-nav-custom pull-right">
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <strong style="font-size: 2rem;"><?php echo get_cookie("admin-language") == "Vi-VN" ? "Tiếng Việt" : "Tiếng Anh" ?></strong>
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right" style="left: auto; right: 0;">
                                <li>
                                    <a href="admin/change-laguage/Vi-VN">
                                        Tiếng Việt
                                    </a>
                                </li>
                                <li>
                                    <a href="admin/change-laguage/En-US">
                                        Tiếng Anh
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!-- User Dropdown -->
                        <li class="dropdown">
                            <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="img/no-user-image.png" alt="avatar">
                            </a>
                            <ul class="dropdown-menu dropdown-custom dropdown-menu-right" style="left: auto; right: 0;">
                                <li class="dropdown-header text-center">Tài khoản</li>
                                
                                <li>
                                    <a href="javascript:void(0);" onClick="logoutConfirm();"><i class="fa fa-ban fa-fw pull-right"></i> Đăng xuất</a>
                                </li>
                            </ul>
                        </li>
                        <!-- END User Dropdown -->
                    </ul>
                    <!-- END Right Header Navigation -->
                </header>
                <!-- END Header -->

                <!-- Page content -->
                <div id="page-content">
                    
                    <?php 
						$contentData = array();
						if(isset($viewData)) $contentData["viewData"] = $viewData;
						if(isset($contentModel)) $contentData["contentModel"] = $contentModel;
						$this->load->view($content, $contentData); 
					?>
                </div>
                <!-- END Page Content -->

                <!-- Footer -->
                <footer class="clearfix">
                    <div class="pull-right">
                        Developed with <i class="fa fa-heart text-danger"></i> by <a href="javascript:void(0);" target="_blank">Duy Hoàng</a>
                    </div>
                </footer>
                <!-- END Footer -->
            </div>
            <!-- END Main Container -->
        </div>
        <!-- END Page Container -->
    </div>
    <!-- END Page Wrapper -->

    <!-- Scroll to top link, initialized in js/app.js - scrollToTop() -->
    <a href="#" id="to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
    <div id="modal-user-settings" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header text-center">
                    <h2 class="modal-title"><i class="fa fa-key"></i> Thay đổi mật khẩu</h2>
                </div>
                <!-- END Modal Header -->

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="container-fluid">
                    	<form action="admin/manage/changepassworduser-module-user.html" method="post" class="form-horizontal form-bordered">
                        
							<fieldset>
								<div class="form-group">
									<label for="NEW_PASSWORD_CURRENT_USER">Mật khẩu mới</label>
									<input type="password" id="NEW_PASSWORD_CURRENT_USER" name="NEW_PASSWORD_CURRENT_USER" 
										class="form-control form-control-lg" placeholder="Mật khẩu mới..">
								</div>
							</fieldset>
							<div class="form-group form-actions">
								<div class="col-xs-12 text-right">
									<button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Đóng</button>
									<button type="submit" class="btn btn-lg btn-primary"  onClick="return confirm('Xác nhận xoá bản ghi này ?');" >Lưu lại</button>
								</div>
							</div>
						</form>
                    </div>
                </div>
                <!-- END Modal Body -->
            </div>
        </div>
    </div>
    
    
   
	<script>
		var logoutConfirm = function(){
			BootstrapDialog.confirm({
				title: "Xác nhận đăng xuất",
				message: "Bạn muốn đăng xuất hệ thống ?",
				type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
				closable: true, // <-- Default value is false
				draggable: true, // <-- Default value is false
				btnCancelLabel: "Không", // <-- Default value is 'Cancel',
				btnOKLabel: "Đồng ý", // <-- Default value is 'OK',
				btnOKClass: 'btn-success', // <-- If you didn't specify it, dialog type will be used,
				callback: function (result) {
					// result will be true if button was click, while it will be false if functions close the dialog directly.
					if (result) {
						window.location = "admin/manage/logout-module-userlogout.html";
					} else {
						//alert('Nope.');
					}
				}
			});
		}
	</script>
    
    <style>
		
		.validaterrormsg{
			font-weight: bold;
		}

		.validaterrormsg p{
			margin: 0px 0 5px;
			background: #f00;
			color: #fff;
			padding: 5px 10px;
		}
		
		.validaterrormsg p:last-child{
			margin-bottom: 15px;
		}

		.validaterrormsg p:before{
			content: "\f040";
			display: inline-block;
			margin-right: 6px;
			font: normal normal normal 14px/1 FontAwesome;
		}
	</style>
    <!-- END User Settings -->
    <script>
		function executeFunctionByName(functionName, context , args ) {
			  var args = Array.prototype.slice.call(arguments, 2);
			  var namespaces = functionName.split(".");
			  var func = namespaces.pop();
			  for(var i = 0; i < namespaces.length; i++) {
				context = context[namespaces[i]];
			  }
			  return context[func].apply(context, args);
		}

        $(function () {
			
			$('body').on('submit', '.formAjaxSubmit', function (e) {
			//$('form#feedInput').submit(function(e) {

				var form = $(this);

				e.preventDefault();
				var urlAction = form.attr("action");
				var methodSubmit = form.attr("method");
				var targetUpdateId = form.attr("targetUpdateId") || "";
				var OnSuccessFunction = form.attr("OnSuccess") || "";
				var msgconfirm = form.attr("confirm") || "";
				
				if(msgconfirm !== ""){
					if(!confirm(msgconfirm)){
						return;
					}
				}
				
				$.ajax({
					type: methodSubmit,
					url: urlAction,
					data: form.serialize(), // <--- THIS IS THE CHANGE
					dataType: "html",
					success: function(data){
						$('#' + targetUpdateId).html(data);
						executeFunctionByName(OnSuccessFunction, window, data);
					},
					error: function(ex) { 
						var msg = result.msg || "Đã có lỗi xảy ra ! Vui lòng kiểm tra và thử lại";
						$.bootstrapGrowl('<h4>ERROR!</h4> <p>' + msg + '</p>', {
							type: "danger",
							delay: 2500,
							allow_dismiss: true,
							offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
							align: 'left', // ('left', 'right', or 'center')
						});
					}
			   });

			});

            // Initialize Tooltips
            $('[data-toggle="tooltip"]').tooltip({ container: 'body', animation: true });
            setTimeout(function () {
                $('[data-toggle="tooltip"]').tooltip({ container: 'body', animation: true });
            }, 1000);
        });

        $('input[type="file"]').change(function (e) {
            var targetFileNameDisplay = $(this).data("filenamedisplay");
            var inputfilename = $(this).data("inputfilename");
            var btnDelete = $(this).data("buttondelete");
            var btnPick = $(this).data("buttonpick");
            var fileName = e.target.files[0].name;
            $("#" + inputfilename).val(fileName);
            $("#" + targetFileNameDisplay).text(fileName);
            $("#" + btnDelete).show();
            $("#" + btnPick).hide();
            $("#" + targetFileNameDisplay).ellipsis({
                row: 1,
                onlyFullWords: false,
                position: 'middle'
            });
        });

        $(".btnDeleteAttach").click(function () {
            if (confirm("Bạn chắc chắn xoá mục này?")) {
                var targetFileNameDisplay = $(this).data("filenamedisplay");
                var fileInput = $(this).data("fileinput");
                var clearInput = $(this).data("clearinput");
                var btnPick = $(this).data("buttonpick");
                var btnDelete = $(this).data("buttondelete");
                $("#" + targetFileNameDisplay).text("Chọn file..");
                $(this).hide();
                $("#" + btnPick).show();
                $("#" + fileInput).val('');
                $(clearInput).val('');
            }
        });

        $('.number').number(true, 0);
        $('.number1').number(true, 1);
        $('.number2').number(true, 2);
		
        
    </script>
</body>
</html>
