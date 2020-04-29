<?php
session_start();
require_once('DBInserts.php');


$_SESSION['Questionario'] = "";
$_SESSION["VI"] = "";
$_SESSION["VC"] = "";
$_SESSION["FotosOk"] = "";

$User = isset($_SESSION['User']) ? $_SESSION['User'] : '';
$_SESSION['Questionario'] = isset($_GET['Questionario']) ? $_SESSION['Questionario'] : '';

if (isset($_GET['IC'])) {
	$IC = $_GET['IC'];
}

if (isset($_POST['IC'])) {
	$IC = $_POST['IC'];
}

$_SESSION["IC"] = $IC;
$replaceUser = array(".", "-");

isset($_POST['Usuario']) ? $_SESSION['User'] = str_replace($replaceUser, "", $_POST['Usuario']) : '';

$Campanha = Select('Escala7', 'Id, QRCode, Campanha, IdQuestionario, IFrame, Dt_Inicio, Dt_Termino', 'Campanhas', "Id =".$_SESSION["IC"], "",$link);
$_SESSION["Campanha"] = $Campanha;


$VI = isset($_GET["VI"]) ? $_SESSION["VI"] = $_GET["VI"] : '';
$VC = isset($_GET["VC"]) ? $_SESSION["VC"] = $_GET["VC"] : '';
$FotosOk = isset($_GET["FotosOk"]) ? $_SESSION["FotosOk"] = $_GET["FotosOk"] : '';
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
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/dist/jquery.mask.js"></script>
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/dist/jquery.mask.min.js"></script>
	<script type="text/javascript" src="jQuery-Mask-Plugin-master/src/jquery.mask.js"></script>

	<link rel="stylesheet" type="text/css" href="css/style.css?<?=date('d/m/Y-H:i:s')?>">
	<!-- Place your kit's code here -->
	<script src="https://kit.fontawesome.com/12838c155d.js" crossorigin="anonymous"></script>

</head>


<body>
	<!--class="" style="background-size: cover; background-repeat: no-repeat;"-->
	<section class="background-index">
		<div class="container">
			<div class="row center">
				<div class="col s4"></div>
				<div class="col s4">
					<img src="images/DESK/1_wireframes_web_login/logo_branco.png" class="responsive-img mt-50-p mb-50-p">
				</div>
				<div class="col s4"></div>
			</div>
		</div>
	</section>

	<section class="center section-minha-campanha">
		<div class="container center">
			<div class="col s12 center">
				<button class="btn btn-rounded b-blue bkg-white c-blue" onclick="$('.section-minha-campanha').hide(); $('.section-estrutura-campanha').show();">Minha Campanha</button>
			</div>
		</div>
	</section>

	<section class="center section-estrutura-campanha">
		<div class="container center container-informacoes-campanha">
			
		</div>
		<br>
		<div class="container center">
			<div class="row">
				<div class="col s12 center">
					<a class="btn btn-rounded b-blue bkg-white c-blue topics-buttons" href="Videos.php?type=Inst&getType=usr&IC=<?=$IC?>&VI=F">
						Video Institucional
						<i class="material-icons right i-default">videocam</i>
					</a>
				</div>
			</div>

			<div class="row">
				<div class="col s12 center">
					<a class="btn btn-rounded b-blue bkg-white c-blue topics-buttons" href="Videos.php?type=Mont&getType=usr&IC=<?=$IC?>&VC=F">
						Video Montagem
						<?php 
							if ($_SESSION["VC"] == "T") {
								echo '<i class="material-icons right i-default">check</i>';
							}else{
								echo '<i class="fas fa-exclamation-circle right "></i>';
							}
						?>
						<i class="material-icons right i-default">videocam</i>
					</a>
				</div>
			</div>

			<div class="row">
				<div class="col s12 center">
					<a class="btn btn-rounded b-blue bkg-white c-blue topics-buttons <?=$_SESSION["FotosOk"] == "T" ? "disabled" : ''?>" href="Fotos.php?type=New&getType=usr&IC=<?=$IC?>">
						Foto
						<?php 
							if ($_SESSION["FotosOk"] == "T") {
								echo '<i class="material-icons right i-default">check</i>';
							}else{
								echo '<i class="fas fa-exclamation-circle right "></i>';
							}
						?>
						<i class="fas fa-camera right"></i>
					</a>
				</div>
			</div>

			<div class="row">
				<div class="col s12 center">
					<a class="btn btn-rounded b-blue bkg-white c-blue topics-buttons" href="QuestionarioCampanha.php?type=New&getType=usr&IC=<?=$IC?>">
						Questionario
						<?php 
							if ($_SESSION["Questionario"] == "OK") {
								echo '<i class="material-icons right i-default">check</i>';
							}else{
								echo '<i class="fas fa-exclamation-circle right "></i>';
							}
						?>
						<i class="fas fa-question-circle right"></i>
					</a>
				</div>
			</div>
		</div>
	</section>

	<footer class="footer" style="position:relative;bottom:0; margin-top: 5%;">
		<section class="center">
			<div class="container center">
				<div class="col s12 center">
					<button class="btn btn-rounded b-blue bkg-blue c-white" onclick="logoff('usr');">Sair</button>
				</div>
				<div class="col s12 center">
					<i class="medium material-icons i-default" onclick="$('.section-minha-campanha').toggle(); $('.section-estrutura-campanha').toggle();">keyboard_arrow_up</i>
				</div>
			</div>
		</section>		
	</footer>


	<script type="text/javascript">
		$(document).ready(function(){
			$('.collapsible').collapsible();
			$('.section-estrutura-campanha').hide();
		});
	</script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
	<script type="text/javascript" src="materialize/js/materialize.js"></script>
	<script type="text/javascript" src="materialize/js/materialize.min.js"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js"></script>

	<script type="text/javascript">

		jQuery(document).ready(function($) {
			templateInformacoesCampanha(Campanha);	
		});

		var Campanha = <?=$Campanha?>;
		Campanha = Campanha;

		function datePtBr(date){
			date = date.replace(' 00:00:00', '');
			date = date.split('-');

			date = date[2]+'/'+date[1]+'/'+date[0];

			return date;
		}

		function templateInformacoesCampanha(Campanha){
			$('.container-informacoes-campanha').html(
				`
			<h5 class="color-default"><strong>Bem vindo</strong></h5>
			<i class="medium material-icons i-default" onclick="$('.section-minha-campanha').show(); $('.section-estrutura-campanha').hide();">keyboard_arrow_down</i>

			<div class="row">
				<div class="col s12">
					<h5 class="color-default left">${Campanha[0]["Campanha"]}</h5>
				</div>
			</div>

			<div class="row" style="margin-bottom: 0">
				<div class="col s6">
					<h5 class="color-default left">Status</h5>
				</div>

				<div class="col s6">
					<h5 class="color-default right">${Campanha[0]["Status"] == 0 ? 'Desativado' : 'Ativo'}</h5>
				</div>
			</div>
			<hr>

			<div class="row" style="margin-bottom: 0">
				<div class="col s6">
					<h5 class="color-default left">Inicio</h5>
				</div>

				<div class="col s6">
					<h5 class="color-default right">${datePtBr(Campanha[0]["Dt_Inicio"])}</h5>
				</div>
			</div>
			<hr>

			<div class="row" style="margin-bottom: 0">
				<div class="col s6">
					<h5 class="color-default left">Termino</h5>
				</div>

				<div class="col s6">
					<h5 class="color-default right">${datePtBr(Campanha[0]["Dt_Termino"])}</h5>
				</div>
			</div>
			<hr>
		`)
		}
		
	</script>
</body>
</html>