<div class="col s12 m3">
	<div class="card white card-home">
		<div class="card-content white-text">
			<div class="collection">
				<a href="#" class="collection-item" style="border-bottom: 0px;">
					<span class="left badge">
						&nbsp;
					</span>
					&nbsp;
				</a>
				<?php
				if ($_SESSION["UserType"] == 1) {
					echo '
				<a href="Usuarios.php" class="collection-item">
					<span class="left badge">
						<i class="material-icons i-default">account_circle</i>
					</span>
					Usuários
				</a>';
				}
				?>

				<a href="Campanhas.php" class="collection-item">
					<span class="left badge">
						<i class="material-icons i-default">record_voice_over</i>
					</span>
					Campanhas
				</a>

				<?php
				if ($_SESSION["UserType"] == 1) {
					echo '
				<a href="#dropdownQuestionario" class="collection-item li-icon dropdown-trigger">
					<span class="left badge">
						<i class="material-icons i-default">assignment</i>
					</span>
					Questionários
				</a>
				<ul id="dropdownQuestionario" class="dropdown-content">
					<li>
						<a href="Questionario.php">Questionários</a>
					</li>
					<li>
						<a href="Perguntas.php">Perguntas</a>
					</li>
				</ul>
					';
				}
				?>

				<a href="Respostas.php" class="collection-item">
					<span class="left badge">
						<i class="material-icons i-default">check_box</i>
					</span>
					Respostas
				</a>
				<?php
				if ($_SESSION["UserType"] == 1) {
					echo '
				<a href="VideoInstitucional.php" class="collection-item">
					<span class="left badge">
						<i class="material-icons i-default">videocam</i>
					</span>
					Video Institucional
				</a>

				<a href="Relatorios.php" class="collection-item">
					<span class="left badge">
						<i class="material-icons i-default">archive</i>
					</span>
					Relatorios
				</a>

				<a href="Imagens.php" class="collection-item">
					<span class="left badge">
						<i class="material-icons i-default">folder</i>
					</span>
					Fotos
				</a>
				';
				}

				?>
			</div>
		</div>
		<footer class="footer" style="position: absolute;bottom:0;margin: 35px 35px;">
			<a href="#dropdownConfig" class="collection-item li-icon dropdown-trigger">
				<span class="left badge">
					<i class="material-icons i-default">settings</i>
				</span>
				Configurações
			</a>

			<ul id="dropdownConfig" class="dropdown-content" style="width: 225px;">
				<li>
					<a onclick="$('#modalAlterPass').modal('open')">Alterar Senha</a>
				</li>
				<li>
					<a onclick="logoff();">Sair</a>
				</li>
			</ul>
		</footer>
	</div>
</div>

<div id="modalAlterPass" class="modal modal-alt-pass">
	<div class="modal-content center">
		<div class="row center-align">
			<div class="col s12">
				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix i-default">assignment_ind</i>
						<input type="text" id="autocomplete-email" class="autocomplete c-blue">
						<label for="autocomplete-email">Email</label>
					</div>
				</div>


				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix i-default">assignment_ind</i>
						<input type="password" id="autocomplete-senha" class="autocomplete c-blue">
						<label for="autocomplete-senha">Senha</label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix i-default">assignment_ind</i>
						<input type="password" id="autocomplete-new-senha" class="autocomplete c-blue">
						<label for="autocomplete-new-senha">Nova Senha</label>
					</div>
				</div>

				<div class="row">
					<div class="input-field col s12">
						<i class="material-icons prefix i-default">assignment_ind</i>
						<input type="password" id="autocomplete-repetir-new-senha" class="autocomplete c-blue">
						<label for="autocomplete-repetir-new-senha">Repetir nova Senha</label>
					</div>
				</div>

				<div class="modal-footer">
					<div class="col s12 m12">
						<button type="button" class="btn btn-blue" onclick="verifcaSenhas()">Salvar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	function verifcaSenhas(){
		let email = $('#autocomplete-email').val();
		let senha = $('#autocomplete-senha').val();
		let novaSenha = $('#autocomplete-new-senha').val();
		let repetirNovaSenha = $('#autocomplete-repetir-new-senha').val();

		if (email == '') {
			M.toast({html: 'Informe o Email', displayLength: 4000});
		}else if (senha == '') {
			M.toast({html: 'Informe a Senha', displayLength: 4000});
		}else if (novaSenha == '') {
			M.toast({html: 'Informe a nova senha', displayLength: 4000});
		}else if (repetirNovaSenha == '') {
			M.toast({html: 'Informe o repetir nova senha', displayLength: 4000});
		}else if (novaSenha != repetirNovaSenha) {
			M.toast({html: 'O campo nova senha e repetir nova senha não conhecidem', displayLength: 4000});
		}

		ajaxVerificaDB(email, senha);
	}

	function ajaxVerificaDB(email, senha, option = 'Select'){
		let Schema = 'escala75_Easy7';
	  	let tableName = 'Users';
	  	let columns = 'Email'
	  	let where = `Email = '${email}' and Senha = '${senha}'`

		let params = {
			Schema,
			tableName,
			columns,
			where,
			option
		};

		$.ajax({
			url: 'DBInserts.php',
			type: 'POST',
			dataType: 'json',
			data: params,
			beforeSend: function(){
				$('#modalProgress').modal('open');
			}
		})
		.done(function(data) {

			if (data.length > 0) {
				atualizaSenha();
			}else{
				M.toast({html: 'Usuário ou senha inválida', displayLength: 4000});
			}
			//$('#modalResposta').modal('open');
			$('#modalProgress').modal('close');
		})
		.fail(function() {
			console.log("error");
			$('#modalProgress').modal('close');
		});
	}

	function atualizaSenha(){
			let Schema = 'escala75_Easy7';
			let tableName = 'Users';
			let setQuery = `Senha = '${$('#autocomplete-new-senha').val()}'`;
			let where = `Email = '${$('#autocomplete-email').val()}'`;
			let option = 'Update'
			let params = {
			  option,
			  Schema,
			  tableName,
			  setQuery,
			  where

			}


			$.ajax({
				url: 'DBInserts.php',
				type: 'POST',
				dataType: 'html',
				data: params,
			})
			.done(function(data) {
				console.log("success: ");

				M.toast({html: 'Atualização executada com êxito', displayLength: 4000});
				$('#modalAlterPass').modal('close');
			})
			.fail(function() {
				console.log("error");
			});
		}
</script>