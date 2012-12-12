<?php 

/**
* DatabaseConnection Singleton
* 
* @package    
* @subpackage 
* @author     Argiris Gounaris agounaris@gmail.com
*/
class DatabaseConnection {

	/**
	*	database object
	*	@var $db
	*/
	protected static $db = null;

	/**
	*	get the connection
	*
	*	@return object $db
	*/
	public static function getConnection() {

		if (self::$db == null) {
			echo 'new connection', "\n";
			new DatabaseConnection();
		}else{
			echo 'the same connection', "\n";
		}

		return self::$db;
	}

	private function __construct() {

		try {

			self::$db = new PDO( 'mysql:host=localhost;dbname=test', 'root', 'toor' );
			self::$db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );

		}catch ( PDOException $e){
			echo 'Connection Error:'.$e -> getMessage();
		}
	}

}