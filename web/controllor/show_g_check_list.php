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
$str = "\"审核中\"";
$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
		FROM Goods_1, Goods_2
		WHERE
		Goods_1.Gno = Goods_2.Gno AND 
		Gstate = $str
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