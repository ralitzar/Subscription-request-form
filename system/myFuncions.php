<?php

	function get_post_data($arr = false) {
		if ($arr === false)
			$arr = $_POST;
		array_walk_recursive($arr, 'get_var_ref');
		return $arr;
	}


<?php
	require_once "vendor/autoload.php";

	$mail = new PHPMailer;

	//Enable SMTP debugging. 
	$mail->SMTPDebug = 3;                               
	//Set PHPMailer to use SMTP.
	$mail->isSMTP();            
	//Set SMTP host name                          
	$mail->Host = "smtp.gmail.com";
	//Set this to true if SMTP host requires authentication to send email
	$mail->SMTPAuth = true;                          
	//Provide username and password     
	$mail->Username = "ralitza.raynova@gmail.com";                 
	$mail->Password = "Pw4Gmail";                           
	//If SMTP requires TLS encryption then set it
	$mail->SMTPSecure = "tls";                           
	//Set TCP port to connect to 
	$mail->Port = 587;                                   

	$mail->From = "ralitza.raynova@gmail.com";
	$mail->FromName = "Ralitza Raynova";

	$mail->addAddress("ralitza.raynova@gmail.com", "Recepient Name");

	$mail->isHTML(true);

	$mail->Subject = "Test";
	$mail->Body = "<i>formRegistration.html</i>";
	$mail->AltBody = "This is the plain text version of the email content";

	if(!$mail->send()) 
	{
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} 
	else 
	{
	    echo "Message has been sent successfully";
	}

?>