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
	session_start();
	include("install/config.php");
	if($_POST){
		$studentnumber=$_POST['studentnumber'];
		$password=$_POST['password'];
		$result=$conn->query("SELECT studentnumber,password FROM member WHERE studentnumber='$studentnumber'");
		$row=$result->fetch_assoc();
		if($row['studentnumber']==$studentnumber && $row['password']==$password){
			$_SESSION['studentnumber'] = $studentnumber;
			echo json_encode(["err_code" => 200, "msg" => '登录成功！']);
		} else {
			echo json_encode(["err_code" => 500, "msg" => '账号或者密码错误！']);
		}
	}
?>