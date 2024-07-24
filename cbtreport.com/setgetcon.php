<?php
class Database
{
private $connection;
private $user = 'root';
private $pass = '';
//private $chars = 'utf8mb4';
private $dsn = 'mysql:host=localhost;dbname=schooldb';
private $options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
    	public function __construct() {
	   mysqli_report(MYSQLI_REPORT_STRICT);
	  try 
{
     $connection = new PDO($this->dsn,$this->user,$this->pass);
     $connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
     $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     return $connection;
}
 catch (\PDOException $e) {
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->__construct();
	}

}
?>