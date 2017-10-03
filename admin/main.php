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
	if($_POST){
		$n = $_POST['n'];
		switch ($n){
			case 0:
				{
					$result = $conn->query("SELECT COUNT(*) FROM member");   //获得数据库记录总数  用户数
					list($row_num) = $result->fetch_row();
					echo json_encode(["code" => 200, "msg" => $row_num]);					
				}
				break;
			case 1:
				{
					$result = $conn->query("SELECT COUNT(*) FROM member_form");  //获得数据库记录总数  申请表数
					list($row_num) = $result->fetch_row();
					echo json_encode(["code" => 200, "msg" => $row_num]);		
				}
		}	
	}
?>