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
$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp, Ginstruction, Gparameter, Gtime, Gprice
		FROM Goods_1, Goods_2
		WHERE
		Goods_1.Gno = Goods_2.Gno AND 
		Goods_1.Gno = Goods_3.Gno AND
		Gstate = $str AND
		Uname != $uname AND
		Goods_1.Gno NOT IN (SELECT Gno FROM Search WHERE Uname = $uname ORDER BY BROtimestamp DESC) AND
		Gtype IN (SELECT Gtype FROM Goods_1, Search WHERE Goods_1.Gno = Search.Gno AND Search.Uname = $uname ORDER BY BROtimestamp DESC)
		ORDER BY Gtimestamp DESC;";		
$result_1 = $conn -> query ($sql);
$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp, Ginstruction, Gparameter, Gtime, Gprice
		FROM Goods_1, Goods_2
		WHERE
		Goods_1.Gno = Goods_2.Gno AND 
		Goods_1.Gno = Goods_3.Gno AND
		Gstate = $str AND
		Uname != $uname AND
		Goods_1.Gno NOT IN (SELECT Gno FROM Search WHERE Uname = $uname ORDER BY BROtimestamp DESC) AND
		Gtype NOT IN (SELECT Gtype FROM Goods_1, Search WHERE Goods_1.Gno = Search.Gno AND Search.Uname = $uname ORDER BY BROtimestamp DESC)
		ORDER BY Gtimestamp DESC;";		
$result_2 = $conn -> query ($sql);
if ($result_1 && mysqli_num_rows ($result_1) || $result_2 && mysqli_num_rows ($result_2)) {
	$json = array ("status" => "y");
	$i = 0;
	if ($result_1 && mysqli_num_rows ($result_1))  
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
			$jsonn ["ginstruction"] = $row ["Ginstruction"];
			$jsonn ["gparameter"] = $row ["Gparameter"];
			$jsonn ["gtime"] = $row ["Gtime"];
			$jsonn ["gprice"] = $row ["Gprice"];
			$json [++$i] = $jsonn;
		}
	if ($result_2 && mysqli_num_rows ($result_2)) 
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