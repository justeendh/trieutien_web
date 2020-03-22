
<label style="cursor: pointer; position: relative; width: 100%;">                                    
    <a id="<?php echo $cropImageModal['ClearButtonID']; ?>" class="btn btn-danger" style="position: absolute; right: 5px; top: 5px; display: none;">
        <i class="fa fa-times"></i>
    </a>
    <img id="<?php echo $cropImageModal['TargetUpdate']; ?>" src="<?php echo $cropImageModal['NoImageUrl']; ?>" style="width: 100%;" 
    class="<?php echo $cropImageModal['ImageCssClass']; ?>"> 
    <input type="file" id="<?php echo $cropImageModal['FileInputID']; ?>" style="display: none;"  />
</label>               
<input type="hidden" id="<?php echo $cropImageModal['TargetInputUpdate']; ?>" name="<?php echo $cropImageModal['TargetInputUpdate']; ?>" 
value="<?php echo $cropImageModal['InitTargetInputUpdateVal']; ?>">

<!-- Modal -->

<input type="hidden" id="no_image_<?php echo $cropImageModal['JQModalSelector']; ?>" value="<?php echo $cropImageModal['NoImageUrl']; ?>"/>
<div id="curent_<?php echo $cropImageModal['JQModalSelector']; ?>_ctn">
    <div class="modal fade" id="<?php echo $cropImageModal['JQModalSelector']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">
                        <i class="fa fa-crop"></i> <?php echo $cropImageModal['NameCrop']; ?>
                    </h4>
                </div>
                <div class="modal-body" id="modalbody_<?php echo $cropImageModal['JQModalSelector']; ?>">
                    <!-- Wrap the image or canvas element with a block element (container) -->
                    <div>
                        <img id="<?php echo $cropImageModal['ImageID']; ?>" src="<?php echo $cropImageModal['CurrentImage']; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <div id="progressLoad_<?php echo $cropImageModal['JQModalSelector']; ?>" class="progress progress-striped active" 
                       style="display: none;">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">Loading..</div>
                    </div>
                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Huỷ bỏ</button>
                    <button type="button" id="btn_done_<?php echo $cropImageModal['JQModalSelector']; ?>" class="btn btn-success btn-lg">
                        <i class="fa fa-check"></i> Đồng ý
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->
</div>
<?php if ($cropImageModal['JQModalContainerSelector'] != "")
{
    echo "<script type=\"text/javascript\">";
    	echo "$(\"#".$cropImageModal['JQModalContainerSelector']."\").html($(\"#curent_".$cropImageModal['JQModalSelector']."_ctn\").html());";
    	echo "$(\"#curent_".$cropImageModal['JQModalSelector']."_ctn\").html('');";
    echo "</script>";
} ?>
<script type="text/javascript">

    var Image_<?php echo $cropImageModal['JQModalSelector']; ?> = null;
    $('#<?php echo $cropImageModal['TargetUpdate']; ?>').attr('src', "<?php echo $cropImageModal['CurrentImage']; ?>");
	if("<?php echo $cropImageModal['CurrentImage']; ?>" !== "" && "<?php echo $cropImageModal['NoImageUrl']; ?>" !== "<?php echo $cropImageModal['CurrentImage']; ?>"){		
        $("#<?php echo $cropImageModal['ClearButtonID']; ?>").show();
	}

    $("#<?php echo $cropImageModal['FileInputID']; ?>").on("click", function () {
        this.value = null;
    });

    $("#<?php echo $cropImageModal['ClearButtonID']; ?>").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
		if(confirm('Gỡ bỏ hình ảnh này ?')){			
			$('#<?php echo $cropImageModal['TargetUpdate']; ?>').attr('src', '<?php echo $cropImageModal['NoImageUrl']; ?>');
			$('#<?php echo $cropImageModal['TargetInputUpdate']; ?>').val('');
			$("#<?php echo $cropImageModal['ClearButtonID']; ?>").hide();
		}
    });

    $("#<?php echo $cropImageModal['FileInputID']; ?>").change(function () {
        var files = this.files, file;
        if (files && files.length) {
            file = files[0];
			
			if((file.size/1024)/1024 > 2){
				alert("Vui lòng tải lên file nhỏ hơn hoặc bằng 2Mb");
				return;
			}
			
            if (/^image\/\w+$/.test(file.type)) {
                blobURL = URL.createObjectURL(file);
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#<?php echo $cropImageModal['ImageID']; ?>').attr('src', e.target.result);
                    $('#<?php echo $cropImageModal['JQModalSelector']; ?>').modal({ backdrop: 'static', keyboard: false });
                }
                reader.readAsDataURL(file);
            } else {
                showMessage('Vui lòng chọn file hình ảnh.');
            }
        }
    });

    function SetCropModal_<?php echo $cropImageModal['JQModalSelector']; ?>()
    {
        $('#<?php echo $cropImageModal['ImageID']; ?>').cropper("destroy");
        $('#<?php echo $cropImageModal['ImageID']; ?>').cropper({
            viewMode: <?php echo $cropImageModal['ViewMode']; ?>,
            <?php if ($cropImageModal['aspectRatio'] == "true") { echo "aspectRatio: ".round((float)$cropImageModal['WidthImage'] / (float)$cropImageModal['HeightImage'], 1).","; } ?>
            minContainerWidth: $("#modalbody_<?php echo $cropImageModal['JQModalSelector']; ?>").width(),
			minContainerHeight: $("#modalbody_<?php echo $cropImageModal['JQModalSelector']; ?>").width()*0.5,
            responsive: true, movable: false,
            zoomable: false,
            rotatable: false,
            scalable: false,
            crop: function (e) {
                    // Output the result data for cropping image.
                }
            });
    }

    $('#<?php echo $cropImageModal['JQModalSelector']; ?>').on('shown.bs.modal', function (e) {
        SetCropModal_<?php echo $cropImageModal['JQModalSelector']; ?>();
    })

    $("#btn_done_<?php echo $cropImageModal['JQModalSelector']; ?>").on("click", function () {
        $("#progressLoad_<?php echo $cropImageModal['JQModalSelector']; ?>").show();
		var imageType = "<?php echo isset($cropImageModal['ImageTypeExport']) ? $cropImageModal['ImageTypeExport'] : ""; ?>" || "image/jpeg";
        var dataBase64 = $('#<?php echo $cropImageModal['ImageID']; ?>').cropper('getCroppedCanvas').toDataURL(imageType);
        $('#<?php echo $cropImageModal['TargetUpdate']; ?>').attr('src', dataBase64);
        $('#<?php echo $cropImageModal['TargetInputUpdate']; ?>').val(dataBase64);
        $('#<?php echo $cropImageModal['JQModalSelector']; ?>').modal("hide");
        $("#<?php echo $cropImageModal['ClearButtonID']; ?>").show();
        $("#progressLoad_<?php echo $cropImageModal['JQModalSelector']; ?>").hide();
    });

    $(window).resize(function () {

    });


    </script>