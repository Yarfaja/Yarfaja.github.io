<?php
include("connect.php");
session_start();
if(!isset($_SESSION['email'])){
header("Location:login.php");
}

$idpub = $_GET['idp'];
$email = $_GET['email'];


    $checkpub = mysqli_query($con,"SELECT * FROM pubs WHERE idpub='$idpub' AND email='$email'");

	
	mysqli_query($con,"DELETE FROM pubs WHERE id='$idpub' AND email='$email'");
	








?>