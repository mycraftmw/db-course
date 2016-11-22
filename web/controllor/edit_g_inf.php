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
$gno = "\"" . $_POST ["goodsno"] . "\"";
$gname = "\"" . $_POST ["goodsname"] . "\"";	
$gtype = "\"" . $_POST ["type"] . "\"";
$ginstruction = "\"" . $_POST ["instruction"] . "\"";	
$gparameter = "\"" . $_POST ["parameter"] . "\"";	
$gtime= $_POST ["time"];	
$gprice = $_POST ["price"];
$conn -> query ("BEGIN;");
$sql = "UPDATE G1 SET Gname = $gname, Gtype = $gtype WHERE Gno = $gno;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$sql = "UPDATE G3 SET Ginstruction = $ginstruction, Gparameter = $gparameter, Gtime = $gtime, Gprice = $gprice WHERE Gno = $gno;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);;
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
?>