<?php  
$servername = "localhost";
$username = "root";
$password = "root";


function get_connect(){
   $conn = new mysqli("localhost", "root", "root", "hope_research");

   if(! $conn ) {
      die('Could not connect: ' . mysql_error());
   }
   
   return $conn;
}

function register_new_user($username, $email, $password){
	$db_con = get_connect();
	if(!check_exists($db_con, $username,$email)){
		if($db_con->query("insert into user values('$username','$email','$password','')") === TRUE) {
			echo "{  Response : 200,  Message : \"User Registered Successfully\"}";
		}
		else{
			echo "{  Response : 500,  Message : \"".$db_con->error."\"}";
		}
	}
	else{
		echo "{  Response : 409,  Message : \"UserName or email id already Registered\"}";	
	}
}


function check_exists($con, $username, $email){
	if($res=$con->query("select * from user where username='".$username."' or email='".$email."'")) {
		if($res->num_rows > 0){
			return true;
		}
		else
			return false;
	}
	else{
		echo "{  Response : 500,  Message : \"".$db_con->error."\"}";
		exit();
	}
}


function isValid($con, $email, $password){
	if($res=$con->query("select * from user where email='".$email."' and password='".$password."'")) {
		if($res->num_rows > 0){
			return true;
		}
		else
			return false;
	}
	else{
		echo "{  Response : 500,  Message : \"".$db_con->error."\"}";
		exit();
	}
}

function isValidUser($email, $password){
	$con=get_connect();
	if(isValid($con,$email,$password)){
		echo "{  Response : 200,  Message : \"Valid User\"}";
	}
	else
		echo "{  Response : 401,  Message : \"emailid or password is wrong\"}";
}

function isValidMail($email) {
	$con=get_connect();
	if($res=$con->query("select * from user where email='".$email."'")) {
		if($res->num_rows > 0){
			return true;
		}
		else
			return false;
	}
	else{
		echo "{  Response : 500,  Message : \"".$db_con->error."\"}";
		exit();
	}
}

function updateToken($token,$email){
	$con=get_connect();
	
		if($con->query("update user set token='$token' where email='$email'")===TRUE)
			echo "{  Response : 200,  Message : \"Recovery mail sent.check mail\"}";
		else{
			echo "{  Response : 500,  Message : \"".$db_con->error."\"}";
			exit();
		}
		
	
}

function changePassword($email, $oldpass, $newpass){
	$con=get_connect();
	if(isValid($con,$email,$oldpass)){
		if($con->query("update user set password='$newpass' where email='$email'")===TRUE)
			echo "{  Response : 200,  Message : \"password updated successfully\"}";
		else{
			echo "{  Response : 500,  Message : \"".$db_con->error."\"}";
			exit();
		}
		
	}
	else{
		echo "{  Response : 401,  Message : \"old password is wrong\"}";
	}
}

function isValidToken($token,$email){
	$con=get_connect();
	if($res=$con->query("select * from user where email='".$email."' and token='".$token."'")) {
		if($res->num_rows > 0){
			return true;
		}
		else
			return false;
	}
	else{
		echo "{  Response : 500,  Message : \"".$db_con->error."\"}";
		exit();
	}
}

function updatePassword($email, $newpass){
	$con=get_connect();
		if($con->query("update user set password='$newpass' where email='$email'")===TRUE){
			$con->close();
			updateToken("",$email);
			echo "{  Response : 200,  Message : \"password updated successfully\"}";
		}
		else{
			echo "{  Response : 500,  Message : \"".$db_con->error."\"}";
			exit();
		}
		
}

?>