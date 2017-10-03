<?php
	/**                   BY:xue8
 *   
 *                           ,.  
 *                         (_|,.  
 *                        ,' /, )_______   _  
 *                     __j o``-'        `.'-)'  
 *                    (")                 \'  
 *                     `-j                |  
 *                       `-._(           /  
 *                   xry    |_\  |--^.  /  
 *                         /_]'|_| /_)_/  
 *                            /_]'  /_]'  
 *  
 */ 		
	include("../install/config.php");
	session_start();
	if($_POST){
		$studentnumber=$_SESSION['studentnumber'];  //session判断操作对象
		$n=$_POST["n"];
//		$email=$_POST["email"];
//		$name=$_POST["name"];
//		$phone=$_POST["phone"];
//		$qq=$_POST["qq"];
//		$major=$_POST["major"];
//		$hometown=$_POST["hometown"];
//		$profile=$_POST["profile"];
//		$profile1=$_POST["profile1"];
//		$profile2=$_POST["profile2"];
//		$profile3=$_POST["profile3"];
		switch ($n){
			case 4:  //账户信息修改信息
				{	
					$email=$_POST["email"];
					$name=$_POST["name"];
					$phone=$_POST["phone"];
					$qq=$_POST["qq"];
					$major=$_POST["major"];
					$hometown=$_POST["hometown"];
					// 修改数据
					$result=$conn->query("UPDATE member SET name='$name',phone='$phone', email='$email', qq='$qq', major='$major', hometown='$hometown' WHERE studentnumber='$studentnumber'"); 
					if(!$result){
						echo json_encode(["code" => 200, "msg" => "修改失败"]);
					}else {
						echo json_encode(["code" => 200, "msg" => "修改成功"]);
					}
				}
				break;
			case 5:
				{
					//账户信息修改页显示信息
					$res=$conn->query("SELECT * FROM member WHERE studentnumber='$studentnumber'");
					$row=$res->fetch_assoc();
					$data=array("name"=>$row['name'], "studentnumber"=>$row['studentnumber'], "email"=>$row['email'], "phone"=>$row['phone'], "qq"=>$row['qq'], "major"=>$row['major'], "hometown"=>$row['hometown']);
					echo json_encode($data);
				}
				break;
			case 6:  
				{
					//提交报名表
					$form_name=$_POST["form_name"];
					//$form_studentnumber=$_POST["form_studentnumber"];
					$form_email=$_POST["form_email"];
					$form_phone=$_POST["form_phone"];
					$form_qq=$_POST["form_qq"];
					$form_major=$_POST["form_major"];
					$form_hometown=$_POST["form_hometown"];
					$form_profile=$_POST["form_profile"];
					$form_profile1=$_POST["form_profile1"];
					$form_profile2=$_POST["form_profile2"];
					$form_profile3=$_POST["form_profile3"];
										
					$result=$conn->query("UPDATE member SET name='$form_name',phone='$form_phone', email='$form_email', qq='$form_qq', major='$form_major', hometown='$form_hometown' WHERE studentnumber='$studentnumber'");
					// 判断用户是否存在报名表  存在则更新 不存在则创建
					$result1=$conn->query("SELECT studentnumber FROM member_form WHERE studentnumber='$studentnumber'");
					$row=$result1->fetch_assoc();
					if($row['studentnumber']==$studentnumber){
						$result=$conn->query("UPDATE member_form SET profile='$form_profile', profile1='$form_profile1', profile2='$form_profile2', profile3='$form_profile3' WHERE studentnumber='$studentnumber'");  
					}else{
						$res=$conn->query("INSERT INTO member_form(studentnumber, profile, profile1, profile2, profile3) VALUES('$studentnumber', '$form_profile', '$form_profile1', '$form_profile2', '$form_profile3')");
						if($res){
							echo json_encode(["code" => 200, "msg" => "注册成功"]);
						}else {
							echo json_encode(["code" => 500, "msg" => "注册失败，请联系管理员"]);
						}	
					}//判断结束
													
					if(!$result){
						echo json_encode(["code" => 200, "msg" => "修改失败"]);
					}else {
						echo json_encode(["code" => 200, "msg" => "修改成功"]);
					}	
					break;					
				}	
			case 7:  
				{
					//实时显示报名表信息 还有进度条信息
					$res=$conn->query("SELECT * FROM member WHERE studentnumber='$studentnumber'");
					$res1=$conn->query("SELECT * FROM member_form WHERE studentnumber='$studentnumber'");
					$row=$res->fetch_assoc();
					$row1=$res1->fetch_assoc();
					if($row1['profile']==""){
						$data=array("name"=>$row['name'], "studentnumber"=>$row['studentnumber'], "email"=>$row['email'], "phone"=>$row['phone'], "qq"=>$row['qq'], "major"=>$row['major'], "hometown"=>$row['hometown'], "profile"=>$row1['profile'], "profile1"=>$row1['profile1'], "profile2"=>$row1['profile2'], "profile3"=>$row1['profile3'], "progress"=>"10", "progress_msg"=>"你已注册账号，填写报名表吧！");					
					}else {
						if($row1['progress']==""){
							$data=array("name"=>$row['name'], "studentnumber"=>$row['studentnumber'], "email"=>$row['email'], "phone"=>$row['phone'], "qq"=>$row['qq'], "major"=>$row['major'], "hometown"=>$row['hometown'], "profile"=>$row1['profile'], "profile1"=>$row1['profile1'], "profile2"=>$row1['profile2'], "profile3"=>$row1['profile3'], "progress"=>"20", "progress_msg"=>"已填写报名表，请等待通知");												
						}else {
							$data=array("name"=>$row['name'], "studentnumber"=>$row['studentnumber'], "email"=>$row['email'], "phone"=>$row['phone'], "qq"=>$row['qq'], "major"=>$row['major'], "hometown"=>$row['hometown'], "profile"=>$row1['profile'], "profile1"=>$row1['profile1'], "profile2"=>$row1['profile2'], "profile3"=>$row1['profile3'], "progress"=>$row1['progress'], "progress_msg"=>$row1['progress_msg']);								
						}			
					}
//					$data=array("name"=>$row['name'], "studentnumber"=>$row['studentnumber'], "email"=>$row['email'], "phone"=>$row['phone'], "qq"=>$row['qq'], "major"=>$row['major'], "hometown"=>$row['hometown'], "profile"=>$row1['profile'], "profile1"=>$row1['profile1'], "profile2"=>$row1['profile2'], "profile3"=>$row1['profile3'], "progress"=>$row1['progress'], "progress_msg"=>$row1['progress_msg']);
					echo json_encode($data);
					break;
				}	
			case 8:  
				{
					//修改密码
					$pwd = $_POST['change_pwd'];
					$pwd1 = $_POST['change_pwd1'];
					$pwd2 = $_POST['change_pwd2'];
					$res=$conn->query("SELECT * FROM member WHERE password='$pwd' ");
					$row=$res->fetch_assoc();
					if($pwd1==$pwd2){
						if($row['password']==$pwd){
							$res=$conn->query("UPDATE member SET password='$pwd1' WHERE studentnumber='$studentnumber'"); 
							echo json_encode(array("msg"=>"成功")); 							
						}else{
							echo json_encode(array("msg"=>"旧密码不对")); 
						}
					}else {
						echo json_encode(array("msg"=>"密码不一样"));
					}
					break;
				}															
		}
	}	
?>