<?php
/**
* BookMedik
* @author evilnapsis
**/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/../../../vendor/phpmailer/phpmailer/src/SMTP.php';
include "../../autoload.php";
include '../model/ReservationData.php'; 
include '../model/PacientData.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);

$mail->CharSet = 'UTF-8';

$datet = explode(" ",$_POST["date_time"]);
$rx = ReservationData::getRepeated($_POST["medic_id"],$datet[0],$datet[1]);
$dia = ReservationData::getDia($_POST["medic_id"],$datet[0],$datet[1]);

$pacientEmail = $_POST['email'];
$pacientName = $_POST['name'];
$pacientLastname = $_POST['lastname'];
$pacientDpi = $_POST['dpi'];
if($dia == null){
    Core::alert('El medico seleccionado no cuenta con disponiblidad el día seleccionado');
    Core::redir("/citas/index.php?view=citasno");
} else {
    if($rx == null){
        $time = strtotime($datet[0]);
        $ymd = DateTime::createFromFormat('d/m/Y', $datet[0])->format('Y-m-d');


        $pacient = new PacientData();

        $pacient->name = $pacientName;
	    $pacient->lastname = $pacientLastname;
	    $pacient->gender = $_POST["gender"];
	    $pacient->day_of_birth = $_POST["day_of_birth"];
	    $pacient->address = $_POST["address"];
	    $pacient->email = $pacientEmail;
	    $pacient->phone = $_POST["phone"];
        $pacient->dpi = $pacientDpi;
	    $pacient->add();

        $timestamp = strtotime($datet[0]); 
        $newDate = date("d-m-Y", $timestamp );
        $newTime = date('H:i A', strtotime($time));

        $pacientData = PacientData::getByDpi($pacientDpi);
        if($pacientData){
            $r = new ReservationData();
            $r->title = null;
            $r->note = null;
            $r->pacient_id = $pacientData->id;
            $r->medic_id = $_POST["medic_id"];
            $r->date_at = $ymd;
            $r->time_at = $datet[1]; 
            $newTime = date('H:i A', strtotime($datet[1]));
            $r->user_id = 1;
            $r->status_id = 1;
            $r->payment_id = 1;
            $r->price = 0;
            $r->sick = '';
            $r->symtoms = '';
            $r->medicaments = '';
            $r->add();

            try {
           
                // Server settings
                $mail->isSMTP();
                $mail->Host = 'mail.aprofam.net';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
            
                $mail->Username = 'servicioalcliente@aprofam.net'; // YOUR gmail email
                $mail->Password = 'Aprofam2022*'; // YOUR gmail password
            
                // Sender and recipient settings
                $mail->setFrom('servicioalcliente@aprofam.net', 'Aprofam');
                $mail->addAddress($pacientEmail, '');
                
                // Setting the email content
                $mail->IsHTML(true);
                $subject = "Nueva cita";
                $subject = utf8_decode($subject);
                $mail->Subject = $subject;
                $mail->Body = 'Hola '. $pacientName.' '.$pacientLastname . ', <br> Tu cita para el día '. $datet[0]. ' en el horario de ' .$newTime. ' se agendo de forma exitosa. <br><br> Saludos,';
            
                if($mail->send()){
                    $sended = true;
                }else{
                    $sended = false;
                }
                
            } catch (Exception $e) {
                echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            }
            Core::alert("Agregado exitosamente!");
            Core::redir("/citas/index.php?view=citasno");
        }
        
    }else{
        echo "else";
        Core::alert("Error al agregar, Cita Repetida!");
        Core::redir("/citas/index.php?view=citasno");
    }
}

?>