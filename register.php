<!DOCTYPE html>
<html>
<head>
<?php
include("connect.php");
session_start();
if(isset($_SESSION['email'])){
header("Location:membre.php");
}
?>
<meta charset='UTF8'>
<title>Sign-up</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">

</head>
<body>
<div style='width:50%;margin:auto;padding:4% 1%;background-color:white;text-align:center;margin-top:10%;float:left;'>

<form method='POST'>
<div style='font-weight:bold;'>
<input type='radio' name='status' value='ngos'>  NGOs&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;&#160;
<input type='radio' name='status' checked value='user'>  User<br><br><br>
</div>

<input type='text' name='firstname' placeholder=' First name' required style='text-align:center;color:black;font-weight:bold;width:30%;height:32px;background-color:#e7e7e7;border:1px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'>

<input type='text' name='lastname' placeholder=' Last name' required style='margin-left:4%;text-align:center;color:black;font-weight:bold;width:30%;height:32px;background-color:#e7e7e7;border:1px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'><br><br>

<input type='email' name='email' placeholder=' Your email' required style='text-align:center;color:black;font-weight:bold;width:65%;height:30px;background-color:#e7e7e7;border:3px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'><br><br>

<input type='password' name='password' placeholder=' Your password' required style='text-align:center;color:black;font-weight:bold;width:65%;height:30px;background-color:#e7e7e7;border:3px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'><br><br>

<input type='password' name='repeatpassword' placeholder='Repeat your password' required style='text-align:center;color:black;font-weight:bold;width:65%;height:30px;background-color:#e7e7e7;border:3px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13.5px;'>


<br><br>
<span style='font-weight:bold;color:black;'>By registering, you accept our <a href='#' style='text-decoration:none;font-weight:bold;color:#66B2FF;'>General Conditions</a>.</span>
<br><br>
<input type='submit' name='register' value='Create account' style='text-align:center;color:white;font-weight:bold;width:67%;height:35px;background-color:#66B2FF;border:1px solid #66B2FF;outline:none;font-family:Poppins;font-size:13.5px;'>
</form>
<?php
if(isset($_POST['register'])){

	$firstname = htmlspecialchars($_POST['firstname']);
	$lastname = htmlspecialchars($_POST['lastname']);
	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$repeatpassword = htmlspecialchars($_POST['repeatpassword']);
	$status = $_POST['status'];

	
	if(strlen($firstname)>=3){
	if(strlen($lastname)>=3){
	if(strlen($password)>=6){
	if($password == $repeatpassword){
	$password = md5($password);
	mysqli_query($con,"INSERT INTO users VALUES ('','$firstname','$lastname','$email','$password','$status','avatar/default.png')");
	session_start();
	$_SESSION['email'] = $email;
	header("Location:membre.php");
	
	
	
	
	}else echo "<br><br><div style='background-color:#f56358;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Passwords are not matched</div>";
	}else echo "<br><br><div style='background-color:#f56358;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Password too short</div>";
	}else echo "<br><br><div style='background-color:#f56358;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Last name too short</div>";
	}else echo "<br><br><div style='background-color:#f56358;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>First name too short</div>";

}
?>
</div>
<div style='float:left;margin-top:10%;'>
<img src='images/image.jpeg' style='height:379px;'>
</div>
<div style='clear:both;'>




<style>
body{
	background-color:white;
	font-family:Poppins;
	font-size:13.5px;
}
::placeholder{
	font-weight:bold;
	color:#A4A4A4;
}
</style>
</body>
</html>