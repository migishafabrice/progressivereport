<?php
/*
* Mysql database class - only one connection alowed
*/
class Database {
	private $connection;
	private static $_instance; //The single instance
	private $host = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "schooldb";
	/*
	Get an instance of the Database
	@return Instance
	*/
	public static function getInstance() {
		if(!self::$_instance) { // If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	// Constructor
	public function __construct() {
	   mysqli_report(MYSQLI_REPORT_STRICT);
	   try{
		$this->_connection = new mysqli($this->host, $this->username, 
			$this->password, $this->database);
  
            //unset($_SESSION["error"]);
            //unset($_SESSION["info"]);
	}
    catch(Exception $e)
    {
		// Error handling
		
		$_SESSION["error"]="Failed to conenct to server or database!<br/> Try again";
        echo("<script>location.href='login.php';</script>");
        }
	}
	// Magic method clone is empty to prevent duplication of connection
	private function __clone() { }
	// Get mysqli connection
	public function getConnection() {
		return $this->_connection;
	}
}
?>