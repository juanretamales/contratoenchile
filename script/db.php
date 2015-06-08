<?php
require_once "dbConfig.php";
class db 
{
	public function conectar()
    {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
		if($mysqli->connect_errno > 0){   
			die("Imposible conectarse con la base de datos [" . $mysqli->connect_error . "]");   
		}
		return $mysqli;
	}
}
?>