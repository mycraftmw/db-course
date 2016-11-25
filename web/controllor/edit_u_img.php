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
if ($_FILES ["image"]["type"] != "") {
	$ouaddress = "img/user/" . mt_rand (0, 1000000) . ".jpg";
	while (file_exists ($ouaddress))
		$ouaddress = "img/user/" . mt_rand (0, 1000000) . ".jpg";
	move_uploaded_file ($_FILES ["image"]["tmp_name"], "D:/code/repository/db-course/web/".$ouaddress);
	$uaddress = "\"" . $ouaddress . "\"";
}
else {
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$conn -> query ("BEGIN;");
$sql = "UPDATE User_2 SET Uaddress = $uaddress WHERE Uname = $uname;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$json['imgUrl']= $ouaddress;
$conn -> close ();			
echo json_encode ($json);
exit;
?>