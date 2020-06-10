<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Questionários</title>
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
								<th>Nome</th>
								<th>Status</th>
								<th></th>
							</tr>
						</thead>

						<tbody class="color-default tbody-Questionarios">
							
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="col s12 m9">
			<div class="cards-footer">
				<div class="col s12 m12 right-align">
					<button class="btn btn-default" type="button" onclick="$('#modalQuestionario').modal('open');optionCRUDQuestionarios('Salvar')"><span class="d-none-mobile">+</span> Cadastrar</button>
				</div>
			</div>
		</div>

	</div>


	<!-- Modal Structure -->
	<div id="modalQuestionario" class="modal">
		<div class="modal-content">
			<div class="col s12 m12 right-align">
				<img src="images/icons/close.png" class="responsive-img modal-close" onclick="clearForm('#formQuestionario')">
			</div>

			<div class="">
				<div class="col s12 m3 center-align">
					<img src="images/icons/user-bgd-blue.png" class="responsive-img">
				</div>
			</div>

			<div class="container center-align">
				<form id="formQuestionario">
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
						<label class="color-default">Status</label>
					</div>

					<input type="hidden" name="controlButton" id="controlButton" value="Salvar">
					<input type="hidden" name="Id" id="Id">
				</form>

				<div class="modal-footer">
					<div class="col s12 m12">
						<button type="button" class="btn btn-blue btn-view-perguntas left" onclick="returnPerguntas($('#formQuestionario #Id').val())">Visualizar</button>
						<button type="button" class="btn btn-blue btn-action-formQuestionario">Salvar</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="modalPerguntas" class="modal">
		<div class="modal-content">
			<h4 class="title-campanha center color-default"></h4>
			<p class="return-perguntas"></p>

			<div class="modal-footer">
				<div class="col s12 m12">
					<button type="button" class="btn btn-blue" onclick="$('#modalPerguntas').modal('close');$('#modalQuestionario').modal('open');">Fechar</button>
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

	<?
		require_once('footer.php');
	?>
	<input type="hidden" name="valueScanner" id="valueScanner">
	<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">
	<input type="hidden" name="UserInactivity" id="UserInactivity" value="<?=$_SESSION['User']?>">
	<input type="hidden" name="Campanha" id="Campanha" value="<?=$_SESSION["Campanha"]?>">
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="js/Generic.js?<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Questionarios/Questionarios.js?<?=date('d/m/Y-H:i:s')?>"></script>
	
</body>
</html>