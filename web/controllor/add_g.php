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
$gname = "\"" . $_POST ["gname"] . "\"";	
$uname = "\"" . $_POST ["uname"] . "\"";	
$gtype = "\"" . $_POST ["gtype"] . "\"";
if ($_FILES ["image"]["type"] != "") {
	$ogaddress = "img/item/" . mt_rand (0, 1000000) . ".jpg";
	while (file_exists ($ogaddress))
		$ogaddress = "img/item/" . mt_rand (0, 1000000) . ".jpg";
	move_uploaded_file ($_FILES ["image"]["tmp_name"], "D:/code/repository/db-course/web/" . $ogaddress);
	$gaddress = "\"" . $ogaddress . "\"";
}
else		
	$gaddress="\"img/none.jpg\"";
$gstate = "\"审核中\"";
$ginstruction = "\"" . $_POST ["ginstruction"] . "\"";	
$gparameter = "\"" . $_POST ["gparameter"] . "\"";	
$gtime= $_POST ["gtime"];	
$gprice = $_POST ["gprice"];
$sql = "SELECT Gno FROM Goods_1 ORDER BY Gno DESC;";
$result = $conn -> query ($sql);
if ($result) {
	$row = $result -> fetch_assoc ();
	$gno = $row ["Gno"] + 1;
}
else
	$gno = 1;
$conn -> query ("BEGIN;");
$sql = "INSERT INTO Goods_1 VALUES ($gno, $gname, $uname, $gtype, $gaddress, $gstate);";
if (!($conn -> query ($sql))) {
	$conn -> query ("ROLLBACK;");
	$json = array ("status" => "n1","a"=>"$gno");
	$conn -> close ();			
	echo json_encode ($json);
	exit;
}
$sql = "INSERT INTO Goods_3 VALUES ($gno, $ginstruction, $gparameter, $gtime, $gprice);";
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