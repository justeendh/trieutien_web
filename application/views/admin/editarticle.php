
<form action="admin/manage/savearticle-module-<?php echo $contentModel->ID_MODULE; ?>" method="post" accept-charset="utf-8">
	<div class="row">
		<div class="col-lg-12">
			<!-- Timeline Widget -->
			<div class="widget">
				<div class="widget-extra themed-background-dark">
					<h3 class="widget-content-light">
						<strong><i class="fa fa-pencil"></i> 
						<?php 
							echo ($viewData['ACTION_EDIT']) ? 'CHỈNH SỬA ' : 'THÊM MỚI '; 
							echo $moduleName; 
						?></strong>
					</h3>
					<div class="widget-options">
						<?php if($viewData['ACTION_EDIT'] == "true") { ?>
							<a href="admin/manage/addarticle-module-<?php echo $contentModel->ID_MODULE; ?>" class="btn btn-default">
								<i class="fa fa-plus"></i> Thêm mới
							</a>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php } ?>
						<span style="color: #fafafa;">
							<strong>Hiển thị</strong>
							<label class="switch switch-warning">
								<input type="checkbox" id="VISIBLE_AR" name="VISIBLE_AR" value="1" 
									<?php if($contentModel->VISIBLE_AR == "1") echo "checked" ?>><span></span>
							</label>&nbsp;&nbsp;&nbsp;
						</span>
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
								<div class="col-xs-6 col-sm-3 col-md-3">
									<div style="margin-bottom: 10px;">
										<?php $this->load->view("cropimage", array('cropImageModal' => array(
											 "CurrentImage" => default_value($contentModel->IMAGE_AR, 'img/no-image.jpg'),
											"JQModalContainerSelector" => "",
											"FileInputID" => "file_article_avt_select", "TargetUpdate" => "avt_target_article", 
											"TargetInputUpdate" => "IMAGE_ARTICLE_UPLOAD", "InitTargetInputUpdateVal" => default_value($contentModel->IMAGE_AR, 'img/no-image.jpg'),
											"ImageID" => "imagearticleImage", "ImageCssClass" => "", "JQModalSelector" => "imagearticle", 
											"ViewMode" => 2, "NoImageUrl" => "img/no-image.jpg",
											"NameCrop" => "Cắt hình ảnh", "aspectRatio" => $moduleImageRatio, "HeightImage" => $moduleImageHeight, 
											"WidthImage" => $moduleImageWidth, 
											"ClearButtonID" => "btn_clearimage"
										))); ?>
									</div>
								</div>

								<div class="col-xs-12 col-sm-9 col-md-9">
									<div class="form-group">
										<label for="NAME_AR">Tên bài viết</label>
										<input type="hidden" name="langQuery" value="<?php echo $langQuery; ?>"/>
										<input type="hidden" name="ACTION_EDIT" value="<?php echo $viewData['ACTION_EDIT']; ?>"/>
										<input type="hidden" name="ID_AR" value="<?php echo $contentModel->ID_AR; ?>" />
										<input type="hidden" name="IMAGE_AR" value="<?php echo $contentModel->IMAGE_AR; ?>" />
										<input type="hidden" name="ID_MODULE" value="<?php echo $contentModel->ID_MODULE; ?>" />
										<input type="hidden" name="SORT_INDEX" value="<?php echo $contentModel->SORT_INDEX; ?>" />
										<input type="hidden" name="DATE_CREATED" value="<?php echo $contentModel->DATE_CREATED; ?>"/>
										<input type="hidden" name="USER_CREATED" value="<?php echo $contentModel->USER_CREATED; ?>"/>
										<input type="text" id="NAME_AR" name="NAME_AR" value="<?php echo $contentModel->NAME_AR; ?>" 
											class="form-control form-control-lg" placeholder="Tên bài viết..">
									</div>
									
									<?php if (strpos($moduleAllowAction, 'MANAGE_GROUP') !== false) { ?>
									<div class="row">
										<div class="col-sm-12">
											<div class="form-group">
												<label for="GROUP_ID">Danh mục/nhóm sản phẩm</label>
												<!-- Chosen plugin (class is initialized in js/app.js -> uiInit()), for extra usage examples you can check out http://harvesthq.github.io/chosen/ -->
												<select id="GROUP_ID" name="GROUP_ID" class="select-chosen" data-placeholder="Chọn danh mục..">
													<option value=""></option>													
													<?php 
														$queryDuAn = $this->db->query("SELECT * FROM hd_groups where ID_MODULE ='".($contentModel->ID_MODULE)."' ORDER BY SORT_INDEX");
														foreach ($queryDuAn->result() as $row)
														{
														?>													
															<option <?php if($contentModel->GROUP_ID == $row->ID_GR) echo 'selected'; ?> value="<?php echo $row->ID_GR; ?>"><?php echo $row->NAME_GR; ?></option>
														<?php  } ?>
												</select>
											</div>
										</div>
									</div>
									<?php  } ?>
									
									<div class="form-group">
										<label for="product-short-description">Mô tả ngắn sản phẩm</label>
										<textarea id="DESC_AR" name="DESC_AR" class="form-control form-control-lg" rows="4" style="resize: vertical"><?php echo $contentModel->DESC_AR; ?></textarea>
									</div>
								</div>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-lg btn-success"><i class="fa fa-floppy-o"></i> Save</button>
								<button type="reset" class="btn btn-lg btn-warning"><i class="fa fa-repeat"></i> Reset</button>
							</div>
							<?php if (strpos($moduleAllowAction, 'EDIT_CONTENT') !== false) { ?>
							<div class="form-group">
								<label for="product-description">Mô tả chi tiết sản phẩm</label>
								<textarea id="CONTENT_AR" name="CONTENT_AR" class="ckeditor">
									<?php echo $contentModel->CONTENT_AR; ?>
								</textarea>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-lg btn-success"><i class="fa fa-floppy-o"></i> Save</button>
								<button type="reset" class="btn btn-lg btn-warning"><i class="fa fa-repeat"></i> Reset</button>
							</div>
							<?php  } ?>
						<!-- END General Data Content -->
					</div>
				</div>
			</div>
			<!-- END Timeline Widget -->
		</div>
		<div class="col-lg-4" style="display: none;">
			<!-- Timeline Widget -->
			<div class="widget">
				<div class="widget-extra themed-background-dark">
					<h3 class="widget-content-light">
						<strong><i class="fa fa-code"></i> Lịch sử chỉnh sửa</strong>
					</h3>
				</div>
				<div class="widget-extra" style="height: auto !important;">
					<div style="padding: 10px 0;">
						
						<div class="form-group">
							<button type="submit"  class="btn btn-lg btn-success"><i class="fa fa-floppy-o"></i> LƯU LẠI</button>
							<button type="reset" class="btn btn-lg btn-warning"><i class="fa fa-repeat"></i> NHẬP LẠI</button>
						</div>
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
	CKEDITOR.replace('CONTENT_AR', { height: 600 });
	<?php if($viewData['ACTION_EDIT'] == "false"){ ?>
	window.history.pushState("", "Administrators Trieu Tien Portal", "admin/manage/addarticle-module-<?php echo $contentModel->ID_MODULE; ?>");
	<?php } ?>
</script>
