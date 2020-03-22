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
	
	
	
</style>

<script>
	$(function(){
		$("meta[property='og:title']").attr("content", "<?php echo $module ?>");
		$("meta[property='og:description']").attr("content", "<?php echo $module ?>");
	});
</script>

<section  class="content-section">
	<div class="listproject newsitem-block">
		<div class="container pos-relative">
			<h2 class="block-title text-secondary-font"><?php echo $module ?></h2>
			<div style="margin-bottom: 15px;">
				<?php 
					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
					$full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				?>
				<div class="fb-like" data-href="<?php echo $full_url; ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			</div>
			<?php  if(isset($queryProjects) && count($queryProjects) > 0) { ?>
			<div class="list-news-block row">
				<?php  foreach ($queryProjects as $row) { ?>
				<div class="col-xs-12 col-sm-6 col-md-3 construc-item">
					<a class="image-link" href="detail-project/du-an/<?php echo friendlyName($row->NAME_PRJ); ?>-viewpost-<?php echo $row->ID_PRJ ?>.html" title="<?php echo $row->NAME_PRJ ?>">
						<img class="img-c-two2" src="thumbnail/img?imageurl=<?php echo default_value($row->IMAGE_PRJ, 'img/no-image.jpg'); ?>&width=500" alt="<?php echo $row->NAME_PRJ ?>">
						<div class="fdw-background2">
							<div class="detail-btn">Xem chi tiết</div>
						</div>
					</a>				
					<div class="project-info-wrap">
						<a href="detail-project/du-an/<?php echo friendlyName($row->NAME_PRJ); ?>-viewpost-<?php echo $row->ID_PRJ ?>.html" title="<?php echo $row->NAME_PRJ ?>">
							<h4 class="text-primary-font project-name">
								<?php echo $row->NAME_PRJ ?>
							</h4>
						</a>
						<div class="mota_project">
							<ul>
								<li><strong><i class="fa fa-user-secret"></i>Chủ đầu tư: </strong><?php echo $row->HOST_PRJ ?></li>
								<li><strong><i class="fa fa-map-marker"></i>Địa điểm thi công:</strong>&nbsp;<?php echo $row->LOCATION_PRJ ?></li>
								<li><strong><i class="fa fa-calendar"></i>Thời gian thi công:</strong> <?php echo $row->YEAR_PRJ ?></li>
							</ul>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
				
			<div class="text-center">
				<?php 
					$currentURL = current_url();					  
					if(base_url() != "/") $currentURL = str_replace(base_url(), "", $currentURL);
					$config['base_url'] = $currentURL;
					$config['total_rows'] = $viewData["TOTAL_REC"];
					$config['per_page'] = 24;
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
			<?php  } else{ ?> 
				<div class="text-center no-data">
					<div><i class="fa fa-4x fa-frown-o"></i></div>
					<h4>Không có dữ liệu hiển thị</h4>
				</div>
			<?php } ?>
			
		</div>
	</div>

</section>