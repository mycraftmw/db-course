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
$gno = $_POST ["goodsno"];
$sql = "SELECT G1.Gno, Gname, Uname, Gtype, Gaddress, Ginstruction, Gparameter, Gtime, Gprice 
		FROM G1, G3
		WHERE
		G1.Gno = G3.Gno AND
		G1.Gno = $gno;";
$result = $conn -> query ($sql);
$row = $result -> fetch_assoc();
$json = array ("status" => "y");
$json ["no"] = $row ["Gno"];
$json ["gname"] = $row ["Gname"];
$json ["name"] = $row ["Uname"];
$json ["type"] = $row ["Gtype"];
$json ["address"] = $row ["Gaddress"];
$json ["instruction"] = $row ["Ginstruction"];
$json ["parameter"] = $row ["Gparameter"];
$json ["time"] = $row ["Gtime"];
$json ["price"] = $row ["Gprice"];
$sql = "SELECT Tno FROM DES WHERE Gno = $gno;";
$result = $conn -> query ($sql);
$tcontent = "";
while ($row = $result -> fetch_assoc()) 
	$tcontent = $row ["Tno"] . " ";
$json ["tag"] = $tcontent;
$conn -> close ();			
echo json_encode ($json);
?>