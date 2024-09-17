<div>
    <div class="validaterrormsg text-danger">
		<?php echo validation_errors(); ?>
	</div>
       
    <div class="row">
        <div class="col-md-12">
            <label class="control-label" for="NAME_GR">Tên danh mục/nhóm <?php echo $langQueryVal; ?> (<span class="text-danger">*</span>)</label>
            <div>
                <input type="hidden" name="langQuery" value="<?php echo get_cookie("admin-language"); ?>"/>
               <input type="hidden" name="ACTION" value="<?php echo $addGroupAction; ?>" />
               <input type="hidden" name="ID_GR" value="<?php echo $addGroupId; ?>" />
			   <input type="hidden" name="SORT_INDEX" value="<?php echo $addGroupSortIndex; ?>" />
               <input type="text" name="NAME_GR" value="<?php echo $addGroupName; ?>" class = "form-control form-control-lg" autocomplete="off" placeholder="Tên danh mục/nhóm.." />
               
            </div>
        </div>
    </div>
    <div>
        <label class="control-label" for="DESC_GR">Mô tả</label>
        <div>
           <textarea name="DESC_GR" class = "form-control form-control-lg" 
           	rows="3" autocomplete="off" placeholder="Mô tả danh mục/nhóm.."><?php echo $addGroupDesc; ?></textarea>
        </div>
    </div>
    <div style="margin-top: 10px;">
        <label class="control-label">Cho phép hiển thị</label>&nbsp;
        <label class="switch switch-success">
            <input type="checkbox" name="VISIBLE_GR" value="1" <?php if($addGroupVisibleGroup == "true") echo "checked"; ?>><span></span>
        </label>
    </div>
    <?php
    if ($addGroupAction == "ADD")
    {
	?>
        <div class="pull-left">
            <label class="switch switch-success">
                <input type="checkbox" name="GROUP_NEW_AFTER_SAVE" value="1" <?php if($addGroupNewAfterSave == "true") echo "checked"; ?>><span></span>
                
            </label>&nbsp;
            <label class="control-label">Thêm bản ghi mới sau khi lưu</label>
        </div>
    <?php } ?>
    <div class="text-right">
        <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-save"></i> Lưu lại</button>
        <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Đóng</button>
    </div>
</div>
