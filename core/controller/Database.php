<?php
class Database {
	public static $db;
	public static $con;
	function Database(){
		$this->user="ffklwvhysrbcue";
		$this->pass="d793e771d947323058987dc718bab324b35777c7d3b56e1dbb5667711605a38d";
		$this->host="ec2-107-20-226-93.compute-1.amazonaws.com";
		$this->ddbb="d1kutd0jpqtuse";
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
