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
$gname = "\"" . $_POST ["goodsname"] . "\"";	
$uname = "\"" . $_POST ["username"] . "\"";	
$gtype = "\"" . $_POST ["type"] . "\"";
if ($_FILES ["image"]["type"] == "image/jpeg") {
	$gaddress = "image\\user\\" . mt_rand (0, 1000000) . ".jpg";
	while (file_exists ($gaddress))
		$gaddress = "image\\user\\" . mt_rand (0, 1000000) . ".jpg";
	move_uploaded_file ($_FILES ["image"]["tmp_name"], $gaddress);
	$gaddress = "\"" . $gaddress . "\"";
}
else {		
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$ginstruction = "\"" . $_POST ["instruction"] . "\"";	
$gparameter = "\"" . $_POST ["parameter"] . "\"";	
$gtime= $_POST ["time"];	
$gprice = $_POST ["price"];
$sql = "SELECT Gno FROM G1 ORDER BY Gno DESC;";
$result = $conn -> query ($sql);
$row = $result -> fetch_assoc ();
$gno = $row ["Gno"] + 1;
$conn -> query ("BEGIN;");
$sql = "INSERT INTO G1 VALUES ($gno, $gname, $uname, $gtype, $gaddress, 0);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$sql = "INSERT INTO G3 VALUES ($gno, $ginstruction, $gparameter, $gtime, $gprice);";
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