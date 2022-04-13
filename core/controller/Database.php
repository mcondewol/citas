<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		$this->user="admin";$this->pass="apr0f4m21";$this->host="aprofam-db.cedzwrni6pi1.us-west-2.rds.amazonaws.com";$this->ddbb="bookmedik";
	}

	function connect(){
		$con = new mysqli($this->host,$this->user,$this->pass,$this->ddbb);
		$con->query("set sql_mode=''");
		return $con;
	}

	public static function getCon(){
		if(self::$con==null && self::$db==null){
			self::$db = new Database();
			self::$con = self::$db->connect();
		}
		return self::$con;
	}
	
}
?>
