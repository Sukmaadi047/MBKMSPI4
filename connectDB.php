<?php
/* Database connection settings */
	$servername = "localhost";
    $username = "u743710388_user";		//put your phpmyadmin username.(default is "root")
    $password = "SukmaAdi047";			//if your phpmyadmin has a password put it here.(default is "root")
    $dbname = "RFID_MBKM_SPI_4";
    
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }
?>
