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
	include("../../../install/config.php");
	if($_POST){
		$n = $_POST["n"];
		switch($n){
			case 0:    //显示基本信息
			{
				$pageNow = $_POST['pageNow'];  //现在所在的页面
				$perNumber = 10; //每页显示的记录数
				$pageStart = ($pageNow-1)*$perNumber;	//记录数开始
				$pageEnd = $pageNow*$perNumber;	//记录数结束
				$result = $conn->query("SELECT COUNT(*) FROM member");  // 获得用户信息数据库记录总数
				$result1 =$conn->query("SELECT * FROM member LIMIT $pageStart, $pageEnd");   //获得用户信息数据库表的全部信息
				list($totalNum) = $result->fetch_row();
				$per_num = ceil($totalNum/$perNumber);  //获得分页总数
				while($row=$result1->fetch_assoc()){
					$studentnumber=$row['studentnumber'];
					$data['list'][] = array(
									"msg" => "成功",
									"per_num" => $per_num,
									"uid" => $row['uid'], 
									"studentnumber" => $row['studentnumber'], 
									"name" => $row['name'], 
									"email" => $row['email'], 
									"phone" => $row['phone'], 
									"qq" => $row['qq'], 
									"major" => $row['major'], 
									"hometown" => $row['hometown'],
								);
				}
				echo json_encode($data);
				break;				
			}
			case 1:         //后台显示报名表信息
			{
				$studentnumber = $_POST['studentnumber'];
				$result = $conn->query("SELECT * FROM member_form WHERE studentnumber='$studentnumber' ");
				$row = $result->fetch_assoc();
				$data = array(
							"progress" => $row['progress'],
							"progress_msg" => $row['progress_msg'],
							"profile" => $row['profile'],
							"profile1" => $row['profile1'],
							"profile2" => $row['profile2'],
							"profile3" => $row['profile3']
							);
				echo json_encode($data);
				break;
			}
			case 2:   //改密 进度百分比 进度信息
			{
				$studentnumber = $_POST['studentnumber'];
				$password = $_POST['password'];
				$progress = $_POST['progress_num'];
				$progress_msg = $_POST['progress_msg'];
				$result = $conn->query("UPDATE member SET password='$password' WHERE studentnumber='$studentnumber' ");
				$result_form = $conn->query("UPDATE member_form SET progress='$progress', progress_msg='$progress_msg' WHERE studentnumber='$studentnumber' ");
				$data = array(
							"code" => "500",
							"msg" => "成功"
							);
				echo json_encode($data);
				break;				
			}
			case 3:   //后台显示 密码 进度百分比 进度信息
			{
				$studentnumber = $_POST['studentnumber'];
				$result = $conn->query("SELECT * FROM member_form WHERE studentnumber='$studentnumber' ");
				$row = $result->fetch_assoc();
				$result_password = $conn->query("SELECT * FROM member WHERE studentnumber='$studentnumber' ");
				$row_password = $result_password->fetch_assoc();				
				$data = array(
							"progress" => $row['progress'],
							"progress_msg" => $row['progress_msg'],
							"password" => $row_password['password'],
							);
				echo json_encode($data);
				break;				
			}
			
		}
	}	
?>