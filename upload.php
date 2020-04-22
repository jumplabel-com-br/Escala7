<?php
	//Envia as fotos para uma pasta chamada fotos


$img = $_POST['base64image'];
$CPF = $_POST['CPF'];
$Campanha = $_POST['Campanha'];
$Data = $_POST['Data'];

if (is_dir("fotos/$Campanha/$CPF") == false) {
	mkdir("fotos/$Campanha/$CPF", 0777, true);				
}

define('UPLOAD_DIR', "fotos/$Campanha/$CPF/");



$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = UPLOAD_DIR . $Data  . '.jpg';
$success = file_put_contents($file, $data);
print $success ? $file : 'Não é possível salvar o arquivo.';
?>