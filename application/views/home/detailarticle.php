<?php 
	if(get_cookie("language") == "en") { require 'lang-en.php'; $langQuery = 'En-US'; }
	else { require 'lang-vi.php'; $langQuery = 'Vi-VN'; }
?>

<section class="content-section">
	<div class="newsitem-block">
		<div class="container pos-relative">
			<h2 class="block-title text-secondary-font"><?php echo $module ?></h2>
			<div class="row">
				<div class="col-md-70p">
					<div style="line-height: 24px; text-align: justify;">
						<div style="padding-top: 0px; padding-bottom: 10px;">
							<h2 class="text-primary-font" style="color: #fa4747; margin-bottom: 0px;"><?php echo $articleModel->NAME_AR; ?></h2>
							
						</div>
						<div>
							<?php 
								$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
								$full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
							?>
							<div class="fb-like" data-href="<?php echo $full_url; ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
						</div>
						<div style="text-align: justify !important; margin-top: 20px;">
							<div style="font-weight: bold;">
								<?php echo $articleModel->DESC_AR; ?>
							</div>
							<div>
								<?php echo $articleModel->CONTENT_AR; ?>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-30p">
					<?php if($moduleType == "0" || $moduleID == "tuyendung") { ?>
					<ul class="categories-lst">
							<li class="headlist">
								<i class="fa fa-list"></i>&nbsp;&nbsp;
								<span><?php echo $language_dict['categories'] ?></span>
							</li>
							<?php 
								$queryArticlesMd = $this->db->query("SELECT * FROM hd_articles where ID_MODULE ='".$moduleID."' AND LANGUAGE = '".$langQuery."' AND VISIBLE_AR = 1 ORDER BY SORT_INDEX, DATE_MODIFIED DESC, DATE_CREATED DESC ");
								foreach ($queryArticlesMd->result() as $row)
								{
							?>
							<li>
								<a href="detail-article/<?php echo $moduleID; ?>/<?php echo friendlyName($row->NAME_AR); ?>-viewpost-<?php echo $row->ID_AR; ?>"
								 title="<?php echo $row->NAME_AR; ?>">
									<?php echo $row->NAME_AR; ?>
								</a>
							</li>
							<?php } ?>
							<?php if($moduleID == "gioithieu") { ?>
								<li>
									<a href="articles-detail-image-flb/ho-so-nang-luc"
									 title="<?php echo $language_dict['companyProfile'] ?>">
									 	<?php echo $language_dict['companyProfile'] ?>
									</a>
								</li>
							<?php } ?>
					</ul>
					<?php } ?>
					<?php if($moduleID == "tintuc") { ?>
					<div style="margin-bottom: 20px;">
						<ul class="categories-lst" style="margin-bottom: 0;">
							<li class="headlist">
								<i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;
								<span><?php echo $language_dict['nearProjects'] ?></span>
							</li>
						</ul>
						<div class="newslisst" style="background-color: #f3f3f3 !important;">
							<ul style="list-style: none; padding: 0; margin: 0; padding-top: 0px;">
								<?php 
									$queryProject = $this->db->query("SELECT * FROM hd_projects where ID_MODULE ='duan'  AND LANGUAGE = '".$langQuery."'  AND VISIBLE_PRJ = 1 ORDER BY DATE_MODIFIED DESC, DATE_CREATED DESC LIMIT 8 ");
									foreach ($queryProject->result() as $row)
									{
								?>
								<li>
									<div class="pull-left text-center" style="height: 50px; width: 50px; overflow-x: hidden; display: inline-block; margin-right: 10px;">
										<a href="detail-project/du-an/<?php echo friendlyName($row->NAME_PRJ); ?>-viewpost-<?php echo $row->ID_PRJ; ?>" 
										title="<?php echo $row->NAME_PRJ; ?>">
											<img src="<?php echo $row->IMAGE_PRJ; ?>" alt="<?php echo $row->NAME_PRJ ?>" style="height: 100%;" />
										</a>

									</div>
									<strong class="text-justify" style="padding-top: 3px; font-size: 14px;">
										<a href="detail-project/du-an/<?php echo friendlyName($row->NAME_PRJ); ?>-viewpost-<?php echo $row->ID_PRJ; ?>"
										 title="<?php echo $row->NAME_PRJ; ?>">
											<span class="limmit-line" data-original="<?php echo $row->NAME_PRJ; ?>" data-limit="2">
												<?php echo $row->NAME_PRJ; ?>
											</span>
										</a>
									</strong>

									<div class="clearfix"></div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php } ?>
					<?php if($moduleID != "") { ?>
					<div style="margin-bottom: 20px;">
						<ul class="categories-lst" style="margin-bottom: 0;">
							<li class="headlist">
								<i class="fa fa-newspaper-o"></i>&nbsp;&nbsp;
								<span><?php echo $language_dict['proNewsLow'] ?></span>
							</li>
						</ul>
						<div class="newslisst" style="background-color: #f3f3f3 !important;">
							<ul style="list-style: none; padding: 0; margin: 0; padding-top: 0px;">
								<?php 
									$queryNews = $this->db->query("SELECT * FROM hd_articles where ID_MODULE ='tintuc'  AND LANGUAGE = '".$langQuery."'  AND ID_AR != ".$articleModel->ID_AR." AND VISIBLE_AR = 1 ORDER BY rand(), DATE_MODIFIED DESC, DATE_CREATED DESC LIMIT 10 ");
									foreach ($queryNews->result() as $row)
									{
								?>
								<li>
									<div class="pull-left text-center" style="height: 50px; width: 50px; overflow-x: hidden; display: inline-block; margin-right: 10px;">
										<a href="detail-article/tin-tuc/<?php echo friendlyName($row->NAME_AR); ?>-viewpost-<?php echo $row->ID_AR; ?>" 
										title="<?php echo $row->NAME_AR; ?>">
											<img src="<?php echo $row->IMAGE_AR; ?>" alt="<?php echo $row->NAME_AR ?>" style="height: 100%;">
										</a>

									</div>
									<strong class="text-justify" style="padding-top: 3px; font-size: 14px;">
										<a href="detail-article/tin-tuc/<?php echo friendlyName($row->NAME_AR); ?>-viewpost-<?php echo $row->ID_AR; ?>"
										 title="<?php echo $row->NAME_AR; ?>">
											<span class="limmit-line" data-original="<?php echo $row->NAME_AR; ?>" data-limit="2">
												<?php echo $row->NAME_AR; ?>
											</span>
										</a>
									</strong>

									<div class="clearfix"></div>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

</section>