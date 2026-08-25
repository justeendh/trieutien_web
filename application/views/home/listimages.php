<?php 
	if(get_cookie("language") == "en") { require 'lang-en.php'; $langQuery = 'En-US'; }
	else { require 'lang-vi.php'; $langQuery = 'Vi-VN'; }
?>
<style>
	.project-highlight .highlight-project-info > h4 {
		padding: 15px 20px 0;
	}
	
	body{
		background-image: url('img/bg.gif');
	}
</style>

<script>
	$(function(){
		$("meta[property='og:title']").attr("content", "<?php echo $module ?>");
		$("meta[property='og:description']").attr("content", "<?php echo $module ?>");
	});
</script>

<section  class="content-section">
	<div class="newsitem-block project-highlight">
		<div class="container pos-relative" style="min-height: calc(100vh - 470px);">
			<h2 class="block-title text-secondary-font"><?php echo $module ?></h2>
			<div style="margin-bottom: 15px;">
				<?php 
					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
					$full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				?>
				<div class="fb-like" data-href="<?php echo $full_url; ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			</div>
			<div class="project-list">
				<?php  if($queryImageActivity->row() != null && count($queryImageActivity->result()) > 0) { ?>
				<div>
					<div class="row">
						<?php  foreach ($queryImageActivity->result() as $row) { ?>
						<div class="col-md-4 col-xs-12 col-sm-6 project-item-ctn">
							<a href="images-detail-image/<?php echo $moduleID; ?>-viewdetail-<?php echo $row->ID ?>"
							 title="<?php echo $row->NAME_IMG ?>" class="pos-relative">
								<div class="imgsamesize-article">
									<img src="thumbnail/img?imageurl=<?php echo default_value($row->IMAGE_URL, 'img/no-image.jpg'); ?>&width=500" alt="<?php echo $row->NAME_IMG ?>">
								</div>
								<div class="highlight-project-info">
									<h4 class="text-center"><?php echo $row->NAME_IMG ?></h4>
									<div class="text-center">
										<div class="btn btn-viewdetail">Xem chi tiết</div>
									</div>
								</div>
							</a>
						</div>		
						<?php } ?>		
					</div>
				</div>
				<div class="text-center">
					<?php 
						$config['base_url'] = 'articles-list-images/'.$moduleID.'';
						$config['total_rows'] = $viewData["TOTAL_REC"];
						$config['per_page'] = 10;
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
				<?php 				
				}
				else{
					?> 
						<div class="text-center no-data">
							<div><i class="fa fa-4x fa-frown-o"></i></div>
							<h4><?php echo $language_dict['no_data'] ?></h4>
						</div>
					<?php
				}
			?>
			</div>
		</div>
	</div>

</section>