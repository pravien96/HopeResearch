<?php
	include 'DB.php';

	$email=$_POST["email"];
	$oldpassword=$_POST["oldpassword"];
	$newpassword=$_POST["newpassword"];

	changePassword($email,$oldpassword,$newpassword);
?>