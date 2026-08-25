<?php
	if(get_cookie("language") == "en") require 'lang-en.php';
	else require 'lang-vi.php';
?>


<div class="map-ctn" style="position: relative; margin-top: 140px;">
	<div style="width: 100%">
		<iframe width="100%" style="position: absolute; width: 100%; height: 100%; left: 0; top: 0;" src="https://maps.google.com/maps?width=100%&amp;height=600&amp;hl=en&amp;coord=16.0221347,108.1967358&amp;q=+(C%C3%94NG%20TY%20C%E1%BB%94%20PH%E1%BA%A6N%20X%C3%82Y%20D%E1%BB%B0NG%20TRI%E1%BB%80U%20TI%E1%BA%BEN)&amp;ie=UTF8&amp;t=&amp;z=16&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a href="https://www.maps.ie/create-google-map/">Add map to website</a></iframe></div><br />
</div>



<section  class="content-section" style="margin-top: 0;">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-md-5">
				<div class="newsitem-block" style="margin-top: 10px;">
					<div class="pos-relative">
						<h2 class="block-title text-secondary-font"><?php echo $language_dict['contact'] ?></h2>
						<div>
							<h4 class="text-primary-font"><?php echo $infomations['companyfullname']; ?></h4>
							<div>
								<p><strong><?php echo $language_dict['address'] ?>:</strong> <?php echo $infomations['fulladdress']; ?></p>
								<p><strong><?php echo $language_dict['phoneNumber'] ?>:</strong> <a href="tel:<?php echo $infomations['phone']; ?>"><?php echo $infomations['phone']; ?></a></p>
								<p><strong><?php echo $language_dict['hotline'] ?>:</strong> <a href="tel:<?php echo $infomations['mobile']; ?>"><?php echo $infomations['mobile']; ?></a></p>
								<p><strong><?php echo $language_dict['emailAddress'] ?>:</strong><a href="mailto:<?php echo $infomations['email']; ?>"><?php echo $infomations['email']; ?></a></p>
							</div>
							<div class="hidden-sm hidden-xs" style="margin-top: 25px;">
								<img src="img/logo.jpg" class="logo">
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-7">
				<div class="newsitem-block" style="margin-top: 10px;">
					<div class="pos-relative">
						<h2 class="block-title text-secondary-font"><?php echo $language_dict['sendContact'] ?></h2>
						<div>
							<div>
								<?php echo $infomations['contactformintro']; ?>
							</div>	
							<div class="the-form-wrapper">
								<form action="page/contact" method="post"><input name="__RequestVerificationToken" type="hidden" value="LqgBfKVBe4KPRiP4dXbIv5DHmd4mRWjgaeCcyWWQbVC-F4HXClAXJ9kQ347pwEPGx5S_9DRdc2nZv70zFF9LcHn87-U1">                        <div style="padding: 10px 0;">
									
									<?php
									if (isset($viewData["Success"]))
									{
										?>
										<div class="alert alert-success alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<h4><i class="fa fa-check-circle"></i> Success</h4>
											<div>
												<?php echo $viewData["Success"]; ?>
											</div>
										</div>
										<?php
									}

									if (isset($viewData["Failed"]))
									{
									?>
										<div class="alert alert-danger alert-dismissable">
											<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
											<h4><i class="fa fa-check-circle"></i> Error</h4>
											<div>
												<?php echo $viewData["Failed"]; ?>
											</div>
										</div>
									<?php
									}
									?>
									</div>
										<table class="table-responsive">
											<tbody>
												<tr>
													<td style="width: 1%; white-space: nowrap;" class="text-nowrap">
														<div class="label-wrapper">
															<label for="TITLE_CONTACT"><?php echo $language_dict["contactTitle"]; ?> <span class="text-danger">*</span></label>
														</div>
													</td>
													<td>
														<div class="input-wrapper">
															<input autocomplete="off" class="input title" id="TITLE_CONTACT" name="TITLE_CONTACT" type="text" value="<?php echo $this->input->post("TITLE_CONTACT"); ?>">
														</div>
													</td>
												</tr>
												<tr>
													<td style="width: 1%; white-space: nowrap;" class="text-nowrap">
														<div class="label-wrapper">
															<label for="CONTENT_CONTACT"><?php echo $language_dict["contactContent"]; ?> <span class="text-danger">*</span></label>                            
														</div>
													</td>
													<td>
														<div class="input-wrapper">
															<input id="STATUS_CONTACT" name="STATUS_CONTACT" type="hidden" value="0">
															<input id="IS_REPLY" name="IS_REPLY" type="hidden" value="False">
															<textarea autocomplete="off" class="textarea message" cols="20" id="CONTENT_CONTACT" name="CONTENT_CONTACT" placeholder="<?php echo $language_dict["contactContentPlaceHolder"]; ?>" rows="2"><?php echo $this->input->post("CONTENT_CONTACT"); ?></textarea>

														</div>
													</td>
												</tr>
												<tr>
													<td style="width: 1%; white-space: nowrap;" class="text-nowrap">
														<div class="label-wrapper">
															<label for="NAME_CONTACT"><?php echo $language_dict["contactName"]; ?> <span class="text-danger">*</span></label>
														</div>
													</td>
													<td>
														<div class="input-wrapper">
															<input autocomplete="off" class="input title" id="NAME_CONTACT" name="NAME_CONTACT" type="text" value="<?php echo $this->input->post("NAME_CONTACT"); ?>">
														</div>
													</td>
												</tr>
												<tr>
													<td style="width: 1%; white-space: nowrap;" class="text-nowrap">
														<div class="label-wrapper">
															<label for="EMAIL_CONTACT"><?php echo $language_dict["contactEmail"]; ?> <span class="text-danger">*</span></label>
														</div>
													</td>
													<td>
														<div class="input-wrapper">
															<input autocomplete="off" class="input title" id="EMAIL_CONTACT" name="EMAIL_CONTACT" type="email" value="<?php echo $this->input->post("EMAIL_CONTACT"); ?>">
														</div>
													</td>
												</tr>
												<tr>
													<td style="width: 1%; white-space: nowrap;" class="text-nowrap">
														<div class="label-wrapper">
															<label for="PHONE_CONTACT"><?php echo $language_dict["contactPhone"]; ?> <span class="text-danger">*</span></label>
														</div>
													</td>
													<td>
														<div class="input-wrapper">
															<input autocomplete="off" class="input title" id="PHONE_CONTACT" name="PHONE_CONTACT" type="tel" value="<?php echo $this->input->post("PHONE_CONTACT"); ?>">
														</div>
													</td>
												</tr>
												<tr>
													<td style="width: 1%; white-space: nowrap;" class="text-nowrap">

													</td>
													<td>
														<img src="page/captcha" style="height: 50px;" />
													</td>
												</tr>
												<tr>
													<td style="width: 1%; white-space: nowrap;" class="text-nowrap">
														<div class="label-wrapper">
															<label for="title"><?php echo $language_dict["contactSecurityCode"]; ?> <span class="text-danger">*</span></label>
														</div>
													</td>
													<td>
														<div class="input-wrapper">
															<input autocomplete="off" class="input title" id="CaptchaCode" name="CaptchaCode" type="text" value="">
														</div>
													</td>
												</tr>
												<tr>
													<td style="width: 1%; white-space: nowrap;"></td>
													<td style="white-space: nowrap;" class="text-nowrap">
														<div class="submit-wrapper">
															<button type="submit" name="submit" class="btn btn-lg text-primary-font" style="background-color: #c12f32; color: #fff;">
																<i class="fa fa-paper-plane-o"></i>&nbsp;&nbsp;<?php echo $language_dict["contactSendBtn"]; ?>
															</button>
														</div>
													</td>
												</tr>
											</tbody>
										</table>
								</form>                
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	

</section>


<style>
	.gm-style .place-card-large {
		padding-top: 35px !important;
	}
	
	
	.the-form-wrapper {
		border: 1px solid #f4f4f4;
		border-radius: 3px;
		margin-bottom: 10px;
		padding: 14px 14px 10px;
		display: inline-block;
		width: 100%;
	}

	.the-form-wrapper .topic-filter-wrapper {
		background-color: #fff;
		background-image: url(content/desktop/images/site/contact-us-form-shadow.jpg);
		background-position: 100% 38px;
		background-repeat: no-repeat;
		margin-bottom: 15px;
		padding: 0 0 29px;
		height: 20px;
	}

	.the-form-wrapper table {
		margin-bottom: 15px;
		border: none !important;
	}

		.the-form-wrapper table td {
			vertical-align: top;
			padding: 10px 0;
		}

			.the-form-wrapper table td .label-wrapper {
				float: left;
				text-align: right;
				width: 100%;
				padding-right: 5px;
			}

	.the-form-wrapper .row-wrapper .input-wrapper {
		float: right;
		width: 100%;
		position: relative;
		color: #f00 !important;
	}

	.the-form-wrapper table td .label-wrapper label,
	.the-form-wrapper table td .input-wrapper input,
	.the-form-wrapper table td .input-wrapper textarea {
		border-color: #ddd;
		font-size: 14px;
		height: auto;
		line-height: 35px;
		margin: 0;
		padding: 0 8px;
		resize: none;
		width: 100%;
		border-radius: 0px;
		box-shadow: none;
	}

	.the-form-wrapper table td .input-wrapper textarea {
		height: 100px;
		line-height: 18px;
		padding: 0;
		border: none;
		padding: 10px 8px;
		border: 1px solid #ddd;
		color: #f00 !important;
	}

	.the-form-wrapper table td .input-wrapper textarea {
		font-size: 14px;
		line-height: 24px;
		margin: 0;
		padding: 5px 5px;
		resize: none;
		width: 100%;
	}

	.the-form-wrapper input, .the-form-wrapper textarea, .the-form-wrapper select {
		background: #fff;
		border: 1px solid #999;
		border-radius: 3px;
		box-shadow: 0 1px 1px rgba(0,0,0,.075) inset;
		font-size: 1em;
		line-height: 1.8em;
		margin: 0;
		transition: border .2s linear .2s,box-shadow .2s linear .2s;
		-webkit-transition: border .2s linear .2s,box-shadow .2s linear .2s;
		-moz-transition: border .2s linear .2s,box-shadow .2s linear .2s;
		color: #f00 !important;
	}


</style>
