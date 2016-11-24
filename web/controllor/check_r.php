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
$uroot = "\"" . $_POST ["uroot"] . "\""; 
$rcontent = "\"" . $_POST ["rcontent"] . "\"";
$sql = "SELECT *
		FROM User_Administrator_Root, Root
		WHERE
		User_Administrator_Root.rno = Root.rno AND
		Uroot = $uroot AND
		Rcontent = $rcontent;";
$result = $conn -> query ($sql);
if ($result && mysqli_num_rows ($result)) {
	$json = array ("status" => "y");
	$conn -> close ();
	echo json_encode ($json);
	exit;
}
else {
	$json = array ("status" => "n");
	$conn -> close ();
	echo json_encode ($json);
	exit;
}
?>