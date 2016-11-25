<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";

// 创建连接
$conn = new mysqli ($servername, $username, $password, $dbname);
// 检测连接
if ($conn -> connect_error) 
     die ("连接失败: " . $conn -> connect_error . '<br>');
	 
$sql = "CREATE DEFINER=`root`@`localhost` PROCEDURE `Charge_insert` (`gnoplan` INT, `gnoadopt` INT, `chamoney` INT)  BEGIN
INSERT INTO Charge VALUES (gnoplan, gnoadopt, chamoney, "等待交易", 0, "等待交易", 0, CURRENT_TIMESTAMP);
END$$";
$conn -> query ($sql);

$conn -> close; 
?> 