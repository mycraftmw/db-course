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
$tno = "\"" . $_POST ["tag"] . "\"";
$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
		FROM G1, G2, DES
		WHERE
		G1.Gno = G2.Gno AND
		G1.Gno = DES.Gno AND
		Gstate = 1 AND
		Tno = $tno
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