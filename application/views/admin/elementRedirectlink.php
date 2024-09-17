
<!-- Timeline Widget -->
<div class="widget">
    <div class="widget-extra themed-background-dark">
        <h3 class="widget-content-light">
            <strong><?php echo $moduleName; ?></strong>
        </h3>
        <div class="widget-options">
			<div class="btn-group">
				
			</div>
		</div>
    </div>
    <div class="widget-extra" style="height: auto !important;">      
		<?php echo form_open_multipart('admin/manage/do_upload_file-module-hosonangluc_download');?>  
			<div style="padding: 1em;">
				<h3><strong>Nhập liên kết</strong></h3>
				<div class="form-group">
					<label for="redirectLink">Liên kết <?php echo $moduleName; ?> </label>
					<div class="input-group">
						<div class="input-group-addon"><i class="fa fa-link"></i> Nhập liên kết&nbsp;&nbsp;</div>
						<input class="form-control" id="redirectLink" placeholder="https://link-to-file/download"
							style="font-size: 18px;"/>
						<div class="input-group-btn">
							<button type="button" class="btn btn-lg btn-primary" id="browseFileInput"
								style="padding: 1rem 3rem !important;">
								<i class="fa fa-link"></i> Browse
							</button>
						</div>
					</div>	
				</div>	 
			</div>
		</form>
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

		$('#browseFileInput').click(() =>{
			selectFileWithCKFinder( 'redirectLink' );
		});
	});
</script>
<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/normalize.css" />
<style lang="css">
    
.hidden {
	position: absolute;
	overflow: hidden;
	width: 0;
	height: 0;
	pointer-events: none;
}


/* Header */

.codrops-header {
	padding: 2em 1em 4em;
	text-align: center;
}

.codrops-header h1 {
	margin: 0.5em 0 0;
	letter-spacing: -1px;
	font-size: 3em;
	line-height: 1;
}

.codrops-header h1 span {
	display: block;
	padding: 0.5em 0 1em;
	color: #999;
	font-weight: normal;
	font-size: 0.45em;
}


/* Top Navigation Style */

.codrops-links {
	position: relative;
	display: inline-block;
	text-align: center;
	white-space: nowrap;
}

.codrops-links::after {
	position: absolute;
	top: 0;
	left: 50%;
	width: 1px;
	height: 100%;
	background: rgba(0, 0, 0, 0.1);
	content: '';
	-webkit-transform: rotate3d(0, 0, 1, 22.5deg);
	transform: rotate3d(0, 0, 1, 22.5deg);
}

.codrops-icon {
	display: inline-block;
	margin: 0.5em;
	padding: 0em 0;
	width: 1.5em;
	text-decoration: none;
}

.codrops-icon span {
	display: none;
}

.codrops-icon:before {
	margin: 0 5px;
	text-transform: none;
	font-weight: normal;
	font-style: normal;
	font-variant: normal;
	font-family: 'codropsicons';
	line-height: 1;
	speak: none;
	-webkit-font-smoothing: antialiased;
}

.codrops-icon--drop:before {
	content: "\e001";
}

.codrops-icon--prev:before {
	content: "\e004";
}


/* Demo links */

.codrops-demos {
	margin: 2em 0 0;
}

.codrops-demos a {
	display: inline-block;
	margin: 0 0.5em;
}

.codrops-demos a.current-demo {
	color: #333;
}


/* Content */

.content {
	width: 100%;
	max-width: 800px;
	text-align: center;
	margin: 0 auto;
	padding: 0 0 3em 0;
}

.content footer {
	color: #b39295;
	margin-top: 40px;
}

.content footer a:hover,
.content footer a:focus {
	color: #4b0f31;
}

.box {
	background-color: #dfc8ca;
	padding: 6.25rem 1.25rem;
}

.box + .box {
	margin-top: 2.5rem;
}


/* Related demos */

.content--related {
	text-align: center;
	font-weight: bold;
	padding-top: 4em;
}

.media-item {
	display: inline-block;
	padding: 1em;
	vertical-align: top;
	-webkit-transition: color 0.3s;
	transition: color 0.3s;
}

.media-item__img {
	max-width: 100%;
	opacity: 0.6;
	-webkit-transition: opacity 0.3s;
	transition: opacity 0.3s;
}

.media-item:hover .media-item__img,
.media-item:focus .media-item__img {
	opacity: 1;
}

.media-item__title {
	margin: 0;
	padding: 0.5em;
	font-size: 1em;
}

@media screen and (max-width: 50em) {
	.codrops-header {
		padding: 3em 10% 4em;
	}
}

@media screen and (max-width: 40em) {
	.codrops-header h1 {
		font-size: 2.8em;
	}
}

</style>

<link rel="stylesheet" type="text/css" href="<?=base_url()?>/css/component.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
<script src="<?=base_url()?>/js/jquery.custom-file-input.js"></script>

<style>
    .box {
        background-color: #cccccc47 !important;
        padding: 4.25rem 1.25rem !important;
        text-align: center !important;
    }

    .inputfile + label {
        max-width: 80%;
        font-size: 2.25rem;
        font-weight: 700;
        text-overflow: ellipsis;
        white-space: nowrap;
        cursor: pointer;
        display: inline-block;
        overflow: hidden;
        padding: 1.625rem 3.25rem;
    }

    .inputfile-1 + label {
        color: #f1e5e6;
        background-color: #394263;
    }

    .inputfile-1:focus + label, .inputfile-1.has-focus + label, .inputfile-1 + label:hover {
        background-color: #394263 !important;
    }
</style>