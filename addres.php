<?php
/**
* BookMedik
* @author evilnapsis
**/
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/phpmailer/src/SMTP.php';

// passing true in constructor enables exceptions in PHPMailer
$mail = new PHPMailer(true);
try {
    // Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'support@wolvisor.com'; // YOUR gmail email
    $mail->Password = 'elqbtqgcaicnnzsz'; // YOUR gmail password

    // Sender and recipient settings
    $mail->setFrom('support@wolvisor.com', 'Aprofam');
    $mail->addAddress('norellana@wol.group', 'Nery Orellana');

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Send email using Gmail SMTP and PHPMailer";
    $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';

    $mail->send();
    echo "Email message sent.";
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}

$rx = ReservationData::getRepeated($_POST["medic_id"],$_POST["date_at"],$_POST["time_at"]);
$dia = ReservationData::getDia($_POST["medic_id"],$_POST['date_at'],$_POST["time_at"]);
if($dia == null){
    Core::alert('El medico Seleccionado no cuenta con disponiblidad el día seleccionado');

} else {
    if($rx==null){
        $r = new ReservationData();
        $r->title = null;
        $r->note = null;
        $r->pacient_id = $_SESSION['user_id'];
        $r->medic_id = $_POST["medic_id"];
        $r->date_at = $_POST["date_at"];
        $r->time_at = $_POST["time_at"];
        $r->user_id = 1;
        
        $r->status_id = 1;
        $r->payment_id = 1;
        $r->price = 0;
        $r->sick = '';
        $r->symtoms = '';
        $r->medicaments = '';
        
        
        $r->add();
        
        Core::alert("Agregado exitosamente!");
        Core::redir("/Citas_Aprofam_user/index.php");
        }else{
        Core::alert("Error al agregar, Cita Repetida!");
        Core::redir("/Citas_Aprofam_user/AgendarCita.php");
    }
}

?>