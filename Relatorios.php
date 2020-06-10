<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
	<title>Relatorios</title>
	<?php require_once("header.php")?>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyBOni-fl7eqwuCXR7qUppY4-afzDp31oaU&callback=initMap&sensor=false" type="text/javascript"></script>

</head>
<body class="background background-home">

	<?php require_once("logo.php")?>

	<div class="row">
		
		<?php require_once("nav.php")?>

		<div class="col s12 m3">
			<div class="card white card-home">
				<div class="card-content white-text">
					<span class="card-title color-default f-Helvetica-Bold left-align">Relatório <br> Respostas livres</span>
					<select class="center Questionarios" id="QuestionariosRL"></select>
					<select class="center Campanhas" id="CampanhasRL"></select>
				</div>

				<footer class="footer" style="position: absolute;bottom:0;margin: 35px 35px; width: 79%; text-align: center">
					<button class="btn btn-blue" onclick="extrairRespostasLivres();">Extrair</button>
				</footer>
			</div>
		</div>

		<div class="col s12 m3">
			<div class="card white card-home">
				<div class="card-content white-text">
					<span class="card-title color-default f-Helvetica-Bold left-align">Gráfico <br> Respostas combos</span>
					<select class="center Questionarios" id="QuestionariosRC" onchange="extrairRespostasCombo()"></select>
					<select class="center Campanhas" id="CampanhasRC" onchange="extrairRespostasCombo()"></select>
				</div>
			</div>
		</div>

		<div class="col s12 m3">
			<div class="card white card-home">
				<div class="card-content white-text">
					<span class="card-title color-default f-Helvetica-Bold center-align">Mapa <br> &nbsp;</span>
					<select class="center Campanhas" id="CampanhasMapa" onchange="createLocations();"></select>
					<div id="map" style="width: 100%; height: 330px;"></div>
				</div>
			</div>
		</div>
	</div>

	
	<div id="modal1" class="modal">
		<div class="modal-content">
			<div id="RespostasCombo" class="col"></div>
		</div>
		<div class="modal-footer">
			<a href="#!" class="modal-close waves-effect btn btn-blue">x</a>
		</div>
	</div>

	<div class="hide" id="relatorioRespostasLivres">
		<table id="tableRespostasLivres" border="1">
			<thead id="theadRespostasLivres">
				<th>CPF</th>
				<th>Data</th>
				<th>Campanha</th>
				<th>Questionário</th>
				<th>Pergunta</th>
				<th>Resposta</th>
			</thead>
			<tbody id="tbodyRespostasLivres">

			</tbody>
		</table>
	</div>

	<div class="hide" id="relatorioRespostasCombo">
		<table id="tableRespostasCombo" border="1">
			<thead id="theadRespostasCombo">
				<th>CPF</th>
				<th>Data</th>
				<th>Campanha</th>
				<th>Questionário</th>
				<th>Pergunta</th>
				<th>Resposta</th>
			</thead>
			<tbody id="tbodyRespostasCombo">

			</tbody>
		</table>
	</div>

	<div id="modalProgress" class="modal modal-progress">
		<div class="modal-content">
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
	</div>
	<?
		require_once('footer.php');
	?>
	<input type="hidden" name="valueScanner" id="valueScanner">
	<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="js/Generic.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Campanhas/Campanhas.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Relatorios/ReportRespostasLivres.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Relatorios/ReportRespostasCombo.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Relatorios/Mapa.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			selectedQuestionario();
			//createLocations();;
		});

		
	</script>
</body>
</html>