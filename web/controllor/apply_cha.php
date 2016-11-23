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
$gnoplan = $_POST ["gnoplan"];
$gnoadopt = $_POST ["gnoadopt"];
$chamoney = $_POST ["chamoney"];
$chaplanstate = "\"等待交易\"";
$chaadoptstate = "\"等待交易\"";
$sql = "INSERT INTO Charge VALUES ($gnoplan, $gnoadopt, $chamoney, $chaplanstate, 0, $chaadoptstate, 0, CURRENT_TIMESTAMP);";
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