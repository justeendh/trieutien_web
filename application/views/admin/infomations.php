
<form action="admin/manage/saveinfomations-module-info.html" method="post">
    <div class="row">
        <div class="col-sm-12">
            <!-- Timeline Widget -->
            <div class="widget">
                <div class="widget-extra themed-background-dark">
                    <h3 class="widget-content-light">
                        <strong>
                            THÔNG TIN TRANG WEB
                        </strong>
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
                        <!-- General Data Content -->
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
                       
                        <div>
                        <?php if (isset($contentModel) && count($contentModel) > 0)
                        {
                            foreach ($contentModel as $itemInfo)
                            {
								if($itemInfo->TYPE_INFO == 1 && $itemInfo->VISIBLE_EDIT == 1) {
						?>
                                <div>
									<div class="form-group">
										<label for="<?php echo $itemInfo->KEY_INFO; ?>"><?php echo $itemInfo->NAME_INFO; ?></label>
										<input type="text" class="form-control form-control-lg"  autocomplete = "off" id="<?php echo $itemInfo->KEY_INFO; ?>"
										 name="<?php echo $itemInfo->KEY_INFO; ?>" placeholder="<?php echo $itemInfo->NAME_INFO; ?>" value="<?php echo $itemInfo->VAL_INFO; ?>" />
									</div>
								</div>                                
                          <?php
								}
								else if($itemInfo->TYPE_INFO == 3 && $itemInfo->VISIBLE_EDIT == 1){
									?>
										<div>
											<div class="form-group">
												<label for="<?php echo $itemInfo->KEY_INFO; ?>"><?php echo $itemInfo->NAME_INFO; ?></label>
												<textarea id="<?php echo $itemInfo->KEY_INFO; ?>" name="<?php echo $itemInfo->KEY_INFO; ?>" class="ckeditor"><?php echo $itemInfo->VAL_INFO; ?></textarea>
											</div>
										</div> 
										<script>
											CKEDITOR.replace('<?php echo $itemInfo->KEY_INFO; ?>', { 
												extraPlugins : 'videoembed,video',
												toolbar: [
													 { name: 'insert', items : ['VideoEmbed', 'Video'] }
												]
											});
										</script>
									 <?php
								}
								else if ($itemInfo->TYPE_INFO == 4 && $itemInfo->VISIBLE_EDIT == 1){
									?>

										<div style="padding: 1em 0;">
											<h3><strong>Nhập liên kết <?php echo $itemInfo->NAME_INFO; ?></strong></h3>
											<div class="form-group">
												<div class="input-group">
													<div class="input-group-addon">&nbsp;&nbsp;<i class="fa fa-link"></i>&nbsp;&nbsp;</div>
													<input class="form-control" id="<?php echo $itemInfo->KEY_INFO; ?>" placeholder="https://link-to-file/download"
														style="font-size: 18px;" name="<?php echo $itemInfo->KEY_INFO; ?>" value="<?php echo $itemInfo->VAL_INFO; ?>"/>
													<div class="input-group-btn">
														<button type="button" class="btn btn-lg btn-primary" id="<?php echo $itemInfo->KEY_INFO; ?>Input"
															style="padding: 1rem 3rem !important;">
															<i class="fa fa-link"></i> Browse
														</button>
													</div>
												</div>	
											</div>	 
										</div>

										<script>
											function selectFileWithCKFinder( elementId ) {
												CKFinder.popup( {
													chooseFiles: true,
													width: 800,
													height: 600,
													onInit: function( finder ) {
														finder.on( 'files:choose', function( evt ) {
															var file = evt.data.files.first();
															var output = document.getElementById( elementId );
															output.value = file.getUrl();
														} );

														finder.on( 'file:choose:resizedImage', function( evt ) {
															var output = document.getElementById( elementId );
															output.value = evt.data.resizedUrl;
														} );
													}
												} );
											}
											$(function(){

												$('#<?php echo $itemInfo->KEY_INFO; ?>Input').click(() =>{
													selectFileWithCKFinder( '<?php echo $itemInfo->KEY_INFO; ?>' );
												});
											});
										</script>
									<?php

									
								}
								else{
									if($itemInfo->VISIBLE_EDIT == 1){
									 ?>
										<div>
											<div class="form-group">
												<label for="<?php echo $itemInfo->KEY_INFO; ?>"><?php echo $itemInfo->NAME_INFO; ?></label>
												<textarea id="<?php echo $itemInfo->KEY_INFO; ?>" name="<?php echo $itemInfo->KEY_INFO; ?>" class="ckeditor"><?php echo $itemInfo->VAL_INFO; ?></textarea>
											</div>
										</div> 
										<script>
											CKEDITOR.replace('<?php echo $itemInfo->KEY_INFO; ?>', { 
												toolbar: [

												]
											});
										</script>
									 <?php
									}
								}
							}
						}
						?>
                            
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-lg btn-success"><i class="fa fa-floppy-o"></i> LƯU LẠI</button>
                            <button type="reset" class="btn btn-lg btn-warning"><i class="fa fa-repeat"></i> NHẬP LẠI</button>
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
	window.history.pushState("", "Cập nhật thông tin chung", 'admin/manage/infomations-module-info.html');
</script>