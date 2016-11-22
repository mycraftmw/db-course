<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";
$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	$json = array ("status" => "n");
	$json = array ("status" => "n");
	echo json_encode ($json);
}
$gno = $_POST ["goodsno"];
$gcheck = $_POST ["check"];
$conn -> query ("BEGIN;");
$sql = "UPDATE G2 SET Gcheck = $gcheck, Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = $gno;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
?>