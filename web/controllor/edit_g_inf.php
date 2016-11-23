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
$gname = "\"" . $_POST ["gname"] . "\"";	
$gtype = "\"" . $_POST ["gtype"] . "\"";
$ginstruction = "\"" . $_POST ["ginstruction"] . "\"";	
$gparameter = "\"" . $_POST ["gparameter"] . "\"";	
$gtime= $_POST ["gtime"];	
$gprice = $_POST ["gprice"];
$conn -> query ("BEGIN;");
$sql = "UPDATE Goods_1 SET Gname = $gname, Gtype = $gtype WHERE Gno = $gno;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$sql = "UPDATE Goods_3 SET Ginstruction = $ginstruction, Gparameter = $gparameter, Gtime = $gtime, Gprice = $gprice WHERE Gno = $gno;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
exit;
?>