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
	if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
		$user=$_SESSION['user'];
		$result=$conn->query("SELECT * FROM admin_user WHERE user='$user'");
		$row=$result->fetch_assoc();
		$user=array("msg"=>'成功！', "user"=>$_SESSION['user']);
		echo json_encode($user);
	}else {
		echo json_encode(["msg"=>'失败！']);
	}
?>