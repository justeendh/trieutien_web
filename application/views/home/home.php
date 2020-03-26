<?php
	if(get_cookie("language") == "en") { require 'lang-en.php'; $langQuery = 'En-US'; }
	else { require 'lang-vi.php'; $langQuery = 'Vi-VN'; }
?>

<link rel="stylesheet" href="css/jquery.bxslider.css">
<link rel="stylesheet" href="css/owl.carousel.min.css">
<link rel="stylesheet" href="css/owl.theme.default.min.css">

<div class="slider-section">
	<div class="owl-home-carousel">
		<?php 
			$querySlide = $this->db->query("SELECT * FROM hd_images where ID_MODULE ='homeslide'  AND LANGUAGE = '".$langQuery."'  and VISIBLE_IMG = 1 ORDER BY SORT_INDEX");
			foreach ($querySlide->result() as $row)
			{
		?>
		<div class="slider-items">		
			<div class="slider-item-content-block">		
				<a href="<?php echo $row->URL_LINK_IMG != "" ? $row->URL_LINK_IMG : "javascript:void(0);"; ?>">
					<img src="<?php echo $row->IMAGE_URL; ?>" style="width: 100%;" />
				</a>		
				<div class="slider-item-info">
					<h4 class="text-primary-font"><?php echo $row->NAME_IMG; ?></h4>
					<?php if(trim($row->INFO_1) != "") { ?>
					<div>
						<?php echo trim($row->INFO_1); ?>
					</div>
					<?php } ?>
					<?php if(trim($row->INFO_2) != "") { ?>
					<div>
						<?php echo trim($row->INFO_2); ?>
					</div>
					<?php } ?>
					<?php if(trim($row->INFO_3) != "") { ?>
					<div>
						<?php echo trim($row->INFO_3); ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	
</div>




<div class="service-section">
	<div class="container">
		<div class="row">
			<?php 
				$queryService = $this->db->query("SELECT * FROM hd_articles where ID_MODULE ='dichvucongty' AND LANGUAGE = '".$langQuery."' AND VISIBLE_AR = 1 ORDER BY SORT_INDEX");
				foreach ($queryService->result() as $row)
				{
			?>
			<div class="col-md-6 service-item">
				<a href="javascript:void(0);" class="flex-container">
					<div class="flex-item service-icon">						
						<div><img alt="<?php echo trim($row->NAME_AR); ?>" src="<?php echo trim($row->IMAGE_AR); ?>" /></div>
					</div>
					<div class="flex-item">						
						<h4 class="service-title text-secondary-font">
							<span><?php echo trim($row->NAME_AR); ?></span>
						</h4>
						<div class="service-desc"><?php echo trim($row->DESC_AR); ?></div>
					</div>
				</a>
			</div>
			<?php } ?>
		</div>
	</div>
</div>




<?php 
	$queryDuAn = $this->db->query("SELECT * FROM hd_groups where ID_MODULE ='duan' AND LANGUAGE = '".$langQuery."' and VISIBLE_GR = 1 ORDER BY SORT_INDEX");
	foreach ($queryDuAn->result() as $row)
	{
		$queryProjects = $this->db->query("SELECT * FROM hd_projects 
						WHERE ID_MODULE ='duan'   AND LANGUAGE = '".$langQuery."'  AND GROUP_ID = ".$row->ID_GR
					  ." AND VISIBLE_PRJ = 1 ORDER BY PRIORITY DESC, DATE_MODIFIED DESC, DATE_CREATED DESC LIMIT 8 ");
		if( $queryProjects->num_rows() > 0){
	?>
		<div class="newsitem-block">
			<div class="container pos-relative">
				<h2 class="block-title text-secondary-font"><?php echo $row->NAME_GR; ?></h2>
				<div class="list-news-block owl-public-carousel">
					<?php  foreach ($queryProjects->result() as $rowPrj) { ?>
					<div class="construc-item">
						<a class="image-link" href="detail-project/du-an/<?php echo friendlyName($rowPrj->NAME_PRJ); ?>-viewpost-<?php echo $rowPrj->ID_PRJ ?>.html"
							title="<?php echo $rowPrj->NAME_PRJ ?>">
							<img class="img-c-two2" src="thumbnail/img?imageurl=<?php echo default_value($rowPrj->IMAGE_PRJ, 'img/no-image.jpg'); ?>&width=500" alt="<?php echo $rowPrj->NAME_PRJ ?>">
							<div class="fdw-background2">
								<div class="detail-btn"><?php echo $language_dict['viewDetail'] ?></div>
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
									<li><strong><i class="fa fa-user-secret"></i><?php echo $language_dict['investor'] ?>: </strong><?php echo $rowPrj->HOST_PRJ ?></li>
									<li><strong><i class="fa fa-map-marker"></i><?php echo $language_dict['constructionSite'] ?>:</strong>&nbsp;<?php echo $rowPrj->LOCATION_PRJ ?></li>
									<li><strong><i class="fa fa-calendar"></i><?php echo $language_dict['constructionTime'] ?>:</strong> <?php echo $rowPrj->YEAR_PRJ ?></li>
								</ul>
							</div>
						</div>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>

	<?php 
		}
	}
?>



<section class="section_gioi_thieu" style="margin-top: 60px;">
	<div class="container">
    	<div class="row">
        	<div class="col-lg-6 col-md-7 col-sm-12 col-xs-12">
            	<h2 class="lined-heading text-primary-font"><span><strong><?php echo $language_dict['aboutTrieuTien'] ?></strong></span></h2>
                <div class="gioi_thieu_home">
                	<div style="text-align: justify;">
                		<?php echo $infomations['homeintro']; ?>
				</div>
				<div class="text-left">
					<a href="articles-list-articles/gioi-thieu.html" class="btn btn-danger">
						<i class="fa fa-hand-o-right"></i> &nbsp;&nbsp;<?php echo $language_dict['viewMore'] ?>
					</a>
				</div>
            </div>
        </div>
    </div>
</section>


<!-- Sự án tiêu biểu-->


<div class="newsitem-block">
	<div class="container pos-relative">
		<h2 class="block-title text-secondary-font"><?php echo $language_dict['proNews'] ?></h2>
		<div class="newspaper-list">
			<div>
				<div class="row">
					<?php 
						$query = $this->db->query("SELECT * FROM hd_articles WHERE ID_MODULE = 'tintuc'  AND LANGUAGE = '".$langQuery."'  AND VISIBLE_AR = 1 ORDER BY PRIORITY DESC, DATE_MODIFIED DESC, DATE_CREATED DESC LIMIT 4 ");
						foreach ($query->result() as $row)
						{
					?>
						<div class="col-md-3 col-xs-12 col-sm-6 newspaper-item-ctn">
							<div class="articles-news-ctn">
								<div class="img">
									<a href="detail-article/tin-tuc/<?php echo friendlyName($row->NAME_AR); ?>-viewpost-<?php echo $row->ID_AR; ?>.html">
										<img src="<?php echo $row->IMAGE_AR; ?>" alt="<?php echo $row->NAME_AR; ?>" />
									</a>
								</div>
								<div class="title text-primary-font">
									<a href="detail-article/tin-tuc/<?php echo friendlyName($row->NAME_AR); ?>-viewpost-<?php echo $row->ID_AR; ?>.html">
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
			</div>
			<div class="text-center">
				<a href="articles-list-articles/tin-tuc.html" class="btn btn-danger btn-lg">
					<i class="fa fa-newspaper-o"></i> &nbsp;&nbsp;<?php echo $language_dict['proNewsOther'] ?>
				</a>
			</div>
		</div>
	</div>
</div>

<style>
	.service-section div.row:hover{
		background-color: #2a2a2a;
	}	
	
	.modal-backdrop.fade.in{
		opacity: 0.8;
		z-index: 2000000001 ;
	}
	
	#popupVideoIntro{
		z-index: 2000000002;
	}
	#popupVideoIntro p{
		margin: 0; padding: 0;
	}
	#popupVideoIntro video{
		width: 100%;
		height: auto !important;
	}
</style>
	
	
<?php if($infomations['homevideopopup'] != "") { ?>
<div>
	<!-- Modal -->
	<div class="modal fade" id="popupVideoIntro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-body" style="position: relative; padding: 5px 5px 0;">
					<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"
							style="position: absolute;right: 10px;top: 10px;z-index: 100000000000000;">
					  <span aria-hidden="true"><i class="fa fa-times"></i></span>
					</button>
					<?php echo $infomations['homevideopopup']; ?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php } ?>

<script type="text/javascript" src="js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="js/owl.carousel.min.js"></script>
<script type="text/javascript">
	$(function(){
		$('.owl-home-carousel').bxSlider({
			auto: true, pause: 5000, autoHover: false,
			nextText : "<i class='fa fa-angle-right'></i>", prevText : "<i class='fa fa-angle-left'></i>"
		});
		
		$('.owl-public-carousel').owlCarousel({
			loop: true,
			autoplay: true,
			autoplayTimeout:5000,
			autoplaySpeed: 1000,
			autoplayHoverPause:false,
			margin: 15,
			navText: ["&nbsp;&nbsp;", "&nbsp;&nbsp;"],
			responsive:{
				0:{
					items:1,
					nav:true,
					loop:true
				},
				600:{
					items:2,
					nav:true,
					loop:true
				},
				1000:{
					items:4,
					nav:true,
					loop:true
				}
			}
		});
		
		
		$("#popupVideoIntro").modal({ backdrop : "static", keyboard : false });
		$('#popupVideoIntro').on('shown.bs.modal', function() {
			
			$('#popupVideoIntro video').each(function(){
				$(this).get(0).play();
			});
			
		})
		$('#popupVideoIntro').on('hidden.bs.modal', function (e) {
		  $('#popupVideoIntro video').each(function(){
				$(this).get(0).pause();
			});
		})
	});
</script>








