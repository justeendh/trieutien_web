<?php
    if(get_cookie("admin-language") == "En-US") { require 'lang-en.php'; }
    else { require 'lang-vi.php'; }
    $langQuery = get_cookie("admin-language"); 
?>

<!-- Dashboard Header -->
<!-- For an image header add the class 'content-header-media' and an image as in the following example -->
<div class="content-header content-header-media">
    <div class="header-section">
        <div class="row">
            <!-- Main Title (hidden on small devices for the statistics to fit) -->
            <div class="col-md-8 col-lg-8">
                <h1>
                	<i style="display: inline; line-height: 32px; margin: 0; float: none; font-size: inherit; color: #ffd400;" 
                	 class="fa fa-smile-o"></i> 
					<?php echo $language_dict['helloAdmin']; ?> <strong><?php echo $this->session->fullname; ?></strong><small></small></h1>
					<?php 
					if(get_cookie("admin-language") == "En-US") {
						$greeting= array(
							"aloha"=>"Truth is the most precious thing we have. Please save it",
							 "rawr"=>"Sometimes, you won't know how precious those moments are until they turn into beautiful memories",
							 "ahoy"=>"Like to have to move to the destination. Once not moving, missing without explanation",
							 "salutations"=>"The greatest disease of this era is when people feel that they are unloved",
							 "bonjour"=>"Very pleased to serve you you",
							 "gday"=>"What matters is not where we stand, but where we are going",
							 "whatsup"=>"The wise do not speak much, listen much, Choose the answers, choose the questions",
							 "hello"=>"Every day is a gift that life has given us",
							 "hola"=>"Trust is a power that can turn the impossible into a possible",
							 "hey"=>"Remember to log out after you're done!",
							 "yo"=>"People may forget what you said, but what you leave in their heart is never faded",
							 "hi"=>"The true mission of man is to live, not to exist",
							 "howdy"=>"Life is never a deadlock or the concept of losing everything once you have faith",
							 "sup"=>"Beautiful memories and memories will help people overcome the challenges of life"
						);
					}
					else{
						$greeting= array(
							"aloha"=>"Sự thật là điều quý giá nhất mà chúng ta có. Hãy tiết kiệm nó",
							"rawr"=>"Đôi khi, bạn sẽ chẳng biết được những khoảnh khắc quý giá đến nhường nào cho đến khi chúng biến thành những kí ức đẹp",
							"ahoy"=>"Thích là phải nhích cho tới đích. Một khi không nhích thì mất tích không cần giải thích",
							"salutations"=>"Căn bệnh lớn nhất của thời đại này đó là khi người ta cảm thấy mình không hề được yêu thương",
							"bonjour"=>"Rất hân hạnh được phục vụ bạn bạn",
							"gday"=>"Điều quan trọng ko phải vị trí ta đang đứng, mà ở hướng ta đang đi",
							"whatsup"=>"Người khôn nói ít, nghe nhiều, Lựa lời đối đáp, lựa điều hỏi han",
							"hello"=>"Mỗi ngày là một món quà mà cuộc sống đã ban tặng cho chúng ta",
							"hola"=>"Niềm tin là một sức mạnh có thể biến điều ko thể thành điều có thể",
							"hey"=>"Nhớ đăng xuất sau khi làm việc xong nhé !",
							"yo"=>"Người ta có thể quên đi điều bạn nói, nhưng những gì bạn để lại trong lòng họ thì ko bao giờ nhạt phai",
							"hi"=>"Sứ mệnh chân chính của con người là sống, chứ không phải tồn tại",
							"howdy"=>"Cuộc sống ko bao giờ là bế tắc thực sự hay có khái niệm mất tất cả một khi bạn còn có niềm tin",
							"sup"=>"Những kí ức và kỷ niệm đẹp sẽ giúp con người vượt qua những thử thách của cuộc sống"
					   );
					}

						//echo greeting
						
					?>
               	<table style="width: 100%; margin-top: 5px;">
               		<tr>
               			<td style="vertical-align: top !important;">
               				<h4 style="line-height: 28px; margin: 0;"><small><?php echo (randomArrayVar($greeting)); ?></small></h4>
               			</td>
               		</tr>
               	</table>
                
            </div>
            <div class="col-md-4 col-lg-4 text-right">
            	<span style="color: #fafafa;">
					<label class="switch switch-warning">
						<input type="checkbox" id="ENABLE_SITE" name="ENABLE_SITE" value="1" 
							<?php 
							   $querysiteActive = $this->db->query("SELECT KEY_INFO, VAL_INFO FROM hd_infomations WHERE KEY_INFO = 'stopwebsite'");
							   if($querysiteActive->row()->VAL_INFO == "1") echo "checked" 
						   ?>><span></span>
					</label>&nbsp;&nbsp;&nbsp;
				</span>
           		<script type="text/javascript">
					$("#ENABLE_SITE").change(function () {
						var sender = $(this);
						var visible = $(this).prop("checked");
						$.ajax({
							method: "POST",
							url: "admin/manage/toogleenablesite-module-site", data: { "visible": visible }, success: function (result) {
								if (result.success) {
									$.bootstrapGrowl('<h4>SUCCESS!</h4> <p>Thao tác thực hiện thành công</p>', {
										type: "success",
										delay: 1000,
										allow_dismiss: true,
										offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
										align: 'left', // ('left', 'right', or 'center')
									});
								}
								else {
									sender.prop("checked", !show);
									var msg = result.msg || "Đã có lỗi xảy ra ! Vui lòng kiểm tra và thử lại";
									$.bootstrapGrowl('<h4>ERROR!</h4> <p>' + msg + '</p>', {
										type: "danger",
										delay: 2500,
										allow_dismiss: true,
										offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
										align: 'left', // ('left', 'right', or 'center')
									});
								}
							}
						});
					});
				</script>
            	<div>
            		<h4 style="margin: 5px 15px;"><?php echo $language_dict['accessCount']; ?>: <strong style="color: #ffd600;" id="txtVisitorCount"><?php echo count_visitor(false); ?></strong></h4>
            	</div>
            </div>
            <!-- END Main Title -->

        </div>
        <div class="hidden-xs hidden-sm" style="margin-bottom: 15px; margin-top: 15px; padding-bottom: 15px;">
            <a class="weatherwidget-io" href="https://forecast7.com/en/16d05108d20/da-nang/" data-label_1="ĐÀ NẴNG" data-label_2="WEATHER" data-font="Roboto" data-icons="Climacons Animated" data-theme="pure" >ĐÀ NẴNG WEATHER</a>
            <script>
            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://weatherwidget.io/js/widget.min.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","weatherwidget-io-js");
            </script>
        </div>
    </div>
    <!-- For best results use an image with a resolution of 2560x248 pixels (You can also use a blurred image with ratio 10:1 - eg: 1000x100 pixels - it will adjust and look great!) -->
    <img src="img/placeholders/headers/dashboard_header.jpg" alt="header image" class="animation-pulseSlow">
</div>
<!-- END Dashboard Header -->

<!-- Mini Top Stats Row -->

<!-- Widgets Row -->
<div style="padding: 0px 5px 15px;">

	<div class="hidden-md hidden-lg" style="margin-bottom: 15px; margin-top: 20px;">
		<a class="weatherwidget-io" href="https://forecast7.com/en/16d05108d20/da-nang/" data-label_1="ĐÀ NẴNG" data-label_2="WEATHER" data-font="Roboto" data-icons="Climacons Animated" data-theme="pure" >ĐÀ NẴNG WEATHER</a>
		<script>
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://weatherwidget.io/js/widget.min.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","weatherwidget-io-js");
		</script>
	</div>
	
	<div class="row">
		<div class="col-md-12">
			<div class="block full" style="margin: 0 0 10px; padding: 8px;">
				<div style="margin-top: 8px;" id="visitbydate-chart-live"></div>
			</div>
			<!-- END Web Server Block -->

		</div>
		
		<div class="col-md-12">
			<div class="block full" style="margin: 0 0 10px; padding: 8px;">
				<div class="row">
					<div class="col-md-5">
						<div style="margin-top: 8px;" id="container-login-logout-browser"></div>
					</div>
					<div class="col-md-3">
						<h4><strong><?php echo $language_dict['tableAccessCount']; ?></strong></h4>
						<table id="example-datatable" class="table table-vcenter table-condensed table-bordered table-striped table-hover">
							<thead>
								<tr role="row" style="background-color: #394263; color: #fff;">
									<th style="width: 1%;"><?php echo $language_dict['browser']; ?></th>
									<th class=" text-right text-nowrap"><?php echo $language_dict['traffic']; ?></th>
									<th class=" text-right">%</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$arrayBrowserLabel = array();
									$TotalBrowsers = $this->db->query("SELECT SUM(COUNTER) TOTAL_COUNT FROM hd_userbybrowserlogs WHERE TYPE_LOGS = 'browser'");
									$browserCounter = $this->db->query("SELECT * FROM hd_userbybrowserlogs WHERE TYPE_LOGS = 'browser'");
									foreach($browserCounter->result() as $row) {
										if($row->COUNTER > 0) array_push($arrayBrowserLabel, array("name" => $row->SHORT_NAME, "y" => (int)$row->COUNTER));
								?>
								<tr role="row" class="odd">
									<td class="text-nowrap"><?php echo $row->NAME_LOGS; ?></td>
									<td class="text-nowrap text-right"><?php echo $row->COUNTER; ?></td>
									<td class="text-nowrap text-right">
										<?php echo number_format(($TotalBrowsers->row()->TOTAL_COUNT == 0 ? 0 : $row->COUNTER/$TotalBrowsers->row()->TOTAL_COUNT)*100, 1); ?> %
									</td>
								</tr>
								<?php } ?>
							</tbody>
							<thead>
								<tr role="row" style="background-color: #394263; color: #fff;">
									<th class="text-nowrap" style="width: 1%;"><?php echo $language_dict['operator']; ?></th>
									<th class=" text-right text-nowrap"><?php echo $language_dict['traffic']; ?></th>
									<th class=" text-right">%</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$TotalOSs = $this->db->query("SELECT SUM(COUNTER) TOTAL_COUNT FROM hd_userbybrowserlogs WHERE TYPE_LOGS = 'os'");
									$browserCounter = $this->db->query("SELECT * FROM hd_userbybrowserlogs WHERE TYPE_LOGS = 'os'");
									foreach($browserCounter->result() as $row) {
								?>
								<tr role="row" class="odd">
									<td class="text-nowrap"><?php echo $row->NAME_LOGS; ?></td>
									<td class="text-nowrap text-right"><?php echo $row->COUNTER; ?></td>
									<td class="text-nowrap text-right">
										<?php echo number_format (($TotalOSs->row()->TOTAL_COUNT == 0 ? 0 : $row->COUNTER/$TotalOSs->row()->TOTAL_COUNT)*100, 1); ?> %
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-4 text-right hidden-xs hidden-sm">
						<h4><strong>&nbsp;</strong></h4>
						<img src="img/browser-img.png" />
					</div>
				</div>
			</div>
			<!-- END Web Server Block -->
		</div>
		
	</div>
	
	
</div>


<!-- END Widgets Row -->
<?php  if($this->input->get("changepasswordfailed") != ""){ ?>
<script>
	var msg = result.msg || "Đã có lỗi xảy ra khi đổi mật khẩu ! Vui lòng kiểm tra và thử lại";
	$.bootstrapGrowl('<h4>ERROR!</h4> <p>' + msg + '</p>', {
		type: "danger",
		delay: 2500,
		allow_dismiss: true,
		offset: { from: 'top', amount: 20 }, // 'top', or 'bottom'
		align: 'left', // ('left', 'right', or 'center')
	});
</script>
<?php } ?>

<script>
	$('.articlenameellipsis').ellipsis({
		row: 1,
		onlyFullWords: false,
		position: 'tail'
	});
	
	function getPathFromUrl() {
	  return window.location.href.split(/[?#]/)[0];
	}
	window.history.pushState("", "Administrators Trieu Tien Portal", "admin");

	
</script>
<script src="js/highcharts.js"></script>
<script>
	function getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}
	
	$("#txtVisitorCount").text($.number( parseInt($("#txtVisitorCount").text()), 0, ',', ' ' ));
	
	<?php 
		$arrayXlb = array();
		$arrayValues = array();
		$queryXlabels = $this->db->query("SELECT DATE_ACCESS, COUNTER FROM hd_userbydatelogs ORDER BY DATE_ACCESS DESC LIMIT 30");
	    foreach($queryXlabels->result() as $row){
			array_push($arrayXlb,  $row->DATE_ACCESS);
			array_push($arrayValues,  $row->COUNTER);
			//echo $row->DATE_ACCESS." ";
		}
		$arrayXlb =array_reverse ($arrayXlb);
		$arrayValues = array_reverse ($arrayValues);
	?>
	var arrayXlb = <?php  print(json_encode($arrayXlb)); ?>;
	var arrayValues = <?php  print(json_encode($arrayValues)); ?>;
	
	var arrayBrowserLabel = <?php  print(json_encode($arrayBrowserLabel)); ?>;
	
	var visitorChart = Highcharts.chart('visitbydate-chart-live', {
		chart: {
			height: 330,
			type: 'areaspline',
			zoomType: 'x',
			panning: true,
			panKey: 'shift',
			scrollablePlotArea: {
				minWidth: 100
			},
			marginRight : 0,
			animation: Highcharts.svg
		},
		title: {
			text: '<?php echo $language_dict['chart30day']; ?>',
			style : { "font-family" : "Tahoma", "font-weight" : "bold",  "color" : "#333", "font-size" : "18px", "text-align" : "left" }
		},
		//time: { useUTC: false },
		xAxis: {
			categories : arrayXlb,
			 startOnTick: false,
        	minPadding: 0.2
		},
		yAxis: {
			title: {
				text: '<?php echo $language_dict['traffic']; ?>',
				style : { "font-family" : "Tahoma", "font-weight" : "bold",  "color" : "#333", "font-size" : "18px", "text-align" : "left" }
			}, tickInterval : 10
		},
		legend: { enabled: false },
		plotOptions: {
			areaspline: {
				dataLabels: {
					enabled: true
				},
				fillColor: {
					linearGradient: {
						x1: 0,
						y1: 0,
						x2: 0,
						y2: 1
					},
					stops: [
						[0, Highcharts.getOptions().colors[2]],
						[1, Highcharts.Color(Highcharts.getOptions().colors[2]).setOpacity(0.2).get('rgba')]
					]
				},
				marker: {
					fillColor : Highcharts.getOptions().colors[1],
					lineColor: Highcharts.getOptions().colors[1],
					enabled: false
				}
			},
			line: {
				dataLabels: {
					enabled: true
				},
				enableMouseTracking: false,
				marker: {
					fillColor : Highcharts.getOptions().colors[1],
					lineColor: Highcharts.getOptions().colors[1],
					enabled: false
				}
			}
		},
		series: [{
			name: '<?php echo $language_dict['accessCount']; ?>',
        	color: Highcharts.getOptions().colors[1],
			data: (function () {
				var dataChartVisitInit = [];	
				 	
				for (i = 0; i < arrayValues.length; i += 1) {
					dataChartVisitInit.push({y : parseInt(arrayValues[i]), id : arrayXlb[i]});
				}
				return dataChartVisitInit;
			}())
		}]
	});
	
	
	Highcharts.chart('container-login-logout-browser', {
		chart: {
			plotBackgroundColor: null,
			plotBorderWidth: null,
			plotShadow: false,
			type: 'pie'
		},
		title: {
			text: '<?php echo $language_dict['chartBrowserPercent']; ?>',
			style : { "font-family" : "Tahoma", "font-weight" : "bold",  "color" : "#333", "font-size" : "18px", "text-align" : "left" }
		},
		tooltip: {
			pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
		},
		plotOptions: {
			pie: {
				allowPointSelect: true,
				cursor: 'pointer',
				dataLabels: {
					enabled: false
				},
				showInLegend: true,
				dataLabels: {
					enabled: false,
					format: '<b>{point.name}</b>: {point.percentage:.1f} %',
					style: {
						color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
					}
				}
			}
		},
		legend: { enabled: true },
		series: [{
			name: 'Tỉ lệ',
			colorByPoint: true,
			data: arrayBrowserLabel
		}]
	});

	
	
	
	var disableScrollHighChart = function(){
		$(".highcharts-scrolling").css("overflow", "hidden");
		$('.highcharts-scrolling').scrollLeft(1000);
	}
	
	disableScrollHighChart();
	// set up the updating of the chart each second
	
	$(window).resize(function(){
		disableScrollHighChart();
	});
	
	
	var pushDataLogs = function(){
		$.ajax({
			method: "POST",
			url: "admin/manage/getlogsupdated-module-admin", success: function (result) {
				var resultData = JSON.parse(result);
				$("#txtVisitorCount").text($.number( parseInt(resultData.countvisitor), 0, ',', ' ' ));
				var point = visitorChart.get(resultData.counterdate.date);
        		point.update(parseInt(resultData.counterdate.counter));
				//visitorChart.series[0].addPoint({ x: Math.round((new Date()).getTime()/1000*1000), y: getRandomInt(10, 100)}, true, true);
				setTimeout(function(){
					pushDataLogs();
				}, 3000);
			}
		});
	}	
	
	
	pushDataLogs();
	
</script>       
       
       
       
       
       
        