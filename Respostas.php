<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Respostas</title>
	<?php require_once("header.php")?>
</head>

<body class="background background-home">

	<?php require_once("logo.php")?>

	<div class="row">
		<?php require_once("nav.php")?>

		<div class="col s12 m9">
			<div class="card white">
				<div class="card-content white-text card-Questionario">
					<table class="responsive-table">
						<thead class="color-default">
							<tr>
								<th>Status</th>
								<th>Campanhas</th>
								<th>Respostas</th>
								<th></th>
							</tr>
						</thead>

						<tbody class="color-default tbody-Respostas">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


	<!-- Modal Structure -->
	<div id="modalResposta" class="modal">
		<div class="modal-content div-questionario-campanha">
		</div>
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
	<input type="hidden" name="UserInactivity" id="UserInactivity" value="<?=$_SESSION['User']?>">
	<?php
		if ($_SESSION["UserType"] == 0) {
			echo "<input type='hidden' name='IdUser' id='IdUser' value=".$_SESSION["IdUser"].">";
		}

		require_once('footer.php');
	?>
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="js/Generic.js?<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Respostas/Respostas.js?<?=date('d/m/Y-H:i:s')?>"></script>
</body>
</html>