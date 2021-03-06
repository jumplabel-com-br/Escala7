<?php
//$User = isset($_SESSION['User']);
$M = $_GET["M"];
$Message;

if ($M == "QRCodeUser") {
	$Message = "Escanear novamente o QR Code/Logar novamente, pois sua sessão foi expirada";
}else if ($M == "CE") {
	$Message = "Campanha Expirada";
};

session_destroy(); // destruo a sessão
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<!--Import Jquey-->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<!--Import Google Icon Font-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<link rel="stylesheet" type="text/css" href="materialize/css/materialize.css">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!--Impor JQuery Mask Plugin-->
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/dist/jquery.mask.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/dist/jquery.mask.min.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/src/jquery.mask.js?date=<?=date('d/m/Y-H:i:s')?>"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css?<?=date('d/m/Y-H:i:s')?>">
</head>

<body class="background-index" style="background-size: cover; background-repeat: no-repeat;">

	<section class="mt-3">
		<div class="container ml-10-p">
			<div class="row center">
				<div class="col s4"></div>
				<div class="col s4">
					<img src="images/DESK/1_wireframes_web_login/logo_branco.png" class="responsive-img">
				</div>
				<div class="col s4"></div>
			</div>

			<div class="row center">
				<div class="col s12 center">
					<ul class="collapsible">
						<li>
							<div class="collapsible-header">
								<i class="material-icons i-default">filter_drama</i>
								Erro identificado
								<span class="new badge"></span>
							</div>
							<div class="collapsible-body"><p><?=$Message?></p></div>
						</li>
					</ul>				
				</div>
			</div>		
		</div>
	</section>


	<script type="text/javascript">
		$(document).ready(function(){
			$('.collapsible').collapsible();
		});
	</script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="materialize/js/materialize.min.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
</body>
</html>