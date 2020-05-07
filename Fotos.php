<?php
session_start();

require_once('DBInserts.php');

$getType = $_GET["getType"];
$IC = $_GET["IC"];

$Campanha = Select('escala75_Easy7', '*', 'Campanhas', "Id = $IC", "",$link);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Fotos</title>
	<?php require_once("header.php")?>
</head>

<body class="background-home">

	<div class="container-new-foto">
		<div class="row">
			<div class="col s6 m6">
				<a href="HomeMobile.php?getType=usr&IC=<?=$IC?>"><i class="medium material-icons">keyboard_backspace</i></a>
			</div>

			<div class="col s6 m6">
				<a href="HomeMobile.php?getType=usr&IC=<?=$IC?>"><i class="medium material-icons right">home</i></a>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m12">
				<div class="card-content center white color-default">
					<div class="center col s12 white">
						<h5 class="title-campanha"></h5>
					</div>
				</div>
			</div>	
		</div>

		<div class="row">
			<div class="col s12 m12">
				<div class="cards-footer" id="myCamera">

				</div>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m12">
				<div class="card-content center">
					<div class="center col s12">
						<button class="btn" onclick="takePicture();">Tirar Foto</button>
					</div>
				</div>
			</div>	
		</div>
	</div>

	<div class="container-view-fotos" style="display: none">
		<div class="row">
			<div class="col s6 m6">
				<a href="HomeMobile.php?getType=usr&IC=<?=$IC?>"><i class="medium material-icons">keyboard_backspace</i></a>
			</div>

			<div class="col s6 m6">
				<a href="HomeMobile.php?getType=usr&IC=<?=$IC?>"><i class="medium material-icons right">home</i></a>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m12">
				<div class="card-content center white color-default">
					<div class="center col s12 white">
						<h5 class="title-campanha"></h5>
					</div>
				</div>
			</div>	
		</div>

		<div class="row opacity-70">
			<div class="col s12 m12">
				<div class="cards-footer">
					<div id="results"></div>

					<div class="row mt-2">
						<div class="col s4 m4 center">
							<div class="min-cards-footer center pictures" id="picture_1" img="" onclick="setPrevia(pictures[0].img)">
								<div class=" ">
									<label class="label-pictures">FOTO 1</label>
								</div>
							</div>
						</div>
						<div class="col s4 m4 center">
							<div class="min-cards-footer center pictures" id="picture_2" img="" onclick="pictures[1] != undefined ? setPrevia(pictures[1].img) : ''">
								<label class="label-pictures">FOTO 2</label>
							</div>
						</div>
						<div class="col s4 m4 center">
							<div class="min-cards-footer center pictures" id="picture_3" img="" onclick="pictures[2] != undefined ? setPrevia(pictures[2].img) : ''">
								<label class="label-pictures">FOTO 3</label>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s4 m4 center">
				<i class="medium material-icons i-red tooltipped" data-position="top" data-tooltip="Excluir" onclick="deletePicture();">delete</i>
			</div>
			<div class="col s4 m4 center">
				<i class="medium material-icons i-black tooltipped" data-position="top" data-tooltip="Nova foto" onclick="newPicture();">add_circle_outline</i>
			</div>
			<div class="col s4 m4 center">
				<i class="medium material-icons i-green tooltipped" data-position="top" data-tooltip="Enviar fotos" onclick="savePicture();">send</i>
			</div>
		</div>
	</div>

	<input type="hidden" name="latitue" id="latitue">
	<input type="hidden" name="longitude" id="longitude">

	<div id="modalProgress" class="modal modal-progress">
		<div class="modal-content">	
			<div class="progress">
				<div class="indeterminate"></div>
			</div>
		</div>
	</div>
	<input type="hidden" name="valueScanner" id="valueScanner">
	<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">
	<input type="hidden" name="UserInactivity" id="UserInactivity" value="<?=$_SESSION['User']?>">
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="ajax/AjaxGenericDB.js"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js"></script>
	<script src="materialize/js/materialize.js"></script>
	<script src="js/Generic.js"></script>
	<script src="js/geoLocation.js"></script>
	<script src="js/takePicture.js"></script>
	<script type="text/javascript" src="js/VideoInstitucional/Video.js?<?=date('d/m/Y-H:i:s')?>"></script>

	<script type="text/javascript">
		Campanha = <?=$Campanha?>;

		$('.title-campanha').html(`${Campanha[0]['Campanha']}`)
	</script>
</body>
</html>