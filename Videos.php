<?php
session_start();
require_once('DBInserts.php');

global $_SESSION;

$getType = $_GET["getType"];
$IC = $_GET["IC"];
$VI = isset($_GET["VI"]) ? $_GET["VI"] : '';
$VC = isset($_GET["VC"]) ? $_GET["VC"] : '';

$_SESSION["VideoInstitucional"] = "";
if (!empty($VI)) {
	$_SESSION["VideoInstitucional"] = Select('escala75_Easy7', 'link', 'VideoInstitucional', "Status = 1", "",$link);
}


function createSession(){
	global $_SESSION;
	$_SESSION["VC"] = 'T';
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Video</title>
	<?php require_once("header.php")?>
</head>

<body class="background background-home">

<div class="row">
	<div class="col s12 m12">
			<a href="HomeMobile.php?getType=usr&IC=<?=$IC?>&BarOpen=OPEN"><i class="medium material-icons right">home</i></a>
	</div>
</div>

<div class="row">
	<div class="col s12 m12">
		<div class="card-content center white color-default">
			<div class="center col s12 white title-video">
				<h5>
				<?php
					if (!empty($_SESSION["VideoInstitucional"]) && empty($VC) ) {
						echo 'Video Institucional';
					}else{
						echo 'Video Campanha';
					}
				?>
				</h5>
			</div>
		</div>
	</div>	
</div>

<div class="row">
	<div class="col s12 m12">
		<div class="cards-footer">
			<iframe height="397" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen class="width-complete" id="Iframe"></iframe>
		</div>
	</div>
</div>

<div class="row">
	<div class="col s12 m12">
		<div class="card-content center">
			<div class="center col s12">
				<button class="btn" onclick="redirectHomeParams();">Video Concluído</button>
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

<?
	require_once('footer.php');
?>
<input type="hidden" name="valueScanner" id="valueScanner">
<input type="hidden" name="UserRegistration" id="UserRegistration" value="<?=$_SESSION['User']?>">
<input type="hidden" name="UserInactivity" id="UserInactivity" value="<?=$_SESSION['User']?>">
<!-- Compiled and minified JavaScript -->
<script type="text/javascript">

	var VI = "<?=$VI?>";
	var VC = "<?=$VC?>";
	var Campanha = <?=isset($_SESSION["Campanha"])?> ? <?=$_SESSION["Campanha"]?> : undefined;
	var VideoInstitucional = <?=$_SESSION["VideoInstitucional"]?>[0].link

	setTimeout(function(){
		if (Campanha != "" && Campanha != undefined && VC != "") {
			document.querySelector('#Iframe').setAttribute("src", Campanha[0].IFrame)
		}else if (VideoInstitucional != "" && VideoInstitucional != undefined && VI != "") {
			document.querySelector('#Iframe').setAttribute("src", VideoInstitucional)	
		}
	}, 1000)
</script>
<script src="js/Generic.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
<script type="text/javascript" src="js/VideoInstitucional/Video.js?<?=date('d/m/Y-H:i:s')?>"></script>

</body>
</html>