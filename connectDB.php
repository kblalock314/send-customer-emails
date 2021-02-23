<?php

$dbConn = mysqli_connect('localhost', 'root', '', 'landscape');

//if the connection fails, tell the user whhy
if (!$dbConn) {
	die("Connection failed: " . mysqli_connect_error());
}
?>