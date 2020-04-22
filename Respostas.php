<?php
session_start();
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
	<link rel="stylesheet" href="materialize/css/materialize.css">
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
	<!-- Place your kit's code here -->
	<script src="https://kit.fontawesome.com/12838c155d.js" crossorigin="anonymous"></script>

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
				<h3 class="white-text"><strong>Questionarios Cadastradas</strong></h3>
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
						<li class="li-icon" title="Campanhas" ><a href="Campanhas.php"><i class="material-icons i-default">record_voice_over</i> Campanhas</a></li>
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
							<td>Ativo</td>
							<td>Campanha A</td>
							<td><button type="button" class="btn btn-blue waves-effect tooltipped"  data-position="bottom" data-tooltip="Visualizar respostas">Respostas (20)</button></td>
							<td><i class="material-icons i-default tooltipped" data-position="bottom" data-tooltip="Visualizar respostas">remove_red_eye</i></td>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col s12 m9">
			<div class="cards-footer">
				<div class="col s6 m3 left-align">
					<button class="btn btn-default" type="submit">Relatório</button>
				</div>
				<div class="col s6 m9 right-align">
					<button class="btn btn-default" type="button" onclick="$('#modalResposta').modal('open');optionCRUDQuestionarios('Salvar')"><span class="d-none-mobile">+</span> Cadastrar</button>
				</div>
			</div>
		</div>

	</div>


	<!-- Modal Structure -->
	<div id="modalResposta" class="modal">
		<div class="modal-content">
			<div class="col s12 m12 right-align">
				<img src="icons/close.png" class="responsive-img modal-close" onclick="clearForm('#formResposta')">
			</div>

			<div class="">
				<div class="col s12 m3 center-align">
					<img src="icons/user-bgd-blue.png" class="responsive-img">
				</div>
			</div>

			<div class="container center-align">
				<form id="formResposta">
					<div class="input-field col s12 m7">
						<input type="text" name="Name" id="Name" class="autocomplete c-blue">
						<label for="Name" class="c-blue">Nome</label>
					</div>

					<div class="input-field col s12 m7">
						<select id="Status" class="c-blue">
							<option value="" disabled selected>Status</option>
							<option value="1">Ativo</option>
							<option value="0">Desativado</option>
						</select>
					</div>

					<input type="hidden" name="controlButton" id="controlButton" value="Salvar">
					<input type="hidden" name="Id" id="Id">
				</form>

				<div class="modal-footer">
					<div class="col s12 m12">
						<button type="button" class="btn btn-blue btn-action-formResposta">Salvar</button>
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
	<script type="text/javascript" src="js/Generic.js?<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/AjaxGenericDB.js"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js"></script>
	<script src="materialize/js/materialize.js"></script>
	<script type="text/javascript" src="js/Respostas/Respostas.js?<?=date('d/m/Y-H:i:s')?>"></script>
</body>
</html>