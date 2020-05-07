<div class="col s12 m3">
	<div class="card white card-home">
		<div class="card-content white-text">
			<ul class="list-ul-organize">
				<li class="li-icon"><a href="#"> &nbsp;</a></li>
				<?php
				if (!isset($_SESSION["IC"])) {
					echo '
					<li class="li-icon" title="Usuários">
						<a href="Usuarios.php"><i class="material-icons i-default">account_circle</i> Usuários</a>
					</li>
					';
				}
				?>
				<li class="li-icon" title="Campanhas">
					<a href="Campanhas.php"><i class="material-icons i-default">record_voice_over</i> Campanhas</a>
				</li>
				<?php
				if (!isset($_SESSION["IC"])) {
					echo '
					<li class="li-icon dropdown-trigger" title="Questionário" href="#dropdownQuestionario">
						<a href="#"><i class="material-icons i-default">assignment</i> Questionários</a>
					</li>
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

				<li class="li-icon" title="Respostas"><a href="Respostas.php">
					<i class="material-icons i-default">check_box</i> Respostas</a>
				</li>
				<li class="li-icon" title="Video Institucional">
					<a href="VideoInstitucional.php"><i class="material-icons i-default">videocam</i> Video Institucional</a>
				</li>
				<li class="li-icon sair" title="Sair">
					<a onclick="logoff();"><i class="material-icons i-default">settings</i> Sair</a>
				</li>
			</ul>
		</div>
	</div>
</div>
