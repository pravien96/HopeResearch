<?php
	include 'DB.php';

	$newpassword=$_POST["newpassword"];
	$email=$_GET["email"];
	$token=$_GET["token"];
	

	if(isValidToken($token,$email)){
		updatePassword($email,$newpassword);
	}else{
		echo "{  Response : 500,  Message : \"invalid token\"}";
	}


?>