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

	<div>
		<ul class="sidenav" id="mobile-demo">
			<li class="tab" id="li-img-logo-max"><a href=""><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></a></li>
			<li class="li-icon"><a href="#"> &nbsp;</a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">account_circle</i> Usuários</a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">record_voice_over</i> Campanahs</a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">assignment</i> Questionário</a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">check_box</i> Respostas</a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">videocam</i> Video Institucional</a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">settings</i> Sair</a></li>
		</ul>

		<ul class="sidenav-min" id="mobile-demo-1">
			<li class="tab" id="li-img-logo-min"><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></li>
			<li class="li-icon"><a href="#"> &nbsp;</a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">account_circle</i></a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">record_voice_over</i></a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">assignment</i></a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">check_box</i></a></li>
			<li class="li-icon"><a href="#"><i class="material-icons">videocam</i></a></li>
			<li class="li-icon"><p>&nbsp;</p></li>
			<li class="li-icon"><p>&nbsp;</p></li>
			<li class="li-icon"><a href="#"><i class="material-icons">settings</i></a></li>
		</ul>
	</div>

	<div class="container mobile ml-25 container-usuarios">
		<div class="row">
			<div class="col s12 m7">
				<h3>Usuários cadastrados</h3>
				<h5>Administrador</h5>
			</div>
		</div>

		<div class="row">
			<div class="col s12 m4">
				<div class="card">
					<div class="right-align">
						<i class="fas fa-ellipsis-h dropdown-trigger" data-target='dropdown1'></i>
						<ul id='dropdown1' class='dropdown-content'>
							<li><a href="#modal1" class="modal-trigger"><i class="material-icons">send</i>visualizar mais</a></li>
							<li><a href="#">editar <i class="material-icons">send</i></a></li>
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
	</div>

	<!-- Modal Structure -->
	<div id="modal1" class="modal">
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
				<form id="createUsua">
					<div class="input-field">
						<i class="material-icons prefix">textsms</i>
						<input type="text" name="Name" id="Name" class="autocomplete">
						<label for="Name">Nome</label>
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
						<selec id="Status">
							<option value="" disabled selected>Status</option>
							<option value="1">Ativo</option>
							<option value="2">Desativado</option>
						</select>
					</div>

					<div class="input-field">
						<i class="material-icons prefix">textsms</i>
						<selec id="TipoUsuario">
							<option value="" disabled selected>Tipo de usuário</option>
							<option value="1">Administrador</option>
							<option value="2">Cliente</option>
						</select>
					</div>
				</form>
			</div>
		</div>

		<div class="modal-footer right-align">
			<a class="waves-effect waves-light btn" onclick="">Salvar</a>
		</div>
	</div>

	<input type="hidden" name="valueScanner" id="valueScanner">
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="ajax/AjaxGenericDB.js"></script>
	<script type="text/javascript">
		selectDb(`select CPF, Senha from Escala7.Users`, 'json') 
		

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
  	$('select').formSelect();
  });

  $(document).ready(function(){
  	$('.modal').modal();
  });

  // Initialize collapsible (uncomment the lines below if you use the dropdown variation)
  // var collapsibleElem = document.querySelector('.collapsible');
  // var collapsibleInstance = M.Collapsible.init(collapsibleElem, options);

  // Or with jQuery

  $(document).ready(function(){
  	$('.sidenav').sidenav();
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

  function create(){

  	let Name = $('#Name').val();
  	let CPF = $('#CPF').val();
  	let Email = $('#Email').val();
  	let Status = $('#Status').val();
  	let tipoUsuario = $('#tipoUsuario').val();
  	let option = 0;

  	let param = {
  		Name,
  		CPF,
  		Email,
  		Status,
  		tipoUsuario
  	}

  	$.ajax({
  		url: 'DBInserts.php',
  		type: 'default GET (Other values: POST)',
  		dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
  		data: {param1: 'value1'},
  	})
  	.done(function() {
  		console.log("success");
  	})
  	.fail(function() {
  		console.log("error");
  	})
  	.always(function() {
  		console.log("complete");
  	});
  	
  }
</script>
<script src="materialize/js/materialize.js"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js"></script>
<script type="text/javascript" src="js/readQrCode.js"></script>
<script type="text/javascript" src="js/takePicture.js"></script>
-->
</body>
</html>