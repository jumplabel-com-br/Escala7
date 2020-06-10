<?php
session_start();
require_once('DBInserts.php');

require_once('PHPMailer/send-email.php');

$destinatario = array(
	"nome" => "Matheus Gomes",
	"email" => "matheus01gomes01ferreira2001@gmail.com"
);


$remetente = array(
	"nome" => "Matheus Gomes",
	"email" => "matheus.ferreira@jumplabel.com.br"
);

$status = send_email($destinatario,$remetente,'teste','teste1');

print_r($status);

?>