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
if ($_FILES ["image"]["type"] != "") {
	$ogaddress = "img/item/" . mt_rand (0, 1000000) . ".jpg";
	while (file_exists ($ogaddress))
		$ogaddress = "img/item/" . mt_rand (0, 1000000) . ".jpg";
	move_uploaded_file ($_FILES ["image"]["tmp_name"], "D:/code/repository/db-course/web/" . $ogaddress);
	$gaddress = "\"" . $ogaddress . "\"";
}
else	
	$gaddress="\"img/none.jpg\"";
$conn -> query ("BEGIN;");
$sql = "UPDATE Goods_1 SET Gaddress = $gaddress WHERE Gno = $gno;";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$conn -> query ("COMMIT;");
$json = array ("status" => "y");
$json['imgUrl']=$ogaddress;
$conn -> close ();			
echo json_encode ($json);
exit;
?>