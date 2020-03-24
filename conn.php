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

   /*
   conexao ao sql erver -> 
   serverName = "(local)";   
   $database = "AdventureWorks";  
  
   // Get UID and PWD from application-specific files.   
   $uid = file_get_contents("C:\AppData\uid.txt");  
   $pwd = file_get_contents("C:\AppData\pwd.txt");  
  
   try {  
      $conn = new PDO( "sqlsrv:server=$serverName;Database = $database", $uid, $pwd);   
      $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );   
   }  
  
   catch( PDOException $e ) {  
      die( "Error connecting to SQL Server" );   
   }  
  
   echo "Connected to SQL Server\n";  
  
   $query = 'select * from Person.ContactType';   
   $stmt = $conn->query( $query );   
   while ( $row = $stmt->fetch( PDO::FETCH_ASSOC ) ){   
      print_r( $row );   
   }  
  
   // Free statement and connection resources.   
   $stmt = null;   
   $conn = null;   */
?>  