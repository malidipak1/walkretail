<?php
Class DbMysql {
	private static $db;
	public static $arrQuery = array();
	
	private function __construct(){

		$conn = null;

		try{
			$dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME;
			DbMysql::$db = new PDO($dsn, DB_USER, DB_PASSWD);
			DbMysql::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			DbMysql::$db->exec("SET CHARACTER SET utf8");
			//DbMysql::$db = $conn;		
			//echo "Created DB Connection....";
		} catch(PDOException $e){
			echo 'ERROR: ' . $e->getMessage();
		}
		//$conn;
	}
	 
	public static function getConnection(){
		if(DbMysql::$db == null) {
			$obj = new DbMysql();
		}
		
		return DbMysql::$db;
	}
	
	public function close() {
		echo "Closing db connection..";
		DbMysql::$db = null;
	}
	
	
}