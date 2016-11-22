<?php
$servername = "127.0.0.1";
$username = "root";
$password = "160013";
$dbname = "BDB";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
     die("连接失败: " . $conn->connect_error . '<br>');
} 

$sno = "\"00000001\"";
$spassword = "\"00000001\"";
$sql = "INSERT INTO S VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000002\"";
$spassword = "\"00000002\"";
$sql = "INSERT INTO S VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000003\"";
$spassword = "\"00000003\"";
$sql = "INSERT INTO S VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000004\"";
$spassword = "\"00000004\"";
$sql = "INSERT INTO S VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000005\"";
$spassword = "\"00000005\"";
$sql = "INSERT INTO S VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000006\"";
$spassword = "\"00000006\"";
$sql = "INSERT INTO S VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000007\"";
$spassword = "\"00000007\"";
$sql = "INSERT INTO S VALUES ($sno, $spassword);";
$conn -> query ($sql);

$clevel = 0;
$cleft = -1000;
$cright = 0;
$sql = "INSERT INTO C VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = 1;
$cleft = 1;
$cright = 20;
$sql = "INSERT INTO C VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = 2;
$cleft = 21;
$cright = 40;
$sql = "INSERT INTO C VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = 3;
$cleft = 41;
$cright = 60;
$sql = "INSERT INTO C VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = 4;
$cleft = 61;
$cright = 80;
$sql = "INSERT INTO C VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = 5;
$cleft = 81;
$cright = 100;
$sql = "INSERT INTO C VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = 6;
$cleft = 101;
$cright = 1000;
$sql = "INSERT INTO C VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);

$ano = "\"00000000\"";
$aname = "\"亚当.肖华\"";
$apassword = "\"00000000\"";
$asexy = 1;
$aphone = "\"00000000000\"";
$aemail = "\"00000000000@nba.com\"";
$sql = "INSERT INTO A VALUES ($ano, $aname, $apassword, $asexy, $aphone, $aemail);";
$conn -> query ($sql);

$rno = 1;
$rcontent = "\"删除物品\"";
$sql = "INSERT INTO R VALUES ($rno, $rcontent);";
$conn -> query ($sql);
$rno = 2;
$rcontent = "\"审核物品\"";
$sql = "INSERT INTO R VALUES ($rno, $rcontent);";
$conn -> query ($sql);

$tno = 1;
$tcontent = "\"萌\"";
$sql = "INSERT INTO T VALUES ($tno, $tcontent);";
$conn -> query ($sql);
$tno = 2;
$tcontent = "\"时尚\"";
$sql = "INSERT INTO T VALUES ($tno, $tcontent);";
$conn -> query ($sql);
$tno = 3;
$tcontent = "\"个性\"";
$sql = "INSERT INTO T VALUES ($tno, $tcontent);";
$conn -> query ($sql);
$tno = 4;
$tcontent = "\"实用\"";
$sql = "INSERT INTO T VALUES ($tno, $tcontent);";
$conn -> query ($sql);
$tno = 5;
$tcontent = "\"品牌\"";
$sql = "INSERT INTO T VALUES ($tno, $tcontent);";
$conn -> query ($sql);

$ua = 0;
$Rno = 2;
$sql = "INSERT INTO UAR VALUES ($ua, $rno);";
$conn -> query ($sql);
$ua = 1;
$Rno = 1;
$sql = "INSERT INTO UAR VALUES ($ua, $rno);";
$conn -> query ($sql);

$conn->close();
?>