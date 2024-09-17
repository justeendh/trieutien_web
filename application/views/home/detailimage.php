<style>
	.gallery > .row > div {
		margin-bottom: 30px;
	}
</style>

<section  class="content-section">
	<div class="newsitem-block">
		<div class="container pos-relative">
			<h2 class="block-title text-secondary-font"><?php echo $moduleName; ?></h2>
			<div style="padding-bottom: 15px;">
				<h2 class="text-primary-font" style="color: #fa4747; margin-bottom: 0;"><?php echo $queryImageModel->NAME_IMG; ?></h2>
				
			</div>				
			<div style="margin-bottom: 15px;">
				<?php 
					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
					$full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				?>
				<div class="fb-like" data-href="<?php echo $full_url; ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			</div>
			<?php  if(isset($queryImageListModel) && count($queryImageListModel) > 0) { ?>
			<div class="gallery" data-toggle="lightbox-gallery">
				<div class="row">
					<?php foreach($queryImageListModel as $row) { ?>
					<div class="col-sm-6 col-md-4">
						<a href="<?php echo $row->IMAGE_URL ?>" class="gallery-link" title="<?php echo $queryImageModel->NAME_IMG; ?>">
							<div  style="border: 2px solid #eeeeee; padding: 8px; background-color: #fafafa;">
								<div class="imgsamesize-article">
									<img src="thumbnail/img?imageurl=<?php echo default_value($row->IMAGE_URL, 'img/no-image.jpg'); ?>&width=500" title="<?php echo $queryImageModel->NAME_IMG; ?>" 
										alt="<?php echo $queryImageModel->NAME_IMG; ?>">
								</div>
							</div>
						</a>
					</div>
					<?php } ?>
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
			<!-- END Lightbox Gallery Content -->
		</div>
	</div>

</section>