<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Perguntas</title>
	<?php require_once("header.php")?>
</head>

<body class="background background-home">


	<?php require_once("logo.php")?>

	<div class="row">
		<?php require_once("nav.php")?>

		<div class="col s12 m9">
			<div class="card white">
				<div class="card-content white-text card-Pergunta">
					<table class="responsive-table">
						<thead class="color-default">
							<tr>
								<th>Questionário</th>
								<th>Pergunta</th>
								<th>Respotas</th>
								<th></th>
							</tr>
						</thead>

						<tbody class="color-default tbody-Perguntas">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col s12 m9">
			<div class="cards-footer">
				<div class="col s12 m12 right-align">
					<button class="btn btn-default" type="button" onclick="selectedQuestionario();$('#modalPergunta').modal('open');"><span class="d-none-mobile">+</span> Cadastrar</button>
				</div>
			</div>
		</div>

	</div>


	<!-- Modal Structure -->
	<div id="modalPergunta" class="modal">
		<div class="modal-content">
			<div class="col s12 m12 right-align">
				<img src="images/icons/close.png" class="responsive-img modal-close" onclick="clearForm('#formPergunta')">
			</div>

			<div class="">
				<div class="col s12 m3 center-align">
					<img src="images/icons/user-bgd-blue.png" class="responsive-img">
				</div>
			</div>

			<div class="container center-align">
				<form id="formPergunta">
					<div class="input-field col s12 m7">
						<input type="text" name="Pergunta" id="Pergunta" class="autocomplete c-blue" plc="Pergunta">
						<label for="Pergunta" class="c-blue">Pergunta</label>
					</div>

					<div class="input-field col s12 m7">
						<select id="Tipo" class="c-blue" plc="Tipo" onchange="toggleRespostas();">
							<option value="" disabled selected>Tipo</option>
							<option value="1">Combo</option>
							<option value="0">Texto</option>
						</select>
					</div>

					<div class="input-field col s12 m7">
						<select id="Status" class="c-blue" plc="Status">
							<option value="" disabled selected>Status</option>
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
						</select>
					</div>


					<input type="hidden" name="controlButton" id="controlButton" value="Salvar">
					<input type="hidden" name="Id" id="Id">
				</form>

				<div class="modal-footer">
					<div class="col s12 m12">
						<button type="button" class="btn btn-blue btn-action-formPergunta" onclick="CreatePerguntas()">Salvar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="modalEditPergunta" class="modal">
		<div class="modal-content">
			<div class="col s12 m12 right-align">
				<img src="images/icons/close.png" class="responsive-img modal-close" onclick="clearForm('#formPergunta')">
			</div>

			<div class="">
				<div class="col s12 m3 center-align">
					<img src="images/icons/user-bgd-blue.png" class="responsive-img">
				</div>
			</div>

			<div class="container center-align">
				<form id="formEditPergunta">
					<div class="input-field col s12 m7">
						<select id="Questionarios" class="c-blue SelectQuestionarios" plc="Questionarios">
						</select>
						<i class="material-icons right i-default add-circle-respostas" onclick="CreateQuestionarioPerguntas();">add_circle</i>
					</div>

					<br>

					<div class="input-field col s12 m7">
						<input type="text" name="Pergunta" id="Pergunta" class="autocomplete c-blue" plc="Pergunta">
						<label for="Pergunta" class="c-blue">Pergunta</label>
					</div>

					<div class="input-field col s12 m7">
						<select id="Tipo" class="c-blue" plc="Tipo" onchange="toggleRespostas();" disabled>
							<option value="" disabled selected>Tipo</option>
							<option value="1">Combo</option>
							<option value="0">Texto</option>
						</select>
					</div>

					<div class="input-field col s12 m7">
						<select id="Status" class="c-blue" plc="Status">
							<option value="" disabled selected>Status</option>
							<option value="1">Ativo</option>
							<option value="0">Inativo</option>
						</select>
					</div>

					<div class="input-field col s12 m7 div-respostas" style="display: none">
						<input type="text" name="Resposta" id="Resposta" class="autocomplete c-blue" plc="Resposta">
						<label for="Resposta"0 class="c-blue">Resposta</label>
						<i class="material-icons prefix right i-default add-circle-respostas" onclick="CreateRespostas();">add_circle</i>
					</div>

					<div class="input-field col s12 m7">
						<table class="responsive-table" id="table-Respostas">
						<thead class="color-default">
							<tr>
								<th>#</th>
								<th>Respotas</th>
							</tr>
						</thead>

						<tbody class="color-default tbody-Respostas">
							
						</tbody>
					</table>
					</div>


					<input type="hidden" name="controlButton" id="controlButton" value="Salvar">
					<input type="hidden" name="Id" id="Id">
				</form>

				<div class="modal-footer">
					<div class="col s12 m12">
						<button type="button" class="btn btn-blue btn-action-formPergunta" onclick="UpdatePerguntas()">Salvar</button>
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
	<script type="text/javascript" src="ajax/GenericFunctions.js"></script>
	<script type="text/javascript" src="js/Generic.js?<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Perguntas/Perguntas.js?<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js"></script>
</body>
</html>