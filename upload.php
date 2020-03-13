<?php
	//Envia as fotos para uma pasta chamada fotos
	define('UPLOAD_DIR', 'fotos/');
	
	$img = $_POST['base64image'];
	$img = str_replace('data:image/jpeg;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$file = UPLOAD_DIR . uniqid() . '.jpg';
	$success = file_put_contents($file, $data);
	print $success ? $file : 'Não é possível salvar o arquivo.';
?>