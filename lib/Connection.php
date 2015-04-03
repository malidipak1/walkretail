<?php
class Connection {
		
	private static $conection = null;
	
	private static function database_connection($database_name,$host,$userid,$password){
			MySQL_connect($host,$userid,$password);
			//Select the database we want to use
			MySQL_select_db($database_name) or die("Could not select database");
		}
		
	public static function	getInstance() {
		
		if(Connection::$conection != null) {
			//$conection     =  new database_connection('walkreta_walk','localhost','walkreta_walk','db@walk#558');
			Connection::$conection  =  new database_connection('walkreta_walk','localhost','root','');
		}
		
		return Connection::$conection;
	}
}