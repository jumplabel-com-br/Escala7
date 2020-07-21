<?php

//echo "dataSalva : $dataSalva";
$dataSalva = $_SESSION["ultimoAcesso"];
$agora = date("Y-n-j H:i:s");

$tempo_transcorrido = (strtotime($agora)-strtotime($dataSalva));

$Email = isset($_SESSION["Email"]) ? $_SESSION["Email"] : "";
$Usuario = isset($_SESSION["User"]) ? $_SESSION["User"] : "";
//echo "tempo_transcorrido : $tempo_transcorrido";

if($tempo_transcorrido >= 3200 || ($Email == "" && $Usuario == "") ) {//6400 se passaram 120 minutos ou mais, 1600 para meia hora
      	header('Location:Error.php?M=QRCodeUser'); //envio ao usuário à página de erro caso seja usuário (pelo fato dele não estar no banco)
      //senão, atualizo a data da sessão
  }else {
  	$_SESSION["ultimoAcesso"] = $agora;
}
