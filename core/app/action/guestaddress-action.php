<?php
/**
* BookMedik
* @author evilnapsis
**/
session_start();
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

$date = $_POST["date_at"];
$time = $_POST["time_at"];

$rx = ReservationData::getRepeated($_POST["medic_id"],$date,$time);
$dia = ReservationData::getDia($_POST["medic_id"],$date,$time);
$pacientEmail = $_POST['email'];
$pacientName = $_POST['name'];
$pacientLastname = $_POST['lastname'];
$pacientDpi = $_POST['dpi'];
if($dia == null){
    Core::alert('El medico seleccionado no cuenta con disponiblidad el día seleccionado');
    Core::redir("/citas/index.php?view=citasno");
} else {
    if($rx == null){

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

        $timestamp = strtotime($date); 
        $newDate = date("d-m-Y", $timestamp );
        $newTime = date('H:i A', strtotime($time));

        $pacientData = PacientData::getByDpi($pacientDpi);
        if($pacientData){
            $r = new ReservationData();
            $r->title = null;
            $r->note = null;
            $r->pacient_id = $pacientData->id;
            $r->medic_id = $_POST["medic_id"];
            $r->date_at = $_POST["date_at"];
            $r->time_at = $_POST["time_at"];
            $newTime = date('H:i A', strtotime($_POST["time_at"]));
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
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;
            
                $mail->Username = 'support@wolvisor.com'; // YOUR gmail email
                //$mail->Password = 'zhikcngxixagwwri'; // YOUR gmail password
                $mail->Password = 'lmceoebvcleisjdx'; // YOUR gmail password
            
                // Sender and recipient settings
                $mail->setFrom('support@wolvisor.com', 'Aprofam');
                $mail->addAddress($pacientEmail, '');
                
                // Setting the email content
                $mail->IsHTML(true);
                $mail->Subject = "Nueva Cita";
                $mail->Body = 'Hola '. $pacientName.' '.$pacientLastname . ', <br> Tu cita para el día '. $newDate. ' en el horario de ' .$newTime. ' se agendo de forma exitosa. <br><br> Saludos,';
            
                if($mail->send()){
                    echo "email enviado";
                }else{
                    echo "no se envio";
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