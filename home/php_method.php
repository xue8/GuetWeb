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
			case 4:
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
					//显示数据
					$res=$conn->query("SELECT * FROM member WHERE studentnumber='$studentnumber'");
					$row=$res->fetch_assoc();
					$data=array("name"=>$row['name'], "studentnumber"=>$row['studentnumber'], "email"=>$row['email'], "phone"=>$row['phone'], "qq"=>$row['qq'], "major"=>$row['major'], "hometown"=>$row['hometown']);
					echo json_encode($data);
				}
				break;
			case 6:  
				{
					//提交报名表
					$frome_name=$_POST["frome_name"];
					//$frome_studentnumber=$_POST["frome_studentnumber"];
					$frome_email=$_POST["frome_email"];
					$frome_phone=$_POST["frome_phone"];
					$frome_QQ=$_POST["frome_QQ"];
					$frome_major=$_POST["frome_major"];
					$frome_home=$_POST["frome_home"];
					$from_profile=$_POST["from_profile"];
					$from_profile1=$_POST["from_profile1"];
					$from_profile2=$_POST["from_profile2"];
					$from_profile3=$_POST["from_profile3"];
										
					$result=$conn->query("UPDATE member_form SET name='$frome_name',phone='$frome_phone', email='$frome_email', qq='$frome_QQ', major='$frome_major', hometown='$frome_home', profile='$from_profile', profile1='$from_profile1', profile2='$from_profile2', profile3='$from_profile3' "); 
					if(!$result){
						echo json_encode(["code" => 200, "msg" => "修改失败"]);
					}else {
						echo json_encode(["code" => 200, "msg" => "修改成功"]);
					}	
					break;					
				}	
			case 7:  
				{
					//实时显示报名表信息
					$res=$conn->query("SELECT * FROM member WHERE studentnumber='$studentnumber'");
					$row=$res->fetch_assoc();
					$data=array("name"=>$row['name'], "studentnumber"=>$row['studentnumber'], "email"=>$row['email'], "phone"=>$row['phone'], "qq"=>$row['qq'], "major"=>$row['major'], "hometown"=>$row['hometown']);
					echo json_encode($data);
				}
				break;								
		}
	}	
?>