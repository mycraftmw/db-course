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
$str = "\"市场中\"";
$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp, Ginstruction, Gparameter, Gtime, Gprice
		FROM Goods_1, Goods_2, Goods_3
		WHERE
		Goods_1.Gno = Goods_2.Gno AND 
		Goods_1.Gno = Goods_3.Gno AND	
		Gstate = $str 
		ORDER BY Gtimestamp DESC;";		
$result = $conn -> query ($sql);
if ($result && mysqli_num_rows ($result)) {
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
		$jsonn ["ginstruction"] = $row ["Ginstruction"];
		$jsonn ["gparameter"] = $row ["Gparameter"];
		$jsonn ["gtime"] = $row ["Gtime"];
		$jsonn ["gprice"] = $row ["Gprice"];
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