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
	session_start();
	if(isset($_SESSION['studentnumber']) && !empty($_SESSION['studentnumber'])){
		$studentnumber=$_SESSION['studentnumber'];
		$result=$conn->query("SELECT * FROM member WHERE studentnumber='$studentnumber'");
		$row=$result->fetch_assoc();
		$user=array("msg"=>'成功！', "studentnumber"=>$_SESSION['studentnumber'], "name"=>$row['name']);
		echo json_encode($user);
	}else {
		echo json_encode(["msg"=>'失败！']);
	}
?>