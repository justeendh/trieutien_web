<?php
	defined( 'BASEPATH' )OR exit( 'No direct script access allowed' );
	
	if(get_cookie("language") == "en") { require 'lang-en.php'; $langQuery = 'En-US'; }
	else { require 'lang-vi.php'; $langQuery = 'Vi-VN'; }

	$infomations=array();
	$query = $this->db->query("SELECT KEY_INFO, VAL_INFO FROM hd_infomations a WHERE LANGUAGE = '".$langQuery."' OR a.LANGUAGE = 'ALL' ");
	foreach ($query->result() as $row)
	{
		$infomations[$row->KEY_INFO] = $row->VAL_INFO;
	}

	$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
	$full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	$ogPageTitle = isset($og_Title) && $og_Title != "" ? $og_Title." - ".$infomations['companyfullname'] : $infomations['companyfullname'];
	$ogTitle = isset($og_Title) && $og_Title != "" ? $og_Title : $infomations['companyfullname'];
	$ogDesc = isset($og_Desc) && $og_Desc != "" ? $og_Desc : $infomations['companyfullname']."Địa chỉ: ".$infomations['fulladdress'];
	$ogImageUrl = isset($og_Image) ? $protocol."://".$_SERVER['SERVER_NAME'].base_url().$og_Image : $protocol."://".$_SERVER['SERVER_NAME'].base_url()."img/logo.jpg";
	
?>
<!DOCTYPE html>
<html>

<head>
	<base href="<?=base_url()?>"/>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="keywords" content="xây dựng tại đà nẵng, triều tiến, công ty triều tiến, cong ty trieu tien, <?php echo $infomations['companyfullname']; ?>, trieu tien">
	<meta name="description" content="<?php echo $infomations['companyfullname']; ?>. Địa chỉ: <?php echo $infomations['fulladdress']; ?>. Tel: <?php echo $infomations['phone']; ?> - <?php echo $infomations['mobile']; ?>. Mail: <?php echo $infomations['email']; ?>">
	<meta property="og:url" content="<?php echo $full_url; ?>" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php echo $ogTitle; ?>" />
	<meta property="og:description" content="<?php echo $ogDesc; ?>" />
	<meta property="og:image" content="<?php echo $ogImageUrl; ?>" />
	<title><?php echo $ogPageTitle; ?></title>
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/plugins.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/lightbox.min.css">
	<link rel="stylesheet" href="css/site-style.css">
	<link rel="stylesheet" href="css/media-style.css">
	<script src="js/jquery-3.3.1.min.js" type="text/javascript"></script>
	<script src="js/popper.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/bootstrap.min.js"></script>
	<script src="js/plugins.js"></script>
	<script src="js/lightbox.min.js"></script>
	<script src="js/jquery.ellipsis.min.js"></script>

	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
	<link rel="icon" href="favicon.ico" type="image/x-icon">
	
</head>

<body>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = 'https://connect.facebook.net/<?php echo ($langQuery == 'Vi-VN' ? 'vi_VN' : 'en_US'); ?>>/sdk.js#xfbml=1&version=v3.1';
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	

	<div class="site-wrapper">
		<header>
			<div class="pos-relative">
				<div class="subheader">
					<div class="container">
						<div class="general-info-block">
							<div class="address"><?php echo $infomations['shortaddress']; ?></div>
							<div class="phone">
								<strong style="color: #fa4747;">
									<a href="tel:<?php echo $infomations['phone']; ?>"><?php echo $infomations['phone']; ?></a>
								</strong>
							</div>
							<div class="email">
								<a href="mailto:<?php echo $infomations['email']; ?>"><?php echo $infomations['email']; ?></a>
							</div>
							
							<div class="email">
								<a href="change-language/<?php echo get_cookie("language") == "vi" ? "en" : "vi" ?>">
									<img src="img/<?php echo get_cookie("language") == "vi" ? "en" : "vi" ?>.png"
											style="width: 30px; margin-bottom: 5px; margin-right: 5px;"/>
									<?php echo get_cookie("language") == "vi" ? "English" : "Tiếng Việt" ?>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="navigation">
					<div class="container">
						<div class="logo-ctn">
							<div class="img-logo">
								<a href="">
									<img src="img/logo.jpg" class="logo" />
								</a>
							
							</div>
							<div class="company-name noselect">
								<a href="">
									<?php if(get_cookie("language") == "vi") { ?>
									<h4 class="noselect">
										<div><?php echo $language_dict['companyName1'] ?></div>
									</h4>
									<?php  } else { ?>
									<h1 class="noselect">
										<div><?php echo $language_dict['companyName2'] ?></div>
									</h1>
									<?php  } ?>
									<?php if(get_cookie("language") == "vi") { ?>
									<h1 class="noselect">
										<div><?php echo $language_dict['companyName2'] ?></div>
									</h1>
									<?php  } else { ?>									
									<h4 class="noselect">
										<div><?php echo $language_dict['companyName1'] ?></div>
									</h4>
									<?php  } ?>
								</a>
							</div>
							<div class="hidden-md hidden-lg hidden-sm" 
							style="color: #fafafa; position: absolute; white-space: nowrap; left: 100%; margin-left: 10px; top: 48px; font-family: UTMCafeta !important;font-size: 16px;">
								<?php echo ((get_cookie("language") == "vi") ? "CÔNG TY CỔ PHẦN XÂY DỰNG TRIỀU TIẾN" : "TRIEU TIEN CONSTRUCTION JOINT STOCK COMPANY"); ?>
							</div>
						</div>
						<a href="javascript:void(0)" class="nav-toggle-btn" onclick="$('.nav-block').slideToggle();">
							<i class="fa fa-bars fa-fw"></i>
						</a>
					
						<nav class="nav-block">
							<ul class="nav-ul text-primary-font">
								<li><a href=""><i class="fa fa-chevron-circle-right"></i><?php echo $language_dict['homePage'] ?></a>
								</li>
								<li>
									<a href="articles-list-articles/gioi-thieu"><i class="fa fa-chevron-circle-right"></i><?php echo $language_dict['aboutUs'] ?></a>
									<div class="sub-item-ctn">
										<div class="submenu-ctn">
											<ul>
												<?php 
													$query = $this->db->query("SELECT * FROM hd_articles where ID_MODULE ='gioithieu' AND LANGUAGE = '".$langQuery."' and VISIBLE_AR = 1 ORDER BY SORT_INDEX");
													foreach ($query->result() as $row)
													{
													?>
														<li>
															<a href="detail-article/gioi-thieu/<?php echo friendlyName($row->NAME_AR); ?>-viewpost-<?php echo $row->ID_AR; ?>">
																<i class="fa fa-angle-right"></i><?php echo $row->NAME_AR; ?>
															</a>
														</li>
													<?php 
													}
												?>
												
												<li>
													<a href="articles-detail-image-flb/ho-so-nang-luc">
														<i class="fa fa-angle-right"></i><?php echo $language_dict['companyProfile'] ?>
													</a>
												</li>
												<li>
													<a href="<?php echo $infomations['hsnl_download'] ?>" target="_blank">
														<i class="fa fa-angle-right"></i>Download <?php echo $language_dict['companyProfile'] ?>
													</a>
												</li>
											</ul>
										</div>
									</div>
								</li>
								<li>
									<a href="articles-list-projects/du-an"><i class="fa fa-chevron-circle-right"></i><?php echo $language_dict['projects'] ?></a>
									<div class="sub-item-ctn">
										<div class="submenu-ctn">
											<ul>
												<?php 
													$queryDuAn = $this->db->query("SELECT * FROM hd_groups where ID_MODULE ='duan' AND LANGUAGE = '".$langQuery."' and VISIBLE_GR = 1 ORDER BY SORT_INDEX");
													foreach ($queryDuAn->result() as $row)
													{
													?>
														<li>
															<a href="group-list-projects/du-an/<?php echo friendlyName($row->NAME_GR); ?>-group-<?php echo $row->ID_GR; ?>">
																<i class="fa fa-angle-right"></i><?php echo $row->NAME_GR; ?>
															</a>
														</li>
													<?php 
													}
												?>
											</ul>
										</div>
									</div>
								</li>
								<li><a href="articles-list-images/hinh-anh"><i class="fa fa-chevron-circle-right"></i><?php echo $language_dict['photo'] ?></a>
								</li>
								<li>
									<?php 
									$querytuyendung = $this->db->query("SELECT * FROM hd_articles where ID_MODULE ='tuyendung'  AND LANGUAGE = '".$langQuery."'  and VISIBLE_AR = 1 ORDER BY DATE_MODIFIED DESC, DATE_CREATED DESC LIMIT 1");
									if($querytuyendung->num_rows() > 0){
									?>
									<a href="detail-article/tuyen-dung/tuyen-dung-viewpost-<?php echo $querytuyendung->row()->ID_AR; ?>">
										<i class="fa fa-chevron-circle-right"></i><?php echo $language_dict['tuyendung'] ?>
									</a>
									<?php } ?>
								</li>
								<li><a href="articles-list-articles/tin-tuc"><i class="fa fa-chevron-circle-right"></i><?php echo $language_dict['news'] ?></a>
								</li>
								<li><a href="page/contact"><i class="fa fa-chevron-circle-right"></i><?php echo $language_dict['contact'] ?></a>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="bg_logo"></div>
			</div>
		</header>
		<div class="content-page" style="min-height: 300px;">
			<?php 
				$contentData["infomations"] = $infomations;
				if(isset($viewData)) $contentData["viewData"] = $viewData;
				if(isset($contentModel)) $contentData["contentModel"] = $contentModel;
				$this->load->view($content, $contentData); 
			?>
			
			

			<div class="newsitem-block" style="background-color: #eaeaea; padding-bottom: 50px;">
				<div class="container pos-relative">
					<div class="row">
						<div class="col-md-8">
							<h2 class="block-title text-secondary-font"><?php echo $language_dict['ourPartner'] ?></h2>
							<div class="doitac-list">
								<div>
									<div class="owl-doitac">
									<?php  										
										$queryDoitac = $this->db->query("SELECT * FROM hd_images WHERE ID_MODULE = '
										..'");
										foreach ($queryDoitac->result() as $row) { ?>
										<div class="doitac-item-ctn">
											<div>
												<a href="<?php echo $row->URL_LINK_IMG != "" ? $row->URL_LINK_IMG : "javascript:void(0);"; ?>">
													<img src="<?php echo $row->IMAGE_URL; ?>" />
												</a>
											</div>
										</div>				
									<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div style="margin-top: 20px;">
								<div class="fb-page" data-width="1200px" data-href="https://www.facebook.com/C%C3%B4ng-Ty-C%E1%BB%95-Ph%E1%BA%A7n-X%C3%A2y-D%E1%BB%B1ng-Tri%E1%BB%81u-Ti%E1%BA%BFn-440878513083751/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false"><blockquote cite="https://www.facebook.com/C%C3%B4ng-Ty-C%E1%BB%95-Ph%E1%BA%A7n-X%C3%A2y-D%E1%BB%B1ng-Tri%E1%BB%81u-Ti%E1%BA%BFn-440878513083751/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/C%C3%B4ng-Ty-C%E1%BB%95-Ph%E1%BA%A7n-X%C3%A2y-D%E1%BB%B1ng-Tri%E1%BB%81u-Ti%E1%BA%BFn-440878513083751/">Công Ty Cổ Phần Xây Dựng Triều Tiến</a></blockquote></div>
							</div>
							
						</div>
					</div>
					
				</div>
				
			</div>

		</div>

		<div class="footer-block">
			<div class="copyright">
				<div class="container">
					<div class="row">
						<div class="col-lg-8 col-md-8 col-sm-12 col-sm-12">
							<strong><?php echo $infomations['companyfullname']; ?></strong><br> 
							<?php echo $language_dict['address'] ?>: <?php echo $infomations['fulladdress']; ?><br> 
							<?php echo $language_dict['phoneNumber'] ?>: <a href="tel:<?php echo $infomations['phone']; ?>"><?php echo $infomations['phone']; ?></a> - &nbsp;
							<?php echo $language_dict['hotline'] ?>: <a href="tel:<?php echo $infomations['mobile']; ?>"><?php echo $infomations['mobile']; ?></a> &nbsp;| &nbsp;
							<?php echo $language_dict['emailAddress'] ?>: <a href="mailto:<?php echo $infomations['email']; ?>"><?php echo $infomations['email']; ?></a> </div>
						<div class="col-lg-4 col-md-4 col-sm-12 col-sm-12 goon">
							<a href="javascript:void(0);" target="_blank">Designed by Triều Tiến</a><br> 
							<?php echo $language_dict['visitCount'] ?>:&nbsp; <?php echo count_visitor(); ?><br> 
							Copyright © 2016. &nbsp;All rights reserved
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="js/appJs.js"></script>
	<script type="text/javascript" src="js/owl.carousel.min.js"></script>
	<script type="text/javascript">
		$(function(){
			$(".owl-doitac").owlCarousel({
				loop: false,
				autoplay: true,
				autoplayTimeout:3000,
				autoplaySpeed: 1000,
				margin: 20,
				navText: ["&nbsp;&nbsp;", "&nbsp;&nbsp;"],
				responsiveClass:true,
				nav : false,
				responsive:{
					0:{
						items:2,
						nav:true,
						loop:true
					},
					600:{
						items:2,
						nav:false,
						loop:true
					},
					1000:{
						items:5,
						nav:true,
						loop:true
					}
				}
			});
			
		});
		
	</script>
	<style>
	
		.fb-page, 
		.fb-page span, 
		.fb-page span iframe[style] { 
			width: 100% !important; 
		}
	</style>
	<!--Start of Tawk.to Script-->
	<!--Start of Tawk.to Script-->
	<script type="text/javascript">
	var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
	(function(){
	var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
	s1.async=true;
	s1.src='https://embed.tawk.to/5bbac9f6b8198a041048a184/default';
	s1.charset='UTF-8';
	s1.setAttribute('crossorigin','*');
	s0.parentNode.insertBefore(s1,s0);
	})();
	</script>
<!--End of Tawk.to Script-->
</body>

</html>