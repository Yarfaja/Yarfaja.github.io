<!DOCTYPE html>
<html>
<head>
<script src='js/jquery.js'></script>
<script src='js/blur.js'></script>
<script src='js/code.js'></script>
<script src="js/jquery.modal.min.js"></script>
<link rel="stylesheet" href="js/jquery.modal.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Poppins" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Arimo" rel="stylesheet">
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
<title>Clean water</title>
</head>
<body>
<a href='membre.php' style='position:absolute;left:0.5%;top:3%;'><img src='images/house.png' width='30'></a>
<a href='logout.php' style='position:absolute;right:1%;top:4%;'><img src='images/logout.png' width='25'></a>
<form method='POST' enctype="multipart/form-data">
<img src='images/water.png' style='position:absolute;left:3%;top:0;width:90%;'>

<div id='newpub' style='position:absolute;top:22%;left:17%;'>
<img src='<?php echo $rowsuser['avatar'];?>' style='float:left;width:8%;border-radius:100px;'>
<div style='float:left;margin-top:-8px;margin-left:2%;'>
<textarea name='newpubtext' placeholder='    

     Share your challenge NOW !' style='border-radius:100px;outline:none;height:80px;border:1px solid #44c8e9;background-color:white;width:70%;'></textarea>
<br>
<input type="file" name="photo" id="file1" class="inputfile" accept="image/*" />
<label for="file1"><img src='images/addphoto.png' style='width:30%;'></label>

<input type="file" name="video" id="file2" class="inputfile" accept="video/*" />
<label for="file2" id='secondsinput'><img src='images/addvideo.png' style='width:13%;margin-left:-30%;padding-bottom:1%;'></label>
<div id='secondsmessage' style='display:none;position:absolute;top:50%;right:74%;background-color:#ee7421;padding:0% 1%;color:white;'>
a 45's video
</div>
<input type='submit' value='' name='ajouter'>
</div>
<div style='clear:both;'></div>
</div>
</form>
<a href='profile.php' style='position:absolute;top:25%;right:8%;text-decoration:none;color:#0080FF;font-weight:bold;font-size:18px;'>My profile</a>
<?php
if(isset($_POST['ajouter'])){

	$newpubtext = str_replace('\n', '<br />', nl2br(htmlspecialchars(trim($_POST['newpubtext']))));
	$image = $_FILES['photo']['name'];
	$video = $_FILES['video']['name'];
	$fullname = $rowsuser['firstname']." ".$rowsuser['lastname'];
	$characts    = 'abcdefghijklmnopqrstuvwxyz';
    $characts   .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characts   .= '1234567890';
    $code_aleatoire      = '';
 
    for($i=0;$i < 20;$i++)
    {
        $code_aleatoire .=substr($characts,rand()%(strlen($characts)),1);
    }

	
	
	if($image != ''){
	if($newpubtext != ''){
	$infophoto = pathinfo($_FILES['photo']['name']);
	$extension = $infophoto['extension'];
	$newimagename = $code_aleatoire;
	$path = "photos/".$newimagename.".".$extension;
	move_uploaded_file($_FILES['photo']['tmp_name'],$path);
	mysqli_query($con,"INSERT INTO pubs VALUES ('','cleanwater','$fullname','$email','$newpubtext','$path','novideo',NOW(),NOW())");
	}else{
	$infophoto = pathinfo($_FILES['photo']['name']);
	$extension = $infophoto['extension'];
	$newimagename = $code_aleatoire;
	$dossier = "photos/";
	$path = "photos/".$newimagename.".".$extension;
	move_uploaded_file($_FILES['photo']['tmp_name'],$path);
	mysqli_query($con,"INSERT INTO pubs VALUES ('','cleanwater','$fullname','$email','notext','$path','novideo',NOW(),NOW())");
	}
	}
	if($video != ''){
	if($newpubtext != ''){
	$infovideo = pathinfo($_FILES['video']['name']);
	$extension = $infovideo['extension'];
	$newvideoname = $code_aleatoire;
	$path = "videos/".$newvideoname.".".$extension;
	move_uploaded_file($_FILES['video']['tmp_name'],$path);
	mysqli_query($con,"INSERT INTO pubs VALUES ('','cleanwater','$fullname','$email','$newpubtext','nophoto','$path',NOW(),NOW())");
	}else{
	$infovideo = pathinfo($_FILES['video']['name']);
	$extension = $infovideo['extension'];
	$newvideoname = $code_aleatoire;
	$path = "videos/".$newvideoname.".".$extension;
	move_uploaded_file($_FILES['video']['tmp_name'],$path);
	mysqli_query($con,"INSERT INTO pubs VALUES ('','cleanwater','$fullname','$email','notext','nophoto','$path',NOW(),NOW())");
	}



	}
	header("Location:cleanwater.php");





}
?>
<div style='width:84%;position:absolute;top:40%;left:16%;'>
<br>
<hr style='border:1px solid #E5E5E5;'>
<br><br>
<?php
$querypubs = mysqli_query($con,"SELECT * FROM pubs WHERE cat='cleanwater' ORDER BY -id");
while($rowspubs = mysqli_fetch_array($querypubs)){
?>
<div style='width:45%;background-color:white;border:2px solid #44c8e9;height:250px;float:left;margin:1%;padding:2% 1%;border-radius:10px;position:relative;'>
<span style='margin-left:1%;font-weight:bold;'><?php echo $rowspubs['fullname'];?></span><br><br>
<?php
if($rowspubs['image'] != 'nophoto'){
if($rowspubs['text'] == 'notext'){
?>
<a href="#ex<?php echo $rowspubs['id'];?>" rel="modal:open"><img src='<?php echo $rowspubs['image']?>' style='max-height:85%;max-width:40%;'></a>
<?php
}
if($rowspubs['text'] != 'notext'){
?>
<a href="#ex<?php echo $rowspubs['id'];?>" rel="modal:open"><img src='<?php echo $rowspubs['image']?>' style='max-height:85%;max-width:40%;float:left;'></a>
<div style='float:left;width:50%;margin-left:2%;font-weight:bold;color:black;'>
<?php echo $rowspubs['text'];?>
</div>
<div style='clear:both;'></div>
<?php
}
}
?>



<?php
if($rowspubs['video'] != 'novideo'){
if($rowspubs['text'] == 'notext'){
?>
<a href="#ex<?php echo $rowspubs['id'];?>" rel="modal:open">
<img src='images/fullscreen.png' width='20' style='position:absolute;top:2%;right:2%;'>
</a>
<video controls src='<?php echo $rowspubs['video']?>' style='max-height:85%;max-width:40%;'></video>


<?php
}
if($rowspubs['text'] != 'notext'){
?>
<a href="#ex<?php echo $rowspubs['id'];?>" rel="modal:open">
<img src='images/fullscreen.png' width='20' style='position:absolute;top:2%;right:2%;'>
</a>
<video controls src='<?php echo $rowspubs['video']?>' style='max-height:85%;max-width:40%;float:left;'></video>


<div style='float:left;width:50%;margin-left:2%;font-weight:bold;color:black;'>
<?php echo $rowspubs['text'];?>
</div>
<div style='clear:both;'></div>


<?php
}
}
$idpub = $rowspubs['id'];
$ratingcheck = mysqli_query($con,"SELECT * FROM rating WHERE idpub='$idpub' AND email='$email'");
if(mysqli_num_rows($ratingcheck) == 0){
?>

<div style='position:absolute;bottom:2%;right:2%;'>
<img src='images/wstar.png' id='1star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='2star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='3star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='4star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='5star<?php echo $rowspubs['id'];?>' width='16'>
</div>
<?php
}else{
$rowsrating = mysqli_fetch_array($ratingcheck);

if($rowsrating['rate'] == 1){
?>
<div style='position:absolute;bottom:2%;right:2%;'>
<img src='images/star.png' id='1star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='2star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='3star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='4star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='5star<?php echo $rowspubs['id'];?>' width='16'>
</div>
<?php
}
if($rowsrating['rate'] == 2){
?>
<div style='position:absolute;bottom:2%;right:2%;'>
<img src='images/star.png' id='1star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='2star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='3star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='4star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='5star<?php echo $rowspubs['id'];?>' width='16'>
</div>
<?php
}
if($rowsrating['rate'] == 3){
?>
<div style='position:absolute;bottom:2%;right:2%;'>
<img src='images/star.png' id='1star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='2star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='3star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='4star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='5star<?php echo $rowspubs['id'];?>' width='16'>
</div>	
<?php
}
if($rowsrating['rate'] == 4){
?>
<div style='position:absolute;bottom:2%;right:2%;'>
<img src='images/star.png' id='1star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='2star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='3star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='4star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/wstar.png' id='5star<?php echo $rowspubs['id'];?>' width='16'>
</div>	
<?php
}
if($rowsrating['rate'] == 5){
?>
<div style='position:absolute;bottom:2%;right:2%;'>
<img src='images/star.png' id='1star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='2star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='3star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='4star<?php echo $rowspubs['id'];?>' width='16'>
<img src='images/star.png' id='5star<?php echo $rowspubs['id'];?>' width='16'>
</div>	
<?php
}




	
}
?>




<div id="ex<?php echo $rowspubs['id'];?>" class="modal">
<?php
if($rowspubs['image'] != 'nophoto'){
?>
<img src='<?php echo $rowspubs['image'];?>' style='max-height:90vh;'>
<?php
}else{
?>
<video controls src='<?php echo $rowspubs['video'];?>' style='height:100%;'></video>
<?php	
}
?>
</div>



</div>
<script>
$(document).ready(function(){
	$('#1star<?php echo $rowspubs['id'];?>').click(function(){
	$('#1star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#2star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$('#3star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$('#4star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$('#5star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$.get('addrating.php?email=<?php echo $email;?>&r=1&idp=<?php echo $rowspubs['id'];?>');
	})
	$('#2star<?php echo $rowspubs['id'];?>').click(function(){
	$('#1star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#2star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#3star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$('#4star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$('#5star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$.get('addrating.php?email=<?php echo $email;?>&r=2&idp=<?php echo $rowspubs['id'];?>');
	})
	$('#3star<?php echo $rowspubs['id'];?>').click(function(){
	$('#1star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#2star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#3star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#4star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$('#5star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$.get('addrating.php?email=<?php echo $email;?>&r=3&idp=<?php echo $rowspubs['id'];?>');
	})
	$('#4star<?php echo $rowspubs['id'];?>').click(function(){
	$('#1star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#2star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#3star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#4star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#5star<?php echo $rowspubs['id'];?>').attr('src','images/wstar.png');
	$.get('addrating.php?email=<?php echo $email;?>&r=4&idp=<?php echo $rowspubs['id'];?>');
	})
	$('#5star<?php echo $rowspubs['id'];?>').click(function(){
	$('#1star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#2star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#3star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#4star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$('#5star<?php echo $rowspubs['id'];?>').attr('src','images/star.png');
	$.get('addrating.php?email=<?php echo $email;?>&r=5&idp=<?php echo $rowspubs['id'];?>');
	})
})
</script>
<?php
}
?>

</div>























<style>
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
body{
margin:0;
font-family:Arimo;
}
#newpub input[type="submit"]{
	width:35px;
	height:35px;
	border:1px solid white;
	background-image:url("images/send1.png");
	background-color:white;
	margin-left:60%;
	position:absolute;
	top:64%;
	left:-25%;
	outline:none;
}
</style>
</body>
</html>