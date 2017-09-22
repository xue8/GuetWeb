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
	//	$profile=$_POST["profile"];
	//	$profile1=$_POST["profile1"];
	//	$profile2=$_POST["profile2"];
	//	$profile3=$_POST["profile3"];
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
					$result=$conn->query("UPDATE member SET name='$name',phone='$phone', email='$email', qq='$qq', major='$major', hometown='$hometown'"); 
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
		}
	}	
?>