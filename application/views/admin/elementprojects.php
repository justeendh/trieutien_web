
<!-- Timeline Widget -->
<div class="widget">
    <div class="widget-extra themed-background-dark">
        <h3 class="widget-content-light">
            <strong><?php echo $moduleName; ?></strong>
        </h3>
        <div class="widget-options">
			<div class="btn-group">
				<?php if($moduleType != 0){ ?>
				<a href="javascript:void(0);" id="openGroupModal" class="btn btn-danger">
					<i class="fa fa-list"></i> Nhập danh mục
				</a>
				<?php } ?>
				<a href="admin/manage/addproject-module-<?php echo $moduleID; ?>" class="btn btn-default">
					<i class="fa fa-plus"></i> Thêm mới
				</a>
			</div>
		</div>
    </div>
    <div class="widget-extra" style="height: auto !important;">
        
        <div style="padding: 0 0;">
            <form action="admin/manage/elements-module-<?php echo $moduleID; ?>" accept-charset="UTF-8" method="get" >
            
            	<?php 
					$queryDuAn = $this->db->query("SELECT * FROM hd_groups where ID_MODULE ='".$moduleID."' AND LANGUAGE = '".$langQuery."' ORDER BY SORT_INDEX");
					$dataCat = $queryDuAn->result();
				?>
				<table class="table table-borderless middle-verticle" style="margin-bottom: 0; margin-top: 0;">
					<tr>
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
		    <?php if(isset($contentModel) && count($contentModel) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-borderless table-condensed table-striped table-hover text-center middle-verticle">
                    <thead class="tbhead-color">
                        <tr>
                           <?php if($moduleType == 0){ ?>
								<th class="text-center text-nowrap" style="width: 1%;">
									Sắp xếp
								</th>
							<?php } ?>
                            <th class="text-center text-nowrap" style="width: 1%;">
                                Hình ảnh
                            </th>
                            <th class="text-left">
                                Tên bài viết
                            </th>
                            <th class="text-center text-nowrap">
                                Phân loại
                            </th>                            
                            <th class="text-center text-nowrap" style="width: 1%;">
                                Ưu tiên
                            </th>
                            <th class="text-center text-nowrap" style="width: 1%;">
                                Cho phép
                            </th>
                            <th class="text-center text-nowrap" style="width: 1%;">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="article-list">                       
						<?php 							
							foreach ($contentModel as $row)
							{
						?>
								<tr id="<?php echo $row->ID_PRJ; ?>">
									<?php if($moduleType == 0){ ?>
										<td class="text-center text-nowrap" style="width: 1%;">
											<div style="cursor: pointer;" class="article-list-move-order">
												<i class="hi fa-2x hi-move"></i>
											</div>
											<div class="divcellsize"></div>
										</td>
									<?php } ?>
									<td style="width: 1%;">
										<a href="admin/manage/modifyproject-module-<?php echo $moduleID; ?>?id=<?php echo $row->ID_PRJ; ?>">
											<img src="thumbnail/img?imageurl=<?php echo default_value($row->IMAGE_PRJ, 'img/no-image.jpg'); ?>&width=100&height=100" 
												style="max-width: 100%; height: 50px;" />
										</a>
										<div class="divcellsize"></div>
									</td>
									<td class="text-left" style="padding: 8px;">
										<h4 style="margin-bottom: 0; margin-top: 0;">
											<a href="admin/manage/modifyproject-module-<?php echo $moduleID; ?>?id=<?php echo $row->ID_PRJ; ?>" class="text-warning">
												<strong><?php echo $row->NAME_PRJ; ?></strong>
											</a>
										</h4>
										<small><strong><?php echo $row->USER_CREATED; ?></strong> đăng ngày <strong><em><?php echo $row->DATE_CREATED; ?></em></strong>, 
										<?php if(isset($row->USER_MODIFIED) && $row->USER_MODIFIED != "") { ?>
											<br/><strong><?php echo $row->USER_MODIFIED; ?></strong> cập nhật ngày <strong><em>
											<?php echo $row->DATE_MODIFIED; ?></em></strong></small>
										<?php } ?>
										<div class="divcellsize"></div>
									</td>
									<td class="text-nowrap">
										<strong><?php echo $row->NAME_GR; ?></strong>
										<div class="divcellsize"></div>
									</td>
									<td class="text-nowrap">
										<fieldset class="rating">
											<input class="PRIORITY_ARTICLE_check" type="radio" id="star5<?php echo $row->ID_PRJ; ?>" name="rating" value="5" <?php if($row->PRIORITY == "5") echo "checked" ?>  data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class = "full" for="star5<?php echo $row->ID_PRJ; ?>" title="Awesome - 5 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" id="star4_5<?php echo $row->ID_PRJ; ?>" name="rating" value="4.5" <?php if($row->PRIORITY == "4.5") echo "checked" ?>  data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class="half" for="star4_5<?php echo $row->ID_PRJ; ?>" title="Pretty good - 4.5 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star4<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="4" <?php if($row->PRIORITY == "4") echo "checked" ?>  data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class = "full" for="star4<?php echo $row->ID_PRJ; ?>" title="Pretty good - 4 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star3_5<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="3.5" <?php if($row->PRIORITY == "3.5") echo "checked" ?>  data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class="half" for="star3_5<?php echo $row->ID_PRJ; ?>" title="Meh - 3.5 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star3<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="3" <?php if($row->PRIORITY == "3") echo "checked" ?>  data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class = "full" for="star3<?php echo $row->ID_PRJ; ?>" title="Meh - 3 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star2_5<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="2.5" <?php if($row->PRIORITY == "2.5") echo "checked" ?>  data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class="half" for="star2_5<?php echo $row->ID_PRJ; ?>" title="Kinda bad - 2.5 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star2<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="2" <?php if($row->PRIORITY == "2") echo "checked" ?>  data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class = "full" for="star2<?php echo $row->ID_PRJ; ?>" title="Kinda bad - 2 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star1_5<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="1.5" <?php if($row->PRIORITY == "1.5") echo "checked" ?> data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class="half" for="star1_5<?php echo $row->ID_PRJ; ?>" title="Meh - 1.5 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star1<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="1" <?php if($row->PRIORITY == "1") echo "checked" ?> data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class = "full" for="star1<?php echo $row->ID_PRJ; ?>" title="Sucks big time - 1 star"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star0_5<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="0.5" <?php if($row->PRIORITY == "0.5") echo "checked" ?> data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class="half" for="star0_5<?php echo $row->ID_PRJ; ?>" title="Sucks big time - 0.5 stars"></label>
											<input class="PRIORITY_ARTICLE_check" type="radio" type="radio" id="star0<?php echo $row->ID_PRJ; ?>" name="ratingstar<?php echo $row->ID_PRJ; ?>" value="0" <?php if($row->PRIORITY == "0") echo "checked" ?> data-iditem="<?php echo $row->ID_PRJ; ?>" /><label class="None" <?php if($row->PRIORITY > 0) echo "style=\"display: inline;\"" ?> id="star0<?php echo $row->ID_PRJ; ?>" for="star0<?php echo $row->ID_PRJ; ?>" title="None"><i style="font-size: 25px; display: inline-block; margin-top: 4px;margin-right: 5px;" class="text-danger fa fa-times"></i></label>
										
										</fieldset>
									</td>
									<td class="text-nowrap">
										<label class="switch switch-success">
											<input class="IS_SHOW_PRJ_check" type="checkbox" <?php if($row->VISIBLE_PRJ == "1") echo "checked" ?> data-iditem="<?php echo $row->ID_PRJ; ?>"><span></span>
										</label>
										<div class="divcellsize"></div>
									</td>
									<td class="text-nowrap">
										<a href="admin/manage/modifyproject-module-<?php echo $moduleID; ?>?id=<?php echo $row->ID_PRJ; ?>" class="btn btn-info">
											<i class="fa fa-pencil"></i>
										</a>
										<a href="admin/manage/deleteproject-module-<?php echo $moduleID; ?>?id=<?php echo $row->ID_PRJ; ?>" 
										  onClick="return confirm('Xác nhận xoá bản ghi này ?');"
										  class="btn btn-danger">
											<i class="gi gi-bin"></i>
										</a>
										<div class="divcellsize"></div>
									</td>
								</tr>
						<?php
							}	
						?>
                    </tbody>
                </table>
                
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
	#article-list td{
		position: relative;
	}
</style>

<script type="text/javascript">
	$(".IS_SHOW_PRJ_check").change(function () {
        var sender = $(this);
        var id = $(this).data("iditem");
        var visible = $(this).prop("checked");
        $.ajax({
            method: "POST",
            url: "admin/manage/tooglevisibleproject-module-<?php echo $moduleID; ?>", data: { "id": id, "visible": visible }, success: function (result) {
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
	
	$(".PRIORITY_ARTICLE_check").change(function () {
        var sender = $(this);
        var id = $(this).data("iditem");
        var priority = $(this).val();
        $.ajax({
            method: "POST",
            url: "admin/manage/tooglepriorityproject-module-<?php echo $moduleID; ?>", data: { "arid": id, "priority": priority }, success: function (result) {
                if (result.success) {
					if(parseInt(priority) === 0) $("label#star0" + id).hide();
					else {
						$("label#star0" + id).show();
					}
                    $.bootstrapGrowl('<h4>SUCCESS!</h4> <p>Thao tác thực hiện thành công</p>', {
                        type: "success",
                        delay: 1000,
                        allow_dismiss: true,
                        offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
                        align: 'left', // ('left', 'right', or 'center')
                    });
                }
                else {
                    sender.prop("checked", false);
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
</script>



<?php if($moduleType == 0){ ?>
    <script>
        setTimeout(function () {
            $('#article-list td').each(function () {
                var cell = $(this);
                cell.css("width", cell.find(".divcellsize").width());
            });
        }, 1000);

        $("#article-list").sortable({
            axis: 'y',
            placeholder: {
                element: function (currentItem) {
                    return $("<tr><td colspan='7' style='background-color: #fffbc6; height: 50px;'></td></tr>")[0];
                },
                update: function (container, p) {
                    return;
                }
            },
            update: function (event, ui) {
                var data = $('#article-list').sortable("toArray");
                // POST to server using $.post or $.ajax
                $.ajax({
                    data: { "items": data, "currentpage" : <?php echo ($this->input->get("per_page") != "") ? $this->input->get("per_page") : 1; ?> },
                    type: 'POST',
                    url: 'admin/manage/sortproject-module-<?php echo $moduleID; ?>',
                    success: function (response) {
                        if (!response.success) {
                            $('#article-list').sortable("cancel");
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
                        $('#article-list').sortable("cancel");
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

        $("#article-list").disableSelection();
        $("#article-list").sortable("disable");

        $(".article-list-move-order").mousedown(function () {
            $("#article-list").sortable("enable");
        });

        $(".article-list-move-order").mouseup(function () {
            $("#article-list").sortable("disable");
        });
        
    </script>
<?php } ?>