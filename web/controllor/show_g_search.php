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
		$sql = "SELECT DISTINCT G1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM G1, G2, DES, T
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				Gstate = $str AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 1:
		$sql = "SELECT DISTINCT G1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM G1, G2, DES, T, U2
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				G1.Uname = U2.Uname AND
				Gstate = $str AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Ucredit DESC, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 2:
		$sql = "SELECT DISTINCT G1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM G1, G2, DES, T, G3
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				G1.Gno = G3.Gno AND
				Gstate = $str AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Gprice, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 3:
		$sql = "SELECT DISTINCT G1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM G1, G2, DES, T, G3
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				G1.Gno = G3.Gno AND
				Gstate = $str AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Gprice DESC, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	default :
		$sql = "SELECT DISTINCT G1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp
				FROM G1, G2, DES, T, G3
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				G1.Gno = G3.Gno AND
				Gstate = $str AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
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