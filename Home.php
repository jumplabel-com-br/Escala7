<?php
session_start();
require_once('conn.php');

$user = isset($_SESSION['User']) ? $_SESSION['User'] : '';
$objBd = new db();
$link = $objBd->conecta_mysql();
$sql = "select CPF from Escala7.Users where CPF = '$user'"; 

//echo $sql;
//die;


$result = mysqli_query($link, $sql);
$dados_usuario = mysqli_fetch_array($result);

		if (!isset($dados_usuario['CPF']) || empty($dados_usuario['CPF'])) {
			header('Location: Error.php');
		}
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
	<link rel="stylesheet" href="materialize/css/materialize.css?<?=date('d/m/Y-H:i:s')?>">
	<link rel="stylesheet" type="text/css" href="css/style.css?<?=date('d/m/Y-H:i:s')?>">
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!--Impor JQuery Mask Plugin-->
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>

	<!--Import InstaScan-->
	<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js" ></script>	
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.26/webcam.js"></script>

	<style type="text/css">
		#camera
		{
			background: #ff6666;
			height: 480px;
		}
		#previa
		{
			background: #ffc865;
			height: 480px;
		}
		#salva
		{
			background: #4dea02;
			height: 480px;
		}
	</style>
</head>

<body class="background background-home">

	<!--
	<ul class="sidenav" id="mobile-demo">
		<li class="tab" id="li-img-logo-max"><a href=""><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></a></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon" title="Usuários"><a href="Usuarios.php"><i class="material-icons">account_circle</i> Usuários</a></li>
		<li class="li-icon" title="Campanhas"><a href="#"><i class="material-icons">record_voice_over</i> Campanhas</a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i> Questionário</a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i> Respostas</a></li>
		<li class="li-icon" title="Video Institucional"><a href="#"><i class="material-icons">videocam</i> Video Institucional</a></li>
		<li class="li-icon" title="Sair"><a href="#"><i class="material-icons">settings</i> Sair</a></li>
	</ul>

	<ul class="sidenav-min" id="mobile-demo-1">
		<li class="tab" id="li-img-logo-min"><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon" title="Usuários"><a href="Usuarios.php"><i class="material-icons">account_circle</i></a></li>
		<li class="li-icon" title="Campanhas"><a href="#"><i class="material-icons">record_voice_over</i></a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i></a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i></a></li>
		<li class="li-icon" title="Video Institucional"><a href="#"><i class="material-icons">videocam</i></a></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon" title="Sair"><a href="#"><i class="material-icons">settings</i></a></li>
	</ul>
-->

<div class="container">
	<div class="row center-align">
		<div class="col s12 center-align">
			<div class="col s4"></div>
			<div class="col s4">
				<img src="images/DESK/1_wireframes_web_login/logo_branco.png" class="responsive-img tooltipped" data-position="bottom" data-tooltip="Home" onclick="window.location.href='Home.php'">
			</div>
			<div class="col s4"></div>
		</div>

		<div class="col s12">
			<h3 class="white-text"><strong>Seja Bem-Vindo</strong></h3>
			<h5 class="white-text">Administrador</h5>
		</div>
	</div>
</div>


<div class="row">
	<div class="col s12 m3">
		<div class="card white card-home">
			<div class="card-content white-text">
				<ul class="list-ul-organize">
					<li class="li-icon"><a href="#"> &nbsp;</a></li>
					<li class="li-icon" title="Usuários"><a href="Usuarios.php"><i class="material-icons i-default">account_circle</i> Usuários</a></li>
					<li class="li-icon" title="Campanhas"><a href="Campanhas.php"><i class="material-icons i-default">record_voice_over</i> Campanhas</a></li>
					<li class="li-icon dropdown-trigger" title="Questionário" href="#dropdownQuestionario"><a href="#"><i class="material-icons i-default">assignment</i> Questionários</a></li>
						<ul id='dropdownQuestionario' class='dropdown-content'>
							<li><a href="Questionario.php">Questionários</a></li>
							<li><a href="Perguntas.php">Perguntas</a></li>
						</ul>
					<li class="li-icon" title="Respostas"><a href="Respostas.php"><i class="material-icons i-default">check_box</i> Respostas</a></li>
					<li class="li-icon" title="Video Institucional"><a href="VideoInstitucional.php"><i class="material-icons i-default">videocam</i> Video Institucional</a></li>
					<li class="li-icon sair" title="Sair"><a onclick="logoff();"><i class="material-icons i-default">settings</i> Sair</a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="col s12 m3">
		<div class="card white card-home">
			<div class="card-content white-text">
				<span class="card-title color-default f-Helvetica-Bold left-align">Implatação <br> por Campanha</span>

			</div>
		</div>
	</div>

	<div class="col s12 m3">
		<div class="card white card-home">
			<div class="card-content white-text">
				<span class="card-title color-default f-Helvetica-Bold left-align">Questiónarios <br> Preenchidos</span>

			</div>
		</div>
	</div>

	<div class="col s12 m3">
		<div class="card white card-home">
			<div class="card-content white-text">
				<span class="card-title color-default f-Helvetica-Bold left-align">Campanhas <br> Cadastradas</span>

			</div>
		</div>
	</div>
</div>

<input type="hidden" name="valueScanner" id="valueScanner">
<input type="hidden" name="" value="<?=$_SESSION['User']?>">
<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="js/Generic.js"></script>
<script type="text/javascript" src="ajax/AjaxGenericDB.js"></script>
<script type="text/javascript" src="ajax/GenericFunctions.js"></script>
<script type="text/javascript">
		//selectDb(`select CPF, Senha from Escala7.Users`, 'json') 
		

		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.sidenav');
			var instances = M.Sidenav.init(elems);
		});

  // Initialize collapsible (uncomment the lines below if you use the dropdown variation)
  // var collapsibleElem = document.querySelector('.collapsible');
  // var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

  // Or with jQuery

  $(document).ready(function(){
  	$('.sidenav').sidenav();
  });

  $('#li-img-logo-min').on('click', function(event) {
  	$('#mobile-demo').show();
  	$('#mobile-demo-1').hide();
  	event.preventDefault();
  	/* Act on the event */
  });

  $('#li-img-logo-max').on('click', function(event) {
  	$('#mobile-demo').hide();
  	$('#mobile-demo-1').show();
  	event.preventDefault();
  	/* Act on the event */
  });
</script>
<script src="materialize/js/materialize.js"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js"></script>
<script type="text/javascript" src="js/readQrCode.js"></script>
<script type="text/javascript" src="js/takePicture.js"></script>
-->
</body>
</html>