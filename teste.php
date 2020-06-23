<?php
/*session_start();
ini_set("display_errors", 1);
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
*/
require 'conn.php'
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<?
		require 'header.php'
	?>
</head>
<body>


<script type="text/javascript">
	function Stars(totalStars){
	stars = [];
	for (var i = 0; i <= 5; i++) {
   		stars.push({
   			'star' : i
   		})
   		// more statements
	}

	return stars.map(x => {
		return `
			<label>star</label>
		`
	}).join('')
}
</script>
</body>
</html>