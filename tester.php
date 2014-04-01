<?php
    $cha = curl_init('http://www.instiz.net/popup_join.htm');
            curl_setopt($cha,CURLOPT_FOLLOWLOCATION,true);


            curl_setopt($cha,CURLOPT_RETURNTRANSFER,true);

            curl_exec($cha);

            $code = curl_getinfo($cha, CURLINFO_EFFECTIVE_URL);

            curl_close($cha);

	if (!$code=='http://www.instiz.net/popup_join_later.htm') {
		$message = "인스티즈 가입창 오픈! \n\n\n더이상 이 메세지를 받고싶지 않으시면\nhttp://instiz.rhulcs.com/deAct.php";
		// Send
		$db = mysql_connect("localhost","**DB 이름**","**DB 비밀번호**");
		if(!$db) die("Error connecting to MySQL database.");
		mysql_select_db("**DB 이름**" ,$db);
		$query = "SELECT email FROM subscription";
		$result = mysql_query($query) or die(mysql_error());

		while ($row = mysql_fetch_array($result)) {
			mail($row[0], '인스티즈 가입창 오픈!', $message,"From: admin@rhulcs.com");
		}
			
		$sql = "INSERT INTO email_sent (temp)VALUES('1')";
			$retval = mysql_query( $sql, $db );
			if(! $retval )
			{
			  die('Could not enter data: ' . mysql_error());
			}
		$sql = "INSERT INTO success_record (temp)VALUES('1')";
			$retval = mysql_query( $sql, $db );
			if(! $retval )
			{
			  die('Could not enter data: ' . mysql_error());
			}
		mysql_close($db);
		
	}
?>
