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
			<a onclick="logoff();" class="collection-item">
				<span class="left badge">
					<i class="material-icons i-default">settings</i>
				</span>
				Sair
			</a>
		</footer>
	</div>
</div>