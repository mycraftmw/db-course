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
$sno = "\"" . $_POST ["sno"] . "\"";	
$spassword = "\"" . $_POST ["spassword"] . "\"";	
$uname = "\"" . $_POST ["uname"] . "\"";	
$uroot = "\"用户\"";
$usexy = "\"" . $_POST ["usexy"] . "\"";
$sql = "SELECT * 
		FROM S 
		WHERE 
		Sno = $sno AND Spassword = $spassword;";
$result = $conn -> query ($sql);
if (!$result) {
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
if ($_FILES ["image"]["type"] == "image/jpeg") {
	$uaddress = "image\\user\\" . mt_rand (0, 1000000) . ".jpg";
	while (file_exists ($uaddress))
		$uaddress = "image\\user\\" . mt_rand (0, 1000000) . ".jpg";
	move_uploaded_file ($_FILES ["image"]["tmp_name"], $uaddress);
	$uaddress = "\"" . $uaddress . "\"";
}
else{		
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$upassword = "\"" . $_POST ["upassword"] . "\"";	
$uphone = "\"" . $_POST ["uphone"] . "\"";	
$uemail = "\"" . $_POST ["uemail"] . "\"";
$conn -> query ("BEGIN;");
$sql = "INSERT INTO U1 VALUES ($uname, $sno, $uroot);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$sql = "INSERT INTO U2 VALUES ($uname, $usexy, 60, $uaddress);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$sql = "INSERT INTO U3 VALUES ($uname, $upassword, $uphone, $uemail);";
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