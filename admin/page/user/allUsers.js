$(document).ready(GetSession());
//判断session
function GetSession() {
	$("#container").hide();
	$("#index").show();
	$("#changes_info").hide(); //div隐藏显示
	$.ajax({
		type: "POST",
		url: "../../../admin/login_judge.php",
		dataType: "json",
		data: {
			"result": "test"
		},
		success: function(response) {
			if(response.msg == "失败！") {
				alert("还没有登陆，请重新登陆！");
				window.location.href = "../../";
			} else {
				$("#user_name").html("亲爱的:" + response.studentnumber);
				//$("#user_name").html("亲爱的:"+response.name);
			}
		},
		error: function(err) {
			alert("登陆异常,请联系管理员！");
			window.location.href = "../../";
		}
	});
}

$(document).ready(getBar());
var userInfo =[];   //创建数组
var per_num;		//分页数
var studentnumber;   //学号
function getUserInfo(n) {  //取得一个用户信息的数组
	$("tr").remove(".trid");	 //每次换页时清空上一页的数据
	$("#nowP").text("当前是第:"+n+"页");     //显示当前页数
	var data = {
		'n': 0,
		'pageNow': n   //获得当前页面数
	};
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "allUsers.php",
		data: data,
		success: function (data){
			var list = data.list;
			$.each(list,function (index,val){
				userInfo["uid"] = val['uid'];   //数组添加uid的属性
				userInfo["studentnumber"] = val['studentnumber'];   //数组添加studentnumber的属性
				userInfo["name"] = val['name'];   //数组添加name的属性
				userInfo["email"] = val['email'];   //数组添加email的属性
				userInfo["phone"] = val['phone'];   //数组添加phone的属性
				userInfo["qq"] = val['qq'];   //数组添加qq的属性
				userInfo["major"] = val['major'];   //数组添加major的属性
				userInfo["hometown"] = val['hometown'];   //数组添加hometown的属性
				pageInfo();
			});
		},
		error: function (err){
			alert("信息获取失败");
		}
	});
}
function getBar(){     //获得分页数
	$.ajax({
		type: "POST",
		dataType: "json",
		url: "allUsers.php",
		data: {
			"n": "0",
			"pageNow": "1"
		},
		success: function (data){
			var list = data.list;
			$.each(list,function (index, val){
				per_num = val['per_num'];
			});
			setBar();    
		}
	});
}
function setBar(){   //创建分页
	for(var i=1; i<=per_num; i++){
		$("#after_btn").before("<li><a onclick='getUserInfo("+i+")"+"'>"+i+"</a></li>");   //添加分页
	}	
	getUserInfo(per_num);
}
function pageInfo(){  //设置分页信息
	$(".users_content").after(
						"<tr class='trid'><td>"+userInfo["uid"]+
						"</td><td id='stu'>"+userInfo["studentnumber"]+
						"</td><td>"+userInfo['name']+
						"</td><td>"+userInfo['email']+
						"</td><td>"+userInfo['phone']+
						"</td><td>"+userInfo['qq']+""+
						"</td><td>"+userInfo['major']+
						"</td><td>"+"<a onclick='showForm("+userInfo["studentnumber"]+")'>"+"查看"+"</a>"+
						"</td><td>"+"<a onclick='getOperation("+userInfo["studentnumber"]+")'>"+"改密/进度"+"</a>"+
						"</td></tr>"
				);					
}

function showForm(studentnumber){   //显示报名表数据
	$("#mymodal1").modal("toggle");
	$.ajax({
		type: "POST",
		dataType: "json",
		data: {
			"n": 1,
			"studentnumber": studentnumber
		},
		url: "allUsers.php",
		success: function (response){
			$("#profile").text(response.profile);
			$("#profile1").text(response.profile1);
			$("#profile2").text(response.profile2);
			$("#profile3").text(response.profile3);
		},
		error: function (err){
			alert("showForm失败");
		}
	})
}

function operation(studentnumber){   //改密 进度信息 进度百分比
	$.ajax({
		type: "POST",
		dataType: "json",
		data: {
			"n": 2,
			"studentnumber": studentnumber,
			"password": $("#password").val(),
			"progress_num": $("#progress_num").val(),
			"progress_msg": $("#progress_msg").val()
		},
		url: "allUsers.php",
		success: function (response){
			alert("修改成功");
		},
		error: function (err){
			alert("operation失败");
		}
	})	
}

function getOperation(studentnumber){   //显示 改密 进度信息 进度百分比 数据
	$("#mymodal").modal("toggle");
	$.ajax({
		type: "POST",
		dataType: "json",
		data: {
			"n": 3,
			"studentnumber": studentnumber
		},
		url: "allUsers.php",
		success: function (response){
			$("#password").text(response.password);
			$("#studentnumber111").text(studentnumber);
			$("#progress_num").text(response.progress);
			$("#progress_msg").text(response.progress_msg);
		},
		error: function (err){
			alert("getOperation失败");
		}
	})	
}
function putOperation(){   //执行operation修改密码 进度信息
	var stu = $("#studentnumber111").val();
	operation(stu);
}
