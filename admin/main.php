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
	$n = $_POST['n'];
	if($_POST){
		switch ($n){
			case 0:
				{
					$result = $conn->query("SELECT COUNT(*) FROM member");
					list($row_num) = $result->fetch_row();
					//$row_num = $result->num_rows();
					echo json_encode(["code" => 200, "msg" => $row_num]);					
				}
				break;
		}	
	}
?>