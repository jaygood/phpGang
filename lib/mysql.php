<?php
	
	
	function getConnection() {
    try {
        $db_username = "DB_USERNAME";
        $db_password = "DB_PASSWORD";
        $conn = new PDO('mysql:host=localhost;dbname=DB_NAME', $db_username, $db_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch(PDOException $e) {
        echo 'ERROR: ' . $e->getMessage();
    }
    return $conn;
}

?>
