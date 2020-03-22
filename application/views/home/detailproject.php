<link rel="stylesheet" href="css/jquery.bxslider.css">
<script type="text/javascript" src="js/jquery.bxslider.min.js"></script>

<style>
	.newsitem-block .list-news-block .construc-item .project-info-wrap .mota_project ul li {
		font-size: 13px;
	}
	
	.newsitem-block .list-news-block .construc-item .project-info-wrap .mota_project ul li i {
		top: 3px;
	}
	
	.construc-item{
		margin-bottom: 20px;
	}
	
	.article-introtext ul{
		list-style: none;
		list-style-position: inside;
		font-size: 20px;
		line-height: 33px;
    	color: #525252;
	}
	
	.article-introtext ul li > i{
		display: inline-block;
		margin-right: 15px;
		color: #c12f32;
	}
	
	.gallery{
		margin-top: 30px;
	}
	
	.gallery > .row > div {
		margin-bottom: 30px;
	}
	
	.bx-wrapper img {
		width: 100%;
	}
</style>


<section  class="content-section" style="margin-bottom: 0;">
	<div class="newsitem-block">
		<div class="container pos-relative">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-6">
					<h2 class="block-title text-secondary-font"><?php echo $modelProject->NAME_PRJ ?></h2>
			
					<div style="margin-top: 10px; margin-bottom: 10px;">
						<?php 
							$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
							$full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
						?>
						<div class="fb-like" data-href="<?php echo $full_url; ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
					</div>
					<div class="article-introtext text-primary-font">
						<ul class="ul-info">
							<li><i class="fa fa-hand-o-right"></i><span>Chủ đầu tư: <?php echo $modelProject->HOST_PRJ; ?> <br></span></li>
							<li><i class="fa fa-hand-o-right"></i><span>Địa điểm: <?php echo $modelProject->LOCATION_PRJ; ?></span></li>
							<li><i class="fa fa-hand-o-right"></i><span>Thời Gian thi công: <?php echo $modelProject->YEAR_PRJ; ?></span></li>

						</ul>
					</div>
					<div class="" style="margin-top: 15px; font-size: 14px; line-height: 24px;">
						<?php echo $modelProject->DESC_PRJ; ?>
					</div>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-6">					
					<div style="margin-top: 20px;">
					<?php  if(isset($queryImageListModel) && count($queryImageListModel) > 0) { ?>
						
						<div class="bxslider">
					  		<?php foreach($queryImageListModel as $row) { ?>
						  	<div><img src="<?php echo default_value($row->IMAGE_URL, 'img/no-image.jpg'); ?>" alt="<?php echo $modelProject->NAME_PRJ; ?>"></div>
						  	<?php } ?>
						</div>
						<script>
							$('.bxslider').bxSlider({
								auto: true, pause: 5000,
							  	autoControls: true,
							  	stopAutoOnClick: true,
								nextText : "<i class='fa fa-angle-right'></i>", prevText : "<i class='fa fa-angle-left'></i>",
								pager: false,
								adaptiveHeight : true
							});
						</script>
						<?php 				
							}
							else{
								?> 
									<div class="text-center no-data">
										<div><i class="fa fa-4x fa-frown-o"></i></div>
										<h4>Không có hình ảnh nào. Chúng tôi sẽ cập nhật sớm nhất !</h4>
									</div>
								<?php
							}
						?>
					</div>
				</div>
				
				<!-- END Lightbox Gallery Content -->
			</div>
		</div>
	</div>

</section>

<?php 
	$queryProjectsSame = $this->db->query("SELECT * FROM hd_projects 
					WHERE ID_MODULE ='duan' AND GROUP_ID = ".$modelProject->GROUP_ID." AND ID_PRJ != ".$modelProject->ID_PRJ
				  ." AND VISIBLE_PRJ = 1 ORDER BY PRIORITY DESC, DATE_MODIFIED DESC, DATE_CREATED DESC LIMIT 4 ");
	if( $queryProjectsSame->num_rows() > 0){
?>
<section style="margin-bottom: 50px;">
	<div class="newsitem-block"  style="margin-top: 10px;">
		<div class="container pos-relative">
			<h2 class="block-title text-secondary-font">DỰ ÁN KHÁC CÙNG LOẠI</h2>
			<div class="list-news-block row">
				<?php  foreach ($queryProjectsSame->result() as $rowPrj) { ?>
				<div class="col-xs-12 col-sm-6 col-md-3 construc-item">
					<a class="image-link" href="detail-project/du-an/<?php echo friendlyName($rowPrj->NAME_PRJ); ?>-viewpost-<?php echo $rowPrj->ID_PRJ ?>.html"
							title="<?php echo $rowPrj->NAME_PRJ ?>">
						<img class="img-c-two2" src="<?php echo $rowPrj->IMAGE_PRJ ?>" alt="<?php echo $rowPrj->NAME_PRJ ?>">
						<div class="fdw-background2">
							<div class="detail-btn">Xem chi tiết</div>
						</div>
					</a>				
					<div class="project-info-wrap">
						<a href="detail-project/du-an/<?php echo friendlyName($rowPrj->NAME_PRJ); ?>-viewpost-<?php echo $rowPrj->ID_PRJ ?>.html"
							title="<?php echo $rowPrj->NAME_PRJ ?>">
							<h4 class="text-primary-font project-name">
								<?php echo $rowPrj->NAME_PRJ ?>
							</h4>
						</a>
						<div class="mota_project">
							<ul>
								<li><strong><i class="fa fa-user-secret"></i>Chủ đầu tư: </strong><?php echo $rowPrj->HOST_PRJ ?></li>
								<li><strong><i class="fa fa-map-marker"></i>Địa điểm thi công:</strong>&nbsp;<?php echo $rowPrj->LOCATION_PRJ ?></li>
								<li><strong><i class="fa fa-calendar"></i>Thời gian thi công:</strong> <?php echo $rowPrj->YEAR_PRJ ?></li>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>

</section>
<?php } ?>

<style>
	.ul-info{
		
	}
	
	.ul-info li{
		position: relative;
		padding-left: 30px;
		line-height: 26px;
		margin-bottom: 8px;
	}
	
	.ul-info li i{
		position: absolute;
		left: 0px;
		top: 0px;
	}
	
	.bx-wrapper {
		-moz-box-shadow: 0 0 5px #ccc !important;
		-webkit-box-shadow: 0 0 5px #ccc !important;
		box-shadow: 0 0 5px #ccc !important;
		border: 5px solid #fff !important;
		background: #fff !important;
	}
	
	.no-data {
		background-color: #fafafa;
		padding: 90px 0;
		margin: 35px 0 25px;
	}
	
</style>



