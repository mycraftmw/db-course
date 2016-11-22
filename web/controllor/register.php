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
$sno = "\"" . $_POST ["studentno"] . "\"";	
$spassword = "\"" . $_POST ["studentpassword"] . "\"";	
$uname = "\"" . $_POST ["username"] . "\"";	
$usexy = "\"" . $_POST ["sexy"] . "\"";
$sql = "SELECT * 
		FROM S 
		WHERE 
		Sno = $sno AND Spassword = $spassword;";
$result = $conn -> query ($sql);
if (!(mysqli_num_rows ($result))) {
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
if ($_FILES ["image"]["type"] == "image/jpeg")) {
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
}
$upassword = "\"" . $_POST ["password"] . "\"";	
$uphone = "\"" . $_POST ["phone"] . "\"";	
$uemail = "\"" . $_POST ["email"] . "\"";
$conn -> query ("BEGIN;");
$sql = "INSERT INTO U1 VALUES ($uname, $sno);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$sql = "INSERT INTO U2 VALUES ($uname, $usexy, 60, $uaddress);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
}
$sql = "INSERT INTO U3 VALUES ($uname, $upassword, $uphone, $uemail);";
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