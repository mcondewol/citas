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

$datet = explode(" ",$_POST["date_time"]);
$rx = ReservationData::getRepeated($_POST["medic_id"],$datet[0],$datet[1]);
$dia = ReservationData::getDia($_POST["medic_id"],$datet[0],$datet[1]);
if($dia == null){
    Core::alert('El medico Seleccionado no cuenta con disponiblidad el día seleccionadooooo');

} else {
    if($rx == null){
        $time = strtotime($datet[0]);
        $ymd = DateTime::createFromFormat('d/m/Y', $datet[0])->format('Y-m-d');
        $r = new ReservationData();
        $r->title = null;
        $r->note = null;
        $r->pacient_id = $_SESSION['user_id'];
        $r->medic_id = $_POST["medic_id"];
        $r->date_at = $ymd;
        $r->time_at = $datet[1];
        $r->user_id = 1;
        $r->status_id = 1;
        $r->payment_id = 1;
        $r->price = 0;
        $r->sick = '';
        $r->symtoms = '';
        $r->medicaments = '';
        $r->add();
        //echo json_encode($_SESSION);
        // $pacient = PacientData::getById($_SESSION['user_id']);
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
            $mail->addAddress($_SESSION['email'], '');
            
            // Setting the email content
            $mail->IsHTML(true);
            $mail->Subject = "Nueva Cita";
            $mail->Body = 'Hola '. $_SESSION['username'].' '.$_SESSION['lastname'] . ', <br> Tu cita para el día '. $datet[0]. ' en el horario de ' .$datet[1]. ' se agendo de forma exitosa. <br><br> Saludos,';
        
            if($mail->send()){
                echo "email enviado";
            }else{
                echo "no se envio";
            }
            
        } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
        }
        Core::alert("Agregado exitosamente!");
        Core::redir("/citas/index.php?view=reservations");
    }else{
        echo "else";
        Core::alert("Error al agregar, Cita Repetida!");
        Core::redir("/citas/index.php?view=reservations");
    }
}

?>