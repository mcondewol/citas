<?php
/**
* BookMedik
* @author evilnapsis
* @url http://evilnapsis.com/about/
**/
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/SMTP.php';


include '../model/PacientData.php';
include "../../autoload.php";

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
if(count($_POST)>0){
	$user = new PacientData();
	$user->name = $_POST["name"];
	$user->lastname = $_POST["lastname"];

	$user->gender = $_POST["gender"];
	$user->day_of_birth = $_POST["day_of_birth"];
	 
	$user->dpi = $_POST["dpi"];
	

	$user->address = $_POST["address"];
	$user->email = $_POST["email"];
	$user->phone = $_POST["phone"];
    $user->password = sha1(md5($_POST["password"]));
	$user->add();
	try {
		$userEmail = $_POST["email"];
		// Server settings
		
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = 587;
	
		$mail->Username = 'support@wolvisor.com'; // YOUR gmail email
		//$mail->Password = 'zhikcngxixagwwri'; // YOUR gmail password
		$mail->Password = 'lmceoebvcleisjdx'; // YOUR gmail password
	
		// Sender and recipient settings
		$mail->setFrom('support@wolvisor.com', 'Aprofam');
		$mail->addAddress($userEmail, ''); 
		
		// Setting the email content
		$mail->IsHTML(true);
		$mail->Subject = "Nuevo Usuario";
		$mail->Body = 'Hola '. $_POST['name'].' '.$_POST['lastname'] . ' su usuario ha sido creado exitosamente. <br><br> Saludos,';
	
		if($mail->send()){
			echo "email enviado";
		}else{
			echo "no se envio";
		}
		
	} catch (Exception $e) {
		echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
	}
	Core::alert("¡Usuario Registrado Exitosamente!");
	Core::redir("/citas/index.php");

}


?>