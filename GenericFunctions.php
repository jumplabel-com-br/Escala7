<?php
require_once('conn.php');

$objBd = new db();
$link = $objBd->conecta_mysql();

$sql = $_POST['sql'];
$option = $_POST['option'];


function select_db($sql,$link){
	$result = array();
	if($resultado_id = mysqli_query($link, $sql)){
		while ($row = $resultado_id->fetch_assoc()){
			$result[] = $row;
		}
		
	}
	return $result;

}

function validLogin($sql, $link){
	if ($result = mysqli_query($link, $sql)) {
		$dados_usuario = mysqli_fetch_array($result);

		if (isset($dados_usuario['CPF'])) {
			echo 'True';
			session_start();
			$_SESSION["User"] = $dados_usuario['CPF'];
			return true;
		}else{
			echo 'False';
			return ;
		}

	}

}

switch ($option){
	case 'select_db':
		select_db($sql,$link);
	break;
	
	case 'validLogin':
		validLogin($sql, $link);
	break;
}

/*$dados_usuario = select_db($sql,$link);
//echo "<pre>";
//print_r($dados_usuario);
for ($i = 0; $i < count($dados_usuario); $i++) { 
		echo $dados_usuario[$i]['Id']." - ".$dados_usuario[$i]['Name']."<br>";
	}
*/
	?>