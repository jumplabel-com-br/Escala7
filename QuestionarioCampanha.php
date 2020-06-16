<?php
session_start();

require_once('DBInserts.php');
require_once('startPage.php');

$getType = $_GET["getType"];
$IC = $_GET["IC"];

$Campanha = Select('escala75_Easy7', '*', 'Campanhas', "Id = $IC", "",$link);

function createSession(){
	global $_SESSION;
	$_SESSION["Questionario"] = 'OK';
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Questionário</title>
	<?php require_once("header.php")?>
</head>

<body class="">
	<nav class="background-questionatio">
		<div class="row">
			<div class="col s12 m12">
				<a href="HomeMobile.php?getType=usr&IC=<?=$IC?>&BarOpen=OPEN"><i class="medium material-icons right">home</i></a>
			</div>
		</div>
	</nav>
	
	<div class="row">
		<div class="col s12 m12 center">
			<h5 class="title-campanha"></label>
			</h5>
		</div>
	</div>

	<div class="row form-questionario-campanha" value="">

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
	<script type="text/javascript">
		var Campanha = <?=$Campanha?>;
		function createSession(){
			<?=createSession()?>
		}
		$('.title-campanha').html(`Questionário ${Campanha[0]['Campanha']}`)
	</script>

	<script type="text/javascript" src="ajax/AjaxGenericDB.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script type="text/javascript" src="ajax/GenericFunctions.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="materialize/js/materialize.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="js/Generic.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
	<script src="js/Questionarios/QuestionarioCampanha.js?date=<?=date('d/m/Y-H:i:s')?>"></script>
</body>
</html>