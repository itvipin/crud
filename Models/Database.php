<?php 

class Database {

	public static function getConnection(){
		try
		{
		 return new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USERNAME, DB_PASSWORD);
		}
		catch (PDOException $e)
		{
			exit("Error: " . $e->getMessage());
		}
	}
}
?> 
