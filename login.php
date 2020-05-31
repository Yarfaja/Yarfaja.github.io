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
<title>Sign-in</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">

</head>
<body>
<div style='position:absolute;top:1%;left:90%;width:10%;'>
<a href='register.php' style='text-decoration:none;color:#0078F0;font-weight:bold;font-size:14px;'>Sign-up</a>
</div>
<img src='images/imagepng.jpeg' style='height:100vh;position:absolute;top:0%;left:2%;z-index:1;'>
<div style='width:40%;margin:auto;padding:4% 1%;text-align:center;margin-top:10%;position:absolute;z-index:9;top:2%;left:40%;'>

<form method='POST'>
<br><br><br>
<input type='email' name='email' placeholder=' Your email' required style='text-align:center;color:black;font-weight:bold;width:65%;height:30px;background-color:#e7e7e7;border:3px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'><br><br>

<input type='password' name='password' placeholder=' Your password' required style='text-align:center;color:black;font-weight:bold;width:65%;height:30px;background-color:#e7e7e7;border:3px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'><br><br>




<br>
<input type='submit' name='login' value='Enter' style='text-align:center;color:white;font-weight:bold;width:67%;height:35px;background-color:#66B2FF;border:1px solid #66B2FF;outline:none;font-family:Poppins;font-size:13.5px;'><br><br>
<a href='' style='text-decoration:none;color:#0078F0;font-weight:bold;'>Forget your password ?</a>
</form>
<?php
if(isset($_POST['login'])){


	$email = htmlspecialchars($_POST['email']);
	$password = htmlspecialchars($_POST['password']);
	$password = md5($password);
	
	
	$checklogin = mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND password='$password'");
	if(mysqli_num_rows($checklogin) == 1){
	session_start();
	$_SESSION['email'] = $email;
	header("Location:membre.php");
	
	}else echo "<br><br><div style='background-color:#f56358;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Email or password is incorrect</div>";
	
}
?>
</div>
<div style='margin-top:10%;position:absolute;top:17%;left:80%;'>
<img src='images/image.jpeg' style='width:75%;'>
</div>





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