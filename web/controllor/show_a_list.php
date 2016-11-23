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
$sql = "SELECT Uname, Uroot, Usexy, Ucredit, Uaddress
		FROM U2;";
$result = $conn -> query ($sql);
$json = array ("status" => "y");
$i = 0;
while ($row = $result -> fetch_assoc()) {
		$jsonn = array ();
		$jsonn ["name"] = $row ["Uname"];
		$jsonn ["sexy"] = $row ["Usexy"];
		$jsonn ["credit"] = $row ["Ucredit"];
		$jsonn ["address"] = $row ["Uaddress"];
		$json [++$i] = $jsonn;
}
$conn -> close ();			
echo json_encode ($json);
exit;
?>