<?php
require_once('conn.php');

$objBd = new db();
$link = $objBd->conecta_mysql();

$sql = (isset($_POST['sql'])) ? $_POST['sql'] : '';
$Schema = (isset($_POST['Schema'])) ? $_POST['Schema'] : '';
$tableName = (isset($_POST['tableName'])) ? $_POST['tableName'] : '';
$colums = (isset($_POST['colums'])) ? $_POST['colums'] : '';
$lastquery = (isset($_POST['lastquery'])) ? $_POST['lastquery'] : '';
$setQuery = (isset($_POST['setQuery'])) ? $_POST['setQuery'] : '';
$where = (isset($_POST['where'])) ? $_POST['where'] : '';
$option = (isset($_POST['option'])) ? $_POST['option'] : '';


function Insert($Schema, $tableName, $colums,  $lastquery){
	return "insert into $Schema.$tableName ($colums) values ($lastquery)";
}

function Update($Schema, $tableName, $setQuery, $where){
	return 'update $Schema.$tableName set $setQuery where $where';
}

function Delete($Schema, $tableName, $where){
	return 'delete from $Schema.$tableName where $where';
}


switch ($option) {
	case 'Insert':
		$sqlQuery = Insert($Schema, $tableName, $colums, $lastquery);
		mysqli_query($link, $sqlQuery);
	break;

	case 'Update':
		$sqlQuery = Update($Schema, $tableName, $setQuery, $where);
		mysqli_query($link, $sqlQuery);
	break;

	case 'Delete':
		$sqlQuery = Delete($Schema, $tableName, $where);
		mysqli_query($link, $sqlQuery);
	break;

	case 'Select':

		$query = mysqli_query($link, $sql);
		$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

		// Escreve o resultado JSON:
		echo json_encode($data);
	break;
}
?>