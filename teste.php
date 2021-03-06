<?php 
session_start();
//require_once('startPage.php');
?>
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
					<!--<select class="center Questionarios" id="QuestionariosRL"></select>-->
					<div class="row">
						<div class="col s12">
							<div class="row">
								<div class="input-field col s12">
									<input type="text" id="CampanhasRL" class="center Campanhas autocomplete">
									<label for="CampanhasRL">Campanhas</label>
								</div>
							</div>
						</div>
					</div>
				</div>

				<footer class="footer" style="position: absolute;bottom:0;margin: 35px 35px; width: 79%; text-align: center">
					<button class="btn btn-blue" onclick="extrairRespostasLivres();">Extrair</button>
				</footer>
			</div>
		</div>

		<div class="col s12 m3">
			<div class="card white card-home">
				<div class="card-content white-text">
					<span class="card-title color-default f-Helvetica-Bold left-align">Gráfico <br> Respostas</span>
					<!--<select class="center Questionarios" id="QuestionariosRC" onchange="extrairRespostasCombo()"></select>-->
					<div class="row">
						<div class="col s12">
							<div class="row">
								<div class="input-field col s12">
									<input type="text" id="CampanhasRC" class="center Campanhas autocomplete" onchange="extrairRespostasCombo()">
									<label for="CampanhasRC">Campanhas</label>
								</div>
							</div>
						</div>
					</div>
					<div class="PerguntasRC">
						<select class="center Perguntas" id="PerguntasRC" onchange="returnPerguntas($('#CampanhasRC').val());"></select>
					</div>
				</div>

				<footer class="footer" style="position: absolute;bottom:0;margin: 35px 35px; width: 79%; text-align: center">
					<button class="btn btn-blue" onclick="extractCombo();">Extrair</button>
				</footer>
			</div>
		</div>

		<div class="col s12 m3">
			<div class="card white card-home">
				<div class="card-content white-text">
					<span class="card-title color-default f-Helvetica-Bold center-align">Mapa <br> &nbsp;</span>
					<div class="row">
						<div class="col s12">
							<div class="row">
								<div class="input-field col s12">
									<input type="text" id="CampanhasMapa" class="center Campanhas autocomplete" onchange="createLocations();">
									<label for="CampanhasMapa">Campanhas</label>
								</div>
							</div>
						</div>
					</div>
					<div id="map" style="width: 100%; height: 330px;"></div>
				</div>
			</div>
		</div>
	</div>

	
	<div id="modal1" class="modal">
		<div class="modal-content">
			<a href="#!" class="modal-close waves-effect btn btn-blue right" onclick="$('#modalProgress').modal('close')">x</a>
			<div id="RespostasCombo" style="height: 370px; width: 100%;"></div>
		</div>
		<div class="modal-footer">
			
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
	
	<input type="hidden" name="valueScanner" id="valueScanner">
	<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">

	<?	
	if ($_SESSION["UserType"] == 0) {
		echo "<input type='hidden' name='IdUser' id='IdUser' value=".$_SESSION["IdUser"].">";
	}
	?>
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="js/Generic.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Campanhas/Campanhas.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Relatorios/ReportRespostasLivres.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Relatorios/ReportRespostasCombo.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Relatorios/Mapa.js?date=<?=date('d/m/Y-H:i:s')?>"></script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			selectCampanhas()

		});

		
	</script>
</body>
</html>