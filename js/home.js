$(document).ready(GetSession()); //浏览器加载完成执行函数
$(document).ready(Go(5));

$(function() {
	var data, options;

	// headline charts
	data = {
		labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
		series: [
			[23, 29, 24, 40, 25, 24, 35],
			[14, 25, 18, 34, 29, 38, 44],
		]
	};

	options = {
		height: 300,
		showArea: true,
		showLine: false,
		showPoint: false,
		fullWidth: true,
		axisX: {
			showGrid: false
		},
		lineSmooth: false,
	};

	new Chartist.Line('#headline-chart', data, options);

	// visits trend charts
	data = {
		labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
		series: [{
			name: 'series-real',
			data: [200, 380, 350, 320, 410, 450, 570, 400, 555, 620, 750, 900],
		}, {
			name: 'series-projection',
			data: [240, 350, 360, 380, 400, 450, 480, 523, 555, 600, 700, 800],
		}]
	};

	options = {
		fullWidth: true,
		lineSmooth: false,
		height: "270px",
		low: 0,
		high: 'auto',
		series: {
			'series-projection': {
				showArea: true,
				showPoint: false,
				showLine: false
			},
		},
		axisX: {
			showGrid: false,

		},
		axisY: {
			showGrid: false,
			onlyInteger: true,
			offset: 0,
		},
		chartPadding: {
			left: 20,
			right: 20
		}
	};

	new Chartist.Line('#visits-trends-chart', data, options);

	// visits chart
	data = {
		labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
		series: [
			[6384, 6342, 5437, 2764, 3958, 5068, 7654]
		]
	};

	options = {
		height: 300,
		axisX: {
			showGrid: false
		},
	};

	new Chartist.Bar('#visits-chart', data, options);

	// real-time pie chart
	var sysLoad = $('#system-load').easyPieChart({
		size: 130,
		barColor: function(percent) {
			return "rgb(" + Math.round(200 * percent / 100) + ", " + Math.round(200 * (1.1 - percent / 100)) + ", 0)";
		},
		trackColor: 'rgba(245, 245, 245, 0.8)',
		scaleColor: false,
		lineWidth: 5,
		lineCap: "square",
		animate: 800
	});

	var updateInterval = 3000; // in milliseconds

	setInterval(function() {
		var randomVal;
		randomVal = getRandomInt(0, 100);

		sysLoad.data('easyPieChart').update(randomVal);
		sysLoad.find('.percent').text(randomVal);
	}, updateInterval);

	function getRandomInt(min, max) {
		return Math.floor(Math.random() * (max - min + 1)) + min;
	}

});

//判断session
function GetSession() {
	$("#apply").hide();
	$("#index").show();
	$("#changes_info").hide(); //div隐藏显示
	$.ajax({
		type: "POST",
		url: "../login_judge.php",
		dataType: "json",
		data: {
			"result": "test"
		},
		success: function(response) {
			if(response.msg == "失败！") {
				alert("还没有登陆，请重新登陆！");
				window.location.href = "../user.html";
			} else {
				$("#user_name").html("亲爱的:" + response.studentnumber);
				//$("#user_name").html("亲爱的:"+response.name);
			}
		},
		error: function(err) {
			alert("登陆异常,请联系管理员！");
			window.location.href = "../user.html";
		}
	});
}

//go控制div显示隐藏 start
function Go(n) {
	switch(n) {
		case 0:
			$("#apply").hide();
			$("#index").show();
			//$("#changes_info").hide();
			break;
		case 1:
			$("#apply").show();
			$("#index").hide();
			//$("#changes_info").hide();
			break;
		case 2: //报名表提交
			{
				var data = {
					"n": "2",
					"name": $("#name").val(),
					"iphone": $("#iphone").val(),
					"stuNumber": $("#stuNumber").val(),
					"zhuanye": $("#zhuanye").val(),
					"qq": $("#qq").val(),
					"home": $("#home").val(),
					"profile": $("#profile").val(),
					"profile1": $("#profile1").val(),
					"profile2": $("#profile2").val(),
					"profile3": $("#profile3").val()
				};
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "php_method.php",
					data: data,
					success: function(response) {
						alert(response);
					},
					error: function(err) {
						alert(err);
					}
				})
			}
		case 3:
			$("#apply").hide();
			$("#index").hide();
			$("#mymodal").modal("toggle");
			break;
		case 4: //修改个人信息
			{
				var data = {
					"n": "4",
					"name": $("#change_name").val(),
					"studentnumber": $("#change_studentnumber").val(),
					"email": $("#change_email").val(),
					"phone": $("#change_phone").val(),
					"qq": $("#change_qq").val(),
					"major": $("#change_major").val(),
					"hometown": $("#change_hometown").val()
				};
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "php_method.php",
					data: data,
					success: function(response) {
						alert(response.msg);
					},
					error: function(err) {
						alert(err.msg);
					}
				})
				break;
			}
		case 5: //显示修改页信息
			{
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "php_method.php",
					data: {
						"n": "5"
					},
					success: function(response) {
						$("#change_name").val(response.name);
						$("#change_studentnumber").val(response.studentnumber);
						$("#change_email").val(response.email);
						$("#change_phone").val(response.phone);
						$("#change_qq").val(response.qq);
						$("#change_major").val(response.major);
						$("#change_hometown").val(response.hometown);
					},
					error: function(err) {
						//alert(err);
					}
				})
				break;
			}
	}
}
//go div显隐end

//			//echarts start使用echarts展示报名进度条
//			var myChart = echarts.init(document.getElementById('index'));
//			var option = {
//				tooltip: {
//					trigger: 'item',
//					formatter: "{a} <br/>{b} : {c} ({d}%)"
//				},
//				legend: {
//					orient: 'vertical',
//					x: 'left',
//					data: ['报名进度']
//				},
//				toolbox: {
//					show: true,
//					feature: {
//						mark: {
//							show: true
//						},
//						dataView: {
//							show: true,
//							readOnly: false
//						},
//						magicType: {
//							show: true,
//							type: ['pie', 'funnel'],
//							option: {
//								funnel: {
//									x: '25%',
//									width: '50%',
//									funnelAlign: 'center',
//									max: 1548
//								}
//							}
//						},
//						restore: {
//							show: true
//						},
//						saveAsImage: {
//							show: true
//						}
//					}
//				},
//				calculable: true,
//				series: [{
//					name: '报名进度',
//					type: 'pie',
//					radius: ['50%', '70%'],
//					itemStyle: {
//						normal: {
//							label: {
//								show: false
//							},
//							labelLine: {
//								show: false
//							}
//						},
//						emphasis: {
//							label: {
//								show: true,
//								position: 'center',
//								textStyle: {
//									fontSize: '30',
//									fontWeight: 'bold'
//								}
//							}
//						}
//					},
//					data: [{
//						value: 335,
//						name: '报名进度'
//					}, ]
//				}]
//			};// 使用刚指定的配置项和数据显示图表。
//      myChart.setOption(option);
//      //echarts end