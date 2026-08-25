
<!-- Timeline Widget -->
<div class="widget">
    <div class="widget-extra themed-background-dark">
        <h3 class="widget-content-light">
            <strong>Quản lý người dùng</strong>
        </h3>
        <div class="widget-options">
			<div class="btn-group">
				<a href="admin/manage/adduser-module-user" class="btn btn-default">
					<i class="fa fa-plus"></i> Thêm mới
				</a>
			</div>
		</div>
    </div>
    <div class="widget-extra" style="height: auto !important;">
        
        <div style="padding: 0 0;">
            <form action="admin/manage/listuser-module-user" accept-charset="UTF-8" method="get" >
            
				<table class="table table-borderless middle-verticle" style="margin-bottom: 0; margin-top: 0;">
					<tr>
						<th class="text-left text-nowrap" style="padding-left: 0;">
							<label>Tìm kiếm người dùng</label>
							<div class="input-group">
								<input type="text" class="form-control form-control-lg" name="searchq" value="<?php echo $this->input->get('searchq'); ?>" placeholder="Nhập từ khoá tìm kiếm.." />
								<div class="input-group-btn">
									<button type="submit" class="btn btn-warning btn-lg">
										<i class="fa fa-search"></i><span class="hidden-xs hidden-sm" style="display: inline !important;">&nbsp;&nbsp;Tìm kiếm</span>
									</button>
									<a href="admin/manage/listuser-module-user" class="btn btn-primary btn-lg">
										<i class="fa fa-refresh"></i><span class="hidden-xs hidden-sm" style="display: inline !important;">&nbsp;&nbsp;Làm mới</span>
									</a>
								</div>
							</div>
						</th>
					</tr>
				</table>
            </form>
            
		    <?php  if(isset($contentModel) && count($contentModel) > 0) { ?>
            <div class="table-responsive">
                <table class="table table-borderless table-condensed table-striped table-hover text-center middle-verticle">
                    <thead class="tbhead-color">
                        <tr>
                            <th class="text-left">
                                Tên người dùng
                            </th>
                            <th class="text-center text-nowrap">
                                Loại người dùng
                            </th>
                            <th class="text-center text-nowrap" style="width: 1%;">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="article-list">                       
						<?php 							
							foreach ($contentModel as $row)
							{
						?>
								<tr>
									
									<td class="text-left" style="padding: 8px;">
										
										<div>
											Tên người dùng: <strong><?php echo $row->FULL_NAME; ?></strong>
											
										</div>
										<div>Tên đăng nhập: <strong><?php echo $row->USERNAME; ?></strong></div>
										<div class="divcellsize"></div>
									</td>
									<td class="text-nowrap">
										<span class="label label-<?php echo ($row->IS_ADMIN == 1) ? "danger" : "success"; ?>">
											<?php echo ($row->IS_ADMIN == 1) ? "ADMIN USER" : "NORMAL USER"; ?>
										</span>
										
										<div class="divcellsize"></div>
									</td>
									<td class="text-nowrap">
										<a href="admin/manage/modifyuser-module-user?id=<?php echo $row->USERNAME; ?>" class="btn btn-info">
											<i class="fa fa-pencil"></i>
										</a>
										<?php if ($row->IS_ADMIN != 1){ ?>
										<a href="admin/manage/deleteuser-module-user?id=<?php echo $row->USERNAME; ?>" 
										  onClick="return confirm('Xác nhận xoá bản ghi này ?');"
										  class="btn btn-danger">
											<i class="gi gi-bin"></i>
										</a>
										<?php }	 ?>
										<div class="divcellsize"></div>
									</td>
								</tr>
						<?php }	 ?>
                    </tbody>
                </table>
                
				<div class="text-center">
					<?php 
						$config['base_url'] = 'admin/manage/listuser-module-user';
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
    </div>
</div>

<style>
	#article-list td{
		position: relative;
	}
</style>

