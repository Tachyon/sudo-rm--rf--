<?php
	$lat = $_GET['lat'];
	$long = $_GET['long'];
	
	
	require_once( 'db.php' );
	
	$conn = new Db();
	
	$query = "SELECT * FROM rental WHERE lon<".($long + 0.2)." AND lon>".($long - 0.2)." AND lat>".($lat - 0.2)." AND lat<".($lat + 0.2);
	$result = $conn->query($query);
	$return = array();
	$count = 0;
	while( $row = $conn->getNextAssocRow($result) ) { 
		$lat_dist = abs($lat - $row['lat']) * 111;
		$long_dist = abs($long - $row['lon']) * 111;
		$dist = sqrt( pow($lat_dist,2) + pow($lat_dist,2) );
		$row['dist'] = $dist;
		$return[$count] = $row;
		$count++;
	}
	
	function cmp($a, $b) {
		if ($a['dist'] == $b['dist']) {
			if($a['rent'] == $b['rent']) {
				return 0;
			}
			return ($a['rent'] < $b['rent']) ? -1 : 1;;
		}
		return ($a['dist'] < $b['dist']) ? -1 : 1;
	}

	usort  ( $return, "cmp" );
	echo json_encode($return);

?>