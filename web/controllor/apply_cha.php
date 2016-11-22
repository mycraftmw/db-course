<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";
$conn = new mysqli ($servername, $username, $password, $dbname);

if ($conn -> connect_error) {
	$json = array ("status" => "n");
	echo json_encode ($json);
}
$gnoplan = $_POST ["goodsplanno"];
$gnoadopt = $_POST ["goodsadoptno"];
$chamoney = $_POST ["money"];
$sql = "INSERT INTO CHA VALUES ($gnoplan, $gnoadopt, $chamoney, 0, 0, 0, 0, CURRENT_TIMESTAMP);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);;
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
?>