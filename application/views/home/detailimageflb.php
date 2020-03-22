<style>
	.gallery > .row > div {
		margin-bottom: 30px;
	}
</style>

<link rel="stylesheet" type="text/css" href="css/bookblock.css" />

<section  class="content-section">
	<div class="newsitem-block">
		<div class="container pos-relative">
			<h2 class="block-title text-secondary-font"><?php echo $moduleName; ?></h2>			
			<div style="margin-bottom: 15px;">
				<?php 
					$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? 'https' : 'http';
					$full_url = $protocol."://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
				?>
				<div class="fb-like" data-href="<?php echo $full_url; ?>" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="true"></div>
			</div>
			<div data-toggle="lightbox-gallery">
			<?php  if(isset($queryImageListModel) && count($queryImageListModel) > 0) { ?>			

				<div class="bb-custom-wrapper">
					<div id="bb-bookblock" class="bb-bookblock">
	
					<?php  foreach($queryImageListModel as $row) { ?>
							<div class="bb-item">
								<a href="<?php echo $row->IMAGE_URL ?>" class="gallery-link" title="<?php echo $moduleName; ?>">
									<img src="<?php echo default_value($row->IMAGE_URL, 'img/no-image.jpg'); ?>" title="<?php echo $moduleName; ?>" 
												alt="<?php echo $moduleName; ?>">
								</a>
							</div>
					<?php   } ?>
						
					</div>
					<nav>
						<a id="bb-nav-first" href="#" class="bb-custom-icon bb-custom-icon-first">First page</a>
						<a id="bb-nav-prev" href="#" class="bb-custom-icon bb-custom-icon-arrow-left">Previous</a>
						<a id="bb-nav-next" href="#" class="bb-custom-icon bb-custom-icon-arrow-right">Next</a>
						<a id="bb-nav-last" href="#" class="bb-custom-icon bb-custom-icon-last">Last page</a>
					</nav>
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
			</div>
			<!-- END Lightbox Gallery Content -->
		</div>
	</div>

</section>
<script src="js/modernizr.custom.js"></script>
<script src="js/jquerypp.custom.js"></script>
<script src="js/jquery.bookblock.js"></script>
<script>
	var Page = (function() {

		var config = {
				$bookBlock : $( '#bb-bookblock' ),
				$navNext : $( '#bb-nav-next' ),
				$navPrev : $( '#bb-nav-prev' ),
				$navFirst : $( '#bb-nav-first' ),
				$navLast : $( '#bb-nav-last' )
			},
			init = function() {
				config.$bookBlock.bookblock( {
					speed : 800,
					shadowSides : 0.8,
					shadowFlip : 0.7
				} );
				initEvents();
			},
			initEvents = function() {

				var $slides = config.$bookBlock.children();

				// add navigation events
				config.$navNext.on( 'click touchstart', function() {
					config.$bookBlock.bookblock( 'next' );
					return false;
				} );

				config.$navPrev.on( 'click touchstart', function() {
					config.$bookBlock.bookblock( 'prev' );
					return false;
				} );

				config.$navFirst.on( 'click touchstart', function() {
					config.$bookBlock.bookblock( 'first' );
					return false;
				} );

				config.$navLast.on( 'click touchstart', function() {
					config.$bookBlock.bookblock( 'last' );
					return false;
				} );

				// add swipe events
				$slides.on( {
					'swipeleft' : function( event ) {
						config.$bookBlock.bookblock( 'next' );
						return false;
					},
					'swiperight' : function( event ) {
						config.$bookBlock.bookblock( 'prev' );
						return false;
					}
				} );

				// add keyboard events
				$( document ).keydown( function(e) {
					var keyCode = e.keyCode || e.which,
						arrow = {
							left : 37,
							up : 38,
							right : 39,
							down : 40
						};

					switch (keyCode) {
						case arrow.left:
							config.$bookBlock.bookblock( 'prev' );
							break;
						case arrow.right:
							config.$bookBlock.bookblock( 'next' );
							break;
					}
				} );
			};

			return { init : init };

	})();
</script>
<script>
		Page.init();
</script>