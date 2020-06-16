<?php

//echo "dataSalva : $dataSalva";
$dataSalva = $_SESSION["ultimoAcesso"];
$agora = date("Y-n-j H:i:s");

$tempo_transcorrido = (strtotime($agora)-strtotime($dataSalva));

//echo "tempo_transcorrido : $tempo_transcorrido";

if($tempo_transcorrido >= 1600) {//6400 se passaram 120 minutos ou mais, 1600 para meia hora
      	header('Location:Error.php?M=QRCodeUser'); //envio ao usuário à página de erro caso seja usuário (pelo fato dele não estar no banco)
      //senão, atualizo a data da sessão
  }else {
  	$_SESSION["ultimoAcesso"] = $agora;
}
