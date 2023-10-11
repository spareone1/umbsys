<?php

include_once ("../../lib/dbconfig.php");


$rfid = $_GET['rfid'];

$delsql = "DELETE from tmpumb;";

$sql = "INSERT INTO tmpumb (
	rfid
	) values (
	'$rfid'
	);
	";
	
mysqli_query($db,$delsql);
mysqli_query($db,$sql);

echo "TMP OK";

?>