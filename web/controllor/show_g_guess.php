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
$uname = "\"" . $_POST ["uname"] . "\"";	
$str = "\"市场中\"";
$sql = "SELECT DISTINCT G1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
		FROM G1, G2
		WHERE
		G1.Gno = G2.Gno AND 
		Gstate = $str AND
		Uname != $uname AND
		G1.Gno NOT IN (SELECT Gno FROM BRO WHERE Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10) AND
		Gtype IN (SELECT Gtype FROM G1, BRO WHERE G1.Gno = BRO.Gno AND BRO.Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10)
		ORDER BY Gtimestamp DESC;";		
$result_1 = $conn -> query ($sql);
$sql = "SELECT DISTINCT G1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
		FROM G1, G2
		WHERE
		G1.Gno = G2.Gno AND 
		Gstate = $str AND
		Uname != $uname AND
		G1.Gno NOT IN (SELECT Gno FROM BRO WHERE Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10) AND
		Gtype NOT IN (SELECT Gtype FROM G1, BRO WHERE G1.Gno = BRO.Gno AND BRO.Uname = $uname ORDER BY BROtimestamp DESC LIMIT 10)
		ORDER BY Gtimestamp DESC;";		
$result_2 = $conn -> query ($sql);
if ($result_1 || $result_2) {
	$json = array ("status" => "y");
	$i = 0;
	if ($result_1) 
		while ($row = $result_1 -> fetch_assoc()) {
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
	if ($result_2) 
		while ($row = $result_2 -> fetch_assoc()) {
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