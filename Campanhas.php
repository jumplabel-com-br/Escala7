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
		<li class="li-icon" title="Usuários"><a href="Usuarios.php"><i class="material-icons">account_circle</i> Usuários</a></li>
		<li class="li-icon" title="Campanhas"><a href="#"><i class="material-icons">record_voice_over</i> Campanahs</a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i> Questionário</a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i> Respostas</a></li>
		<li class="li-icon" title="Video Institucional"><a href="#"><i class="material-icons">videocam</i> Video Institucional</a></li>
		<li class="li-icon" title="Sair"><a href="#"><i class="material-icons">settings</i> Sair</a></li>
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
		<li class="li-icon" title="Sair"><a href="#"><i class="material-icons">settings</i></a></li>
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
					<td><i class="fas fa-edit"></i></td>
				</tr>
				<tr>
					<td>#56987326</td>
					<td>Campanha B</td>
					<td>06/12/2019</td>
					<td>23/12/2019</td>
					<td>Inativo</td>
					<td><i class="fas fa-edit"></i></td>
				</tr>
				<tr>
					<td>#56987355</td>
					<td>Campanha C</td>
					<td>02/12/2019</td>
					<td>10/01/2020</td>
					<td>Ativo</td>
					<td><i class="fas fa-edit"></i></td>
				</tr>
			</tbody>
		</table>
	</div>

	<div class="row center-align white">
		
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
<script type="text/javascript">
	var dataInfos;

	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.sidenav');
		var instances = M.Sidenav.init(elems);
	});

	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.dropdown-trigger');
		var instances = M.Dropdown.init(elems);
	});

	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('.modal');
		var instances = M.Modal.init(elems);
	});

	document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('select');
		var instances = M.FormSelect.init(elems,);
	});

  // Or with jQuery

  $(document).ready(function(){
  	$('.sidenav').sidenav();
  	$('.dropdown-trigger').dropdown();
  	$('.modal').modal();
  	$('select').formSelect();
  });


  $('#li-img-logo-min').on('click', function(event) {
  	$('#mobile-demo').show();
  	$('.container-usuarios').addClass('desktop');
  	$('#mobile-demo-1').hide();
  	event.preventDefault();
  	/* Act on the event */
  });

  $('#li-img-logo-max').on('click', function(event) {
  	$('#mobile-demo').hide();
  	$('.container-usuarios').removeClass('desktop');
  	$('#mobile-demo-1').show();
  	event.preventDefault();
  	/* Act on the event */
  });
</script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js"></script>
<script type="text/javascript" src="js/readQrCode.js"></script>
<script type="text/javascript" src="js/takePicture.js"></script>
-->
</body>
</html>