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
		<li class="li-icon" title="Usuários"><a href="Usuarios.php"><i class="material-icons">account_circle</i> Usuários</a></li>
		<li class="li-icon" title="Campanhas"><a href="#"><i class="material-icons">record_voice_over</i> Campanhas</a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i> Questionário</a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i> Respostas</a></li>
		<li class="li-icon" title="Video Institucional"><a href="#"><i class="material-icons">videocam</i> Video Institucional</a></li>
		<li class="li-icon" title="Sair"><a onclick="logoff();"><i class="material-icons">settings</i> Sair</a></li>
	</ul>

	<ul class="sidenav-min" id="mobile-demo-1">
		<li class="tab" id="li-img-logo-min"><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon" title="Usuários"><a href="Usuarios.php"><i class="material-icons">account_circle</i></a></li>
		<li class="li-icon" title="Campanhas"><a href="#"><i class="material-icons">record_voice_over</i></a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i></a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i></a></li>
		<li class="li-icon" title="Video Instituciona"><a href="#"><i class="material-icons">videocam</i></a></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon" title="Sair"><a onclick="logoff();"><i class="material-icons">settings</i></a></li>
	</ul>
</div>

<div class="container mobile ml-25 container-usuarios">

	<div class="row">
		<div class="col s12 m7">
			<h3>Campanhas cadastradas</h3>
			<h5>Administrador</h5>
		</div>
	</div>


	<div class="container">
		<table>
			<thead class="grey darken-3 white-text">
				<tr>
					<th>QR Code</th>
					<th>Campanha</th>
					<th>Data Iniciio</th>
					<th>Data Término</th>
					<th>Status</th>
					<th></th>
				</tr>
			</thead>

			<tbody class="grey-text white">
				<tr>
					<td>#25698823</td>
					<td>Campanha A</td>
					<td>02/02/2019</td>
					<td>20/02/2020</td>
					<td>Inativo</td>
					<td><a href="#modalCampanha" class="modal-trigger"><i class="fas fa-edit"></i></a></td>
				</tr>
				<tr>
					<td>#56987326</td>
					<td>Campanha B</td>
					<td>06/12/2019</td>
					<td>23/12/2019</td>
					<td>Inativo</td>
					<td><a href="#modalCampanha" class="modal-trigger"><i class="fas fa-edit"></i></a></td>
				</tr>
				<tr>
					<td>#56987355</td>
					<td>Campanha C</td>
					<td>02/12/2019</td>
					<td>10/01/2020</td>
					<td>Ativo</td>
					<td><a href="#modalCampanha" class="modal-trigger"><i class="fas fa-edit"></i></a></td>
				</tr>
			</tbody>
		</table>
		<br>
		<div class="container-footer">
			<div class="row">
				<div class="col s6 left-align">
					<button class="btn waves-effect waves-light" type="button" name="action">Relatório</button>
				</div>

				<div class="col s6 right-align">
					<button class="btn waves-effect waves-light modal-trigger" type="button" name="action" href="#modalCampanha" onclick="$('.btn-action-formCampanha').html('Salvar');optionCRUDCampanhas('Salvar');">
						<i class="material-icons left">add</i>
						Cadastrar
					</button>
				</div>
			</div>
		</div>
	</div>

	<div class="row center-align white">
		
	</div>
</div>
-->

<div class="row">
	<div class="col s6 m6">
			<a href="HomeMobile.php"><i class="medium material-icons">keyboard_backspace</i></a>
	</div>

	<div class="col s6 m6">
			<a href="HomeMobile.php"><i class="medium material-icons right">home</i></a>
	</div>
</div>

<div class="row">
	<div class="col s12 m12">
		<div class="card-content center white color-default">
			<div class="center col s12 white">
				<h5>Video Institucional</h5>
			</div>
		</div>
	</div>	
</div>

<div class="row">
	<div class="col s12 m12">
		<div class="cards-footer">
			<iframe height="397" src="https://www.youtube.com/embed/J6xsvPW7em4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="width-complete"></iframe>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 m12">
		<div class="card-content center">
			<div class="center col s12">
				<button class="btn">Video Concluído</button>
			</div>
		</div>
	</div>	
</div>



<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">

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
<script type="text/javascript" src="js/VideoInstitucional/Video.js?<?=date('d/m/Y-H:i:s')?>"></script>
</body>
</html>