<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
include 'DB.php';

$email=$_POST["email"];

if(isValidMail($email)){
	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
	    //Server settings
	    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
	    $mail->isSMTP();                                      // Set mailer to use SMTP
	    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth = true;                               // Enable SMTP authentication
	    $mail->Username = 'mpravien1996@gmail.com';                 // SMTP username
	    $mail->Password = 'Premad123.';                           // SMTP password
	    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	    $mail->Port = 587;  
	    //$mail->refreshToken = '9e57c96d4bd1eb1b4345b1ccf4da0c9e'                                  // TCP port to connect to

	    //Recipients
	    $mail->setFrom('from@example.com', 'Mailer');
	    $mail->addAddress($email, 'hope_user');     // Add a recipient


	    //Content
	    $mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = 'Reset Password Link';
	    $token=rand(10000,200000);
	    $mail->Body = "Sample rest call for password change:<br>curl -X POST 'http://localhost/hope_research_group/resetpassword.php?token=".$token."&email=".$email."' -F newpassword=<b>YOUR_NEW_PASSWORD</b>";
	    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

	    $mail->send();
	    updateToken($token,$email);
	} catch (Exception $e) {
	    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}

}
else{
	echo "{  Response : 500,  Message : \"email id not registered in hope_research\"}";
}



?>