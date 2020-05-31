<?php
include("connect.php");
session_start();
if(!isset($_SESSION['email'])){
header("Location:login.php");
}

$idpub = $_GET['idp'];
$email = $_GET['email'];
$rating = $_GET['r'];

    $checkrating = mysqli_query($con,"SELECT * FROM pubs WHERE idpub='$idpub' AND email='$email'");

	if(mysqli_num_rows($checkrating) != 0){
	mysqli_query($con,"INSERT INTO rating VALUES ('','$idpub','$email','$rating')");
	}else{
	mysqli_query($con,"DELETE FROM rating WHERE idpub='$idpub' AND email='$email'");
	mysqli_query($con,"INSERT INTO rating VALUES ('','$idpub','$email','$rating')");
	}








?>