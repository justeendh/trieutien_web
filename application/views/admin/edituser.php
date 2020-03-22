
<form action="admin/manage/saveuser-module-user.html" method="post" accept-charset="utf-8">
	<div class="row">
		<div class="col-lg-12">
			<!-- Timeline Widget -->
			<div class="widget">
				<div class="widget-extra themed-background-dark">
					<h3 class="widget-content-light">
						<strong><i class="fa fa-pencil"></i> 
						<?php 
							echo ($viewData['ACTION_EDIT']) ? 'CHỈNH SỬA ' : 'THÊM MỚI '; 
							echo "NGƯỜI DÙNG"; 
						?></strong>
					</h3>
					<div class="widget-options">
						<div class="btn-group">
							<button type="submit" class="btn btn-default"><i class="fa fa-floppy-o"></i> Save</button>
							<button type="reset" class="btn btn-danger"><i class="fa fa-repeat"></i> Reset</button>
						</div>
					</div>
				</div>
				<div class="widget-extra" style="height: auto !important;">
					<div style="padding: 10px 0;">
						<div class="validaterrormsg text-danger">
							<?php echo validation_errors(); ?>
						</div>
						<?php


						if (isset($viewData["Success"]))
						{
							?>
							<div class="alert alert-success alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="fa fa-check-circle"></i> Thành công</h4>
								<div>
									<?php echo $viewData["Success"]; ?>
								</div>
							</div>
							<?php
						}

						if (isset($viewData["Failed"]))
						{
						?>
							<div class="alert alert-danger alert-dismissable">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4><i class="fa fa-check-circle"></i> Lỗi</h4>
								<div>
									<?php echo $viewData["Failed"]; ?>
								</div>
							</div>
						<?php
						}
						?>
						<!-- General Data Content -->
							<div class="row">
								
								<div class="col-xs-12 col-sm-9 col-md-9">
									<div class="form-group">
										<label for="FULL_NAME">Tên người dùng</label>
										<input type="hidden" name="ACTION_EDIT" value="<?php echo $viewData['ACTION_EDIT']; ?>"/>
										<input type="hidden" name="LAST_LOGIN" value="<?php echo $contentModel->LAST_LOGIN; ?>"/>
										<input type="hidden" name="IS_ADMIN" value="<?php echo $contentModel->IS_ADMIN; ?>"/>
										<input type="text" id="FULL_NAME" name="FULL_NAME" value="<?php echo $contentModel->FULL_NAME; ?>" 
											class="form-control form-control-lg" placeholder="Tên người dùng..">
									</div>
									<?php if($viewData['ACTION_EDIT'] == "false"){ ?>
									<div class="form-group">
										<label for="USERNAME">Tên đăng nhập</label>
										<input type="text" id="USERNAME" name="USERNAME" value="<?php echo $contentModel->USERNAME; ?>" 
											class="form-control form-control-lg" placeholder="Tên đăng nhập..">
									</div>
									<?php } else { ?>
										<input type="hidden" name="USERNAME" value="<?php echo $contentModel->USERNAME; ?>"/>
									<?php }?>
									<div class="form-group">
										<label for="NEW_PASSWORD">Mật khẩu đăng nhập mới <?php if($viewData['ACTION_EDIT'] != "false"){ ?> (để trống nếu không muốn đổi)<?php }?></label>
										<input type="password" id="NEW_PASSWORD" name="NEW_PASSWORD" value="" 
											class="form-control form-control-lg" placeholder="Mật khẩu mới..">
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-lg btn-success"><i class="fa fa-floppy-o"></i> Save</button>
								<button type="reset" class="btn btn-lg btn-warning"><i class="fa fa-repeat"></i> Reset</button>
							</div>
						<!-- END General Data Content -->
					</div>
				</div>
			</div>
			<!-- END Timeline Widget -->
		</div>
	</div>

</form>

<script>
	/*
	CKEDITOR.replace('DESC_AR', { 
		toolbar: [
			
		]
	}); */
	<?php if($viewData['ACTION_EDIT'] == "false"){ ?>
	window.history.pushState("", "Administrators Trieu Tien Portal", "admin/manage/adduser-module-user.html");
	<?php } ?>
</script>
