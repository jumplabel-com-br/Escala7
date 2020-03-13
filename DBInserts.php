<?php
require_once('conn.php');

$objBd = new db();
$link = $objBd->conecta_mysql();

$sql = $_POST['sql'];
$option = $_POST['option'];

//echo $sql;
//die;

switch ($option) {
	case 0:
	$query = mysqli_query($link, $sql);

	$data = mysqli_fetch_all($query, MYSQLI_ASSOC);

		// Escreve o resultado JSON em arquivo:
	print json_encode($data) ;
	break;

	default:
	mysql_query($link, $sql);
	break;
}
?>