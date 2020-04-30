<?php


// O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
// O return-path deve ser ser o mesmo e-mail do remetente.
$destinatario = $_POST["destinatario"];
$senha = $_POST["senha"];

$headers = "MIME-Version: 1.1\r\n";
$headers .= "Content-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: matheus.ferreira@jumplabel.com.br\r\n"; // remetente
$headers .= "Return-Path: matheus.ferreira@jumplabel.com.br\r\n"; // return-path
echo "$destinatario "."Esqueci minha senha Escala 7 "."Sua nova senha para logar é: $senha ".$headers;
die;
$envio = mail("$destinatario", "Esqueci minha senha Escala 7", "Sua nova senha para logar é: $senha", $headers);
 
if($envio)
 echo "Mensagem enviada com sucesso";
else
 echo "A mensagem não pode ser enviada";

 /*ini_set('display_errors', 1);

 error_reporting(E_ALL);

 $from = "contato@jumplabel.com.br";

 $to = "matheus01gomes01ferreira2001@gmail.com";

 $subject = "Verificando o correio do PHP";

 $message = "O correio do PHP funciona bem";

 $headers = "De:". $from;

 mail($to, $subject, $message, $headers);

 echo "A mensagem de e-mail foi enviada.";*/
?>