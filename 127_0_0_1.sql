-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2016-11-23 17:14:55
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
CREATE DATABASE IF NOT EXISTS `bdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bdb`;

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
-- 转存表中的数据 `charge`
--

INSERT INTO `charge` (`Gnoplan`, `Gnoadopt`, `CHAmoney`, `CHAplanstate`, `CHAplancredit`, `CHAadoptstate`, `CHAadoptcredit`, `CHAtimestamp`) VALUES
(1, 2, 0, 'äº¤æ˜“å¤±è´¥', 2, 'äº¤æ˜“å¤±è´¥', 2, '2016-11-23 15:38:42'),
(3, 4, 3, 'äº¤æ˜“å¤±è´¥', 3, 'äº¤æ˜“å¤±è´¥', 3, '2016-11-23 17:11:14');

--
-- 触发器 `charge`
--
DELIMITER $$
CREATE TRIGGER `TR_apply_charge` AFTER INSERT ON `charge` FOR EACH ROW BEGIN
UPDATE Goods_1 SET Gstate = "äº¤æ˜“ä¸­" WHERE Gno = NEW.Gnoplan OR Gno = NEW.Gnoadopt;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `TR_charge_state` AFTER UPDATE ON `charge` FOR EACH ROW BEGIN
IF NEW.CHAplanstate = "äº¤æ˜“æˆåŠŸ" AND NEW.CHAadoptstate = "äº¤æ˜“æˆåŠŸ" THEN
	UPDATE User_2 SET Ucredit = Ucredit + NEW.CHAadoptcredit WHERE Uname IN (SELECT Uname FROM G1 WHERE Gno = NEW.Gnoplan);
	UPDATE User_2 SET Ucredit = Ucredit + NEW.CHAplancredit WHERE Uname IN (SELECT Uname FROM G1 WHERE Gno = NEW.Gnoadopt);
	DELETE FROM Goods_1 WHERE Gno = Gnoplan OR Gno = Gnoadopt;
END IF;
IF NEW.CHAplanstate = "äº¤æ˜“å¤±è´¥" AND NEW.CHAadoptstate = "äº¤æ˜“å¤±è´¥" THEN
	UPDATE Goods_1 SET Gstate = "å¸‚åœºä¸­" WHERE Gno = NEW.Gnoplan OR Gno = NEW.Gnoadopt;
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
('æ°´æ°´ä¼šå‘˜', -1000, 0),
('ä½Žçº§ä¼šå‘˜', 1, 40),
('ä¸­çº§ä¼šå‘˜', 41, 80),
('é«˜çº§ä¼šå‘˜', 81, 100),
('é’»çŸ³ä¼šå‘˜', 101, 1000);

-- --------------------------------------------------------

--
-- 表的结构 `describle`
--

CREATE TABLE `describle` (
  `Gno` int(11) NOT NULL,
  `Tno` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `describle`
--

INSERT INTO `describle` (`Gno`, `Tno`) VALUES
(2, 'tag_gexing');

--
-- 触发器 `describle`
--
DELIMITER $$
CREATE TRIGGER `TR_edit_tag` AFTER INSERT ON `describle` FOR EACH ROW BEGIN
UPDATE Good_2 SET Gcheck = "æ­£åœ¨å®¡æ ¸", Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
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
-- 转存表中的数据 `goods_1`
--

INSERT INTO `goods_1` (`Gno`, `Gname`, `Uname`, `Gtype`, `Gaddress`, `Gstate`) VALUES
(1, 'ä½ å¥½', 'éŸ¦å¾·', 'fengge', 'dsfsdf', 'å¸‚åœºä¸­'),
(2, 'taing', 'éŸ¦å¾·', 'sdf', 'dfdf', 'äº¤æ˜“ä¸­'),
(3, 'ä½ å¥½', 'éŸ¦å¾·', 'fengge', 'aaa', 'å¸‚åœºä¸­'),
(4, 'ä½ å¥½', 'ç§‘æ¯”', 'fengge', 'aa', 'äº¤æ˜“ä¸­');

--
-- 触发器 `goods_1`
--
DELIMITER $$
CREATE TRIGGER `TR_add_goods` AFTER INSERT ON `goods_1` FOR EACH ROW BEGIN
INSERT INTO Goods_2 VALUES (NEW.Gno, "æ­£åœ¨å®¡æ ¸", CURRENT_TIMESTAMP);
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
	UPDATE Goods_2 SET Gcheck = "æ­£åœ¨å®¡æ ¸", Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
END IF;
IF NEW.Gstate != OLD.Gstate AND NEW.Gstate = "å¸‚åœºä¸­" THEN
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
-- 转存表中的数据 `goods_2`
--

INSERT INTO `goods_2` (`Gno`, `Gcheck`, `Gtimestamp`) VALUES
(1, 'å®¡æ ¸é€šè¿‡', '2016-11-23 15:01:37'),
(2, 'æ­£åœ¨å®¡æ ¸', '2016-11-23 15:27:34'),
(3, 'å®¡æ ¸é€šè¿‡', '2016-11-23 16:09:06'),
(4, 'å®¡æ ¸é€šè¿‡', '2016-11-23 16:25:14');

--
-- 触发器 `goods_2`
--
DELIMITER $$
CREATE TRIGGER `TR_goods_check` AFTER UPDATE ON `goods_2` FOR EACH ROW BEGIN
IF NEW.Gcheck != OLD.Gcheck AND NEW.Gcheck = "å®¡æ ¸é€šè¿‡" THEN
	UPDATE Goods_1 SET Gstate = "å¸‚åœºä¸­" WHERE Gno = NEW.Gno;
ELSEIF NEW.Gcheck != OLD.Gcheck AND NEW.Gcheck = "æ­£åœ¨å®¡æ ¸" THEN
	UPDATE Goods_1 SET Gstate = "å®¡æ ¸ä¸­" WHERE Gno = NEW.Gno;
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
-- 转存表中的数据 `goods_3`
--

INSERT INTO `goods_3` (`Gno`, `Ginstruction`, `Gparameter`, `Gtime`, `Gprice`) VALUES
(1, 'skjfd', 'sdfsdfdsfdsfdsfsd', 1, 11),
(2, 'sdf', 'sdf', 0, 0),
(3, 'skjfd', 'sdfsdfdsfdsfdsfsd', 1, 11),
(4, 'skjfd', 'sdfsdfdsfdsfdsfsd', 1, 11);

--
-- 触发器 `goods_3`
--
DELIMITER $$
CREATE TRIGGER `TR_edit_goods` AFTER UPDATE ON `goods_3` FOR EACH ROW BEGIN
IF NEW.Ginstruction != OLD.Ginstruction OR NEW.Gparameter != OLD.Gparameter OR NEW.Gtime != OLD.Gtime OR NEW.Gprice != old.Gprice THEN
	UPDATE Goods_2 SET Gcheck = "æ­£åœ¨å®¡æ ¸", Gtimestamp = CURRENT_TIMESTAMP WHERE Gno = NEW.Gno;
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
-- 转存表中的数据 `message`
--

INSERT INTO `message` (`Mno`, `Mcontent`, `Mtimestamp`) VALUES
(1, 'sdfsdfsdfsdfsdfsdfsdfsdfsd', '2016-11-23 14:27:28'),
(2, 'sdfsdfsdfsdfsdfsdfsdfsdfsd', '2016-11-23 14:27:40');

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
-- 转存表中的数据 `notify`
--

INSERT INTO `notify` (`Mno`, `Unamesend`, `Unamereceive`) VALUES
(1, 'éŸ¦å¾·', 'ç§‘æ¯”'),
(2, 'éŸ¦å¾·', 'ç§‘æ¯”');

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
(1, 'åˆ é™¤ç‰©å“'),
(2, 'å®¡æ ¸ç‰©å“');

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

--
-- 转存表中的数据 `search`
--

INSERT INTO `search` (`Uname`, `Gno`, `BROtimestamp`) VALUES
('weide', 2, '2016-11-23 15:30:19'),
('weide', 3, '2016-11-23 16:06:45');

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
('tag_meng', 'èŒ'),
('tag_shishang', 'æ—¶å°š'),
('tag_gexing', 'ä¸ªæ€§'),
('tag_shiyong', 'å®žç”¨'),
('tag_pinpai', 'å“ç‰Œ');

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
('äºšå½“.è‚–åŽ', '00000000', 'ç®¡ç†å‘˜'),
('éŸ¦å¾·', '00000001', 'ç”¨æˆ·');

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
('äºšå½“.è‚–åŽ', 'ç”·', 1000, ''),
('éŸ¦å¾·', 'ç”·', 60, 'sd333');

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
('äºšå½“.è‚–åŽ', '00000000', '00000000000', '00000000000@nba.com'),
('éŸ¦å¾·', '122', '11111111113', 'ssad');

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
('ç®¡ç†å‘˜', 1),
('ç”¨æˆ·', 2);

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
  ADD UNIQUE KEY `Gaddress` (`Gaddress`),
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
--
-- Database: `business`
--
CREATE DATABASE IF NOT EXISTS `business` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `business`;

-- --------------------------------------------------------

--
-- 表的结构 `j`
--

CREATE TABLE `j` (
  `JNO` varchar(5) NOT NULL,
  `JNAME` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `CITY` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `j`
--

INSERT INTO `j` (`JNO`, `JNAME`, `CITY`) VALUES
('J1', '三建', '北京'),
('J2', '一汽', '长春'),
('J3', '弹簧厂', '天津'),
('J4', '造船厂', '天津'),
('J5', '机车厂', '唐山'),
('J6', '无线电厂', '常州'),
('J7', '半导体厂', '南京');

-- --------------------------------------------------------

--
-- 表的结构 `p`
--

CREATE TABLE `p` (
  `PNO` varchar(5) NOT NULL,
  `PNAME` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `COLOR` varchar(20) CHARACTER SET utf8 DEFAULT NULL,
  `WEIGHT` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `p`
--

INSERT INTO `p` (`PNO`, `PNAME`, `COLOR`, `WEIGHT`) VALUES
('P1', '螺母', '蓝', 12),
('P2', '螺栓', '绿', 17),
('P3', '螺丝刀', '蓝', 14),
('P4', '螺丝刀', '蓝', 14),
('P5', '凸轮', '蓝', 40),
('P6', '齿轮', '蓝', 30);

-- --------------------------------------------------------

--
-- 表的结构 `s`
--

CREATE TABLE `s` (
  `SNO` varchar(5) NOT NULL,
  `Sname` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `STATUS` int(11) NOT NULL,
  `CITY` varchar(20) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `s`
--

INSERT INTO `s` (`SNO`, `Sname`, `STATUS`, `CITY`) VALUES
('S1', '精益', 20, '天津'),
('S8', 'éŸ¦å¾·', 30, 'ç¾Žå›½'),
('S3', '东方红', 30, '北京'),
('S4', '丰泰盛', 20, '天津'),
('S5', '为民', 30, '上海'),
('S9', '韦德', 30, '美国'),
('S19', '韦德', 30, '美国');

-- --------------------------------------------------------

--
-- 表的结构 `spj`
--

CREATE TABLE `spj` (
  `SNO` varchar(5) NOT NULL,
  `PNO` varchar(5) NOT NULL,
  `JNO` varchar(5) NOT NULL,
  `QTY` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `spj`
--

INSERT INTO `spj` (`SNO`, `PNO`, `JNO`, `QTY`) VALUES
('S1', 'P1', 'J1', 200),
('S1', 'P1', 'J3', 100),
('S1', 'P1', 'J4', 700),
('S1', 'P2', 'J2', 100),
('S2', 'J6', 'P4', 200),
('S3', 'P1', 'J1', 200),
('S3', 'P3', 'J1', 200),
('S4', 'P5', 'J1', 100),
('S4', 'P6', 'J3', 300),
('S4', 'P6', 'J4', 200),
('S5', 'P2', 'J4', 100),
('S5', 'P3', 'J1', 200),
('S5', 'P6', 'J2', 200),
('S3', 'P6', 'J4', 500);

-- --------------------------------------------------------

--
-- 表的结构 `test`
--

CREATE TABLE `test` (
  `name` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `test`
--

INSERT INTO `test` (`name`) VALUES
('韦德');

-- --------------------------------------------------------

--
-- 表的结构 `test1`
--

CREATE TABLE `test1` (
  `name` varchar(40) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- 转存表中的数据 `test1`
--

INSERT INTO `test1` (`name`) VALUES
('韦德');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `j`
--
ALTER TABLE `j`
  ADD PRIMARY KEY (`JNO`);

--
-- Indexes for table `p`
--
ALTER TABLE `p`
  ADD PRIMARY KEY (`PNO`);

--
-- Indexes for table `s`
--
ALTER TABLE `s`
  ADD PRIMARY KEY (`SNO`);

--
-- Indexes for table `spj`
--
ALTER TABLE `spj`
  ADD PRIMARY KEY (`SNO`,`PNO`,`JNO`),
  ADD KEY `PNO` (`PNO`),
  ADD KEY `JNO` (`JNO`);
--
-- Database: `mydb`
--
CREATE DATABASE IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mydb`;

-- --------------------------------------------------------

--
-- 表的结构 `mytest1`
--

CREATE TABLE `mytest1` (
  `Name` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `mytest1`
--

INSERT INTO `mytest1` (`Name`) VALUES
('韦德'),
('éŸ¦å¾·'),
('éŸ¦å¾·'),
('éŸ¦å¾·'),
('éŸ¦å¾·');

-- --------------------------------------------------------

--
-- 表的结构 `te`
--

CREATE TABLE `te` (
  `E1` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `te`
--

INSERT INTO `te` (`E1`) VALUES
(NULL);

-- --------------------------------------------------------

--
-- 表的结构 `tee`
--

CREATE TABLE `tee` (
  `E` int(11) DEFAULT NULL,
  `E1` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tes`
--

CREATE TABLE `tes` (
  `E1` varchar(40) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tes`
--

INSERT INTO `tes` (`E1`) VALUES
('111'),
('1111');

-- --------------------------------------------------------

--
-- 表的结构 `test1`
--

CREATE TABLE `test1` (
  `E1` int(11) DEFAULT NULL,
  `E2` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `test1`
--

INSERT INTO `test1` (`E1`, `E2`) VALUES
(1, 1),
(2, 1),
(3, 1),
(3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `test3`
--

CREATE TABLE `test3` (
  `E1` int(11) DEFAULT NULL,
  `E2` int(11) DEFAULT NULL,
  `E3` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `test3`
--

INSERT INTO `test3` (`E1`, `E2`, `E3`) VALUES
(1, 3, '2016-11-18 11:45:17'),
(1, 1, '2016-11-18 13:01:03');

-- --------------------------------------------------------

--
-- 表的结构 `test4`
--

CREATE TABLE `test4` (
  `E1` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `test4`
--

INSERT INTO `test4` (`E1`) VALUES
(0),
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(0),
(1),
(2),
(3),
(4),
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- 表的结构 `tet`
--

CREATE TABLE `tet` (
  `E1` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tet`
--

INSERT INTO `tet` (`E1`) VALUES
('1111');

-- --------------------------------------------------------

--
-- 表的结构 `tss`
--

CREATE TABLE `tss` (
  `E1` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tss`
--

INSERT INTO `tss` (`E1`) VALUES
(1111);

-- --------------------------------------------------------

--
-- 表的结构 `tsss`
--

CREATE TABLE `tsss` (
  `E1` varchar(23) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `tsss`
--

INSERT INTO `tsss` (`E1`) VALUES
('çœ‹ç”µè§†å‰§å‘'),
('åˆé€‚çš„');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
