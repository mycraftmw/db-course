<?php
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "BDB";

// 创建连接
$conn = new mysqli($servername, $username, $password, $dbname);
// 检测连接
if ($conn->connect_error) {
     die("连接失败: " . $conn->connect_error . '<br>');
} 

$sno = "\"00000000\"";
$spassword = "\"00000000\"";
$sql = "INSERT INTO Student VALUES ($sno, $spassword);";
$sno = "\"00000001\"";
$spassword = "\"00000001\"";
$sql = "INSERT INTO Student VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000002\"";
$spassword = "\"00000002\"";
$sql = "INSERT INTO Student VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000003\"";
$spassword = "\"00000003\"";
$sql = "INSERT INTO Student VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000004\"";
$spassword = "\"00000004\"";
$sql = "INSERT INTO Student VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000005\"";
$spassword = "\"00000005\"";
$sql = "INSERT INTO Student VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000006\"";
$spassword = "\"00000006\"";
$sql = "INSERT INTO Student VALUES ($sno, $spassword);";
$conn -> query ($sql);
$sno = "\"00000007\"";
$spassword = "\"00000007\"";
$sql = "INSERT INTO Student VALUES ($sno, $spassword);";
$conn -> query ($sql);

$clevel = "\"水水会员\"";
$cleft = -1000;
$cright = 0;
$sql = "INSERT INTO Credit VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = "\"低级会员\"";
$cleft = 1;
$cright = 40;
$sql = "INSERT INTO Credit VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = "\"中级会员\"";
$cleft = 41;
$cright = 80;
$sql = "INSERT INTO Credit VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = "\"高级会员\"";
$cleft = 81;
$cright = 100;
$sql = "INSERT INTO Credit VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);
$clevel = "\"钻石会员\"";
$cleft = 101;
$cright = 1000;
$sql = "INSERT INTO Credit VALUES ($clevel, $cleft, $cright);";
$conn -> query ($sql);

$uname = "\"亚当.肖华\"";
$sno = "\"00000000\"";
$uroot = "\"管理员\"";
$usexy = "\"男\"";
$ucredit = 1000;
$uaddress = "\"\"";
$upassword = "\"00000000\"";
$uphone = "\"00000000000\"";
$uemail = "\"00000000000@nba.com\"";
$sql = "INSERT INTO User_1 VALUES ($uname, $sno, $uroot);";
$conn -> query ($sql);
$sql = "INSERT INTO User_2 VALUES ($uname, $usexy, $ucredit, $uaddress);";
$conn -> query ($sql);
$sql = "INSERT INTO User_3 VALUES ($uname, $upassword, $uphone, $uemail);";
$conn -> query ($sql);

$rno = 1;
$rcontent = "\"删除物品\"";
$sql = "INSERT INTO Root VALUES ($rno, $rcontent);";
$conn -> query ($sql);
$rno = 2;
$rcontent = "\"审核物品\"";
$sql = "INSERT INTO Root VALUES ($rno, $rcontent);";
$conn -> query ($sql);

$tno = "\"tag_meng\"";
$tcontent = "\"萌\""; 
$sql = "INSERT INTO Tag VALUES ($tno, $tcontent);";
$conn -> query ($sql);
$tno = "\"tag_shishang\"";
$tcontent = "\"时尚\"";
$sql = "INSERT INTO Tag VALUES ($tno, $tcontent);";
$conn -> query ($sql);
$tno = "\"tag_gexing\"";
$tcontent = "\"个性\"";
$sql = "INSERT INTO Tag VALUES ($tno, $tcontent);";
$conn -> query ($sql);
$tno = "\"tag_shiyong\"";
$tcontent = "\"实用\"";
$sql = "INSERT INTO Tag VALUES ($tno, $tcontent);";
$conn -> query ($sql);
$tno = "\"tag_pinpai\"";
$tcontent = "\"品牌\"";
$sql = "INSERT INTO Tag VALUES ($tno, $tcontent);";
$conn -> query ($sql);

$uroot = "\"用户\"";
$rno = 2;
$sql = "INSERT INTO User_Administrator_Root VALUES ($uroot, $rno);";
$conn -> query ($sql);
$uroot = "\"管理员\"";
$rno = 1;
$sql = "INSERT INTO User_Administrator_Root VALUES ($uroot, $rno);";
$conn -> query ($sql);

$conn->close();
?>