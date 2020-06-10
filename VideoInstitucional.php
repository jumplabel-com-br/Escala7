<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Video Instituncional</title>
	<?php require_once("header.php")?>
</head>

<body class="background background-home">


<?php require_once("logo.php")?>

<div class="row">
	<?php require_once("nav.php")?>

	<div class="col s12 m9">
		<div class="chips"></div>
		<!--
		<div class="card white">
			<div class="card-content white-text card-campanha">
			<iframe width="500" height="538" src="https://www.youtube.com/embed/J6xsvPW7em4" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
			</div>
		</div>-->
	</div>

	<div class="col s12 m9">
		<div class="cards-footer">
			<iframe height="397" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="width-complete"></iframe>
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

<?
	require_once('footer.php');
?>
<input type="hidden" name="valueScanner" id="valueScanner">
<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">
<input type="hidden" name="UserInactivity" id="UserInactivity" value="<?=$_SESSION['User']?>">
<!-- Compiled and minified JavaScript -->
<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/VideoInstitucional/Video.js?<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/Generic.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<!--
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="js/geoLocation.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/readQrCode.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/takePicture.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
-->
</body>
</html>