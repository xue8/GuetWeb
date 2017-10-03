$(document).ready(GetSession()); //浏览器加载完成执行函数
$(document).ready(Go(5));
$(document).ready(Go(6));

//判断session
function GetSession() {
	$("#container").hide();
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
			$("#container").hide();
			$("#home").show();
			break;
		case 1:  //显示 填写入部申请 网页
			$("#container").show();
			$("#home").hide();
			break;
		case 2: 	//弹出修改密码页面
			{
				$("#mymodal1").modal("toggle"); 
				break;
			}
		case 3:  //弹出账户信息页面
			{
				Go(5);  //Go(5)实时显示账户信息
				$("#mymodal").modal("toggle");
				$.ajax({
					type: "POST",
					dataType: "json",
					data: {
						"n": "7"
					},
					url: "../home/php_method.php",
					success: function (response){
						
					},
					error: function (err){
						
					}
				})
				break;				
			}    
		case 4: //账户信息修改信息
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
					url: "../home/php_method.php",
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
		case 5: //账户信息修改页显示信息
			{
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "../home/php_method.php",
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
		case 6:   //显示报名表信息  还有进部进度条信息
			{
				$.ajax({
					type: "POST",
					dataType: "json",
					data: {
						"n": "7"
					},
					url: "../home/php_method.php",
					success: function (response){
						$("#form_name").val(response.name);
						$("#form_studentnumber").val(response.studentnumber);
						$("#form_email").val(response.email);
						$("#form_phone").val(response.phone);
						$("#form_qq").val(response.qq);
						$("#form_major").val(response.major);
						$("#form_hometown").val(response.hometown);
						$("#form_profile").val(response.profile);
						$("#form_profile1").val(response.profile1);
						$("#form_profile2").val(response.profile2);
						$("#form_profile3").val(response.profile3); //显示报名表信息
						
						$("#progress_num").text(response.progress);
						$("#progress_num1").css("width",response.progress+"%");
						$("#progress_msg").text(response.progress_msg);	  	//显示进度条信息			
					},
					error: function (err){
						
					}
				})
				break;				
			}	
		case 7: 	//修改密码
			{
				var data = {
					"n": "8",
					"change_pwd": $("#change_pwd").val(),
					"change_pwd1": $("#change_pwd1").val(),
					"change_pwd2": $("#change_pwd2").val(),
				};
				$.ajax({
					type: "POST",
					dataType: "json",
					url: "../home/php_method.php",
					data: data,
					success: function(response) {
						if(response.msg=="密码不一样"){
							alert("密码两次输入不一致，请重新输入！");
						}else if(response.msg=="旧密码不对"){
							alert("你输入的旧密码不正确，请重新输入！");
						}else if(response.msg=="成功"){
							alert("密码修改成功！");
						}
					},
					error: function(err) {
						alert(err);
					}
				})
				break;
			}			
	}
}
//go div显隐end

	//提交报名表
	function CheckForm(){
		var form_name = $("#form_name").val();
		var form_studentnumber = $("#form_studentnumber").val();
		var form_email = $("#form_email").val();
		var form_phone = $("#form_phone").val();
		var form_qq = $("#form_qq").val();
		var form_major = $("#form_major").val();
		var form_hometown = $("#form_hometown").val();
		var form_profile = $("#form_profile").val();
		var form_profile1 = $("#form_profile1").val();
		var form_profile2 = $("#form_profile2").val();		
		var form_profile3 = $("#form_profile3").val();	
		var data = {
			"n": "6",
			"form_name": form_name,
			"form_studentnumber": form_studentnumber,
			"form_email": form_email,
			"form_phone": form_phone,
			"form_qq": form_qq,
			"form_major": form_major,
			"form_hometown": form_hometown,
			"form_profile": form_profile,
			"form_profile1": form_profile1,
			"form_profile2": form_profile2,
			"form_profile3": form_profile3
		};
		$.ajax({
			type: "POST",
			dataType: "json",
			data: data,
			url: "../home/php_method.php",
			success: function (response){
				alert(response.msg);
			},
			error: function (err){
				alert(response.msg);
			}
		})
	};
