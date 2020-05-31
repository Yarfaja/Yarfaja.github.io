<!DOCTYPE html>
<html>
<head>
<script src='js/jquery.js'></script>
<script src='js/blur.js'></script>
<script src='js/code.js'></script>
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



<div style='font-family:Poppins;font-size:13px;float:left;width:30%;background-color:#279b48;height:100vh;text-align:center;filter: blur(4px);' id='div1'>
<br><br>

<a href='javascript:void(0);' id='lets1' style='text-decoration:none;color:#279b48;font-weight:bold;font-size:14px;width:50%;background-color:#EEEEEE;border-radius:100px;padding:1% 20%;'>Let's volunteer !</a>

<br><br><br><br><br><br>
<div style='text-align:left;color:white;width:80%;margin-left:10%;font-weight:bold;font-family:Arimo;font-size:15px;line-height:1.8;word-spacing:4px;'>
Indicator 3.3 By 2030, end the epidemics of AIDS, tuberculosis, 
malaria and neglected tropical diseases and combat hepatitis,
 water-borne diseases and other communicable diseases.
</div>
<br><br><br><br><br>
<img src='images/3.png' style='width:50%;'>


</div>


<div style='font-family:Poppins;font-size:13px;float:left;width:40%;background-color:white;height:100vh;text-align:center;filter: blur(4px);' id='div2'>

<div style='width:50%;float:left;height:100vh;'>
<br><br><br><br><br><br><img src='images/1.png' style='width:90%;'><br><br>
<div style='text-align:left;width:80%;margin-left:10%;font-weight:bold;font-family:Arimo;font-size:15px;line-height:1.8;word-spacing:4px;'>
Indicator 11.5.2, Direct disaster economic loss in relation to the global GDP,
 including disaster damage to critical infrastructure and disruption of basic services
 
</div>
</div>


<div style='width:50%;float:left;height:100vh;'>
<img src='images/2.png' style='width:90%;margin-top:-10px;'><br><br>
<div style='text-align:left;width:80%;margin-left:10%;font-weight:bold;font-family:Arimo;font-size:15px;line-height:1.8;word-spacing:4px;'>
Indicator 11.A Support positive economic,
 social and environmental links between urban,
 peri-urban and rural areas by strengthening national and regional development planning
</div>
</div>



<div style='clear:both;'></div>
<a href='javascript:void(0);' id='lets2' style='position:absolute;bottom:5%;left:28%;text-decoration:none;color:black;font-weight:bold;font-size:14px;background-color:#EEEEEE;border-radius:100px;padding:0.3% 12%;'>Let's volunteer !</a>

</div>



<div style='font-family:Poppins;font-size:13px;float:left;width:30%;background-color:#00aed9;height:100vh;text-align:center;filter: blur(4px);' id='div3'>
<br><br>
<a href='javascript:void(0);' id='lets3' style='text-decoration:none;color:#279b48;font-weight:bold;font-size:14px;width:50%;background-color:#EEEEEE;border-radius:100px;padding:1% 20%;'>Let's volunteer !</a>

<br><br><br>


<br><br>
<div style='text-align:left;width:80%;margin-left:10%;font-weight:bold;color:white;font-family:Arimo;font-size:15px;line-height:1.8;word-spacing:4px;'>
Indicator 6.3By 2030, improve water quality by reducing pollution, eliminating dumping and minimizing release of hazardous chemicals and materials, halving the proportion of untreated wastewater and substantially increasing recycling and safe reuse globally
</div>
<br><br><br>
<img src='images/4.png' style='width:50%;'>
</div>


<div style='clear:both;'></div>






<style>
body{
margin:0;

}
</style>
</body>
</html>