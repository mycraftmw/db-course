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
$words = "\"" . $_POST ["words"] . "\"";
$opr = $_POST ["operate"];	
$result;
switch ($kind) {
	case 0:
		$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
				FROM G1, G2, DES, T
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				Gstate = 1 AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 1:
		$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
				FROM G1, G2, DES, T, U2
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				G1.Uname = U2.Uname AND
				Gstate = 1 AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Ucredit DESC, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 2:
		$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
				FROM G1, G2, DES, T, G3
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				G1.Gno = G3.Gno AND
				Gstate = 1 AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Gprice, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	case 3:
		$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
				FROM G1, G2, DES, T, G3
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				G1.Gno = G3.Gno AND
				Gstate = 1 AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Gprice DESC, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
	default :
		$sql = "SELECT DISTINCT G1.Gno, Gname, Gtype, Gaddress, Gtimestamp
				FROM G1, G2, DES, T, G3
				WHERE
				G1.Gno = G2.Gno AND
				G1.Gno = DES.Gno AND
				DES.Tno = T.Tno AND
				G1.Gno = G3.Gno AND
				Gstate = 1 AND
				Uname != $uname AND
				(Gname = $words OR Gtype = $words OR Tcontent = $words)
				ORDER BY Gtime, Gtimestamp DESC;";
		$result = $conn -> query ($sql);
		break;
}
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