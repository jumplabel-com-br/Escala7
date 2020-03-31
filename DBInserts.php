<?php
require_once('conn.php');

$objBd = new db();
$link = $objBd->conecta_mysql();

$sql = (isset($_POST['sql'])) ? $_POST['sql'] : '';
$Schema = (isset($_POST['Schema'])) ? $_POST['Schema'] : '';
$tableName = (isset($_POST['tableName'])) ? $_POST['tableName'] : '';
$columns = (isset($_POST['columns'])) ? $_POST['columns'] : '';
$lastquery = (isset($_POST['lastquery'])) ? $_POST['lastquery'] : '';
$setQuery = (isset($_POST['setQuery'])) ? $_POST['setQuery'] : '';
$where = (isset($_POST['where'])) ? $_POST['where'] : '';
$option = (isset($_POST['option'])) ? $_POST['option'] : '';


function Insert($Schema, $tableName, $columns,  $lastquery){
	//echo "insert into $Schema.$tableName ($columns) values ($lastquery)";
	//die;
	return "insert into $Schema.$tableName ($columns) values ($lastquery)";
}

function Update($Schema, $tableName, $setQuery, $where){
	return "update $Schema.$tableName set $setQuery where $where";
}

function Delete($Schema, $tableName, $where){
	return "delete from $Schema.$tableName where $where";
}

function Select($Schema, $columns, $tableName, $where, $link){
	$querySql = "select $columns from $Schema.$tableName";

	if (strlen(trim($where)) > 0) {
		$querySql.=" where $where";
	}

	//echo $querySql;
	//die;

	$query = mysqli_query($link, $querySql);
	$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

	// Escreve o resultado JSON:
	return json_encode($data);
}

function SelectAdvanced($sql, $link){
	echo strtolower(split(" ",$sql)[0]);
	die;
	
	if (strtolower(split(" ",$sql)[0]) != "select") {
		return 'False';
		die;	
	}

	$query = mysqli_query($link, $querySql);
	$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

	// Escreve o resultado JSON:
	echo json_encode($data);	
}

switch ($option) {
	case 'Insert':
		$sqlQuery = Insert($Schema, $tableName, $columns, $lastquery);
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
		echo Select($Schema, $columns, $tableName, $where, $link);
	break;

	case 'SelectAdvanced':
		echo Select($sql, $link);
	break;
}
?>