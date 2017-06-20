<?php

	# - Load data coming from post form into variables corresponding to names of form elements

	function get_post_data($arr = false)
	{
		if ($arr === false)
			$arr = $_POST;
	
		array_walk_recursive($arr, 'get_var_ref');

		return $arr;
	}
	
	# - Apply few funcitons for get entry data
	
	function get_var($item)
	{
		if (get_magic_quotes_gpc())
			$item = stripslashes($item);
			
		$item = trim($item);
		$item = htmlspecialchars($item);
		$item = str_replace(array ("'", "$", "\\"), array ("&#39;", "&#36;", "&#92;"), $item);

		return $item;
	}
	
	function reverse_var($item)
	{
		$item = str_replace( array ("&#39;", "&#36;", "&#92;"), array ("'", "$", "\\"), $item );
		$item = htmlspecialchars_decode( $item );
		
		return $item;
	}

	# - Apply few funcitons for get entry data by reference
	
	function get_var_ref(&$item)
	{
		$item = get_var($item);
	}
	
	# - Get raw data
	
	function get_raw($item, $notrim = false)
	{
		if (get_magic_quotes_gpc())
			$item = stripslashes($item);
		
		if (!$notrim)
			$item = trim($item);
	
		return $item;
	}
	
	// Debug
	
	function pr( $var )
	{
		echo "<pre>";
		// var_dump( $var );
		print_r( $var );
		echo "</pre>";
	}

	function cDate( $date )
	{
		$result = false;

		if ($date)
			$result = substr( $date, 6, 4 ).'-'.substr( $date, 3, 2 ).'-'.substr( $date, 0, 2 );
			
		return $result;
	}

	function rDate( $date )
	{
		$result = false;
		
		if ($date)
			$result = substr( $date, 8, 2 ).'.'.substr( $date, 5, 2 ).'.'.substr( $date, 0, 4 );
			
		return $result;
	}	

/*
	function send_mail( $to, $subject, $body )
	{
	
		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = "smtp.gmail.com";						// Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'ralitza.raynova@gmail.com';				                 // SMTP username
		$mail->Password = 'Pw4Gmail';               	            // SMTP password
		// $mail->SMTPSecure = 'tls';	                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to
		// $mail->SMTPSecure = 'ssl';	                            // Enable TLS encryption, `ssl` also accepted
		// $mail->Port = 465;
		$mail->Port = 25;

		$mail->CharSet = 'UTF-8';
		$mail->setFrom("myemail@abv.bg", 'Subject');
		// $mail->addAddress('tng@gbg.bg', 'Joe User');     // Add a recipient
		$mail->addAddress($to);               // Name is optional
		$mail->addReplyTo("reply@abv.bg");
		// $mail->addCC('cc@example.com');
		// $mail->addBCC('bcc@example.com');

		// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $body;

		
		// $log = "";
		
		// $log .= "<br><div style='background:#bfc8f8;'>".date("Y-m-d H:i:s")."</div><br>";
		// $log .= "To: <b>".$to."</b><br>";
		// $log .= "Subject: <b>".$subject."</b><br><br>";
		// $log .= $body."<br><Br>";
		
		// $log .= file_get_contents('cache/mail-log.html');
		// file_put_contents('cache/mail-log.html', $log);
		
		
		return $mail->send();
	}	
*/

	function send_mail( $to, $subject, $body )
	{
/*
		$body = "
			<div style='width:600px; border:2px solid #3498db; border-radius:10px; padding:30px; padding-top:20px; margin-top:15px;'>
			<div style='font-size:20px; border-bottom: 1px dotted #AAAAAA; padding-bottom:20px; margin-bottom:20px;'><span style='color:#4f4f4f;'>".$subject."</span></div>
			<div style='font-family: Verdana; color: #4f4f4f;'>
		".$body."
			</div>
			</div>
		";
*/

		$mail = new PHPMailer;

		$mail->isSendMail();

/*
		//Enable SMTP debugging. 
		// $mail->SMTPDebug = 3;                               
		//Set PHPMailer to use SMTP.
		$mail->isSMTP();            
		//Set SMTP host name                          
		//$mail->Host = "smtp.gmail.com";
		$mail->Host = "auth.smtp.1and1.co.uk";
		//Set this to true if SMTP host requires authentication to send email
		$mail->SMTPAuth = true;                          
		//Provide username and password     
		$mail->Username = "webform@boyanmaga.org";                 
		$mail->Password = "Pw4Webform";                           
		//If SMTP requires TLS encryption then set it
		$mail->SMTPSecure = "tls";                           
		//Set TCP port to connect to 
		$mail->Port = 587;                                   
*/

		$mail->CharSet = 'UTF-8';

		$mail->From = "webform@boyanmaga.org";
		$mail->FromName = "Boyan Maga";

		$mail->addAddress( $to, "Родител" );
		$mail->addReplyTo("info@boyanmaga.org");
		$mail->addCC('webform@boyanmaga.org');

		$mail->isHTML(true);

		$mail->Subject = $subject;
		$mail->Body = $body;
		$mail->AltBody = "This is the plain text version of the email content";

		if(!$mail->send()) 
		{
			return false;

		    // echo "Mailer Error: " . $mail->ErrorInfo;
		} 
		else 
		{
			return true;
		    // echo "Message has been sent successfully";
		}
	}

?>