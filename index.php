<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
@import url(http://fonts.googleapis.com/earlyaccess/nanumgothic.css);
#error {color: #FF0000;
text-align:center;
font-weight:bold;
}
body{
	background-color:#33cc00;
font-family: "Nanum Gothic", sans-serif;

}

#use{
	font-family: "Nanum Gothic", sans-serif;
	color:#ffffff;
	line-height:200%;
	text-align:center;
	text-decoration:none;
}
#wrapper{
  	 width: 780px;
	height: 600px;

	position: absolute;
	top:0;
	bottom: 0;
	left: 0;
	right: 0;
	margin: auto;
}
#wrapper img{
display: block;
    margin-left: auto;
    margin-right: auto;
}
#search-box {
    /*position: relative; */
    width: 90%;
    margin: 0;
}

#search-form {
    height: 60px;
    border: 1px solid #999;
    -webkit-border-radius: 5px;
    -moz-border-radius: 5px;
    border-radius: 5px;
    background-color: #fff;
    overflow: hidden;
	margin-left:10%;
}


#email {
    font-size: 34px;
    color: #ddd;
    border-width: 0;
    background: transparent;
}

#search-box input[type="text"] {
    width: 85%;
    padding: 11px 0 12px 1em;
    color: #333;
    outline: none;
}

#search-button {
    position: absolute;
    top: 48.3%;
	
    right: 6%;
    height: 61px;
    width: 10%;
	margin:0;
    font-size: 14px;
    color: #fff;
    text-align: center;
    line-height: 42px;
    border-width: 0;
    background-color: #999;
    -webkit-border-radius: 0px 5px 5px 0px;
    -moz-border-radius: 0px 5px 5px 0px;
    border-radius: 0px 5px 5px 0px;
    cursor: pointer;
}

</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>인스티즈 가입창 알림이</title>
</head>

<body>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$accept=false;
		$db = mysql_connect("localhost","**DB 이름**","**DB 비밀번호**");
		if(!$db) die("Error connecting to MySQL database.");
		mysql_select_db("**DB 이름**" ,$db);

	  if (empty($_POST["email"]))
		{
			$emailErr = "이메일을 입력하세요";
		}
		else {
			$email = test_input($_POST["email"]);
			$query = mysql_query("SELECT email FROM subscription WHERE email = '$email'");
			$query = mysql_num_rows($query);
			
			if($query>=1){
			
					$emailErr = "이미 등록되어있는 이메일 주소입니다";
			}
			// check if e-mail address syntax is valid
			else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST["email"])){
				$emailErr = "잘못된 형식입니다."; 
			 }else{
				  $accept=true;
			  }
		  }
    
	
		if($accept){
			$sql = "INSERT INTO subscription (email)VALUES('$email')";
			$message = "인스티즈 실시간 가입창 알림 서비스에 성공적으로 가입하셧습니다.";
			mail($email, '인스티즈 가입창 알림이 서비스', $message,"From: admin@rhulcs.com");
			$message = '이메일이 성공적으로 추가되었습니다';
			$retval = mysql_query( $sql, $db );
	   
			if(! $retval )
			{
			  die('Could not enter data: ' . mysql_error());
			}
			mysql_close($db);
		}
}
	function test_input($data)
	{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
	}

?>
<div id="wrapper">

<a href="http://instiz.rhulcs.com"><img src="img/logo.png" id="image" width="687" height="289" alt="logo" align="middle" border="0"/></a>

<div id='search-box'>
  <form id="search-form" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    
    
    <input id='email' name='email' placeholder='Email' type='text'/>
    <input value="등록" name="button" id='search-button' type='submit'></button>
  </form>
 
</div></br>
 <div id="error"> <?php echo $emailErr; echo $message;?></div>
 <div id=use>
 </br>
 이 웹사이트는 instiz.net 의 회원 가입 기회가 제한되어있어 가입 하지 못하는 분들을 위한 웹사이트입니다.</br>
 가입창이 활성화가 되면 즉시 등록하신 이메일 주소로 메일을 보내드릴 것이며, </br>
 추가 알림을 원하지 않으시면 해지 페이지를 이용해주시면 됩니다.</br>
 수집된 이메일 주소는 위에 기재된 목적 외에는 절대 사용되지 않을 것을 약속드립니다.
 
 </br></br><b><a href="http://instiz.rhulcs.com/deAct.php"  style="color:white; text-decoration:underline;">더 이상 알림을 원치 않습니다</a></b>
 </div>
 
</div>
</body>
</html>
