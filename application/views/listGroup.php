<?php 

if (isset($ListGroupModel) && count($ListGroupModel) > 0)
{
?>
    <table  class="table table-bordered table-condensed text-center middle-verticle">
        <thead class="tbhead-color">
            <tr>
                <th class="text-center text-nowrap" style="width: 1%;">
                    Sắp xếp
                </th>
                <th class="text-left text-nowrap">
                    Tên nhóm/danh mục
                </th>
                <th class="text-center text-nowrap" style="width: 1%;">
                    Hiển thị
                </th>
                <th class="text-center text-nowrap" style="width: 1%;">
                    Action
                </th>
            </tr>
        </thead>
        <tbody id="sortable-<?php echo $moduleListGroup; ?>" >
        <?php
            foreach ($ListGroupModel as $groupRow)
            {
		?>
                <tr style="background-color: #fff;" id="<?php echo $groupRow->ID_GR; ?>">
                   
                    <td class="text-nowrap" style="position: relative;">
                        <div style="cursor: pointer;" class="move-order-<?php echo $moduleListGroup; ?>">
                            <i class="hi fa-2x hi-move"></i>
                        </div>
                        <div class="divcellsize"></div>
                    </td>
                    <td class="text-nowrap text-left" style="position: relative;">
                        <strong><?php echo $groupRow->NAME_GR; ?></strong>
                        <p style="margin: 0;"><?php echo $groupRow->DESC_GR; ?></p>
                        <div class="divcellsize"></div>
                    </td>
                    <td class="text-nowrap" style="position: relative;">
                      	<label class="switch switch-success">
							<input class="IS_SHOW_GROUP_<?php echo $moduleListGroup; ?>_check" type="checkbox" <?php if($groupRow->VISIBLE_GR == "1") echo "checked" ?> data-iditem="<?php echo $groupRow->ID_GR; ?>"><span></span>
						</label>
						<div class="divcellsize"></div>
                    </td>
                    <td class="text-nowrap" style="position: relative;">
                        <a href="javascript:void(0);" class="btn btn-info" onclick="instanceGroup_<?php echo $moduleListGroup; ?>.LoadUpdate('#addModifyGroup-<?php echo $moduleListGroup; ?>', <?php echo $groupRow->ID_GR; ?>)">
                            <i class="fa fa-pencil"></i>
                        </a>
                        <a href="javascript:void(0);" onclick="instanceGroup_<?php echo $moduleListGroup; ?>.Delete(<?php echo $groupRow->ID_GR; ?>);" class="btn btn-danger">
                            <i class="gi gi-bin"></i>
                        </a>
                        <div class="divcellsize"></div>
                    </td>
                </tr>
        <?php } ?>
        </tbody>
    </table>
<?php    
	}
	else
	{
 ?>
    <div class="text-center no-data">
        <div><i class="fa fa-4x fa-frown-o"></i></div>
        <h4>Không có dữ liệu hiển thị</h4>
    </div>
<?php } ?>


    

    <script>

		$(".IS_SHOW_GROUP_<?php echo $moduleListGroup; ?>_check").change(function () {
			var sender = $(this);
			var id = $(this).data("iditem");
			var visible = $(this).prop("checked");
			$.ajax({
				method: "POST",
				url: "admin/manage/tooglevisiblegroup-module-<?php echo $moduleListGroup; ?>", data: { "groupId": id, "visible": visible }, success: function (result) {
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

        $(function () {

            setTimeout(function () {
                $('#sortable-<?php echo $moduleListGroup; ?> td').each(function () {
                    var cell = $(this);
                    cell.css("width", cell.find(".divcellsize").width());
                });
            }, 1000);

            $("#sortable-<?php echo $moduleListGroup; ?>").sortable({
                axis: 'y',
                placeholder: {
                    element: function (currentItem) {
                        return $("<tr><td colspan='5' style='background-color: #fffbc6; height: 50px;'></td></tr>")[0];
                    },
                    update: function (container, p) {
                        return;
                    }
                },
                update: function (event, ui) {
                    var data = $('#sortable-<?php echo $moduleListGroup; ?>').sortable("toArray");
                    var currentPage = instanceGroup_<?php echo $moduleListGroup; ?>.CurrentPage;
                    var pageSize = instanceGroup_<?php echo $moduleListGroup; ?>.CurrentPageSize;
                    // POST to server using $.post or $.ajax
                    $.ajax({
                        data: {
                            "items": data
                        },
                        type: 'POST',
                        url: 'admin/manage/sortgroup-module-<?php echo $moduleListGroup; ?>',
                        success: function (response) {
                            if (!response.success) {
                                $('#sortable-<?php echo $moduleListGroup; ?>').sortable("cancel");
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
                            $('#sortable-<?php echo $moduleListGroup; ?>').sortable("cancel");
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

            $("#sortable-<?php echo $moduleListGroup; ?>").disableSelection();
            $("#sortable-<?php echo $moduleListGroup; ?>").sortable("disable");

            $(".move-order-<?php echo $moduleListGroup; ?>").mousedown(function () {
                $("#sortable-<?php echo $moduleListGroup; ?>").sortable("enable");
            });

            $(".move-order-<?php echo $moduleListGroup; ?>").mouseup(function () {
                $("#sortable-<?php echo $moduleListGroup; ?>").sortable("disable");
            });


        });
    </script>

