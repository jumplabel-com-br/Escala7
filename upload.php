<?php
	//Envia as fotos para uma pasta chamada fotos
session_start();
require_once('DBInserts.php');

$img0 = $_POST['file0'];
$img1 = isset($_POST['file1']) ? $_POST['file1'] : '';
$img2 = isset($_POST['file2']) ? $_POST['file2'] : '';

$CPF = $_POST['CPF'];
$Campanha = $_POST['Campanha'];
$Data0 = date('d-m-Y-H-i-s-364');
$Data1 = date('d-m-y-H-i-s-365');
$Data2 = date('d-m-y-H-i-s-366');
$lat = $_POST["lat"];
$lon = $_POST["lon"];

$user = $_SESSION['User'];

if (is_dir("fotos/$Campanha/$CPF") == false) {
	mkdir("fotos/$Campanha/$CPF", 0777, true);				
}

define('UPLOAD_DIR', "fotos/$Campanha/$CPF/");


if (!empty($img0)) {
	$img0 = str_replace('data:image/jpeg;base64,', '', $img0);
	$img0 = str_replace(' ', '+', $img0);
	$data = base64_decode($img0);
	$file0 = UPLOAD_DIR . $Data0  . '.jpg';
	$success1 = file_put_contents($file0, $data);

	$sql = Insert('Escala7', 'ImagensCampanha', 'Usuario, Imagem, Latitude, Longitude, Status, DataCriacao',  "'$user', '$file0', '$lat', '$lon', 1, now()");
	mysqli_query($link, $sql);
}

if (!empty($img1) ) {
	$img1 = str_replace('data:image/jpeg;base64,', '', $img1);
	$img1 = str_replace(' ', '+', $img1);
	$data = base64_decode($img1);
	$file1 = UPLOAD_DIR . $Data1  . '.jpg';
	$success2 = file_put_contents($file1, $data);

	$sql = Insert('Escala7', 'ImagensCampanha', 'Usuario, Imagem, Latitude, Longitude, Status, DataCriacao',  "$user, $file1, $lat, $lon, 1, now()");
	mysqli_query($link, $sql);
}

if (!empty($img2) ) {
	$img2 = str_replace('data:image/jpeg;base64,', '', $img2);
	$img2 = str_replace(' ', '+', $img2);
	$data = base64_decode($img2);
	$file2 = UPLOAD_DIR . $Data2  . '.jpg';
	$success3 = file_put_contents($file2, $data);

	$sql = Insert('Escala7', 'ImagensCampanha', 'Usuario, Imagem, Latitude, Longitude, Status, DataCriacao',  "$user, $file2, $lat, $lon, 1, now()");
	mysqli_query($link, $sql);
}
?>