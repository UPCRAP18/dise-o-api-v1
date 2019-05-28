<?php
	class DBClass {
		private $host = "remotemysql.com";
		private $username = "2o99AU5EMZ";
		private $pwd = "r7NJ6lIdVw";
		private $db_name = "2o99AU5EMZ";
		public $connection;

		//Obtiene la conexion a la base de datos
		public function getConnection(){
			$this->connection = null;
			try{
				$this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->pwd);
        //$this->connection->exec("set names utf8");
			}catch(PDOException $ex){
				echo "Error al conectar con la base de datos: ".$ex->getMessage();
			}

			return $this->connection;

		}

	}

?>
