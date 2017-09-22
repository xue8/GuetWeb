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
	$conn->query("CREATE TABLE IF NOT EXISTS member(uid INT, studentnumber INT, password VARCHAR(999), name VARCHAR(999),email VARCHAR(999), phone VARCHAR(999), qq VARCHAR(999), major VARCHAR(999), hometown VARCHAR(999), profile VARCHAR(999), profile1 VARCHAR(999), profile2 VARCHAR(999), profile3 VARCHAR(999))");	
	//$conn->query("CREATE TABLE IF NOT EXISTS fxdd(id INT,name VARCHAR(999))");
	//echo($conn->error);
?>