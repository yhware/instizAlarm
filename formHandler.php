<?php
	$email = $_POST['email'];
	if(empty($email) ||!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)){
		 $emailErr = "Invalid email format"; 
		  echo($emailErr);
	}
	
	$db = mysql_connect("localhost","**DB 이름**","**DB 비밀번호**");
   if(!$db) die("Error connecting to MySQL database.");
   mysql_select_db("**DB 이름**" ,$db);
   
   $sql = "INSERT INTO subscription (email)VALUES('$email')";
   
   $retval = mysql_query( $sql, $db );
   
	if(! $retval )
	{
	  die('Could not enter data: ' . mysql_error());
	}
	mysql_close($db);
	
?>
