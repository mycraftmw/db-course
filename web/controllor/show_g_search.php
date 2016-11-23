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
$words = "\"" . $_POST ["words"] . "\"";
$opr = $_POST ["operate"];
$str = "\"市场中\"";	
$result;
switch ($opr) {
	case 0:
		$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM Goods_1, Goods_2, Describle, Tag
				WHERE
				Goods_1.Gno = Goods_2.Gno AND
				Gstate = $str AND 
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR
				(Goods_1.Gno = Describle.Gno AND
				Describle.Tno = Tag.Tno AND
				Tcontent = $words))
				ORDER BY Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 1:
		$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM Goods_1, Goods_2, Describle, Tag, User_2
				WHERE
				Goods_1.Gno = Goods_2.Gno AND
				Goods_1.Uname = User_2.Uname AND
				Gstate = $str AND 
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR
				(Goods_1.Gno = Describle.Gno AND
				Describle.Tno = Tag.Tno AND
				Tcontent = $words))
				ORDER BY Ucredit DESC, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 2:
		$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM Goods_1, Goods_2, Describle, Tag, Goods_3
				WHERE
				Goods_1.Gno = Goods_2.Gno AND
				Goods_1.Gno = Goods_3.Gno AND
				Gstate = $str AND 
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR
				(Goods_1.Gno = Describle.Gno AND
				Describle.Tno = Tag.Tno AND
				Tcontent = $words))
				ORDER BY Gprice, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 3:
		$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM Goods_1, Goods_2, Describle, Tag, Goods_3
				WHERE
				Goods_1.Gno = Goods_2.Gno AND
				Goods_1.Gno = Goods_3.Gno AND
				Gstate = $str AND 
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR
				(Goods_1.Gno = Describle.Gno AND
				Describle.Tno = Tag.Tno AND
				Tcontent = $words))
				ORDER BY Gprice DESC, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	default :
		$sql = "SELECT DISTINCT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM Goods_1, Goods_2, Describle, Tag, Goods_3
				WHERE
				Goods_1.Gno = Goods_2.Gno AND
				Goods_1.Gno = Goods_3.Gno AND
				Gstate = $str AND 
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR
				(Goods_1.Gno = Describle.Gno AND
				Describle.Tno = Tag.Tno AND
				Tcontent = $words))
				ORDER BY Gtime, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
}
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