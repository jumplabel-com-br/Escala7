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

	<ul class="sidenav" id="mobile-demo">
		<li class="tab" id="li-img-logo-max"><a href=""><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></a></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon"><a href="Usuarios.php"><i class="material-icons">account_circle</i> Usuários</a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">record_voice_over</i> Campanahs</a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">assignment</i> Questionário</a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">check_box</i> Respostas</a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">videocam</i> Video Institucional</a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">settings</i> Sair</a></li>
	</ul>

	<ul class="sidenav-min" id="mobile-demo-1">
		<li class="tab" id="li-img-logo-min"><img src="https://escala7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon"><a href="Usuarios.php"><i class="material-icons">account_circle</i></a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">record_voice_over</i></a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">assignment</i></a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">check_box</i></a></li>
		<li class="li-icon"><a href="#"><i class="material-icons">videocam</i></a></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon"><a href="#"><i class="material-icons">settings</i></a></li>
	</ul>


	<input type="hidden" name="valueScanner" id="valueScanner">
	<input type="hidden" name="" value="<?=$_SESSION['User']?>">
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="ajax/AjaxGenericDB.js"></script>
	<script type="text/javascript">
		//selectDb(`select CPF, Senha from Escala7.Users`, 'json') 
		

		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.sidenav');
			var instances = M.Sidenav.init(elems);
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
			$('#mobile-demo-1').hide();
			event.preventDefault();
			/* Act on the event */
		});

		$('#li-img-logo-max').on('click', function(event) {
			$('#mobile-demo').hide();
			$('#mobile-demo-1').show();
			event.preventDefault();
			/* Act on the event */
		});
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