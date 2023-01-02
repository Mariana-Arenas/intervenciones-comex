<?php 

	namespace Model;

	class Database{
	
		public static $instance = false;
		private $res;
		private $cn = false;
		private $cdb = false;
		private $database=false;
		private $smtp=false;

		private function connect(){
			$server = 'localhost';
			$user = 'u664012548_comex';
			$pass = 'Comex2102';
			$this->database = 'u664012548_comex';
			
			$this->cn = new \mysqli($server,$user,$pass,$this->database);
			if ($this->cn->connect_errno) 
			{
				echo "Lo sentimos, este sitio web está experimentando problemas.";
				echo "Error: Fallo al conectarse a MySQL debido a: \n";
				echo "Errno: " . $this->cn->connect_errno . "\n";
				echo "Error: " . $this->cn->connect_error . "\n";
				

				exit;
			}else{
				null;// echo "conexion OK.";
			}

			
			$this->cn->set_charset("utf8");
			$this->cn->query("set sql_mode=''");
			$this->cn->query("SET time_zone='-3:00'");
			
		}	

		private function __construct(){
			$this->database = 'u664012548_comex';
		}

		public static function getInstance() {
			if (!self::$instance)
				self::$instance = new Database;

			return self::$instance ;
		}

		public function query($q){
			//echo "paso1";
			$this->connect();
			//$this->res = $this->cn->query($q);
			 if (!$this->res = $this->cn->query($q)) 
			{
				// echo "Lo sentimos, este sitio web está experimentando problemas.";
				// echo "Error: La ejecución de la consulta falló debido a: \n";
				// echo "Query: " . $q . "\n";
				// echo "Errno: " . $this->cn->errno . "\n";
				return  "Error: " . $this->cn->error . "\n";
				// exit;
				//null;
			}else{
				null;
				//echo "consulta ok";
			}
		}

		public function queryTransaction($q,$conectar){
			//echo "paso1";
			if ($conectar==1)
			{
				$this->connect();
			}
			if (!$this->res = $this->cn->query($q)) 
			{
				// echo "Lo sentimos, este sitio web está experimentando problemas.";
				// echo "Error: La ejecución de la consulta falló debido a: \n";
				// echo "Query: " . $q . "\n";
				// echo "Errno: " . $this->cn->errno . "\n";
				return  "Error: " . $this->cn->error . "\n";
				// exit;
				//null;
			}else{
				null;
				//echo "consulta ok";
			}

			
		}
		public function Begintransaction(){
			
			$this->queryTransaction("SET autocommit = OFF",1);
			
		}

		public function Committransaction(){
			$this->queryTransaction("commit",0);
			$this->queryTransaction("SET autocommit = 1",0);
			
		   
	   }
	   public function RollBacktransaction(){
		$this->queryTransaction("rollback",0);
		$this->queryTransaction("SET autocommit = 1",0);
		
	   
   }
		public function fetch(){
			if($this->res)
			    $fila = $this->res->fetch_assoc();
			else
			    $fila = array();
			return $fila;
		}

		public function fetchAll(){
			$aux = array();
			while($f = $this->fetch()) $aux[] = $f;
			return $aux;
		}
	
		public function lastInsertionId(){
			return $this->cn->insert_id;	      
		}
	}


?>
