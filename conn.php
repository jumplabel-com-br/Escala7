<?php

class db{

	//host
	private $host = 'escala7.ci9niqaqsefm.us-east-1.rds.amazonaws.com';

	//usuario
	private $usuario = 'admin';

	//senha
	private $senha = 'Escala7!';

	//banco de dados
	private $database = 'Escala7';

	public function conecta_mysql(){

		//cria a conexao
		$con = mysqli_connect($this->host, $this->usuario, $this->senha, $this->database);
		//$conn = mssql_select_db($this->host, $this->usuario, $this->senha)
		//ajustar o charset de comunicação entre a aplicação e o banco de dados
		mysqli_set_charset($con, 'utf8');

		//verificar se houve erro de conexão
		if(mysqli_connect_errno()){
			echo 'Erro na conexão do servidor: '.mysqli_connect_error();
		}

		/*
		if (mssql_select_db($this->database)) {
			echo 'Erro na conexão ao banco de dados: ';
		}
		*/

		return $con;

	}
}
?>