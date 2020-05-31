<!DOCTYPE html>
<html>
<head>
<script src='js/jquery.js'></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Arimo&family=Nunito:wght@300&family=Tenali+Ramakrishna&display=swap" rel="stylesheet">
<?php
include("connect.php");
session_start();
if(!isset($_SESSION['email'])){
header("Location:login.php");
}
$email = $_SESSION['email'];
$queryuser = mysqli_query($con,"SELECT * FROM users WHERE email='$email'");

$rowsuser = mysqli_fetch_array($queryuser);


?>
<title>Welcome <?php echo $rowsuser['firstname']." ".$rowsuser['lastname'];?></title>
</head>
<body>
<a href='membre.php'><img src='images/house.png' style='width:35px;margin:1%;float:left;'></a>

<a href='logout.php'><img src='images/logout.png' style='width:25px;margin:1%;float:right;'></a>
<div style='clear:both;'></div>
<hr style='border:1px solid #F3F3F3;'>
<a href='profile.php'><img src='images/back.png' width='30' style='margin-left:1%;'></a>


<br><br><br><br>
<div style='margin-left:5%;width:40%;background-color:#F7F7F7;text-align:center;padding:1% 0%;float:left;'>
<form method='POST'>
<input type='text' name='firstname' value='<?php echo $rowsuser['firstname'];?>' placeholder=' First name' required style='text-align:center;color:black;font-weight:bold;width:30%;height:32px;background-color:#e7e7e7;border:1px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'>

<input type='text' name='lastname' value='<?php echo $rowsuser['lastname'];?>' placeholder=' Last name' required style='margin-left:4%;text-align:center;color:black;font-weight:bold;width:30%;height:32px;background-color:#e7e7e7;border:1px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'><br><br>


<input type='submit' name='changefullname' value='Change' style='text-align:center;color:white;font-weight:bold;width:67%;height:35px;background-color:#66B2FF;border:1px solid #66B2FF;outline:none;font-family:Poppins;font-size:13.5px;'>

</form>
<?php
if(isset($_POST['changefullname'])){
	
	$firstname = htmlspecialchars($_POST['firstname']);
	$lastname = htmlspecialchars($_POST['lastname']);
	
	mysqli_query($con,"UPDATE users SET firstname='$firstname',lastname='$lastname' WHERE email='$email'");
	echo"<br><br><div style='font-family:Poppins;font-size:13.5px;background-color:#66FF66;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Fullname changed</div>";

	
}
?>
</div>



<div style='margin-left:5%;width:45%;background-color:#F7F7F7;text-align:center;padding:1% 0%;float:left;'>
<form method='POST'>
<input type='password' name='oldpassword' placeholder=' Your old password' required style='text-align:center;color:black;font-weight:bold;width:65%;height:30px;background-color:#e7e7e7;border:3px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13px;'><br><br>

<input type='password' name='newpassword' placeholder='Your new password' required style='text-align:center;color:black;font-weight:bold;width:65%;height:30px;background-color:#e7e7e7;border:3px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13.5px;'><br><br>

<input type='password' name='rnewpassword' placeholder='Repeat your new password' required style='text-align:center;color:black;font-weight:bold;width:65%;height:30px;background-color:#e7e7e7;border:3px solid #e7e7e7;outline:none;font-family:Poppins;font-size:13.5px;'><br><br>

<input type='submit' name='changepassword' value='Change my password' style='text-align:center;color:white;font-weight:bold;width:67%;height:35px;background-color:#66B2FF;border:1px solid #66B2FF;outline:none;font-family:Poppins;font-size:13.5px;'>

</form>
<?php
if(isset($_POST["changepassword"])){

	$oldpassword = htmlspecialchars($_POST['oldpassword']);
	$newpassword = htmlspecialchars($_POST['newpassword']);
	$rnewpassword = htmlspecialchars($_POST['rnewpassword']);

	$userpassword = $rowsuser['password'];
	$oldpassword = md5($oldpassword);
	
	
	if($oldpassword == $userpassword){
	if(strlen($newpassword)>=6){
	if($newpassword == $rnewpassword){
	$newpassword = md5($newpassword);
	mysqli_query($con,"UPDATE users SET password='$newpassword' WHERE email='$email'");
	echo"<br><br><div style='font-family:Poppins;font-size:13.5px;background-color:#66FF66;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Password changed</div>";
	
	}else echo "<br><br><div style='font-family:Poppins;font-size:13.5px;background-color:#f56358;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Passwords are not matched !</div>";
	}else echo "<br><br><div style='font-family:Poppins;font-size:13.5px;background-color:#f56358;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Your new password's too short !</div>";
	}else echo "<br><br><div style='font-family:Poppins;font-size:13.5px;background-color:#f56358;padding:1% 1%;color:white;font-weight:bold;margin-left:19%;width:60%;'>Your old password is wrong !</div>";

}
?>
</div>
<div style='clear:both;'></div>

<style>
body{
margin:0;

}
</style>
</body>
</html>