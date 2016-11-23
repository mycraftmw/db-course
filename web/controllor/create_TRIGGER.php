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
 
$str_1 = "\"审核中\"";
$str_2 = "\"市场中\"";
$str_3 = "\"交易中\"";
$str_4 = "\"正在审核\"";
$str_5 = "\"审核通过\"";
$str_6 = "\"审核失败\"";
$str_7 = "\"正在交易\"";
$str_8 = "\"交易成功\"";
$str_9 = "\"交易失败\"";

//S表触发器
$sql = "CREATE TRIGGER TR1 AFTER DELETE ON S FOR EACH ROW
BEGIN
DELETE FROM U2 WHERE Uname IN (SELECT Uname FROM U1 WHERE Sno = OLD.Sno);
DELETE FROM U3 WHERE Uname IN (SELECT Uname FROM U1 WHERE Sno = OLD.Sno);
DELETE FROM G1 WHERE Uname IN (SELECT Uname FROM U1 WHERE Sno = OLD.Sno);
DELETE FROM BRO WHERE Uname IN (SELECT Uname FROM U1 WHERE Sno = OLD.Sno); 
DELETE FROM NTI WHERE Uname IN (SELECT Uname FROM U1 WHERE Sno = OLD.Sno);
DELETE FROM U1 WHERE Sno = OLD.Sno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR1 created successfully" . '<br>';
else 
    echo "创建触发器 TR1 错误: " . $conn -> error . '<br>';

//R表触发器
$sql = "CREATE TRIGGER TR2 AFTER DELETE ON R FOR EACH ROW
BEGIN
DELETE FROM UAR WHERE Rno = OLD.Rno;
END";

if ($conn -> query ($sql) === TRUE)
    echo "TRIGGER TR2 created successfully" . '<br>';
else 
    echo "创建触发器 TR2 错误: " . $conn -> error . '<br>';

//G1表触发器
$sql = "CREATE TRIGGER TR3 AFTER INSERT ON G1 FOR EACH ROW
BEGIN
INSERT INTO G2 VALUES (NEW.Gno, $str_4, CURRENT_TIMESTAMP);
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR3 created successfully" . '<br>';
else 
    echo "创建触发器 TR3 错误: " . $conn -> error . '<br>';

$sql = "CREATE TRIGGER TR4 AFTER UPDATE ON G1 FOR EACH ROW
BEGIN
IF NEW.Gname != OLD.Gname OR NEW.Gtype != OLD.Gtype OR NEW.Gaddress != OLD.Gaddress  THEN
	UPDATE G2 SET Gcheck = $str_4, Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END IF;
IF NEW.Gstate != OLD.Gstate AND NEW.Gstate = $str_2 THEN
	DELETE FROM CHA WHERE Gnoplan = NEW.Gno OR Gnoadopt = NEW.Gno;
END IF;
END";

if ($conn->query($sql) === TRUE) {
    echo "TRIGGER TR4 created successfully".'<br>';
} else {
    echo "创建触发器 TR4 错误: " . $conn->error . '<br>';
}

$sql = "CREATE TRIGGER TR5 AFTER DELETE ON G1 FOR EACH ROW
BEGIN
DELETE FROM G2 WHERE Gno = OLD.Gno;
DELETE FROM G3 WHERE Gno = OLD.Gno;
DELETE FROM DES WHERE Gno = OLD.Gno;
DELETE FROM BRO WHERE Gno = OLD.Gno;
DELETE FROM CHA WHERE Gnoplan = OLD.Gno OR Gnoadopt = OLD.Gno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR5 created successfully" . '<br>';
else 
    echo "创建触发器 TR5 错误: " . $conn -> error . '<br>';

//G2表触发器
$sql = "CREATE TRIGGER TR6 AFTER UPDATE ON G2 FOR EACH ROW
BEGIN
IF NEW.Gcheck != OLD.Gcheck AND NEW.Gcheck = $str_5 THEN
	UPDATE G1 SET Gstate = $str_2 WHERE Gno = NEW.Gno;
ELSEIF NEW.Gcheck != OLD.Gcheck AND NEW.Gcheck = $str_4 THEN
	UPDATE G1 SET Gstate = $str_1 WHERE Gno = NEW.Gno;
END IF;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR6 created successfully" . '<br>';
else 
    echo "创建触发器 TR6 错误: " . $conn -> error . '<br>';

//G3表触发器
$sql = "CREATE TRIGGER TR7 AFTER UPDATE ON G3 FOR EACH ROW
BEGIN
IF NEW.Ginstruction != OLD.Ginstruction OR NEW.Gparameter != OLD.Gparameter OR NEW.Gtime != OLD.Gtime OR NEW.Gprice != old.Gprice THEN
	UPDATE G2 SET Gcheck = $str_4, Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END IF;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR7 created successfully" . '<br>';
else 
    echo "创建触发器 TR7 错误: " . $conn -> error . '<br>';

//T表触发器
$sql = "CREATE TRIGGER TR8 AFTER DELETE ON T FOR EACH ROW
BEGIN
DELETE FROM DES WHERE Tno = OLD.Tno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR8 created successfully" . '<br>';
else 
    echo "创建触发器 TR8 错误: " . $conn -> error . '<br>';

//M表触发器
$sql = "CREATE TRIGGER TR9 AFTER DELETE ON M FOR EACH ROW
BEGIN 
DELETE FROM NTI WHERE Mno = OLD.Mno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR9 created successfully" . '<br>';
else 
    echo "创建触发器 TR9 错误: " . $conn -> error . '<br>';

//DES表触发器
$sql = "CREATE TRIGGER TR10 AFTER INSERT ON DES FOR EACH ROW
BEGIN
UPDATE G2 SET Gcheck = $str_4, Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END";

if ($conn -> query($sql) === TRUE) 
    echo "TRIGGER TR10 created successfully" . '<br>';
else 
    echo "创建触发器 TR10 错误: " . $conn -> error . '<br>';

//CHA表触发器
$sql = "CREATE TRIGGER TR11 AFTER INSERT ON CHA FOR EACH ROW
BEGIN
UPDATE G1 SET Gstate = $str_3 WHERE Gno = NEW.Gnoplan OR Gno = NEW.Gnoadopt;
END";

if ($conn->query($sql) === TRUE) 
    echo "TRIGGER TR11 created successfully" . '<br>';
else 
    echo "创建触发器 TR11 错误: " . $conn -> error . '<br>';

$sql = "CREATE TRIGGER TR12 AFTER UPDATE ON CHA FOR EACH ROW
BEGIN
IF NEW.CHAplanstate = $str_8 AND NEW.CHAadoptstate = $str_8 THEN
	UPDATE U2 SET Ucredit = Ucredit + NEW.CHAadoptcredit WHERE Uname IN (SELECT Uname FROM G1 WHERE Gno = NEW.Gnoplan);
	UPDATE U2 SET Ucredit = Ucredit + NEW.CHAplancredit WHERE Uname IN (SELECT Uname FROM G1 WHERE Gno = NEW.Gnoadopt);
	DELETE FROM G1 WHERE Gno = Gnoplan OR Gno = Gnoadopt;
END IF;
IF NEW.CHAplanstate = $str_9 AND NEW.CHAadoptstate = $str_9 THEN
	UPDATE G1 SET Gstate = $str_2 WHERE Gno = NEW.Gnoplan OR Gno = NEW.Gnoadopt;
END IF;
END";

if ($conn -> query ($sql) === TRUE)
    echo "TRIGGER TR12 created successfully" . '<br>';
else
    echo "创建触发器 TR12 错误: " . $conn -> error . '<br>';

//NTI表触发器
$sql = "CREATE TRIGGER TR13 AFTER DELETE ON NTI FOR EACH ROW
BEGIN 
DELETE FROM M WHERE Mno = OLD.Mno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR13 created successfully" . '<br>';
else 
    echo "创建触发器 TR13 错误: " . $conn -> error . '<br>';

$conn->close();

 ?> 