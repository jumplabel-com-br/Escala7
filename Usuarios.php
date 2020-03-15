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

<body class="grey lighten-3">

	<!--
	
	<script type="text/javascript">
		  var toastHTML = '<span>I am toast content</span><button class="btn-flat toast-action">Undo</button>';
	</script>
	<a class="btn" onclick="M.toast({html: toastHTML, completeCallback: function(){alert('Your toast was dismissed')}, displayLength: 4000})">Toast!</a>
-->

<div>
	<ul class="sidenav" id="mobile-demo">
		<li class="tab" id="li-img-logo-max"><a href=""><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></a></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon" title="Usuários"><a href="#"><i class="material-icons">account_circle</i> Usuários</a></li>
		<li class="li-icon" title="Campanhas"><a href="Campanhas.php"><i class="material-icons">record_voice_over</i> Campanahs</a></li>
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

<!-- Modal Structure -->
<div id="modalUser" class="modal">
	<div class="row">
		<div class="col s12 m4">
			<div class="">
				<div class="card-image">
					<span class="card-title"></span>
				</div>
				<div class="card-content center-align">
					<p><i class="xl material-icons">account_circle</i></p>
				</div>
			</div>
		</div>
		<div class="col s12 m8">
			<form id="formUser">
				<div class="input-field">
					<i class="material-icons prefix">textsms</i>
					<input type="text" name="Nome" id="Nome" class="autocomplete">
					<label for="Nome">Nome</label>
				</div>

				<div class="input-field">
					<i class="material-icons prefix">textsms</i>
					<input type="text" id="CPF" class="autocomplete">
					<label for="CPF">CPF</label>
				</div>

				<div class="input-field">
					<i class="material-icons prefix">textsms</i>
					<input type="text" id="Email" class="autocomplete">
					<label for="Email">Email</label>
				</div>

				<div class="input-field">
					<i class="material-icons prefix">textsms</i>
					<input type="password" id="Senha" class="autocomplete">
					<label for="Senha">Senha</label>
				</div>

				<div class="input-field">
					<i class="material-icons prefix">textsms</i>
					<select id="Status">
						<option value="" disabled selected>Status</option>
						<option value="1">Ativo</option>
						<option value="0">Desativado</option>
					</select>
				</div>

				<div class="input-field">
					<i class="material-icons prefix">textsms</i>
					<select id="UserType">
						<option value="" disabled selected>Tipo de usuário</option>
						<option value="1">Administrador</option>
						<option value="2">Cliente</option>
					</select>
				</div>

				<input type="hidden" name="Id" id="Id">
			</form>
		</div>
	</div>

	<div class="modal-footer">
		<div class="row">
			<div class="col s4 center-align">
				<a class="waves-effect waves-light btn" onclick="clearForm('#formUser')">Limpar</a>
			</div>
			<div class="col s8 right-align">
				<a class="waves-effect waves-light btn btn-action-formUser"></a>
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
<script src="materialize/js/materialize.js"></script>
<script type="text/javascript" src="js/Usuarios/Usuarios.js"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js"></script>
<script type="text/javascript" src="js/readQrCode.js"></script>
<script type="text/javascript" src="js/takePicture.js"></script>
-->
</body>
</html>