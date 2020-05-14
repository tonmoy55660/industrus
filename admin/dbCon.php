<?php
function connect ($setup=FALSE){
	$servername="localhost";
	$username="root";
	$password="";
	$database="industrusdb";
	$conn = new mysqli ($servername,$username,$password,$database);

	if($conn->connect_error){
		echo "Connection is failed";
		exit;
	}
	return $conn;
}


?>
