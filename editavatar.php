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



<br><br><br><br>
<div style='width:40%;background-color:#EBEBEB;margin:auto;padding:1% 1%;border-radius:10px;'>
<form method='POST' enctype='multipart/form-data'>
<input type='file' id='image' class="inputfile" name='avatar' accept="image/*">
<label for='image' style='background-color:black;color:white;font-weight:bold;padding:1% 1%;border-radius:5px;float:left;'>Choose an image</label>

<input type='submit' value='' name='upload'>
<div style='clear:both;'></div>
</form>
<?php
if(isset($_POST['upload'])){
$newavatar = $_FILES['avatar']['name'];


$characts    = 'abcdefghijklmnopqrstuvwxyz';
    $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characts   .= '1234567890';
    $code_aleatoire      = '';
 
    for($i=0;$i < 20;$i++)
    {
        $code_aleatoire .=substr($characts,rand()%(strlen($characts)),1);
    }
if($newavatar != ''){
	$infophoto = pathinfo($newavatar);
	$extension = $infophoto['extension'];
	$newimagename = $code_aleatoire;
	$path = "avatar/".$newimagename.".".$extension;
	move_uploaded_file($_FILES['avatar']['tmp_name'],$path);
	mysqli_query($con,"UPDATE users SET avatar='$path' WHERE email='$email'");
	header("Location:editavatar.php");




}
}
?>
</div>


























<style>
body{
margin:0;
font-family:Poppins;
font-size:13.5px;
}
.inputfile {
	width: 0.1px;
	height: 0.1px;
	opacity: 0;
	overflow: hidden;
	position: absolute;
	z-index: -1;
}
.inputfile + label {
	
	margin-top:0%;
   
    display: inline-block;
}
input[type="submit"]{
	width:35px;
	height:35px;
	border:1px solid #EBEBEB;
	background-image:url("images/send1.png");
	background-color:#EBEBEB;
	outline:none;
	float:right;
}
</style>
</body>
</html>