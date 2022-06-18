<?php 
	//aquí emplearemos el modelo syngletón para tener una conexión más segura y controlada, así mismo será aquí donde llevaremos a cabo todas las consultas mediante medotos, al tener lo en este archivo lo controlaremos con más facilidad
	
	//aquí guardaré los datos de la conexión
	include_once ("Config.php");
	
	class Conectate extends PDO{

		private static $instance=null;

		public function __construct(){
			parent::__construct("mysql:host=".Config::$dbhost.";"."dbname=".Config::$dbdata,Config::$dbuser,Config::$dbpass);
			parent::exec("set names utf8");
			parent::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		}

		public static function GetInstance(){
			if(self::$instance==null){
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function select($sql){
			return self::query($sql)->fetchAll(PDO::FETCH_ASSOC);
			
		}

		public function insert($sql){
			return self::exec($sql);
		}
	} 

	
	

 ?>