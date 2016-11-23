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
$unamesend = "\"" . $_POST ["unamesend"] . "\"";	
$unamereceive = "\"" . $_POST ["unamereceive"] . "\"";	
$mcontent = "\"" . $_POST ["mcontent"] . "\"";
$sql = "SELECT Mno FROM M ORDER BY Mno DESC;";
$result = $conn -> query ($sql);
$row = $result -> fetch_assoc ();
$mno = $row ["Mno"] + 1;
$conn -> query ("BEGIN;");
$sql = "INSERT INTO M VALUES ($mno, $mcontent, CURRENT_TIMESTAMP);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$sql = "INSERT INTO NTI VALUES ($mno, $unamesend, $unamereceive);";
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