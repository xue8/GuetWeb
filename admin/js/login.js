// login start
function login() {
	var user = $('#user').val();
	var password = $('#password').val();
	var data = {
		"user": user,
		"password": password
	};
	$.ajax({
		type: 'POST',
		url: '../login.php',
		data: data,
		dataType: "json",
		success: function(response) {
			if(response.msg == "登录成功！") {
				alert(response.msg);
				window.location.href = "home.html";
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
