jQuery(document).ready(function(){
  function doStep(){
    // Next Button
    $('a.next-step').click(function(event){
      event.preventDefault();
      // Part 1
      if($('.alpha').hasClass("in")) {
        $('.alpha').removeClass("in");
      }
      $('.alpha').addClass("out");
      // Part 2
      if($('.beta').hasClass("out")) {
        $('.beta').removeClass("out");
      }
      $('.beta').addClass("in");
    });
    
    // Previous Button
    $('a.prev-step').click(function(event){
      event.preventDefault(); 
      $('.alpha').removeClass("out").addClass("in");
      $('.beta').removeClass("in").addClass("out");
    });
    
    // Submit & Complete
    $('.submit').click(function(event){
      event.preventDefault();
      // Part 1
      if($('.beta').hasClass("in")) {
        $('.beta').removeClass("in");
      }
      $('.beta').addClass("out");
      // Part 2
      if($('.charlie').hasClass("out")) {
        $('.charlie').removeClass("out");
      }
      $('.charlie').addClass("in");
    });
  }
  // Active Functions
  doStep();
  //CheckFrom();
});
	//提交报名表
	function CheckFrom(){
		var frome_name = $("#frome_name").val();
		var frome_studentnumber = $("#frome_studentnumber").val();
		var frome_email = $("#frome_email").val();
		var frome_phone = $("#frome_phone").val();
		var frome_QQ = $("#frome_QQ").val();
		var frome_major = $("#frome_major").val();
		var frome_home = $("#frome_home").val();
		var from_profile = $("#from_profile").val();
		var from_profile1 = $("#from_profile1").val();
		var from_profile2 = $("#from_profile2").val();		
		var from_profile3 = $("#from_profile3").val();	
		var data = {
			"n": 6,
			"frome_name": frome_name,
			"frome_studentnumber": frome_studentnumber,
			"frome_email": frome_email,
			"frome_phone": frome_phone,
			"frome_QQ": frome_QQ,
			"frome_major": frome_major,
			"frome_home": frome_home,
			"from_profile": from_profile,
			"from_profile1": from_profile1,
			"from_profile2": from_profile2,
			"from_profile3": from_profile3
		};
		$.ajax({
			type: "POST",
			dataType: "json",
			data: data,
			url: "/ajax/ajax/GuetWeb/home/php_method.php",
			success: function (response){
				alert(response.msg);
			},
			error: function (err){
				alert(response.msg);
			}
		})
	};
