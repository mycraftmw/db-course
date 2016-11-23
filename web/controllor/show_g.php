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
$gno = $_POST ["gno"];
$sql = "SELECT G1.Gno, Gname, Uname, Gtype, Gaddress, Ginstruction, Gparameter, Gtime, Gprice 
		FROM G1, G3
		WHERE
		G1.Gno = G3.Gno AND
		G1.Gno = $gno;";
$result = $conn -> query ($sql);
if ($result) {
	$row = $result -> fetch_assoc();
	$json = array ("status" => "y");
	$json ["gno"] = $row ["Gno"];
	$json ["gname"] = $row ["Gname"];
	$json ["uname"] = $row ["Uname"];
	$json ["gtype"] = $row ["Gtype"];
	$json ["gaddress"] = $row ["Gaddress"];
	$json ["ginstruction"] = $row ["Ginstruction"];
	$json ["gparameter"] = $row ["Gparameter"];
	$json ["gtime"] = $row ["Gtime"];
	$json ["gprice"] = $row ["Gprice"];
	$sql = "SELECT Tno FROM DES WHERE Gno = $gno;";
	$result = $conn -> query ($sql);
	$tno = "";
	if ($result) {
		while ($row = $result -> fetch_assoc()) 
			$tno = $row ["Tno"] . " ";
		$json ["tno"] = $tno;
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
}
else {
	$conn -> close ();
	$json = array ("status" => "n");	
	echo json_encode ($json);
	exit;
}
?>