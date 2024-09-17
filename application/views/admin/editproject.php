
<form action="admin/manage/saveproject-module-<?php echo $contentModel->ID_MODULE; ?>" method="post" accept-charset="utf-8">
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
							<a href="admin/manage/addproject-module-<?php echo $contentModel->ID_MODULE; ?>" class="btn btn-default">
								<i class="fa fa-plus"></i> Thêm mới
							</a>&nbsp;&nbsp;&nbsp;&nbsp;
						<?php } ?>
						<span style="color: #fafafa;">
							<strong>Hiển thị</strong>
							<label class="switch switch-warning">
								<input type="checkbox" id="VISIBLE_PRJ" name="VISIBLE_PRJ" value="1" 
									<?php if($contentModel->VISIBLE_PRJ == "1") echo "checked" ?>><span></span>
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
								<div class="col-xs-12 col-sm-3 col-md-3">
									<div style="margin-bottom: 10px;">
										<?php $this->load->view("cropimage", array('cropImageModal' => array(
											 "CurrentImage" => default_value($contentModel->IMAGE_PRJ, 'img/no-image.jpg'),
											"JQModalContainerSelector" => "",
											"FileInputID" => "file_article_avt_select", "TargetUpdate" => "avt_target_article", 
											"TargetInputUpdate" => "IMAGE_ARTICLE_UPLOAD", "InitTargetInputUpdateVal" => default_value($contentModel->IMAGE_PRJ, 'img/no-image.jpg'),
											"ImageID" => "imagearticleImage", "ImageCssClass" => "", "JQModalSelector" => "imagearticle", 
											"ViewMode" => 2, "NoImageUrl" => "img/no-image.jpg",
											"NameCrop" => "Cắt hình ảnh", "aspectRatio" => $moduleImageRatio, "HeightImage" => $moduleImageHeight, 
											"WidthImage" => $moduleImageWidth, 
											"ClearButtonID" => "btn_clearimage"
										))); ?>
									</div>
									
									<a class="btn btn-block btn-danger hidden-xs" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
										<label for="DESC_PRJ">Click để chỉnh sửa mô tả</label>
									</a>
								</div>

								<div class="col-xs-12 col-sm-9 col-md-9">
									
									
									
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label for="NAME_PRJ">Tên sản phẩm/dự án</label>
												<input type="hidden" name="langQuery" value="<?php echo $langQuery; ?>"/>
												<input type="hidden" name="ACTION_EDIT" value="<?php echo $viewData['ACTION_EDIT']; ?>"/>
												<input type="hidden" name="ID_PRJ" value="<?php echo $contentModel->ID_PRJ; ?>" />
												<input type="hidden" name="IMAGE_PRJ" value="<?php echo $contentModel->IMAGE_PRJ; ?>" />
												<input type="hidden" name="ID_MODULE" value="<?php echo $contentModel->ID_MODULE; ?>" />
												<input type="hidden" name="DATE_CREATED" value="<?php echo $contentModel->DATE_CREATED; ?>"/>
												<input type="hidden" name="USER_CREATED" value="<?php echo $contentModel->USER_CREATED; ?>"/>
												<input type="text" id="NAME_PRJ" name="NAME_PRJ" value="<?php echo $contentModel->NAME_PRJ; ?>" 
													class="form-control form-control-lg" placeholder="Tên sản phẩm/dự án..">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label for="GROUP_ID">Danh mục sản phẩm/dự án</label>
												<!-- Chosen plugin (class is initialized in js/app.js -> uiInit()), for extra usage examples you can check out http://harvesthq.github.io/chosen/ -->
												<select id="GROUP_ID" name="GROUP_ID" class="select-chosen" data-placeholder="Chọn danh mục..">
													<option value=""></option>													
													<?php 
														$queryDuAn = $this->db->query("SELECT * FROM hd_groups where ID_MODULE ='".($contentModel->ID_MODULE)."' ORDER BY SORT_INDEX");
														foreach ($queryDuAn->result() as $row)
														{
														?>													
															<option <?php if($contentModel->GROUP_ID == $row->ID_GR) echo 'selected'; ?> value="<?php echo $row->ID_GR; ?>"><?php echo $row->NAME_GR; ?></option>
														<?php 
														}
													?>
												</select>
											</div>
										</div>
										<div class="clearfix"></div>
										<div class="col-sm-12">
											<div class="form-group">
												<label for="HOST_PRJ">Chủ đầu tư</label>
												<input type="text" id="HOST_PRJ" name="HOST_PRJ" value="<?php echo $contentModel->HOST_PRJ; ?>" 
													class="form-control form-control-lg" placeholder="Chủ đầu tư..">
											</div>
										</div>
										
										<div class="col-sm-8 col-md-9">
											<div class="form-group">
												<label for="LOCATION_PRJ">Địa điểm thi công</label>
												<input type="text" id="LOCATION_PRJ" name="LOCATION_PRJ" value="<?php echo $contentModel->LOCATION_PRJ; ?>" 
													class="form-control form-control-lg" placeholder="Địa điểm thi công..">
											</div>
										</div>
										<div class="col-sm-4 col-md-3">
											<div class="form-group">
												<label for="YEAR_PRJ">Thời gian khởi công</label>
												<input type="text" id="YEAR_PRJ" name="YEAR_PRJ" value="<?php echo ($contentModel->YEAR_PRJ); ?>" 
													class="form-control form-control-lg" placeholder="Thời gian khởi công..">
											</div>
										</div>
									</div>

								</div>
							</div>

						
							<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
							  <div class="panel panel-default" style="border: none;">
								<a class="btn btn-block btn-danger hidden-sm hidden-md hidden-lg" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
									<label for="DESC_PRJ">Click để chỉnh sửa mô tả</label>
								</a>
								<div id="collapseOne" class="panel-collapse collapse <?php if($contentModel->DESC_PRJ != "") echo "in"; ?>" role="tabpanel" aria-labelledby="headingOne">
								  <div class="panel-body" style="padding: 10px 0 0; border: none;">										
										<div class="form-group">
											<textarea id="DESC_PRJ" name="DESC_PRJ" class="ckeditor" rows="6" style="resize: vertical">
												<?php echo $contentModel->DESC_PRJ; ?>
											</textarea>
										</div>
								  </div>
								</div>
							  </div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-lg btn-success"><i class="fa fa-floppy-o"></i> Save</button>
								<button type="reset" class="btn btn-lg btn-warning"><i class="fa fa-repeat"></i> Reset</button>
							</div>
							<input type="hidden" name="CONTENT_PRJ" value="" />
							
							
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

<?php if($viewData['ACTION_EDIT'] == "true") { ?>
<div>
	<!-- Timeline Widget -->
	<div class="widget">
		<div class="widget-extra themed-background-dark">
			<h3 class="widget-content-light">
				<strong><i class="fa fa-image"></i> Hình ảnh chi tiết</strong>
			</h3>
		</div>
		<div class="widget-extra" style="height: auto !important;">
			<div style="padding: 10px 0;">
				<div style="margin-bottom: 20px;">
					<div id="myAwesomeADropzone" class="dropzone">
						<form action="" method="post" enctype="multipart/form-data">
						  <div class="fallback">
							<input name="fileDetailImage" type="file" multiple />
						  </div>
						</form>
					</div>
				</div>
				<div class="gallery" data-toggle="lightbox-gallery">
					<div class="container-fluid">
						<div class="row">
							<?php 
								$queryGetImageItem = $this->db->query("SELECT * FROM hd_images WHERE ID_MODULE = '".$contentModel->ID_MODULE."_ref_".$contentModel->ID_PRJ."' AND REF_ID = ".$contentModel->ID_PRJ);
								foreach($queryGetImageItem->result() as $rowImageDetail)
								{
							?>
							<div class="col-sm-3 col-xs-6 gallery-image">
								<div class="image-border">
									<div class="imgctnlb">
										<img src="thumbnail/img?imageurl=<?php echo default_value($rowImageDetail->IMAGE_URL, 'img/no-image.jpg'); ?>&width=500" 
										alt="<?php echo $contentModel->NAME_PRJ; ?>">							
									</div>
									<div class="gallery-image-options text-center">
										<div class="btn-group btn-group-sm">
											<a href="<?php echo $rowImageDetail->IMAGE_URL; ?>"
											 class="gallery-link btn btn-sm btn-success" title="<?php echo $contentModel->NAME_PRJ; ?>">Xem hình</a>
											<a href="admin/manage/deleteimageprjdetail-module-<?php echo $moduleID; ?>?id=<?php echo $rowImageDetail->ID; ?>&refid=<?php echo $contentModel->ID_PRJ; ?>" 
												  onClick="return confirm('Xác nhận xoá bản ghi này ?');" class="btn btn-sm btn-danger">
												<i class="fa fa-times"></i>
											</a>
										</div>
									</div>
								</div>
							</div>
							<?php } ?>
						</div>
					</div>
				</div>
				<!-- END Lightbox Gallery Content -->
			</div>
		</div>
	</div>

	<!-- END Timeline Widget -->
</div>
<?php } ?>

<script>
	$("div#myAwesomeADropzone").dropzone(
	{ 
		url: "admin/manage/dropzoneupload-module-<?php echo $contentModel->ID_MODULE; ?>?id=<?php echo $contentModel->ID_PRJ; ?>",
		addRemoveLinks: false,
		acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
		maxFilesize: 2,
		queuecomplete : function(){
			window.location = "admin/manage/modifyproject-module-<?php echo $contentModel->ID_MODULE; ?>?id=<?php echo $contentModel->ID_PRJ; ?>";
		}
	});
	
	Dropzone.autoDiscover = false;
	
    CKEDITOR.replace('DESC_PRJ', { 
		toolbar: [
			
		]
	});
	<?php if($viewData['ACTION_EDIT'] == "false"){ ?>
	window.history.pushState("", "Administrators Trieu Tien Portal", "admin/manage/addproject-module-<?php echo $contentModel->ID_MODULE; ?>");
	<?php } ?>
</script>


<style>
	.gallery-image{
		margin-bottom: 20px;
	}
	.gallery-image .image-border {
		border: 2px solid #efefef;
		padding: 5px;
	}
</style>
