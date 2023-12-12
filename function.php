<?php
function query($sorov){
	
	global $conn;

	return mysqli_query($conn, $sorov);
}

function fetch_array($var){
	return mysqli_fetch_array($var);
}
?>