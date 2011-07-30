<?php
	$name = $_GET['name'];
	$rent = $_GET['rent'];
	$lat = $_GET['lat'];
	$long = $_GET['lon'];
	
	
	require_once( 'db.php' );
	
	$conn = new Db();
	
	$query = "INSERT INTO rental (name, rent, lon, lat) VALUES ($name, $rent, $lat, $long)";
	$result = $conn->query($query);
	if($result) {
			header('Location: showrent.html');
	}

?>