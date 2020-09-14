<?php
session_start();

//ini_set("display_errors", 1);

require_once('DBInserts.php');
require_once('startPage.php');

if (!isset($_SESSION["ultimoAcesso"])) {
	if (empty($_SESSION["ultimoAcesso"])) {
		$_SESSION["ultimoAcesso"] = date("Y-n-j H:i:s");
	}
}else{
	$_SESSION["ultimoAcesso"] = $_SESSION["ultimoAcesso"];
}

//$_SESSION['BarOpen'] = isset($_GET['BarOpen']) ? $_GET['BarOpen'] : '';

if (isset($_GET['Questionario'])) {
	$_SESSION['Questionario'] = $_GET['Questionario'];
}else{
	$_SESSION["Questionario"] = "";
}

$User = isset($_SESSION['User']) ? $_SESSION['User'] : '';
//$BarOpen = $_SESSION['BarOpen'];

if (isset($_GET['IC'])) {
	$IC = $_GET['IC'];
}

if (isset($_POST['IC'])) {
	$IC = $_POST['IC'];
}

if (isset($_GET['VC'])) {
	$_SESSION["VC"] = $_GET['VC']; 
}else{
	$_SESSION["VC"] = $_SESSION["VC"]; 
}

if (isset($_GET['FotosOk'])) {
	$_SESSION["FotosOk"] = $_GET['FotosOk']; 
}else{
	$_SESSION["FotosOk"] = $_SESSION["FotosOk"]; 
}

$_SESSION["IC"] = $IC;
$replaceUser = array(".", "-");

isset($_POST['Usuario']) ? $_SESSION['User'] = str_replace($replaceUser, "", $_POST['Usuario']) : '';

$Campanha = Select('escala75_Easy7', 'Id, QRCode, Campanha, IdQuestionario, IFrame, Dt_Inicio, Dt_Termino, Status', 'Campanhas', "Id =".$_SESSION["IC"], "",$link);
$_SESSION["Campanha"] = $Campanha;

function bloqueioFotos(){
	if ($_SESSION["VC"] != "T" || $_SESSION["FotosOk"] == "T") {
		echo 'disabled';
	}
}

function bloqueioQuestionario(){
	if ($_SESSION["FotosOk"] != "T" || $_SESSION["Questionario"] == "OK") {
		echo 'disabled';
	}
}

//var_dump($_SESSION["Campanha"]);
//var_dump(array($Campanha));
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<?php require_once("header.php")?>

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

	<section class="center section-minha-campanha" style="display: none">
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
					<a class="btn btn-rounded b-blue bkg-white c-blue topics-buttons <?php bloqueioFotos()?>" href="Fotos.php?type=New&getType=usr&IC=<?=$IC?>">
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
					<a class="btn btn-rounded b-blue bkg-white c-blue topics-buttons <?php bloqueioQuestionario()?>" href="QuestionarioCampanha.php?type=New&getType=usr&IC=<?=$IC?>">
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
	
	<?php
		if ($_SESSION["Questionario"] == "OK" && $_SESSION["FotosOk"] == "T" && $_SESSION["VC"] == "T") {
			echo '
				<div id="modalFinish" class="modal modal-finish open background bckg-modal-finish">
					<div class="modal-content center">
						<div class="row col s12 m4 center">
							<img src="images/MOBILE/4_wireframes_mobile_etapaconcluida/logo_branco.png" class="responsive-img">
						</div>

						<div class="col s12 m4 center box-opacity-white">
							<img src="images/MOBILE/4_wireframes_mobile_etapaconcluida/icone_etapaconcluida.png" width="100" class="ml-10-p">
							<p class="color-default upper">
								<strong>Parábens</strong>
								<br>
								Você concluiu todas as etapas.
								<br>
								<strong>Não há pendências</strong> em suas campanhas.
							</p>
							<p>
								&nbsp;
							</p>
						</div>

						<div class="col s12 m4 center">
							<button type="button" class="btn btn-default" onclick="logoff(`usr`);">Confirmar</button>
						</div>
					</div>
				</div>

				<script type="text/javascript">
					$(document).ready(function(){
						$(".modal").modal();
						$("#modalFinish").modal("open");
					});
				</script>
			';
		}
	?>
	

	<script type="text/javascript">
		$(document).ready(function(){
			$('.collapsible').collapsible('open');
			
			/*			
			let VC  = <?=isset($_SESSION["VC"]) ? $_SESSION["VC"] : ""?>;
			let FotosOk  = <?=isset($_SESSION["FotosOk"]) ? $_SESSION["FotosOk"] : ""?>;
			let Questionario  = <?=isset($_SESSION["Questionario"]) ? $_SESSION["Questionario"] : ""?>;



			if (VC == "T" && FotosOk == "T" && Questionario == "OK") {
				$('#modalFinish').modal('open');
			}
			*/
			//$('.section-estrutura-campanha').hide();
		});
	</script>
	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="materialize/js/materialize.min.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>

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