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

//Student表触发器
$sql = "CREATE TRIGGER TR_delete_student AFTER DELETE ON Student FOR EACH ROW
BEGIN
DELETE FROM User_2 WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno);
DELETE FROM User_3 WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno);
DELETE FROM Goods_1 WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno);
DELETE FROM Search WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno); 
DELETE FROM Notify WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno);
DELETE FROM User_1 WHERE Sno = OLD.Sno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR_delete_student created successfully" . '<br>';
else 
    echo "创建触发器 TR_delete_student 错误: " . $conn -> error . '<br>';

//Root表触发器
$sql = "CREATE TRIGGER TR_delete_root AFTER DELETE ON Root FOR EACH ROW
BEGIN
DELETE FROM User_Administrator_Root WHERE Rno = OLD.Rno;
END";

if ($conn -> query ($sql) === TRUE)
    echo "TRIGGER TR_delete_root created successfully" . '<br>';
else 
    echo "创建触发器 TR_delete_root 错误: " . $conn -> error . '<br>';

//Goods_1表触发器
$sql = "CREATE TRIGGER TR_add_goods AFTER INSERT ON Goods_1 FOR EACH ROW
BEGIN
INSERT INTO Goods_2 VALUES (NEW.Gno, $str_4, CURRENT_TIMESTAMP);
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR_add_goods created successfully" . '<br>';
else 
    echo "创建触发器 TR_add_goods 错误: " . $conn -> error . '<br>';

$sql = "CREATE TRIGGER TR_goods_state AFTER UPDATE ON Goods_1 FOR EACH ROW
BEGIN
IF NEW.Gname != OLD.Gname OR NEW.Gtype != OLD.Gtype OR NEW.Gaddress != OLD.Gaddress  THEN
	UPDATE Goods_2 SET Gcheck = $str_4, Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END IF;
IF NEW.Gstate != OLD.Gstate AND NEW.Gstate = $str_2 THEN
	DELETE FROM Charge WHERE Gnoplan = NEW.Gno OR Gnoadopt = NEW.Gno;
END IF;
END";

if ($conn->query($sql) === TRUE) {
    echo "TRIGGER TR_goods_state created successfully".'<br>';
} else {
    echo "创建触发器 TR_goods_state 错误: " . $conn->error . '<br>';
}

$sql = "CREATE TRIGGER TR_delete_goods AFTER DELETE ON Goods_1 FOR EACH ROW
BEGIN
DELETE FROM Goods_2 WHERE Gno = OLD.Gno;
DELETE FROM Goods_3 WHERE Gno = OLD.Gno;
DELETE FROM Describle WHERE Gno = OLD.Gno;
DELETE FROM Search WHERE Gno = OLD.Gno;
DELETE FROM Charge WHERE Gnoplan = OLD.Gno OR Gnoadopt = OLD.Gno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR_delete_goods created successfully" . '<br>';
else 
    echo "创建触发器 TR_delete_goods  错误: " . $conn -> error . '<br>';

//Goods_2表触发器
$sql = "CREATE TRIGGER TR_goods_check AFTER UPDATE ON Goods_2 FOR EACH ROW
BEGIN
IF NEW.Gcheck != OLD.Gcheck AND NEW.Gcheck = $str_5 THEN
	UPDATE Goods_1 SET Gstate = $str_2 WHERE Gno = NEW.Gno;
ELSEIF NEW.Gcheck != OLD.Gcheck AND NEW.Gcheck = $str_4 THEN
	UPDATE Goods_1 SET Gstate = $str_1 WHERE Gno = NEW.Gno;
END IF;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR_goods_check created successfully" . '<br>';
else 
    echo "创建触发器 TR_goods_check 错误: " . $conn -> error . '<br>';

//Good_3表触发器
$sql = "CREATE TRIGGER TR_edit_goods AFTER UPDATE ON Goods_3 FOR EACH ROW
BEGIN
IF NEW.Ginstruction != OLD.Ginstruction OR NEW.Gparameter != OLD.Gparameter OR NEW.Gtime != OLD.Gtime OR NEW.Gprice != old.Gprice THEN
	UPDATE Goods_2 SET Gcheck = $str_4, Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END IF;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR_edit_goods  created successfully" . '<br>';
else 
    echo "创建触发器 TR_edit_goods  错误: " . $conn -> error . '<br>';

//Tag表触发器
$sql = "CREATE TRIGGER TR_delete_tag AFTER DELETE ON Tag FOR EACH ROW
BEGIN
DELETE FROM Describle WHERE Tno = OLD.Tno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR_delete_tag created successfully" . '<br>';
else 
    echo "创建触发器 TR_delete_tag 错误: " . $conn -> error . '<br>';

//Message表触发器
$sql = "CREATE TRIGGER TR_delete_message AFTER DELETE ON Message FOR EACH ROW
BEGIN 
DELETE FROM Notify WHERE Mno = OLD.Mno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR_delete_message created successfully" . '<br>';
else 
    echo "创建触发器 TR_delete_message 错误: " . $conn -> error . '<br>';

//Describle表触发器
$sql = "CREATE TRIGGER TR_edit_tag AFTER INSERT ON Describle FOR EACH ROW
BEGIN
UPDATE Good_2 SET Gcheck = $str_4, Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END";

if ($conn -> query($sql) === TRUE) 
    echo "TRIGGER TR_edit_tag created successfully" . '<br>';
else 
    echo "创建触发器 TR_edit_tag 错误: " . $conn -> error . '<br>';

//Charge表触发器
$sql = "CREATE TRIGGER TR_apply_charge AFTER INSERT ON Charge FOR EACH ROW
BEGIN
UPDATE Goods_1 SET Gstate = $str_3 WHERE Gno = NEW.Gnoplan OR Gno = NEW.Gnoadopt;
END";

if ($conn->query($sql) === TRUE) 
    echo "TRIGGER TR_apply_charge created successfully" . '<br>';
else 
    echo "创建触发器 TR_apply_charge 错误: " . $conn -> error . '<br>';

$sql = "CREATE TRIGGER TR_charge_state AFTER UPDATE ON Charge FOR EACH ROW
BEGIN
IF NEW.CHAplanstate = $str_8 AND NEW.CHAadoptstate = $str_8 THEN
	UPDATE User_2 SET Ucredit = Ucredit + NEW.CHAadoptcredit WHERE Uname IN (SELECT Uname FROM G1 WHERE Gno = NEW.Gnoplan);
	UPDATE User_2 SET Ucredit = Ucredit + NEW.CHAplancredit WHERE Uname IN (SELECT Uname FROM G1 WHERE Gno = NEW.Gnoadopt);
	DELETE FROM Goods_1 WHERE Gno = Gnoplan OR Gno = Gnoadopt;
END IF;
IF NEW.CHAplanstate = $str_9 AND NEW.CHAadoptstate = $str_9 THEN
	UPDATE Goods_1 SET Gstate = $str_2 WHERE Gno = NEW.Gnoplan OR Gno = NEW.Gnoadopt;
END IF;
END";

if ($conn -> query ($sql) === TRUE)
    echo "TRIGGER TR_charge_state created successfully" . '<br>';
else
    echo "创建触发器 TR_charge_state 错误: " . $conn -> error . '<br>';

//Notify表触发器
$sql = "CREATE TRIGGER TR_delete_notification AFTER DELETE ON Notify FOR EACH ROW
BEGIN 
DELETE FROM Message WHERE Mno = OLD.Mno;
END";

if ($conn -> query ($sql) === TRUE) 
    echo "TRIGGER TR_delete_notification created successfully" . '<br>';
else 
    echo "创建触发器 TR_delete_notification 错误: " . $conn -> error . '<br>';

$conn->close();

 ?> 