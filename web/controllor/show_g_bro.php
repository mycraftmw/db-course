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
$uname = "\"" . $_POST ["username"] . "\"";	
$sql = "SELECT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
		FROM G1, G2
		WHERE
		G1.Gno = G2.Gno AND
		Gstate = 1 AND
		Uname != $uname AND
		G1.Gno IN (SELECT Gno FROM BRO WHERE Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10)
		ORDER BY Gtimestamp DESC;";
$result = $conn -> query ($sql);
$json = array ("status" => "y");
$i = 0;
while ($row = $result -> fetch_assoc()) {
		$jsonn = array ();
		$jsonn ["no"] = $row ["Gno"];
		$jsonn ["gname"] = $row ["Gname"];
		$jsonn ["type"] = $row ["Gtype"];
		$jsonn ["address"] = $row ["Gaddress"];
		$jsonn ["timestamp"] = $row ["Gtimestamp"];
		$json [++$i] = $jsonn;
}
$conn -> close ();			
echo json_encode ($json);
?>