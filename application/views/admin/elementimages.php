
<!-- Timeline Widget -->
<div class="widget">
    <div class="widget-extra themed-background-dark">
        <h3 class="widget-content-light">
            <strong><?php echo $moduleName; ?></strong>
        </h3>
        <div class="widget-options">
			<div class="btn-group">
				<?php if (strpos($moduleAllowAction, 'MANAGE_GROUP') !== false) { ?>
				<a href="javascript:void(0);" id="openGroupModal" class="btn btn-danger">
					<i class="fa fa-list"></i> Nhập danh mục
				</a>
				<?php } ?>
				<?php if (strpos($moduleAllowAction, 'ADD') !== false) { ?>
				<a href="admin/manage/addimage-module-<?php echo $moduleID; ?>" class="btn btn-default">
					<i class="fa fa-plus"></i> Thêm mới
				</a>
				<?php } ?>
			</div>
		</div>
    </div>
    <div class="widget-extra" style="height: auto !important;">
        
        <div style="padding: 0 0;">
            <form action="admin/manage/elements-module-<?php echo $moduleID; ?>" accept-charset="UTF-8" method="get" >
            
            	<?php 
					$queryDuAn = $this->db->query("SELECT * FROM hd_groups where ID_MODULE ='".$moduleID."' ORDER BY SORT_INDEX");
					$dataCat = $queryDuAn->result();
					$currentURL = current_url();
					$currentURL = str_replace(base_url(), "", $currentURL);
					$paramsQrs   = $_SERVER['QUERY_STRING'];
					parse_str($paramsQrs, $get_array);
					unset($get_array["viewtype"]);
					$newParamQrs = http_build_query($get_array);
				?>
				<table class="table table-borderless middle-verticle" style="margin-bottom: 0; margin-top: 0;">
					<tr>
						<th style="width: 1%; display: none;">
                            <label>Kiểu xem</label>
                            <div class="input-group">
								<div class="input-group-btn">
									<a href="<?php echo $currentURL; echo ((count($get_array) > 0) ? "?".$newParamQrs."&" : "?")."viewtype=listview" ?>" class="btn btn-primary btn-lg">
										<i class="fa fa-list"></i>
									</a>
									<a href="<?php echo $currentURL; echo ((count($get_array) > 0) ? "?".$newParamQrs."&" : "?")."viewtype=gridview" ?>" class="btn btn-primary btn-lg">
										<i class="fa fa-th-large"></i>
									</a>
								</div>
							</div>
                            
                        </th>
						<?php if(count($dataCat) > 0){ ?>
						<th style="width: 300px;">
							<label>Danh mục xem</label>
							<select id="groupId" name="groupId" class="select-chosen" data-placeholder="Chọn danh mục..">
								
								<option value="">Xem tất cả</option>												
								<?php 
									foreach ($dataCat as $row)
									{
									?>													
										<option <?php if($this->input->get('groupId') == $row->ID_GR) echo 'selected'; ?> value="<?php echo $row->ID_GR; ?>"><?php echo $row->NAME_GR; ?></option>
									<?php 
									}
								?>
							</select>
						</th>
						<?php } ?>
						<th class="text-left text-nowrap" style="padding-left: 0;">
							<label>Tìm kiếm <?php echo $moduleName; ?></label>
							<div class="input-group">
								<input type="text" class="form-control form-control-lg" name="searchq" value="<?php echo $this->input->get('searchq'); ?>" placeholder="Nhập từ khoá tìm kiếm <?php echo $moduleName; ?>.." />
								<div class="input-group-btn">
									<button type="submit" class="btn btn-warning btn-lg">
										<i class="fa fa-search"></i><span class="hidden-xs hidden-sm" style="display: inline !important;">&nbsp;&nbsp;Tìm kiếm</span>
									</button>
									<a href="admin/manage/elements-module-<?php echo $moduleID; ?>" class="btn btn-primary btn-lg">
										<i class="fa fa-refresh"></i><span class="hidden-xs hidden-sm" style="display: inline !important;">&nbsp;&nbsp;Làm mới</span>
									</a>
								</div>
							</div>
						</th>
					</tr>
				</table>
            </form>
            
		    <?php  if(isset($contentModel) && count($contentModel) > 0) { ?>
           
           	<div style="margin-top: 20px;">
				<div class="row" data-toggle="lightbox-gallery" id="image-list">
				<?php 							
					foreach ($contentModel as $row)
					{
				?>
					<div class="col-sm-4 imgitemctn" id="<?php echo $row->ID; ?>" style="margin-bottom: 20px;">
						<div>

							<div style="margin-bottom: 3px; margin-top: 0; overflow: hidden;">
								<a href="javascript:void(0);" class="text-warning">
									<strong title="<?php echo $row->NAME_IMG; ?>" class="text-nowrap articlenameellipsis"><?php echo $row->NAME_IMG; ?></strong>
								</a>
							</div>
						</div>
						<a href="<?php echo $row->IMAGE_URL; ?>" class="gallery-link" title="<?php echo $row->NAME_IMG; ?>">							
							<div class="imgctnlb">
								<img src="thumbnail/img?imageurl=<?php echo default_value($row->IMAGE_URL, 'img/no-image.jpg'); ?>&width=400" 
									onerror="this.src = '/img/no-image.jpg'"
									alt="<?php echo $row->NAME_IMG; ?>" style="width: 100%;" />
							</div>
						</a>
						<div>
							<div style="padding: 5px 0 0;"><strong class="text-danger">Danh mục: <?php echo $row->NAME_GR != "" ? $row->NAME_GR : "[Chưa thiết lập]"; ?></strong></div>
							<strong><?php echo $row->USER_CREATED; ?></strong> đăng ngày <strong><em><?php echo $row->DATE_CREATED; ?></em></strong>
							<?php if(isset($row->USER_MODIFIED) && $row->USER_MODIFIED != "") { ?>
								<br/><strong><?php echo $row->USER_MODIFIED; ?></strong> cập nhật ngày <strong><em>
								<?php echo $row->DATE_MODIFIED; ?></em></strong>
							<?php } ?>
						</div>
						<div class="options-cnt">
							<?php if (strpos($moduleAllowAction, 'MODIFY') !== false) { ?>
							<a href="admin/manage/modifyimage-module-<?php echo $moduleID; ?>?id=<?php echo $row->ID; ?>" class="btn btn-info">
								<i class="fa fa-pencil"></i>
							</a>&nbsp;&nbsp;
							<?php } ?>
							<?php if (strpos($moduleAllowAction, 'DELETE') !== false) { ?>
							<a href="admin/manage/deleteimage-module-<?php echo $moduleID; ?>?id=<?php echo $row->ID; ?>" 
										  onClick="return confirm('Xác nhận xoá bản ghi này ?');" class="btn btn-danger">
								<i class="gi gi-bin"></i>
							</a>&nbsp;&nbsp;
							<?php } ?>
							<span>
								<label class="switch switch-success"  style="position: relative; top: 2px;">
									<input type="checkbox" class="VISIBLE_IMAGE_check" data-iditem="<?php echo $row->ID; ?>" <?php if($row->VISIBLE_IMG == "1") echo "checked" ?>><span></span>
								</label>
							</span>&nbsp;&nbsp;
							<span style="cursor: pointer;" class="image-list-move-order">
								<i class="hi fa-2x hi-move"></i>
							</span>
						</div>
						<div class="divcellsize"></div>
					</div>
				<?php
					}	
				?>
				</div>
			</div>
           
            <div>
                
				<div class="text-center">
					<?php 
						$config['base_url'] = 'admin/manage/elements-module-'.$moduleID.'';
						$config['total_rows'] = (int)$viewData['TOTAL_REC'];
						$config['per_page'] = 20;
						$config['full_tag_open'] = "<div class='pagination pagination-lg'>";
						$config['full_tag_close'] = '</div>';
						$config['cur_tag_open'] = "<a class='active' href='javascript:void(0)'>";
						$config['cur_tag_close'] = "</a>";
						$config['num_tag_open'] = "";
						$config['num_tag_close'] = "";
						$config['prev_link'] = "<i class='fa fa-chevron-left'></i>";
						$config['next_link'] = "<i class='fa fa-chevron-right'></i>";
						$config['first_link'] = "<i class='fa fa-arrow-left'></i>";
						$config['last_link'] = "<i class='fa fa-arrow-right'></i>";
						$config['page_query_string'] = true;
						$config['use_page_numbers'] = TRUE;
						$config['reuse_query_string'] = TRUE;
						$this->pagination->initialize($config);
						echo $this->pagination->create_links();
					?>
				</div>
            </div>
            <?php 				
				}
				else{
					?> 
						<div class="text-center no-data">
							<div><i class="fa fa-4x fa-frown-o"></i></div>
							<h4>Không có dữ liệu hiển thị</h4>
						</div>
					<?php
				}
			?>
        </div>
    </div>
</div>
<!-- END Timeline Widget -->
<?php
	$this->load->view("groupManage", 
	  array('groupManageModal' => array(
		"IdOpenGroup" => "openGroupModal",
		"KeyManage" => $moduleID,
		"Module" => $moduleID,
		"NameDisplayOfGroup" => $moduleName,
		"NameOfGroup" => $moduleID
	)));
?>

<style>
	#image-list {
		list-style-type: none;
		margin: 0;
		padding: 0;
	}

	#image-list li {
	}
</style>
<script>
	$(".VISIBLE_IMAGE_check").change(function () {
        var sender = $(this);
        var id = $(this).data("iditem");
        var visible = $(this).prop("checked");
        $.ajax({
            method: "POST",
            url: "admin/manage/tooglevisibleimage-module-<?php echo $moduleID; ?>", data: { "id": id, "visible": visible }, success: function (result) {
                if (result.success) {
                    $.bootstrapGrowl('<h4>SUCCESS!</h4> <p>Thao tác thực hiện thành công</p>', {
                        type: "success",
                        delay: 1000,
                        allow_dismiss: true,
                        offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
                        align: 'left', // ('left', 'right', or 'center')
                    });
                }
                else {
                    sender.prop("checked", !show);
                    var msg = result.msg || "Đã có lỗi xảy ra ! Vui lòng kiểm tra và thử lại";
                    $.bootstrapGrowl('<h4>ERROR!</h4> <p>' + msg + '</p>', {
                        type: "danger",
                        delay: 2500,
                        allow_dismiss: true,
                        offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
                        align: 'left', // ('left', 'right', or 'center')
                    });
                }
            }
        });
    });
	
	$('.articlenameellipsis').ellipsis({
        row: 1,
        onlyFullWords: false,
        position: 'tail'
    });
	var axis = 'x,y';
	var holder = null;
	setTimeout(function () {
		var heightset = $('#image-list li .divcellsize').first().height();
		$('#image-list li').each(function () {
			var cell = $(this);
			cell.css("width", cell.find(".divcellsize").width());
			cell.css("height", heightset);
		});
	}, 1000);
</script>


<script>

	$("#image-list").sortable({
		axis: axis,
		placeholder: holder,
		update: function (event, ui) {
			var data = $('#image-list').sortable("toArray");
			// POST to server using $.post or $.ajax
			$.ajax({
				data: { "items": data },
				type: 'POST',
				url: 'admin/manage/sortimage-module-<?php echo $moduleID; ?>',
				success: function (response) {
					if (!response.success) {
						$('#image-list').sortable("cancel");
						var msg = result.msg || "Đã có lỗi xảy ra ! Vui lòng kiểm tra và thử lại";
						$.bootstrapGrowl('<h4>ERROR!</h4> <p>' + msg + '</p>', {
							type: "danger",
							delay: 2500,
							allow_dismiss: true,
							offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
							align: 'left', // ('left', 'right', or 'center')
						});
					}
					else{
						$.bootstrapGrowl('<h4>SUCCESS!</h4> <p>Thao tác thực hiện thành công</p>', {
							type: "success",
							delay: 1000,
							allow_dismiss: true,
							offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
							align: 'left', // ('left', 'right', or 'center')
						});
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					$('#image-list').sortable("cancel");
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
		}
	});

	$("#image-list").disableSelection();
	$("#image-list").sortable("disable");

	$(".image-list-move-order").mousedown(function () {
		$("#image-list").sortable("enable");
	});

	$(".image-list-move-order").mouseup(function () {
		$("#image-list").sortable("disable");
	});

</script>

   
  