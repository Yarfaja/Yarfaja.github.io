<!DOCTYPE html>
<html>
<head>
<meta charset='UTF8'>
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
<div style='text-align:right;padding:0% 1%;'>
<a href='profile.php' style='text-decoration:none;font-weight:bold;color:#0066CC;'>My profile</a>
</div>
<br>

<div style='margin-left:2%;'>
<img src='<?php echo $rowsuser['avatar'];?>' style='height:100px;float:left;border-radius:100px;border:4px solid #EBEBEB;'>

<div style='float:left;font-weight:bold;margin-top:70px;'>
<?php echo $rowsuser['firstname']." ".$rowsuser['lastname'];?>
</div>
<div style='clear:both;'></div>
</div>
<hr style='border:1px solid #F3F3F3;'>
<a href='profile.php'><img src='images/back.png' width='30' style='margin-left:1%;'></a>


<br><br><br><br>
<?php
$idpub = $_GET['idp'];
$querypub = mysqli_query($con,"SELECT * FROM pubs WHERE id='$idpub' AND email='$email'");
if(mysqli_num_rows($querypub) == 0){
header("Location:membre.php");
}
$rowspub = mysqli_fetch_array($querypub);
?>
<div style='width:40%;background-color:#E5E5E5;padding:1% 1%;margin:auto;border-radius:10px;text-align:center;'>
<form method='POST'>
<textarea name='newtext' style='width:80%;height:100px;border:1px solid white;outline:none;font-family:Poppins;font-size:13.5px;' required placeholder='Edit your publiction'><?php if($rowspub['text'] == 'notext'){echo"";}else{echo str_replace('<br />', '', $rowspub['text']);}?></textarea>

<br><br>
<input type='submit' name='edit' value='Confirm' style='outline:none;width:80%;background-color:#66B2FF;border:1px solid #66B2FF;padding:1% 1%;font-weight:bold;color:white;'>


</form>
<?php
if(isset($_POST['edit'])){

	$newtext = str_replace('\n', '<br />', nl2br(mysql_escape_string(htmlspecialchars(trim($_POST['newtext'])))));
	mysqli_query($con,"UPDATE pubs SET text='$newtext' WHERE id='$idpub'");
	header("Location:editpub.php?idp=".$idpub."");
	
}
?>
</div>






<style>
body{
margin:0;
font-family:Poppins;
font-size:13.5px;
}
</style>
</body>
</html>