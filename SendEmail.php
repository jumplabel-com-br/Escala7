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
?>