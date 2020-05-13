<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Usuários</title>
	<?php require_once("header.php")?>
</head>

<body class="background background-home">


<?php require_once("logo.php")?>


<div class="row">
	<?php require_once("nav.php")?>

	<div class="col s12 m1"></div>
	<div class="col s12 m8" style="overflow-x: auto; height: 475px; padding-bottom: 10px;">
		<div class="row-cards-usuarios"></div>
	</div>

	<div class="col s12 m9">
		<div class="cards-footer">
			<div class="col s12 m1"></div>
			<div class="col s6 m2 center">
				<button class="btn btn-default" type="submit">Relatório</button>
			</div>
			<div class="col s2 m7"></div>
			<div class="col s6 m2 right-align">
				<button class="btn btn-default" type="button" onclick="setHTMLButtonModal('Salvar')" class="modal-trigger"><span class="d-none-mobile">+</span> Cadastrar</button>
			</div>
		</div>
	</div>
</div>

<div id="modalUser" class="modal">
	<div class="modal-content">
		<div class="col s12 m12 right-align">
			<img src="images/icons/close.png" class="responsive-img modal-close" onclick="clearForm('#formUser');">
		</div>
		
		<div class="">
			<div class="col s12 m3 center-align">
				<img src="images/icons/user-bgd-blue.png" class="responsive-img">
			</div>
		</div>

		<div class="container center-align">
			<form id="formUser">
				<div class="input-field col s12 m7">
					<input type="text" name="Nome" id="Nome" class="autocomplete c-blue" plc="Nome">
					<label for="Nome" class="c-blue">Nome</label>
				</div>

				<div class="input-field col s12 m7">

					<input type="text" id="CPF" class="autocomplete c-blue">
					<label for="CPF" class="c-blue">CPF</label>
				</div>

				<div class="input-field col s12 m7">

					<input type="text" id="Email" class="autocomplete c-blue" plc="Email">
					<label for="Email" class="c-blue">Email</label>
				</div>

				<div class="input-field col s12 m7">

					<input type="password" id="Senha" class="autocomplete c-blue" plc="Senha">
					<label for="Senha" class="c-blue">Senha</label>
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

					<select id="UserType" class="c-blue" plc="Tipo de Usuario">
						<option value="" disabled selected>Tipo de usuário</option>
						<option value="1">Administrador</option>
						<option value="2">Cliente</option>
					</select>
					<label class="color-default">Tipo de usuário</label>
				</div>

				<input type="hidden" name="controlButton" id="controlButton" value="Salvar">
				<input type="hidden" name="Id" id="Id">
			</form>

			<div class="modal-footer">
				<div class="col s12 m12">
					<button type="button" class="btn btn-blue btn-action-formUser" onclick="$(this).html() == 'Salvar' ? CRUDUsers('Insert') : CRUDUsers('Update');">Salvar</button>
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
<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/Usuarios/Usuarios.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/Generic.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/readQrCode.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/takePicture.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
-->
</body>
</html>