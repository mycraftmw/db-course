-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-25 07:05:20
-- 服务器版本： 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bdb`
--

DELIMITER $$
--
-- 存储过程
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `Charge_insert` (`gnoplan` INT, `gnoadopt` INT, `chamoney` INT)  BEGIN
INSERT INTO Charge VALUES (gnoplan, gnoadopt, chamoney, "等待交易", 0, "等待交易", 0, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Charge_update` (`gnoplan` INT, `gnoadopt` INT, `chamoney` INT, `chaplanstate` VARCHAR(40), `chaplancredit` INT, `chaadoptstate` VARCHAR(40), `chaadoptcredit` INT)  BEGIN
INSERT INTO Charge VALUES (gnoplan, gnoadopt, chamoney, chaplanstate, chaplancredit, chaadoptstate, chaadoptcredit, CURRENT_TIMESTAMP);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Goods_1_insert` (`gno` INT, `gname` VARCHAR(40), `uname` VARCHAR(40), `gtype` VARCHAR(40), `gaddress` VARCHAR(40))  BEGIN
INSERT INTO Goods_1 VALUES (gno, gname, uname, gtype, gaddress, "审核中");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Goods_3_insert` (`gno` INT, `ginstruction` VARCHAR(400), `gparameter` VARCHAR(400), `gtime` INT, `gprice` INT)  BEGIN
INSERT INTO Goods_3 VALUES (gno, ginstruction, gparameter, gtime, gprice);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Goods_delete` (`gno` INT)  BEGIN
DELETE FROM G1 WHERE Gno = gno;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Goods_information` (`gno` INT)  BEGIN
SELECT Goods_1.Gno, Gname, Uname, Gtype, Gaddress, Gstate, Gcheck, Gtimestamp, Ginstruction, Gparameter, Gtime, Gprice
FROM Goods_1, Goods_2, Goods_3
WHERE
Goods_1.Gno = Goods_2.Gno AND
Goods_1.Gno = Goods_3.Gno AND
Goods_1.Gno = gno;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Goods_tag_insert` (`gno` INT, `tno` VARCHAR(40))  BEGIN
INSERT INTO Describle VALUES (gno, tno);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Message_information` (`mno` INT)  BEGIN
SELECT Mcontent, CURRENT_TIMESTAMP, Unamesend, Unamereceive
FROM Message, Notify
WHERE
Message.Mno = Notify.Mno AND
Mno = mno;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `Message_insert` (`Mno` INT, `Mcontent` VARCHAR(400), `unamesend` VARCHAR(40), `unamereceive` VARCHAR(40))  BEGIN
INSERT INTO Message VALUES (Mno, Mcontent, CURRENT_TIMESTAMP);
INSERT INTO Notify VALUES (Mno, unamesend, unamereceive);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `User_1_insert` (`uname` VARCHAR(40), `sno` CHAR(8), `uroot` VARCHAR(40))  BEGIN
INSERT INTO User_1 VALUES (uname, sno, uroot);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `User_2_insert` (`uname` VARCHAR(40), `usexy` VARCHAR(40), `uaddress` VARCHAR(40))  BEGIN
INSERT INTO User_2 VALUES (uname, usexy, 60, uaddress);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `User_3_insert` (`uname` VARCHAR(40), `upassword` VARCHAR(40), `uphone` CHAR(11), `uemail` VARCHAR(40))  BEGIN
INSERT INTO User_3 VALUES (uname, upassword, uphone, uemail);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `User_information` (`uname` VARCHAR(40), `upassword` VARCHAR(40))  BEGIN
SELECT User_1.Uname, Sno, Uroot, Usexy, Ucredit, Uaddress, Upassword, Uphone, Uemail 
FROM User_1, User_2, User_3 
WHERE 
User_1.Uname = User_2.Uname AND
User_1.Uname = User_3.Uname AND
User_1.Uname = @uname AND 
Upassword = @upassword;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `charge`
--

CREATE TABLE `charge` (
  `Gnoplan` int(11) NOT NULL,
  `Gnoadopt` int(11) NOT NULL,
  `CHAmoney` int(11) NOT NULL,
  `CHAplanstate` varchar(40) NOT NULL,
  `CHAplancredit` int(11) NOT NULL,
  `CHAadoptstate` varchar(40) NOT NULL,
  `CHAadoptcredit` int(11) NOT NULL,
  `CHAtimestamp` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 触发器 `charge`
--
DELIMITER $$
CREATE TRIGGER `TR_apply_charge` AFTER INSERT ON `charge` FOR EACH ROW BEGIN
UPDATE Goods_1 SET Gstate = "交易中" WHERE Gno = NEW.Gnoplan OR Gno = NEW.Gnoadopt;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_charge_state` AFTER UPDATE ON `charge` FOR EACH ROW BEGIN
IF NEW.CHAplanstate = "审核通过" AND NEW.CHAadoptstate = "审核通过" THEN
	UPDATE User_2 SET Ucredit = Ucredit + NEW.CHAadoptcredit WHERE Uname IN (SELECT Uname FROM G1 WHERE Gno = NEW.Gnoplan);
	UPDATE User_2 SET Ucredit = Ucredit + NEW.CHAplancredit WHERE Uname IN (SELECT Uname FROM G1 WHERE Gno = NEW.Gnoadopt);
	DELETE FROM Goods_1 WHERE Gno = Gnoplan OR Gno = Gnoadopt;
END IF;
IF NEW.CHAplanstate = "审核失败" AND NEW.CHAadoptstate = "审核失败" THEN
	UPDATE Goods_1 SET Gstate = "市场中" WHERE Gno = NEW.Gnoplan OR Gno = NEW.Gnoadopt;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `credit`
--

CREATE TABLE `credit` (
  `Clevel` varchar(40) NOT NULL,
  `Cleft` int(11) NOT NULL,
  `Cright` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `credit`
--

INSERT INTO `credit` (`Clevel`, `Cleft`, `Cright`) VALUES
('水水会员', -1000, 0),
('低级会员', 1, 40),
('中级会员', 41, 80),
('高级会员', 81, 100),
('钻石会员', 101, 1000);

-- --------------------------------------------------------

--
-- 表的结构 `describle`
--

CREATE TABLE `describle` (
  `Gno` int(11) NOT NULL,
  `Tno` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 触发器 `describle`
--
DELIMITER $$
CREATE TRIGGER `TR_edit_tag` AFTER INSERT ON `describle` FOR EACH ROW BEGIN
UPDATE Good_2 SET Gcheck = "正在审核", Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `goods_1`
--

CREATE TABLE `goods_1` (
  `Gno` int(11) NOT NULL,
  `Gname` varchar(40) NOT NULL,
  `Uname` varchar(40) NOT NULL,
  `Gtype` varchar(40) NOT NULL,
  `Gaddress` varchar(40) NOT NULL,
  `Gstate` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 触发器 `goods_1`
--
DELIMITER $$
CREATE TRIGGER `TR_add_goods` AFTER INSERT ON `goods_1` FOR EACH ROW BEGIN
INSERT INTO Goods_2 VALUES (NEW.Gno, "正在审核", CURRENT_TIMESTAMP);
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_delete_goods` AFTER DELETE ON `goods_1` FOR EACH ROW BEGIN
DELETE FROM Goods_2 WHERE Gno = OLD.Gno;
DELETE FROM Goods_3 WHERE Gno = OLD.Gno;
DELETE FROM Describle WHERE Gno = OLD.Gno;
DELETE FROM Search WHERE Gno = OLD.Gno;
DELETE FROM Charge WHERE Gnoplan = OLD.Gno OR Gnoadopt = OLD.Gno;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_goods_state` AFTER UPDATE ON `goods_1` FOR EACH ROW BEGIN
IF NEW.Gname != OLD.Gname OR NEW.Gtype != OLD.Gtype OR NEW.Gaddress != OLD.Gaddress  THEN
	UPDATE Goods_2 SET Gcheck = "正在审核", Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END IF;
IF NEW.Gstate != OLD.Gstate AND NEW.Gstate = "市场中" THEN
	DELETE FROM Charge WHERE Gnoplan = NEW.Gno OR Gnoadopt = NEW.Gno;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `goods_2`
--

CREATE TABLE `goods_2` (
  `Gno` int(11) NOT NULL,
  `Gcheck` varchar(40) NOT NULL,
  `Gtimestamp` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 触发器 `goods_2`
--
DELIMITER $$
CREATE TRIGGER `TR_goods_check` AFTER UPDATE ON `goods_2` FOR EACH ROW BEGIN
IF NEW.Gcheck != OLD.Gcheck AND NEW.Gcheck = "审核通过" THEN
	UPDATE Goods_1 SET Gstate = "市场中" WHERE Gno = NEW.Gno;
ELSEIF NEW.Gcheck != OLD.Gcheck AND NEW.Gcheck = "正在审核" THEN
	UPDATE Goods_1 SET Gstate = "审核中" WHERE Gno = NEW.Gno;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `goods_3`
--

CREATE TABLE `goods_3` (
  `Gno` int(11) NOT NULL,
  `Ginstruction` varchar(400) DEFAULT NULL,
  `Gparameter` varchar(400) DEFAULT NULL,
  `Gtime` int(11) DEFAULT NULL,
  `Gprice` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 触发器 `goods_3`
--
DELIMITER $$
CREATE TRIGGER `TR_edit_goods` AFTER UPDATE ON `goods_3` FOR EACH ROW BEGIN
IF NEW.Ginstruction != OLD.Ginstruction OR NEW.Gparameter != OLD.Gparameter OR NEW.Gtime != OLD.Gtime OR NEW.Gprice != old.Gprice THEN
	UPDATE Goods_2 SET Gcheck = "正在审核", Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `message`
--

CREATE TABLE `message` (
  `Mno` int(11) NOT NULL,
  `Mcontent` varchar(400) NOT NULL,
  `Mtimestamp` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 触发器 `message`
--
DELIMITER $$
CREATE TRIGGER `TR_delete_message` AFTER DELETE ON `message` FOR EACH ROW BEGIN 
DELETE FROM Notify WHERE Mno = OLD.Mno;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `notify`
--

CREATE TABLE `notify` (
  `Mno` int(11) NOT NULL,
  `Unamesend` varchar(40) NOT NULL,
  `Unamereceive` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 触发器 `notify`
--
DELIMITER $$
CREATE TRIGGER `TR_delete_notification` AFTER DELETE ON `notify` FOR EACH ROW BEGIN 
DELETE FROM Message WHERE Mno = OLD.Mno;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `root`
--

CREATE TABLE `root` (
  `Rno` int(11) NOT NULL,
  `Rcontent` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `root`
--

INSERT INTO `root` (`Rno`, `Rcontent`) VALUES
(1, '删除物品'),
(2, '审核物品');

--
-- 触发器 `root`
--
DELIMITER $$
CREATE TRIGGER `TR_delete_root` AFTER DELETE ON `root` FOR EACH ROW BEGIN
DELETE FROM User_Administrator_Root WHERE Rno = OLD.Rno;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `search`
--

CREATE TABLE `search` (
  `Uname` varchar(40) NOT NULL,
  `Gno` int(11) NOT NULL,
  `BROtimestamp` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE `student` (
  `Sno` char(8) NOT NULL,
  `Spassword` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `student`
--

INSERT INTO `student` (`Sno`, `Spassword`) VALUES
('00000000', '00000000'),
('00000001', '00000001'),
('00000002', '00000002'),
('00000003', '00000003'),
('00000004', '00000004'),
('00000005', '00000005'),
('00000006', '00000006'),
('00000007', '00000007');

--
-- 触发器 `student`
--
DELIMITER $$
CREATE TRIGGER `TR_delete_student` AFTER DELETE ON `student` FOR EACH ROW BEGIN
DELETE FROM User_2 WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno);
DELETE FROM User_3 WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno);
DELETE FROM Goods_1 WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno);
DELETE FROM Search WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno); 
DELETE FROM Notify WHERE Uname IN (SELECT Uname FROM User_1 WHERE Sno = OLD.Sno);
DELETE FROM User_1 WHERE Sno = OLD.Sno;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `tag`
--

CREATE TABLE `tag` (
  `Tno` varchar(40) NOT NULL,
  `Tcontent` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tag`
--

INSERT INTO `tag` (`Tno`, `Tcontent`) VALUES
('tag_meng', '萌'),
('tag_shishang', '时尚'),
('tag_gexing', '个性'),
('tag_shiyong', '实用'),
('tag_pinpai', '品牌');

--
-- 触发器 `tag`
--
DELIMITER $$
CREATE TRIGGER `TR_delete_tag` AFTER DELETE ON `tag` FOR EACH ROW BEGIN
DELETE FROM Describle WHERE Tno = OLD.Tno;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `user_1`
--

CREATE TABLE `user_1` (
  `Uname` varchar(40) NOT NULL,
  `Sno` char(8) NOT NULL,
  `Uroot` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_1`
--

INSERT INTO `user_1` (`Uname`, `Sno`, `Uroot`) VALUES
('亚当.肖华', '00000000', '管理员');

-- --------------------------------------------------------

--
-- 表的结构 `user_2`
--

CREATE TABLE `user_2` (
  `Uname` varchar(40) NOT NULL,
  `Usexy` varchar(40) NOT NULL,
  `Ucredit` int(11) NOT NULL,
  `Uaddress` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_2`
--

INSERT INTO `user_2` (`Uname`, `Usexy`, `Ucredit`, `Uaddress`) VALUES
('亚当.肖华', '男', 1000, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `user_3`
--

CREATE TABLE `user_3` (
  `Uname` varchar(40) NOT NULL,
  `Upassword` varchar(40) NOT NULL,
  `Uphone` char(11) NOT NULL,
  `Uemail` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_3`
--

INSERT INTO `user_3` (`Uname`, `Upassword`, `Uphone`, `Uemail`) VALUES
('亚当.肖华', '00000000', '00000000000', '00000000@nba.com');

-- --------------------------------------------------------

--
-- 表的结构 `user_administrator_root`
--

CREATE TABLE `user_administrator_root` (
  `Uroot` varchar(40) NOT NULL,
  `Rno` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user_administrator_root`
--

INSERT INTO `user_administrator_root` (`Uroot`, `Rno`) VALUES
('用户', 2),
('管理员', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `charge`
--
ALTER TABLE `charge`
  ADD PRIMARY KEY (`Gnoplan`),
  ADD UNIQUE KEY `Gnoadopt` (`Gnoadopt`);

--
-- Indexes for table `credit`
--
ALTER TABLE `credit`
  ADD PRIMARY KEY (`Clevel`),
  ADD UNIQUE KEY `Cleft` (`Cleft`),
  ADD UNIQUE KEY `Cright` (`Cright`);

--
-- Indexes for table `describle`
--
ALTER TABLE `describle`
  ADD PRIMARY KEY (`Gno`,`Tno`),
  ADD KEY `Tno` (`Tno`);

--
-- Indexes for table `goods_1`
--
ALTER TABLE `goods_1`
  ADD PRIMARY KEY (`Gno`),
  ADD KEY `Uname` (`Uname`);

--
-- Indexes for table `goods_2`
--
ALTER TABLE `goods_2`
  ADD PRIMARY KEY (`Gno`);

--
-- Indexes for table `goods_3`
--
ALTER TABLE `goods_3`
  ADD PRIMARY KEY (`Gno`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`Mno`);

--
-- Indexes for table `notify`
--
ALTER TABLE `notify`
  ADD PRIMARY KEY (`Mno`),
  ADD KEY `Unamesend` (`Unamesend`),
  ADD KEY `Unamereceive` (`Unamereceive`);

--
-- Indexes for table `root`
--
ALTER TABLE `root`
  ADD PRIMARY KEY (`Rno`),
  ADD UNIQUE KEY `Rcontent` (`Rcontent`);

--
-- Indexes for table `search`
--
ALTER TABLE `search`
  ADD PRIMARY KEY (`Uname`,`Gno`),
  ADD KEY `Gno` (`Gno`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`Sno`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`Tno`),
  ADD UNIQUE KEY `Tcontent` (`Tcontent`);

--
-- Indexes for table `user_1`
--
ALTER TABLE `user_1`
  ADD PRIMARY KEY (`Uname`),
  ADD KEY `Sno` (`Sno`);

--
-- Indexes for table `user_2`
--
ALTER TABLE `user_2`
  ADD PRIMARY KEY (`Uname`);

--
-- Indexes for table `user_3`
--
ALTER TABLE `user_3`
  ADD PRIMARY KEY (`Uname`),
  ADD UNIQUE KEY `Uphone` (`Uphone`),
  ADD UNIQUE KEY `Uemail` (`Uemail`);

--
-- Indexes for table `user_administrator_root`
--
ALTER TABLE `user_administrator_root`
  ADD PRIMARY KEY (`Uroot`,`Rno`),
  ADD KEY `Rno` (`Rno`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
