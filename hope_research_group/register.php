<?php 
	include 'DB.php';
	$name = $_POST["name"];
	$email = $_POST["email"];
	$password = $_POST["password"];

	register_new_user($name, $email, $password);
	
 ?>