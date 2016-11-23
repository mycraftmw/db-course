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
$opr = $_POST ["operate"];
$gno = $_POST ["gno"];
$tno = "\"" . $_POST ["tno"] . "\"";
$conn -> query ("BEGIN;");
if ($opr) {
	$sql = "INSERT INTO Describle VALUES ($gno, $tno);";
	$conn -> query ($sql);
}
else {
	$sql = "DELETE FROM Describle WHERE Gno = $gno AND Tno = $tno;";
	if (!($conn -> query ($sql))) {
		$conn -> query ("ROLLBACK;");
		$json = array ("status" => "n");
		$conn -> close ();			
		echo json_encode ($json);
		exit;
	}
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
exit;
?>