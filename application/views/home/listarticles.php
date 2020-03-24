<?php 
	if(get_cookie("language") == "en") { require 'lang-en.php'; $langQuery = 'En-US'; }
	else { require 'lang-vi.php'; $langQuery = 'Vi-VN'; }
?>

<style>
	
	.articles-news-ctn{
		padding-bottom: 0px;
    	background-color: #f4f4f4;
	}
	
	
	.articles-news-ctn .img{
		overflow: hidden;
	}
	
	.articles-news-ctn img{
		transition: transform 0.5s;
		-moz-transition: transform 0.5s;
		-webkit-transition: transform 0.5s;
	}
	
	.newspaper-item-ctn:hover img{
		transform: scale(1.05);
		-moz-transform: scale(1.05);
		-webkit-transform: scale(1.05);
	}
	
	
</style>

<script>
	$(function(){
		$("meta[property='og:title']").attr("content", "<?php echo $module ?>");
		$("meta[property='og:description']").attr("content", "<?php echo $module ?>");
	});
</script>

<section  class="content-section">
	<div class="newsitem-block">
		<div class="container pos-relative" style="min-height: calc(100vh - 470px);">
			<h2 class="block-title text-secondary-font"><?php echo $module ?></h2>
			<div style="margin-bottom: 15px;">
				<?php 
					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
					$full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				?>
				<div class="fb-like" data-href="<?php echo $full_url; ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			</div>
			<?php if(isset($contentModel) && count($contentModel) > 0) { ?>
			<div class="newspaper-list">
				<div>
					<div class="row">
						<?php  foreach ($contentModel as $row) { ?>
						<div class="col-md-3 col-xs-12 col-sm-6 newspaper-item-ctn">
							<div class="articles-news-ctn">
								<div class="img">
									<a href="detail-article/<?php echo $moduleID ?>/<?php echo friendlyName($row->NAME_AR); ?>-viewpost-<?php echo $row->ID_AR; ?>.html" 
										title="<?php echo $row->NAME_AR; ?>">
										<img src="thumbnail/img?imageurl=<?php echo default_value($row->IMAGE_AR, 'img/no-image.jpg'); ?>&width=500" alt="<?php echo $row->NAME_AR ?>"/>
									</a>
								</div>
								<div class="title text-primary-font">
									<a href="detail-article/<?php echo $moduleID ?>/<?php echo friendlyName($row->NAME_AR); ?>-viewpost-<?php echo $row->ID_AR; ?>.html" 
										title="<?php echo $row->NAME_AR; ?>">
										<h4><?php echo $row->NAME_AR; ?></h4>
									</a>
								</div>
								<div class="desc text-justify">
									 <?php echo $row->DESC_AR; ?>
								</div>
							</div>
						</div>				
						<?php } ?>
					</div>
					<div class="text-center">
						<?php 
							$config['base_url'] = 'articles-list-articles/'.$moduleID.'.html';
							$config['total_rows'] = $viewData["TOTAL_REC"];
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
			</div>
			<?php } else { ?>
				<div class="text-center no-data">
					<div><i class="fa fa-4x fa-frown-o"></i></div>
					<h4><?php echo $language_dict['no_data'] ?></h4>
				</div>
			<?php } ?>
		</div>
	</div>

</section>