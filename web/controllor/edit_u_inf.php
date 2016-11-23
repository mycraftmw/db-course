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
$upassword = "\"" . $_POST ["upassword"] . "\"";	
$uphone = "\"" . $_POST ["uphone"] . "\"";	
$uemail = "\"" . $_POST ["uemail"] . "\"";
$conn -> query ("BEGIN;");
$sql = "UPDATE User_3 SET Upassword = $upassword, Uphone = $uphone, Uemail = $uemail WHERE Uname = $uname;";
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