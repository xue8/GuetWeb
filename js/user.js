jQuery(function($) {
	$(document).on('click', '.toolbar a[data-target]', function(e) {
		e.preventDefault();
		var target = $(this).data('target');
		$('.widget-box.visible').removeClass('visible'); //hide others
		$(target).addClass('visible'); //show target
	});
});

//you don't need this, just used for changing background
jQuery(function($) {
	$('#btn-login-dark').on('click', function(e) {
		$('body').attr('class', 'login-layout');
		$('#id-text2').attr('class', 'white');
		$('#id-company-text').attr('class', 'blue');

		e.preventDefault();
	});
	$('#btn-login-light').on('click', function(e) {
		$('body').attr('class', 'login-layout light-login');
		$('#id-text2').attr('class', 'grey');
		$('#id-company-text').attr('class', 'blue');

		e.preventDefault();
	});
	$('#btn-login-blur').on('click', function(e) {
		$('body').attr('class', 'login-layout blur-login');
		$('#id-text2').attr('class', 'white');
		$('#id-company-text').attr('class', 'light-blue');

		e.preventDefault();
	});

});
// login start
function login() {
	var studentnumber = $('#studentnumber').val();
	var password = $('#password').val();
	var data = {
		"studentnumber": studentnumber,
		"password": password
	};
	$.ajax({
		type: 'POST',
		url: 'login.php',
		data: data,
		dataType: "json",
		success: function(response) {
			if(response.msg == "登录成功！") {
				alert(response.msg);
				window.location.href = "home";
			} else {
				alert(response.msg);
			}
		},
		error: function(err) {
			alert(err.msg);
		}
	});
}
// login end
//GetSession start
function GetSession() {
	$.ajax({
		type: "POST",
		url: "login_judge.php",
		dataType: "json",
		data: {
			"result": "test"
		},
		success: function(response) {
			if(response.msg == "成功！") {
				window.location.href = "home";
			}
		},
		error: function(err) {
			//alert("登陆异常,请联系管理员！");
		}
	});
}
$(document).ready(GetSession());
//GetSession end
//register start
function register() {
	var studentnumber = $('#register_studentnumber').val();
	var password = $('#register_password').val();
	var email = $('#register_email').val();
	var data = {
		"studentnumber": studentnumber,
		"password": password,
		"email": email
	}
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: 'register.php',
		data: data,
		success: function(response) {
			alert(response.msg);
		},
		error: function(err) {
			alert(err.msg);
		}
	});
}
//register end