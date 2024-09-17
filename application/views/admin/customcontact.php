
<!-- Timeline Widget -->
<div class="widget">
    <div class="widget-extra themed-background-dark">
        <h3 class="widget-content-light">
            <strong>DANH SÁCH LIÊN HỆ</strong>
        </h3>
    </div>
    <div class="widget-extra" style="height: auto !important;">
        <div style="padding: 0 0;">
			 <form action="admin/manage/customcontact-module-contact" accept-charset="UTF-8" method="get" >

				<?php 
					$currentURL = current_url();
					if(base_url() != '/') $currentURL = str_replace(base_url(), "", $currentURL);
					$paramsQrs   = $_SERVER['QUERY_STRING'];
					parse_str($paramsQrs, $get_array);
					unset($get_array["viewtype"]);
				 	unset($get_array["per_page"]);
					$newParamQrs = http_build_query($get_array);
				?>
				<div style="margin-top: 10px;">
					<div class="btn-group">
						<a href="<?php echo $currentURL; echo ((count($get_array) > 0) ? "?".$newParamQrs."&" : "?")."viewtype=all" ?>"
							 class="btn btn-success">
							 <?php if($this->input->get('viewtype') == "all" || $this->input->get('viewtype') == "" ) echo "<i class='fa fa-check'></i>&nbsp;&nbsp;"; ?>Tất cả liên hệ</a>
						<a href="<?php echo $currentURL; echo ((count($get_array) > 0) ? "?".$newParamQrs."&" : "?")."viewtype=0" ?>" 
							class="btn btn-danger">
							<?php if($this->input->get('viewtype') == "0") echo "<i class='fa fa-check'></i>&nbsp;&nbsp;"; ?>Liên hệ chưa xem</a>
						<a href="<?php echo $currentURL; echo ((count($get_array) > 0) ? "?".$newParamQrs."&" : "?")."viewtype=1" ?>" 
							class="btn btn-success">
							<?php if($this->input->get('viewtype') == "1") echo "<i class='fa fa-check'></i>&nbsp;&nbsp;"; ?>Liên hệ đã xem</a>
						<a href="<?php echo $currentURL; echo ((count($get_array) > 0) ? "?".$newParamQrs."&" : "?")."viewtype=2" ?>" 
							class="btn btn-success">
							<?php if($this->input->get('viewtype') == "2") echo "<i class='fa fa-check'></i>&nbsp;&nbsp;"; ?>Liên hệ đã xong</a>
					</div>
				</div>
				<table class="table table-borderless middle-verticle" style="margin-bottom: 0; margin-top: 0;">
					<tr>
						<th class="text-left text-nowrap" style="padding-left: 0;">
							<label>Tìm kiếm</label>
							<input name="searchq" value="<?php echo $this->input->get('searchq'); ?>" type="text" class="form-control form-control-lg" placeholder="Nhập từ khoá tìm kiếm.."/>
							<span class="help-block hidden-xs hidden-sm">Nhập thông tin tìm kiếm để tìm nhanh người dùng</span>
						</th> 
						<th class="text-left text-nowrap" style="width: 180px;">
							<label>Từ ngày</label>
							<input name="datecreatedfrom" value="<?php echo $this->input->get('datecreatedfrom'); ?>" type="text" class="form-control form-control-lg input-datepicker" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"/>
							<span class="help-block hidden-xs hidden-sm">Ngày nhận thư</span>
						</th>           
						<th class="text-left text-nowrap" style="width: 180px;">
							<label>Đến ngày</label>
							<input name="datecreatedto" value="<?php echo $this->input->get('datecreatedto'); ?>" type="text" class="form-control form-control-lg input-datepicker" data-date-format="dd-mm-yyyy" placeholder="dd-mm-yyyy"/>
							<span class="help-block hidden-xs hidden-sm">Ngày nhận thư</span>
						</th>                         
						<th class="text-nowrap" style="width: 1%; padding-right: 0;">
							<div><label>&nbsp;</label></div>
							<button type="submit" class="btn btn-warning btn-lg">
								<i class="fa fa-search"></i> <span class="hidden-xs hidden-sm">Tìm kiếm</span>
							</button> 
							<a href="admin/manage/customcontact-module-contact" class="btn btn-success btn-lg">
								<i class="fa fa-refresh"></i> <span class="hidden-xs hidden-sm">Làm mới</span>
							</a>     
							<div><span class="help-block hidden-xs hidden-sm">&nbsp;</span></div>
						</th>
					</tr>
				</table>
			</form>
            <?php if(isset($contentModel) && count($contentModel) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-hover table-vcenter">
                    <tbody>
                        <?php foreach($contentModel as $row) { ?>
                        <!-- Use the first row as a prototype for your column widths -->
                        <tr>                    
                            
                            <td class="text-center" style="width: 30px;">
                                <a href="javascript:void(0)" class="text-<?php echo (($row->STATUS_CONTACT == 0) ? "danger" : ($row->STATUS_CONTACT == 1 ? "warning" : "success") ); ?> msg-read-btn"><i class="fa fa-circle"></i></a>
                            </td>
                            <td class="text-nowrap" style="width: 1%;"><?php echo $row->NAME_CONTACT; ?></td>
                            <td class="text-left text-nowrap" style="overflow: hidden;">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_viewcontact_<?php echo $row->ID; ?>" data-backdrop="static" data-keyboard="false">
                                    <strong><?php echo $row->TITLE_CONTACT; ?></strong>
                                </a>
                            </td>
                            <td class="text-right text-nowrap" style="width: 1%;">
                            	<?php echo date('d-m-Y H:i:s', strtotime($row->DATE_CREATED)); ?>
							</td> 
                      		<td style="width: 1%; white-space: normal !important;">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#modal_viewcontact_<?php echo $row->ID; ?>" 
                                	data-backdrop="static" data-keyboard="false" class="btn btn-xs btn-success">Xem</a>
                                <!-- Modal -->
                                <div class="modal fade" id="modal_viewcontact_<?php echo $row->ID; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            
                                            <div class="modal-body" style="padding: 8px 15px;">
                                                <table class="table table-borderless table-vcenter remove-margin">
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center" style="width: 80px;">
                                                                <a href="page_ready_user_profile" class="pull-left">
                                                                    <img src="img/no-user-image.png" style="width: 80px;"
                                                                     alt="Avatar" class="img-circle">
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <h4 style="margin-top: 0; margin-bottom: 3px;"><strong><?php echo $row->NAME_CONTACT; ?></strong></h4>
                                                                <div><strong>Email: <?php echo $row->EMAIL_CONTACT; ?></strong></div>
                                                                <div><strong>Điện thoại: <?php echo $row->PHONE_CONTACT; ?></strong></div>
                                                                <div><strong>Ngày nhận: <?php echo date('d-m-Y H:i:s', strtotime($row->DATE_CREATED)); ?></strong></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                                <hr style="margin-top: 5px;" />
                                                <div>
                                                    <h3 style="margin-top: 0;">
                                                        <strong>
                                                            <?php echo $row->TITLE_CONTACT; ?>
                                                        </strong>
                                                    </h3>
                                                    <?php echo nl2br($row->CONTENT_CONTACT); ?>
                                                </div>
                                                <hr/>
                                                <div class="form-group">   
                                                    <button type="button" class="btn btn-danger btn-lg" data-dismiss="modal">Huỷ bỏ</button>   
                                                    <div class="pull-right">
                                                    	<?php 
															parse_str($paramsQrs, $get_array_set);
															unset($get_array_set["id"]);
															$newparamsQrsSetStt = http_build_query($get_array_set);
															  
															if($row->STATUS_CONTACT == 0 || $row->STATUS_CONTACT == 2){ 
														?>
                                                    	<a href="admin/manage/markviewcontact-module-contact?id=<?php echo $row->ID; ?>&<?php echo $newparamsQrsSetStt; ?>"
                                                    		onClick="return confirm('Đánh dấu đã xem mục này ?');" class="btn btn-success btn-lg">
															<i class="fa fa-eye"></i> Đánh dấu đã xem
														</a>         
														<?php } if($row->STATUS_CONTACT == 1 || $row->STATUS_CONTACT == 2) { ?>     
														<a href="admin/manage/markunviewcontact-module-contact?id=<?php echo $row->ID; ?>&<?php echo $newparamsQrsSetStt; ?>"
                                                    		onClick="return confirm('Đánh dấu chưa xem mục này ?');" class="btn btn-success btn-lg">
															<i class="fa fa-eye-slash"></i> Đánh dấu chưa xem
														</a>   
														<?php }  if($row->STATUS_CONTACT != 2) { ?>                                
														<a href="admin/manage/markreplycontact-module-contact?id=<?php echo $row->ID; ?>&<?php echo $newparamsQrsSetStt; ?>"
															onClick="return confirm('Đánh dấu đã trả lời mục này ?');" class="btn btn-success btn-lg">
															<i class="fa fa-check"></i> Đánh dấu đã xong
														</a>
                                                   		<?php } ?> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                
                <div class="text-center">
					<?php 		
						$config['base_url'] = 'admin/manage/customcontact-module-contact';
						$config['total_rows'] = (int)$viewData['TOTAL_REC'];
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
			<?php } else { ?>
            	<div class="text-center no-data">
					<div><i class="fa fa-4x fa-frown-o"></i></div>
					<h4>Không có dữ liệu hiển thị</h4>
				</div>
            <?php } ?>
            
            </div>
        </div>
    </div>
</div>
<!-- END Timeline Widget -->