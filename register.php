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
	include("config.php");
	if($_POST){
		$studentnumber=$_POST['studentnumber'];
		$password=$_POST['password'];
		$email=$_POST['email'];
		$result=$conn->query("SELECT studentnumber FROM member WHERE studentnumber='$studentnumber'");
		$row=$result->fetch_assoc();
		if($row['studentnumber']==$studentnumber){
			echo json_encode(["code" => 500, "msg" => "账号已存在，请重新选择账号"]);
		}else{
			$res=$conn->query("INSERT INTO member(studentnumber,password,email) VALUES('$studentnumber','$password','$email')");
			if($res){
				echo json_encode(["code" => 200, "msg" => "注册成功"]);
			}else {
				echo json_encode(["code" => 500, "msg" => "注册失败，请联系管理员"]);
			}	
		}
	}		
?>