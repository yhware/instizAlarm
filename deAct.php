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

#message{
	font-family: "Nanum Gothic", sans-serif;
	color:red;
	font-weight: bold;
	font-decoration: underline;
	font-size: 26px;
	line-height:200%;
	text-align:center;
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
    top: 60%;
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
<title>인스티즈 가입창 알림이 :: 이메일 삭제</title>
</head>
<?php
	if ($_SERVER["REQUEST_METHOD"] == "POST"){
		$accept=false;
		$db = mysql_connect("localhost","**DB 이름**","**DB 비밀번호**");
		if(!$db) die("Error connecting to MySQL database.");
		mysql_select_db("**DB 이름**" ,$db);

	  if (empty($_POST["email"]))
		{
			$emailErr = "이메일을 입력하세요";
		}else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$_POST["email"])){
				$emailErr = "잘못된 형식입니다."; 
		}
		else{
			$email = test_input($_POST["email"]);
			$accept=true;
		}
		if($accept){
			$hi = mysql_query("DELETE FROM subscription WHERE email = '$email'");

				$message = "이메일이 성공적으로 삭제되었습니다";
			
			
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
<body>
<div id="wrapper">

<a href="http://instiz.rhulcs.com"><img src="img/logo.png" id="image" width="687" height="289" alt="logo" align="middle" border="0"/></a>

<div id="message">삭제하실 이메일 주소를 적어주세요</div></br>
<div id='search-box'>
  <form id="search-form" name="form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <input id='email' name='email' placeholder='Email' type='text'/>
    <input value="삭제" name="button" id='search-button' type='submit'></button>
  </form>
 
</div></br>
 <div id="error"> <?php echo $emailErr; echo $message;?></div>

 
</div>
</body>
</html>
