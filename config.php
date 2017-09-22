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
	$conn=new mysqli("localhost","root","root","test");
	if(!$conn){
		die("数据库连接失败".$conn->error);
	}
	$result=$conn->query("SELECT users FROM test");
	if(!$result){
		$conn->query("CREATE TABLE IF NOT EXISTS users(user CHAR,password CHAR ,email CHAR,stuNumber int,college CHAR)");
	}
	$conn->query('set names utf8');
?>