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
	include("../install/config.php");
	if($_POST){
		$user=$_POST['user'];
		$password=$_POST['password'];
		$result=$conn->query("SELECT user,password FROM admin_user WHERE user='$user'");
		$row=$result->fetch_assoc();
		if($row['user']==$user && $row['password']==$password){
			$_SESSION['user'] = $user;
			echo json_encode(["err_code" => 200, "msg" => '登录成功！']);
		} else {
			echo json_encode(["err_code" => 500, "msg" => '账号或者密码错误！']);
		}
	}
?>