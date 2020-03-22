
<script>
    var instanceGroup_<?php echo $groupManageModal['KeyManage']; ?> = new ModuleViewJs();
    instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.Init({
        ModuleName: "group",
        ActionUrl: "admin/manage/listgroups-module-<?php echo $groupManageModal['Module']; ?>.html",
        targetUpdateInsert: "groups-data-container_<?php echo $groupManageModal['KeyManage']; ?>",
        targetInsertForm: "formAddGroup_<?php echo $groupManageModal['KeyManage']; ?>",
        inserFormUrl: "admin/manage/creategroup-module-<?php echo $groupManageModal['Module']; ?>.html",
		deleteUrl : "admin/manage/deletegroup-module-<?php echo $groupManageModal['Module']; ?>.html"
    });
    instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.setModule('<?php echo $groupManageModal['Module']; ?>');
    instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.setPageSize(10);
</script>


<!-- END Timeline Widget -->
<!-- Modal -->
<div class="modal fade" id="modal-manager-group-<?php echo $groupManageModal['Module']; ?>" 
   tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="text-transform: uppercase;">
                	DANH MỤC NHÓM <?php echo $groupManageModal['NameDisplayOfGroup']; ?>
				</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="padding: 10px 0;">
                    <div class="form-group">
                        <a href="javascript:void(0);" class="btn btn-success btn-lg" onclick="instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.LoadInsert('#addModifyGroup-<?php echo $groupManageModal['Module']; ?>')">
                            <i class="fa fa-plus"></i> Thêm mới
                        </a>
                        <a href="javascript:void(0);" class="btn btn-warning btn-lg" onclick="instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.LoadDataInit()">
                            <i class="fa fa-refresh"></i> Làm mới danh sách
                        </a>
                    </div>
                    <div class="table-responsive" id="groups-data-container_<?php echo $groupManageModal['KeyManage']; ?>">                
                        
                    </div>
                </div>
                <hr />
                <div class="text-right">
                    <button type="button" class="btn btn-danger  btn-lg" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addModifyGroup-<?php echo $groupManageModal['Module']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle" style="text-transform: uppercase;">THÊM MỚI/CHỈNH SỬA DANH MỤC NHÓM <?php echo $groupManageModal['NameDisplayOfGroup']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                
				<form class="formAjaxSubmit" action="admin/manage/savegroup-module-<?php echo $groupManageModal['Module']; ?>.html" method="post"
					targetUpdateId="formAddGroup_<?php echo $groupManageModal['KeyManage']; ?>" confirm="Bạn chắc chắn thực hiện thao tác này ?"
					OnSuccess="instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.OnSuccessInsert">
					<input type="hidden" name="ID_MODULE" value="<?php echo $groupManageModal['Module']; ?>" />
					<div id="formAddGroup_<?php echo $groupManageModal['KeyManage']; ?>">
						<?php 
							$dataAddGroup = array(
								"addGroupAction" => "ADD", 
							  	"addGroupId" => "",
								"addGroupName" => "",
								"addGroupDesc" => "",
								"addGroupSortIndex" => "",
								"addGroupVisibleGroup" => "true",
								"addGroupNewAfterSave" => "true"
							);
							$this->load->view("addGroup", $dataAddGroup); 
						?>
					</div>
				</form>
            </div>
        </div>
    </div>
</div>


<script>
    $("#<?php echo $groupManageModal['IdOpenGroup']; ?>").click(function () {
        instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.LoadDataInit();
        $("#modal-manager-group-<?php echo $groupManageModal['Module']; ?>").modal({ backdrop: 'static', keyboard: false });
    });

    $("#pageSizeGroup-<?php echo $groupManageModal['Module']; ?>").change(function () {
        instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.setPageSize(parseInt($(this).val()));
        instanceGroup_<?php echo $groupManageModal['KeyManage']; ?>.LoadDataInit();
    });
</script>