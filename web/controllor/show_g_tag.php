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
$tno = "\"" . $_POST ["tno"] . "\"";
$str = "\"市场中\"";
$sql = "SELECT DISTINCT G1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
		FROM G1, G2
		WHERE
		G1.Gno = G2.Gno AND 
		Gstate = $str AND
		Tno = $tno
		ORDER BY Gtimestamp DESC;";		
$result = $conn -> query ($sql);
if ($result) {
	$json = array ("status" => "y");
	$i = 0;
	while ($row = $result -> fetch_assoc()) {
		$jsonn = array ();
		$jsonn ["gno"] = $row ["Gno"];
		$jsonn ["gname"] = $row ["Gname"];
		$jsonn ["uname"] = $row ["Uname"];
		$jsonn ["gtype"] = $row ["Gtype"];
		$jsonn ["gaddress"] = $row ["Gaddress"];
		$jsonn ["gstate"] = $row ["Gstate"];
		$jsonn ["gcheck"] = $row ["Gcheck"];
		$jsonn ["gtimestamp"] = $row ["Gtimestamp"];
		$json [++$i] = $jsonn;
	}
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
else {
	$conn -> close ();
	$json = array ("status" => "n");	
	echo json_encode ($json);
	exit;
}
?>