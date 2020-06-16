<?php 
	session_start();
	require_once('startPage.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Campanhas</title>
	<?php require_once("header.php")?>
</head>

<body class="background background-home">

	<?php require_once("logo.php")?>

	<div class="row">
		<?php require_once("nav.php")?>

		<div class="col s12 m9">
			<div class="card white">
				<div class="card-content white-text card-campanha">
					<table class="responsive-table">
						<thead class="color-default">
							<tr>
								<th>Id</th>
								<th>QR Code</th>
								<th>Campanha</th>
								<th>Data Inicio</th>
								<th>Data Término</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>

						<tbody class="color-default tbody-campanhas">

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col s12 m9">
			<div class="cards-footer">
				<div class="col s6 m3 left-align">
					<button class="btn btn-default" type="button" onclick="$('#modalFiltros').modal('open')">Filtros</button>
				</div>
				<div class="col s6 m9 right-align">
					<button class="btn btn-default" type="button" onclick="$('#modalCampanha').modal('open');clearForm('#formCampanha');$('select').formSelect();selectedQuestionario();$('.editShow').addClass('hide');"><span class="d-none-mobile">+</span> Cadastrar</button>
				</div>
			</div>
		</div>
	</div>

	<div id="modalFiltros" class="modal">
		<div class="modal-content">
			<img src="images/icons/close.png" class="responsive-img modal-close">
		</div>
		<div class="container center-align">
			<form id="formFilters">
				<div class="input-field col s12 m7">
						<select id="StatusFilter" class="c-blue">
							<option value="" disabled selected>Status</option>
							<option value="1">Ativo</option>
							<option value="0">Desativado</option>
						</select>
						<label class="color-default">Status</label>
					</div>
			</form>
		</div>
	</div>


	<!-- Modal Structure -->
	<div id="modalCampanha" class="modal">
		<div class="modal-content">
			<div class="col s12 m12 right-align">
				<img src="images/icons/close.png" class="responsive-img modal-close" onclick="clearForm('#formCampanha')">
			</div>

			<div class="">
				<div class="col s12 m3 center-align">
					<img src="images/icons/user-bgd-blue.png" class="responsive-img">
				</div>
			</div>

			<div class="container center-align">
				<form id="formCampanha">
					<div class="input-field col s12 m7">
						<input type="text" name="Id" id="Id" disabled="">
						<label for="Id" class="c-blue">Id</label>
					</div>

					<div class="input-field col s12 m7">
						<input type="text" name="QRCode" id="QRCode" class="autocomplete c-blue" plc="QR Code">
						<label for="QRCode" class="c-blue">QR Code</label>
					</div>

					<div class="input-field col s12 m7">
						<input type="text" id="Campanha" class="autocomplete c-blue" plc="Campanha">
						<label for="Campanha" class="c-blue">Campanha</label>
					</div>

					<div class="input-field col s12 m7">
						<select id="Questionarios" class="c-blue" plc="Questionarios">
						</select>
						<label class="color-default">Questionários</label>
					</div>

					<div class="input-field col s12 m7">
						<input type="text" id="Dt_Inicio" class="datepicker c-blue" plc="Data Inicio">
						<label for="Dt_Inicio" class="c-blue">Data Inicio</label>
					</div>

					<div class="input-field col s12 m7">
						<input type="text" id="Dt_Termino" class="datepicker c-blue" plc="Data Término">
						<label for="Dt_Termino" class="c-blue">Data Término</label>
					</div>

					<div class="input-field col s12 m7">
						<select id="Status" class="c-blue" plc="Status">
							<option value="" disabled selected>Status</option>
							<option value="1">Ativo</option>
							<option value="0">Desativado</option>
						</select>
						<label class="color-default">Status</label>
					</div>

					<div class="input-field col s12 m7">
						<input type="text" id="IFrame" class="autocomplete c-blue" plc="IFrame">
						<label for="IFrame" class="c-blue" class="c-blue">IFrame</label>
					</div>

					
					<div class="hide editShow">
						<div class="input-field col s12 m7">
							<select id="VinculoCliente" class="c-blue">

							</select>
							<label class="color-default">Vinculo de cliente por campanha</label>
							<i class="material-icons right i-default pointer add-circle-respostas" onclick="addClientInTemplate();">add_circle</i>
						</div>

						<br>

						<div class="input-field col s12 m7">
							<table id="table-Clientes" class="responsive-table">
								<thead class="color-default">
									<tr>
										<td>#</td>
										<td>Cliente</td>
									</tr>
								</thead>
								<tbody class="tbody-Clientes color-default">

								</tbody>
							</table>
						</div>

						<div class="input-field col s12 m7">
							<div id="qrcode"></div>
						</div>
						<div class="input-field col s12 m7">
							<iframe src="" id="iframeCampanha" style="width: auto; height: auto"></iframe>
						</div>

					</div>

					<input type="hidden" name="controlButton" id="controlButton" value="Salvar">
				</form>

				<div class="modal-footer">
					<div class="col s12 m12">
						<? 
							if ($_SESSION["UserType"] == 1) { 
								echo "<button type='button' class='btn btn-blue btn-action-formCampanha' onclick='$(this).html() == `Salvar` ? CRUDCampanhas(`Insert`) : CRUDCampanhas(`Update`)'>Salvar</button>";
							}
						?>
						
					</div>
				</div>
			</div>
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
	?>
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="QRCode/qrcodeJquery.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Generic.js?<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Campanhas/Campanhas.js?<?=date('d/m/Y-H:i:s')?>"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/readQrCode.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/takePicture.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
-->
</body>
</html>