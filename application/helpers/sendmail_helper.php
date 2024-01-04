<?php 
require_once APPPATH."third_party/PHPMailer/PHPMailer.php";
require_once APPPATH."third_party/PHPMailer/SMTP.php";
require_once APPPATH."third_party/PHPMailer/Exception.php";

use PHPMailer\PHPMailer\PHPMailer;	
function sendmail($from, $fromname, $to, $subject, $content){

	$mail = new PHPMailer();

	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = "admin@thegabsjeans.com";
	$mail->Password = "b3l4nj4j34ns";
	$mail->Port = 465;
	$mail->SMTPSecure = 'ssl';

	$mail->isHTML(true);
	$mail->setFrom($from, $fromname);
	$mail->addAddress($to);
	$mail->Subject = $subject;
	$mail->Body = $content;


	if ($mail->Send()){
		$response = true;
	}else{
		$response = "Something is wrong! ".$mail->ErrorInfo;
	}

	return $response;

}

