<?php 
	session_start();
	require_once('startPage.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Fotos</title>
	<?php require_once("header.php")?>
</head>

<body class="background background-home">

	<?php require_once("logo.php")?>

	<div class="row">
		<?php require_once("nav.php")?>

		<div class="col s12 m9">
			<div class="card white">
				<div class="card-content white-text card-fotos">
				
			</div>
		</div>

	<input type="hidden" name="valueScanner" id="valueScanner">
	<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">
	<input type="hidden" name="UserInactivity" id="UserInactivity" value="<?=$_SESSION['User']?>">
	<?php
	if ($_SESSION["UserType"] == 0) {
		echo "<input type='hidden' name='IdUser' id='IdUser' value=".$_SESSION["IdUser"].">";
	}
	?>
	<!-- Compiled and minified JavaScript -->
	<script type="text/javascript" src="QRCode/qrcodeJquery.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Generic.js?<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="js/Fotos/fotos.js?<?=date('d/m/Y-H:i:s')?>"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/readQrCode.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/takePicture.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
-->
</body>
</html>