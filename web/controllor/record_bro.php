<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";
$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	$json = array ("status" => "n");
	echo json_encode ($json);
	exit;
}
$uname = "\"" . $_POST ["uname"] . "\"";	
$gno = $_POST ["gno"];
$conn -> query ("BEGIN;");
$sql = "DELETE FROM Search WHERE Uname = $uname AND Gno = $gno;";
$conn -> query ($sql);
$sql = "INSERT INTO Search VALUES ($uname, $gno, CURRENT_TIMESTAMP);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
exit;
?>