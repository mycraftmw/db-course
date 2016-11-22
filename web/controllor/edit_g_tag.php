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
$opr = "\"" . $_POST ["operate"] . "\"";
$gno = "\"" . $_POST ["goodsno"] . "\"";
$tno = "\"" . $_POST ["tag"] . "\"";
$conn -> query ("BEGIN;");
if ($opr) {
	$sql = "INSERT INTO DES VALUES ($gno, $tno);";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$json = array ("status" => "n");
		$conn -> close ();			
		echo json_encode ($json);
	}
}
else {
	$sql = "DELETE FROM DES WHERE Gno = $gno AND Tno = $tno;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$json = array ("status" => "n");
		$conn -> close ();			
		echo json_encode ($json);
	}
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
?>