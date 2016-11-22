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
$name = "\"" . $_POST ["username"] . "\""; 
$rcontent = "\"" . $_POST ["root"] . "\"";
$sql = "SELECT *
		FROM U1
		WHERE 
		Uname = $name;";
$result = $conn -> query ($sql);
if (mysqli_num_rows ($result)) {
	$sql = "SELECT *
			FROM UAR, R
			WHERE
			UAR.rno = R.rno AND
			UA = 1 AND
			Rcontent = rcontent;";
	$result = $conn -> query ($sql);
	if (mysqli_num_rows ($result)) {
		$json = array ("status" => "y");
		$conn -> close ();
		echo json_encode ($json);
	}
	else {
		$json = array ("status" => "n");
		$conn -> close ();
		echo json_encode ($json);
	}
}
else {
	$sql = "SELECT *
			FROM UAR, R
			WHERE
			UAR.rno = R.rno AND
			UA = 0 AND
			Rcontent = rcontent";
	$result = $conn -> query ($sql);
	if (mysqli_num_rows ($result)) {
		$json = array ("status" => "y");
		$conn -> close ();
		echo json_encode ($json);
	}
	else {
		$json = array ("status" => "n");
		$conn -> close ();
		echo json_encode ($json);
	}
}
?>