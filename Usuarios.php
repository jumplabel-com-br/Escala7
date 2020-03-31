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

	<!--
	
	<script type="text/javascript">
		  var toastHTML = '<span>I am toast content</span><button class="btn-flat toast-action">Undo</button>';
	</script>
	<a class="btn" onclick="M.toast({html: toastHTML, completeCallback: function(){alert('Your toast was dismissed')}, displayLength: 4000})">Toast!</a>
-->
<!--
<div>
	<ul class="sidenav" id="mobile-demo">
		<li class="tab" id="li-img-logo-max"><a href=""><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></a></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon" title="Usuários"><a href="#"><i class="material-icons">account_circle</i> Usuários</a></li>
		<li class="li-icon" title="Campanhas"><a href="Campanhas.php"><i class="material-icons">record_voice_over</i> Campanhas</a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i> Questionário</a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i> Respostas</a></li>
		<li class="li-icon" title="Video Institucional"><a href="#"><i class="material-icons">videocam</i> Video Institucional</a></li>
		<li class="li-icon" title="Sair"><a href="#"><i class="material-icons">settings</i> Sair</a></li>
	</ul>

	<ul class="sidenav-min" id="mobile-demo-1">
		<li class="tab" id="li-img-logo-min"><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon" title="Usuários"><a href="#"><i class="material-icons">account_circle</i></a></li>
		<li class="li-icon" title="Campanhas"><a href="Campanhas.php"><i class="material-icons">record_voice_over</i></a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i></a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i></a></li>
		<li class="li-icon" title="Video Instituciona"><a href="#"><i class="material-icons">videocam</i></a></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon" title="Sair"><a href="#"><i class="material-icons">settings</i></a></li>
	</ul>
</div>

<div class="container mobile ml-25 container-usuarios">
	<div class="row">
		<div class="col s12 m7">
			<h3>Usuários cadastrados</h3>
			<h5>Administrador</h5>
		</div>
	</div>

	<div class="row row-cards-usuarios">
		<div class="col s12 m3">
			<div class="card">
				<div class="right-align">
					<i class="fas fa-ellipsis-h dropdown-trigger" data-target='dropdown1'></i>
					<ul id='dropdown1' class='dropdown-content'>
						<li><a href="#modalUser" class="modal-trigger"><i class="material-icons right">send</i>visualizar mais</a></li>
						<li><a href="#">editar <i class="material-icons right">send</i></a></li>
					</ul>
				</div>
				<div class="card-content center-align">
					<span class="card-title"><i class="xl material-icons">account_box</i></span>
				</div>
				<div class="card-action">
					<p class="center-align">
						Nome: Matheus Gomes Ferreira
						<br>
						478.975.138-40
					</p>
				</div>
			</div>
		</div>

		<div class="col s12 m3">
			<div class="card">
				<div class="right-align">
					<i class="fas fa-ellipsis-h dropdown-trigger" data-target='dropdown1'></i>
					<ul id='dropdown1' class='dropdown-content'>
						<li><a href="#modalUser" class="modal-trigger"><i class="material-icons right">send</i>visualizar mais</a></li>
						<li><a href="#">editar <i class="material-icons right">send</i></a></li>
					</ul>
				</div>
				<div class="card-content center-align">
					<span class="card-title"><i class="xl material-icons">account_box</i></span>
				</div>
				<div class="card-action">
					<p class="center-align">
						Nome: Matheus Gomes Ferreira
						<br>
						478.975.138-40
					</p>
				</div>
			</div>
		</div>

		<div class="col s12 m3">
			<div class="card">
				<div class="right-align">
					<i class="fas fa-ellipsis-h dropdown-trigger" data-target='dropdown1'></i>
					<ul id='dropdown1' class='dropdown-content'>
						<li><a href="#modalUser" class="modal-trigger"><i class="material-icons right">send</i>visualizar mais</a></li>
						<li><a href="#">editar <i class="material-icons right">send</i></a></li>
					</ul>
				</div>
				<div class="card-content center-align">
					<span class="card-title"><i class="xl material-icons">account_box</i></span>
				</div>
				<div class="card-action">
					<p class="center-align">
						Nome: Matheus Gomes Ferreira
						<br>
						478.975.138-40
					</p>
				</div>
			</div>
		</div>

		<div class="col s12 m3">
			<div class="card">
				<div class="right-align">
					<i class="fas fa-ellipsis-h dropdown-trigger" data-target='dropdown1'></i>
					<ul id='dropdown1' class='dropdown-content'>
						<li><a href="#modalUser" class="modal-trigger"><i class="material-icons right">send</i>visualizar mais</a></li>
						<li><a href="#">editar <i class="material-icons right">send</i></a></li>
					</ul>
				</div>
				<div class="card-content center-align">
					<span class="card-title"><i class="xl material-icons">account_box</i></span>
				</div>
				<div class="card-action">
					<p class="center-align">
						Nome: Matheus Gomes Ferreira
						<br>
						478.975.138-40
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="container-footer">
		<div class="row">
			<div class="col s6 left-align">
				<button class="btn waves-effect waves-light" type="button" name="action">Relatório</button>
			</div>

			<div class="col s6 right-align">
				<button class="btn waves-effect waves-light modal-trigger" type="button" name="action" href="#modalUser" onclick="$('.btn-action-formUser').html('Salvar');optionCRUDUsers('Salvar');">
					<i class="material-icons left">add</i>
					Cadastrar
				</button>
			</div>
		</div>
	</div>
</div>
-->

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
			<h3 class="white-text"><strong>Usuários Cadastrados</strong></h3>
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
					<li class="li-icon" title="Campanhas"><a href="Campanhas.php"><i class="material-icons i-default">record_voice_over</i> Campanhas</a></li>
					<li class="li-icon dropdown-trigger" title="Questionário" href="#dropdownQuestionario"><a href="#"><i class="material-icons i-default">assignment</i> Questionário</a></li>
					<ul id='dropdownQuestionario' class='dropdown-content'>
						<li><a href="Questionario.php">Questionário</a></li>
						<li><a href="Perguntas.php">Perguntas</a></li>
					</ul>
					<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons i-default">check_box</i> Respostas</a></li>
					<li class="li-icon" title="Video Institucional"><a href="VideoInstitucional.php"><i class="material-icons i-default">videocam</i> Video Institucional</a></li>
					<li class="li-icon sair" title="Sair"><a onclick="logoff();"><i class="material-icons i-default">settings</i> Sair</a></li>
				</ul>
			</div>
		</div>
	</div>

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
			<img src="icons/close.png" class="responsive-img modal-close" onclick="clearForm('#formUser');">
		</div>
		
		<div class="">
			<div class="col s12 m3 center-align">
				<img src="icons/user-bgd-blue.png" class="responsive-img">
			</div>
		</div>

		<div class="container center-align">
			<form id="formUser">
				<div class="input-field col s12 m7">
					<input type="text" name="Nome" id="Nome" class="autocomplete c-blue" plc="Nome">
					<label for="Nome" class="c-blue">Nome</label>
				</div>

				<div class="input-field col s12 m7">

					<input type="text" id="CPF" class="autocomplete c-blue" plc="CPF">
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
				</div>

				<div class="input-field col s12 m7">

					<select id="UserType" class="c-blue" plc="Tipo de Usuario">
						<option value="" disabled selected>Tipo de usuário</option>
						<option value="1">Administrador</option>
						<option value="2">Cliente</option>
					</select>
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
<script type="text/javascript" src="ajax/AjaxGenericDB.js"></script>
<script type="text/javascript" src="ajax/GenericFunctions.js"></script>
<script src="materialize/js/materialize.js"></script>
<script type="text/javascript" src="js/Usuarios/Usuarios.js"></script>
<script type="text/javascript" src="js/Generic.js"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js"></script>
<script type="text/javascript" src="js/readQrCode.js"></script>
<script type="text/javascript" src="js/takePicture.js"></script>
-->
</body>
</html>