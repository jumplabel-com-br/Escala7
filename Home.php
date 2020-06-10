<?php
session_start();
require_once('conn.php');

$_SESSION["ultimoAcesso"]= date("Y-n-j H:i:s");

$user = isset($_SESSION['User']) ? $_SESSION['User'] : '';
$Email = isset($_SESSION["Email"]) ? $_SESSION["Email"] : '';
$objBd = new db();
$link = $objBd->conecta_mysql();
$sql = "select CPF, Email, UserType from escala75_Easy7.Users where Email = '$Email'"; 

//echo $sql;
//die;


$result = mysqli_query($link, $sql);
$dados_usuario = mysqli_fetch_array($result);

		if (!isset($dados_usuario['Email']) || empty($dados_usuario['Email'])) {
			header('Location: Error.php');
		}else {
			global $_SESSION;
			$dados_usuario['UserType'] == 1 ? $_SESSION["UserType"] = 1 : $_SESSION["UserType"] = 0;
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<?php require_once("header.php")?>
</head>

<body class="background background-home">

	<!--
	<ul class="sidenav" id="mobile-demo">
		<li class="tab" id="li-img-logo-max"><a href=""><img src="https://escala75_Easy7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></a></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon" title="Usuários"><a href="Usuarios.php"><i class="material-icons">account_circle</i> Usuários</a></li>
		<li class="li-icon" title="Campanhas"><a href="#"><i class="material-icons">record_voice_over</i> Campanhas</a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i> Questionário</a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i> Respostas</a></li>
		<li class="li-icon" title="Video Institucional"><a href="#"><i class="material-icons">videocam</i> Video Institucional</a></li>
		<li class="li-icon" title="Sair"><a href="#"><i class="material-icons">settings</i> Sair</a></li>
	</ul>

	<ul class="sidenav-min" id="mobile-demo-1">
		<li class="tab" id="li-img-logo-min"><img src="https://escala75_Easy7.com.br/wp-content/uploads/2020/02/cropped-Escala-7-Logotipo-11.png" alt="" class="responsive-img img-in-li"></li>
		<li class="li-icon"><a href="#"> &nbsp;</a></li>
		<li class="li-icon" title="Usuários"><a href="Usuarios.php"><i class="material-icons">account_circle</i></a></li>
		<li class="li-icon" title="Campanhas"><a href="#"><i class="material-icons">record_voice_over</i></a></li>
		<li class="li-icon" title="Questionário"><a href="#"><i class="material-icons">assignment</i></a></li>
		<li class="li-icon" title="Respostas"><a href="#"><i class="material-icons">check_box</i></a></li>
		<li class="li-icon" title="Video Institucional"><a href="#"><i class="material-icons">videocam</i></a></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon"><p>&nbsp;</p></li>
		<li class="li-icon" title="Sair"><a href="#"><i class="material-icons">settings</i></a></li>
	</ul>
-->


<?php require_once("logo.php")?>

<div class="row">
	
	<?php require_once("nav.php")?>

	<div class="col s12 m3">
		<div class="card white card-home">
			<div class="card-content white-text">
				<span class="card-title color-default f-Helvetica-Bold left-align">Implatação <br> por Campanha</span>

			</div>
		</div>
	</div>

	<div class="col s12 m3">
		<div class="card white card-home">
			<div class="card-content white-text">
				<span class="card-title color-default f-Helvetica-Bold left-align">Questiónarios <br> Preenchidos</span>
				<div class="questionarios-preenchidos center"></div>
			</div>
		</div>
	</div>

	<div class="col s12 m3">
		<div class="card white card-home">
			<div class="card-content white-text">
				<span class="card-title color-default f-Helvetica-Bold left-align">Campanhas <br> Cadastradas</span>
				<div class="campanhas-cadastradas center"></div>
			</div>
		</div>
	</div>
</div>

<?
	require_once('footer.php');
?>
<input type="hidden" name="valueScanner" id="valueScanner">
<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">
<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="js/Generic.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript">
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
<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/Generic.js?<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/Home/Home.js?<?=date('d/m/Y-H:i:s')?>"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/readQrCode.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/takePicture.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
-->
</body>
</html>