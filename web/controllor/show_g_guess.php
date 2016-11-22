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
$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
		FROM G1, G2
		WHERE
		G1.Gno = G2.Gno AND
		Gstate = 1 AND
		Uname != $uname AND
		G1.Gno NOT IN (SELECT Gno FROM BRO WHERE Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10) AND
		Gtype IN (SELECT Gtype FROM G1, BRO WHERE G1.Gno = BRO.Gno AND BRO.Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10)
		ORDER BY Gtimestamp DESC;";
$result_1 = $conn -> query ($sql);
$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
		FROM G1, G2
		WHERE
		G1.Gno = G2.Gno AND
		Gstate = 1 AND
		Uname != $uname AND
		G1.Gno NOT IN (SELECT Gno FROM BRO WHERE Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10) AND
		Gtype NOT IN (SELECT Gtype FROM G1, BRO WHERE G1.Gno = BRO.Gno AND BRO.Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10)
		ORDER BY Gtimestamp DESC;";
$result_2 = $conn -> query ($sql);
$json = array ("status" => "y");
$i = 0;
while ($row = $result_1 -> fetch_assoc()) {
		$jsonn = array ();
		$jsonn ["no"] = $row ["Gno"];
		$jsonn ["gname"] = $row ["Gname"];
		$jsonn ["type"] = $row ["Gtype"];
		$jsonn ["address"] = $row ["Gaddress"];
		$jsonn ["timestamp"] = $row ["Gtimestamp"];
		$json [++$i] = $jsonn;
}
while ($row = $result_2 -> fetch_assoc()) {
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