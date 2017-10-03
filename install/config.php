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
	header ( "Content-type:text/html;charset=utf-8" );
	// if($_POST){
	// 	$dbhost=$_POST['dbhost'];
	// 	$dbuser=$_POST['dbuser'];
	// 	$dbpassword=$_POST['dbpassword'];
	// 	$dbname=$_POST['dbname'];

	// 	define("dbhost",$_POST['dbhost']);
	// 	define("dbuser",$_POST['dbuser']);
	// 	define("dbpassword",$_POST['dbpassword']);
	// 	define("dbname",$_POST['dbname']);

	// 	数据库信息写入
	//    	$data =array("dbhost" => $dbhost, "dbuser" => $dbuser, "dbpassword" => $dbpassword, "dbname" => $dbname);
	//    	$numbytes = file_put_contents('config.txt', $data); //如果文件不存在创建文件，并写入内容
	//   	if($numbytes){
	//        //echo '写入成功，我们读取看看结果试试：';
	//        echo file_get_contents('config.txt');
	//    	}else{
	//        echo '写入失败或者没有权限，注意检查';
	//    	}		

	// 	$conn=new mysqli($dbhost,$dbuser,$dbpassword,$dbname);
	// 	if($conn){
	// 		//echo json_encode(["err_code" => 200, "msg" => '数据库连接成功！']);
	// 		$conn->query("CREATE TABLE IF NOT EXISTS dbinfo(dbhost VARCHAR(999), dbuser VARCHAR(999),dbpassword VARCHAR(999), dbname VARCHAR(999))");
	// 		$conn->query("INSERT INTO dbinfo(dbhost, dbuser, dbpassword, dbname) VALUES('$dbhost', '$dbuser', '$dbpassword', '$dbname')");
	// 		//echo json_encode(["err_code" => 200, "msg" => '数据库连接成功！']);
	// 	}	
	// 	//echo json_encode(["err_code" => 200, "msg" => '数据库连接失败！']);
	// }

	$conn=new mysqli("localhost","root","root","test");
	$conn->query("SET NAMES utf8");

?>