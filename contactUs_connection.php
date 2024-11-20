<?php
	include('smtp/PHPMailerAutoload.php');
	
	if(isset($_POST['send']))
	{
		echo smtp_mailer();
	}
	
	function smtp_mailer()
	{
		$user_name = $_POST['name'];
		$user_mail = $_POST['email'];
		$user_contact = $_POST['contact'];
		$user_msg = $_POST['msg'];
		$message = "Name: $user_name <br> Email: $user_mail <br> Contact: $user_contact <br> Message: $user_msg";
		$mail = new PHPMailer(); 
		$mail->IsSMTP(); 
		$mail->SMTPAuth = true; 
		$mail->SMTPSecure = 'tls'; 
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 587; 
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		// $mail->SMTPDebug = 2;
		$mail->Username = "";  // Sender Email Id
		$mail->Password = "";  // Email Id Password
		$mail->SetFrom("");    // Sender Email Id Same
		$mail->Subject = 'Hackathon Contact';
		$mail->Body =$message;
		$mail->AddAddress(''); // Reciver Email Id
		$mail->SMTPOptions=array('ssl'=>array(
			'verify_peer'=>false,
			'verify_peer_name'=>false,
			'allow_self_signed'=>false
		));
		if(!$mail->Send()){
			echo $mail->ErrorInfo;
		}else{
?>
			<script>alert("Message Send");</script>
<?php
		}
	}
?>