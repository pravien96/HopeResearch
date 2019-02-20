<?php 
	include 'DB.php';
	$email=$_POST["email"];
	$password=$_POST["password"];

	isValidUser($email,$password);

	

?>