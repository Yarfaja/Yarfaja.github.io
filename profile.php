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
<a href='editprofile.php' style='text-decoration:none;font-weight:bold;color:#0066CC;'>Edit my profile</a>
</div>
<br>

<div style='margin-left:2%;'>
<a href='editavatar.php'><img src='<?php echo $rowsuser['avatar'];?>' style='height:100px;float:left;border-radius:100px;border:4px solid #EBEBEB;'></a>

<div style='float:left;font-weight:bold;margin-top:70px;'>
<?php echo $rowsuser['firstname']." ".$rowsuser['lastname'];?>
</div>
<div style='clear:both;'></div>
</div>
<hr style='border:1px solid #F3F3F3;'>
<?php
$querypubs = mysqli_query($con,"SELECT * FROM pubs WHERE email='$email'");
while($rowspubs = mysqli_fetch_array($querypubs)){
?>
<div id='fadeout<?php echo $rowspubs['id'];?>' style='width:40%;margin-left:5%;background-color:#E5E5E5;padding:1% 1%;position:relative;float:left;margin-top:2%;border-radius:10px;height:230px;overflow:auto;'>
<?php
if($rowspubs['image'] != 'nophoto'){
if($rowspubs['text'] == 'notext'){
?>
<img src='<?php echo $rowspubs['image']?>' style='max-height:200px;max-width:200px;'>
<?php
}
if($rowspubs['text'] != 'notext'){
?>
<img src='<?php echo $rowspubs['image']?>' style='max-height:200px;max-width:200px;float:left;'>
<div style='float:left;width:50%;margin-left:2%;font-weight:bold;color:black;'>
<?php echo $rowspubs['text'];?>
</div>
<div style='clear:both;'></div>
<?php
}
}
if($rowspubs['video'] != 'novideo'){
if($rowspubs['text'] == 'notext'){
?>
<embed src='<?php echo $rowspubs['video']?>' style='max-height:200px;max-width:200px;'>
<?php
}
if($rowspubs['text'] != 'notext'){
?>
<embed src='<?php echo $rowspubs['video']?>' style='max-height:200px;max-width:200px;float:left;'>
<div style='float:left;width:50%;margin-left:2%;font-weight:bold;color:black;'>
<?php echo $rowspubs['text'];?>
</div>
<div style='clear:both;'></div>


<?php
}
}
?>
<div style='position:absolute;right:1%;bottom:1%;'>
<a href='editpub.php?idp=<?php echo $rowspubs['id'];?>'><img src='images/edit.png' width='22'></a>&#160;&#160;&#160;&#160;
<a href='javascript:void(0);' id='delete<?php echo $rowspubs['id'];?>'><img src='images/delete.png' width='22'></a>
</div>
</div>
<script>
$('document').ready(function(){
	$('#delete<?php echo $rowspubs['id'];?>').click(function(){
		$('#fadeout<?php echo $rowspubs['id'];?>').fadeOut();
		$.get('deletepub.php?idp=<?php echo $rowspubs['id'];?>&email=<?php echo $email;?>');
	})
})
</script>
<?php
}
?>
<div style='clear:both;'></div>

















<style>
body{
margin:0;
font-family:Poppins;
font-size:13.5px;
}
</style>
</body>
</html>