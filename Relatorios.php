<!DOCTYPE html>
<?php session_start();?>
<html>
<head>
	<title>Relatorios</title>
	<?php require_once("header.php")?>

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


	<div id="map" style="width: 500px; height: 400px;"></div>

	<input type="hidden" name="valueScanner" id="valueScanner">
	<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="js/Generic.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Campanhas/Campanhas.js"></script>
	<script type="text/javascript" src="js/Relatorios/ReportRespostasLivres.js"></script>
	<script type="text/javascript" src="js/Relatorios/ReportRespostasCombo.js"></script>

	<script type="text/javascript">
		jQuery(document).ready(function($) {
			selectedQuestionario();
			createLocations();;
		});

		var str = '';
		var locations = [];
		var infosLocation;
		var strArr = [];
		var strArrStr = [];	

		function createLocations(){
			let Schema = 'escala75_Easy7';
			let tableName = 'ImagensCampanha';
			let columns = 'Latitude, Longitude';
			let option = 'Select'

			let params = {
				Schema,
				tableName,
				columns,
				option
			}

			$.ajax({
				url: 'DBInserts.php',
				type: 'POST',
				dataType: 'json',
				data: params,
			})
			.done(function(data) {
				console.log("success");

				if (data.length > 0) {
					locations = [];
					str = ''
					data.map(elem => {
						returnLocation(elem.Latitude, elem.Longitude);

		        		//locations += `[${returnLocation(elem.Latitude, elem.Longitude)}, ${elem.Latitude}, ${elem.Longitude}]`;
		    		});

		    		str = str.substr(0,str.length-1).split('],');

		    		setTimeout(function (){
		    			str.forEach(elem => {
		    				strArrStr.push(elem.replace("]]", "]").replace('undefined', ''));
		    			});

		    			strArrStr.forEach(elem => {
		    				elem != "" ? locations.push(JSON.parse(elem)) : '';
		    			});

		    			initMap(locations);
		    		},3000)
				}
			})
			.fail(function() {
				console.log("error");
			});
		}


		function returnLocation(lat, log){
			let latlng = 'latlng='+lat+','+log;
			let key = 'key=AIzaSyDv2yk_203Fn3MlfqoMbJ22OIkbqWW3YLQ';

			$.ajax({
				url: 'https://maps.googleapis.com/maps/api/geocode/json?'+key+'&'+latlng,
				type: 'GET',
				dataType: 'json',
				async: false,
		    //data: {latlng, key},
		})
			.done(function(data) {
		    //console.log("success: ", data.results[0].formatted_address);
		    str += `["${data.results[0].formatted_address}", ${lat}, ${log}]],`;

		    // str = str.replace(/undefined/g,'');

		})
			.fail(function() {
				console.log("error");
			});

		}


		function initMap(locations){

			var map = new google.maps.Map(document.querySelector('#map'), {
				zoom: 10,
				center: new google.maps.LatLng(-33.92, 151.25),
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});

			var infowindow = new google.maps.InfoWindow();

			var marker, i;

			for (i = 0; i < locations.length; i++) {  
				marker = new google.maps.Marker({
					position: new google.maps.LatLng(locations[i][1], locations[i][2]),
					map: map
				});

				google.maps.event.addListener(marker, 'click', (function(marker, i) {
					return function() {
						infowindow.setContent(locations[i][0]);
						infowindow.open(map, marker);
					}
				})(marker, i));
			}

		}
	</script>
</body>
</html>