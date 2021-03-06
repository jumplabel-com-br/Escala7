<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require_once('../conn.php');
ini_set("display_errors", 1);
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';


$destinatarioEmail = $_POST["destinatarioEmail"];
$destinatarioNome = $_POST["destinatarioNome"];
$remetenteEmail = $_POST["remetenteEmail"];
$remetenteNome = $_POST["remetenteNome"];
$assunto = $_POST["assunto"];
$mensagem = $_POST["mensagem"];
$senha = $_POST["senha"];
$objBd = new db();
$link = $objBd->conecta_mysql();
$sqlQuery = "Update escala75_Easy7.Users set Senha = '$senha' where Email = '$destinatarioEmail'";
//echo "$sqlQuery <br>";

if (!mysqli_query($link, $sqlQuery)) {
     printf("Errormessage: %s\n", mysqli_error($link));
}
//echo 'teste'.$destinatarioEmail;
//die;

function send_email($destinatarioEmail,$destinatarioNome,$remetenteEmail,$remetenteNome,$assunto,$mensagem,$senha)
{

    $status = array();
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'wp190.hostgator.com.br';//'mail.easy7.info'; //'SMTP.office365.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'andre@easy7.info';                     // SMTP username
        $mail->Password   = 'Jleasy7@';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($remetenteEmail, $remetenteNome);
        $mail->addAddress($destinatarioEmail, $destinatarioNome);

        //$mail->setFrom($remetente["email"], $remetente["nome"]);
        //$mail->addAddress($destinatario["email"], $destinatario["nome"]);     // Add a recipient
        //$mail->addReplyTo('defaind@gmail.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $assunto;
        $mail->Body    = $mensagem;//["html"];
        //$mail->AltBody = $mensagem["txt"];

        $mail->send();
        $status["send"] = 0;
    } 
    catch (Exception $e) {
        $status["send"] = 0;
        $status["erro"] = $mail->ErrorInfo;
    }
    //return $status;
}

send_email($destinatarioEmail,$destinatarioNome,$remetenteEmail,$remetenteNome,$assunto,$mensagem,$senha);
/*function send_email($destinatario,$remetente,$assunto,$mensagem)
{
    $status = array();
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 1;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'wp190.hostgator.com.br';//'mail.easy7.info'; //'SMTP.office365.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'matheus.ferreira@easy7.info';                     // SMTP username
        $mail->Password   = 'jleasy7';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients

        $mail->setFrom($remetente["email"], $remetente["nome"]);
        $mail->addAddress($destinatario["email"], $destinatario["nome"]);     // Add a recipient
        //$mail->addReplyTo('defaind@gmail.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = $assunto;
        $mail->Body    = $mensagem;//["html"];
        //$mail->AltBody = $mensagem["txt"];

        $mail->send();
        $status["send"] = 1;

        Update("escala75_easy7", "Users", "Senha = $senha", "Email = ".$destinatario["email"]);
    } 
    catch (Exception $e) {
        $status["send"] = 0;
        $status["erro"] = $mail->ErrorInfo;
    }
    return $status;
}*/

