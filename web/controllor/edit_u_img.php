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
if ($_FILES ["image"]["type"] == "image/jpeg") {
	$uaddress = "image\\user\\" . mt_rand (0, 1000000) . ".jpg";
	while (file_exists ($uaddress))
		$uaddress = "image\\user\\" . mt_rand (0, 1000000) . ".jpg";
	move_uploaded_file ($_FILES ["image"]["tmp_name"], $uaddress);
	$uaddress = "\"" . $uaddress . "\"";
}
else {
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$conn -> query ("BEGIN;");
$sql = "UPDATE U2 SET Uaddress = $uaddress WHERE Uname = $uname;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$conn -> close ();			
echo json_encode ($json);
?>