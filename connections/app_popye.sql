-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2014 年 06 月 19 日 15:15
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `app_popye`
--

-- --------------------------------------------------------

--
-- 表的结构 `first_page_image`
--

CREATE TABLE IF NOT EXISTS `first_page_image` (
  `var_flag` varchar(20) NOT NULL,
  `var_url` text NOT NULL,
  PRIMARY KEY (`var_flag`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='首页';

--
-- 转存表中的数据 `first_page_image`
--

INSERT INTO `first_page_image` (`var_flag`, `var_url`) VALUES
('var_image1', 'http://1.popye.sinaapp.com/images/gz.jpg'),
('var_image2', 'http://1.popye.sinaapp.com/images/guanzhu1.jpg'),
('var_image3', 'http://1.popye.sinaapp.com/images/guanzhu2.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `libInfo`
--

CREATE TABLE IF NOT EXISTS `libInfo` (
  `func_num` varchar(11) DEFAULT NULL,
  `func_type` varchar(20) DEFAULT NULL,
  `func_value` mediumtext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `libInfo`
--

INSERT INTO `libInfo` (`func_num`, `func_type`, `func_value`) VALUES
('4', 'title1', '尊敬的 谢海欧 ,您当前借阅  7 本,3本超期,1本即将超期,具体信息如下:'),
('4', 'picurl1', 'http://1.popye.sinaapp.com/images/jj.jpg'),
('4', 'url1', NULL),
('4', 'title2', '1.宋选词     推荐版本:上海古诗词出版社2007年'),
('4', 'picurl2', 'http://1.popye.sinaapp.com/images/cq.jpg'),
('4', 'url2', NULL),
('4', 'title3', '7.水浒传  (元末明处)施耐庵'),
('4', 'picurl3', 'http://1.popye.sinaapp.com/images/xj.jpg'),
('4', 'url3', NULL),
('4', 'title4', '8.三国演义 (元末明初)罗贯中'),
('4', 'picurl4', 'http://1.popye.sinaapp.com/images/xj.jpg'),
('4', 'url4', NULL),
('4', 'title5', '9.西游记 (明)吴承恩'),
('4', 'picurl5', 'http://1.popye.sinaapp.com/images/xj.jpg'),
('4', 'url5', NULL),
('借阅规则', 'title1', '借阅规则'),
('借阅规则', 'picurl1', 'http://1.popye.sinaapp.com/images/jj.jpg\r\n'),
('借阅规则', 'url1', 'http://1.popye.sinaapp.com/phtml/rules.html'),
('馆藏布局', 'title1', '湖南理工学院图书馆馆藏布局'),
('馆藏布局', 'picurl1', 'http://1.popye.sinaapp.com/images/lib.png'),
('馆藏布局', 'url1', 'http://1.popye.sinaapp.com/phtml/lib.php');

-- --------------------------------------------------------

--
-- 表的结构 `libQuestion`
--

CREATE TABLE IF NOT EXISTS `libQuestion` (
  `serial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person` varchar(128) NOT NULL,
  `ptime` datetime NOT NULL,
  `content` varchar(200) NOT NULL,
  `qtype` varchar(4) DEFAULT NULL,
  `isChecked` tinyint(1) DEFAULT NULL,
  `isSolve` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `libQuestion`
--

INSERT INTO `libQuestion` (`serial`, `person`, `ptime`, `content`, `qtype`, `isChecked`, `isSolve`) VALUES
(1, 'oCNJ-t6bidQeR82a-sFo-kATjPi8', '2014-05-18 00:38:43', '开馆时间', '', 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `libReply`
--

CREATE TABLE IF NOT EXISTS `libReply` (
  `serial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `person` varchar(128) NOT NULL,
  `libQid` int(11) NOT NULL,
  `atime` datetime NOT NULL,
  `content` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `libReply`
--

INSERT INTO `libReply` (`serial`, `person`, `libQid`, `atime`, `content`) VALUES
(1, 'oCNJ-t5zalhEaViWriDoo3bl6KHo', 1, '2014-05-18 11:37:23', '请在微信对话框中回复  kgsj  获取。'),
(2, 'oCNJ-t6bidQeR82a-sFo-kATjPi8', 1, '2014-05-18 19:15:37', 'kgsj'),
(3, 'oCNJ-t6bidQeR82a-sFo-kATjPi8', 1, '2014-05-18 19:16:06', 'kgsj'),
(4, 'oCNJ-t6bidQeR82a-sFo-kATjPi8', 1, '2014-05-21 12:48:53', '123+321=?');

-- --------------------------------------------------------

--
-- 表的结构 `LIBSYS_READER`
--

CREATE TABLE IF NOT EXISTS `LIBSYS_READER` (
  `CERT_ID` bigint(11) DEFAULT NULL,
  `ID_CARD` varchar(10) DEFAULT NULL,
  `NAME` varchar(9) DEFAULT NULL,
  `SEX` varchar(1) DEFAULT NULL,
  `BIRTHDAY` varchar(10) DEFAULT NULL,
  `DEPT` varchar(27) DEFAULT NULL,
  `OCCUPATION` varchar(10) DEFAULT NULL,
  `DUTY` varchar(10) DEFAULT NULL,
  `POSITION` varchar(10) DEFAULT NULL,
  `ADDRESS` varchar(29) DEFAULT NULL,
  `TELE` bigint(12) DEFAULT NULL,
  `POSTCODE` int(6) DEFAULT NULL,
  `EMAIL` varchar(17) DEFAULT NULL,
  `TOTAL_LEND_QTY` int(3) DEFAULT NULL,
  `YEAR_LEND_QTY` int(3) DEFAULT NULL,
  `VOLT_FLAG` int(1) DEFAULT NULL,
  `DEBT_FLAG` int(1) DEFAULT NULL,
  `EDUCATION` varchar(10) DEFAULT NULL,
  `PASSWORD` varchar(32) DEFAULT NULL,
  `CODE01` varchar(12) DEFAULT NULL,
  `CODE02` varchar(10) DEFAULT NULL,
  `PORTRAIT` varchar(10) DEFAULT NULL,
  `REMARK` varchar(10) DEFAULT NULL,
  `REDR_REG_DAY` varchar(10) DEFAULT NULL,
  `REDR_DEL_DAY` varchar(10) DEFAULT NULL,
  `DEPOSIT` int(1) DEFAULT NULL,
  `REDR_FLAG` int(1) DEFAULT NULL,
  `REDR_TYPE_CODE` int(2) DEFAULT NULL,
  `LEND_GRD` int(2) DEFAULT NULL,
  `R_DEP_ID` varchar(10) DEFAULT NULL,
  `OBLIGATE` int(1) DEFAULT NULL,
  `MOBILE` bigint(13) DEFAULT NULL,
  `LIMIT_FLAG` int(1) DEFAULT NULL,
  `UNION_CIRC_FLAG` int(1) DEFAULT NULL,
  `CODE06` varchar(10) DEFAULT NULL,
  `CODE07` varchar(16) DEFAULT NULL,
  `CODE08` varchar(10) DEFAULT NULL,
  `PWD_CHECK_FLAG` int(1) DEFAULT NULL,
  `EMAIL_CHECK_FLAG` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `LIBSYS_READER`
--

INSERT INTO `LIBSYS_READER` (`CERT_ID`, `ID_CARD`, `NAME`, `SEX`, `BIRTHDAY`, `DEPT`, `OCCUPATION`, `DUTY`, `POSITION`, `ADDRESS`, `TELE`, `POSTCODE`, `EMAIL`, `TOTAL_LEND_QTY`, `YEAR_LEND_QTY`, `VOLT_FLAG`, `DEBT_FLAG`, `EDUCATION`, `PASSWORD`, `CODE01`, `CODE02`, `PORTRAIT`, `REMARK`, `REDR_REG_DAY`, `REDR_DEL_DAY`, `DEPOSIT`, `REDR_FLAG`, `REDR_TYPE_CODE`, `LEND_GRD`, `R_DEP_ID`, `OBLIGATE`, `MOBILE`, `LIMIT_FLAG`, `UNION_CIRC_FLAG`, `CODE06`, `CODE07`, `CODE08`, `PWD_CHECK_FLAG`, `EMAIL_CHECK_FLAG`) VALUES
(14113901080, NULL, '陈晖', 'F', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 4, 4, 0, 0, NULL, '52AA36F79A033F9D70D49185FFA52B81', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, NULL, 0, 0, NULL, 'MTQxMTM5MDEwODA', NULL, NULL, NULL),
(14113901091, NULL, '李富仁', 'M', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, '7918161613@qq.com', 60, 60, 0, 0, NULL, '84882C0986AA7DAAEF41FEDBD2E3700E', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, 15842816230, 0, 0, NULL, 'MTk3MjEx', NULL, 1, 0),
(14113901101, NULL, '刘旺', 'M', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 12, 12, 0, 3, NULL, '78FDD86DA725439A3F4EBF4A5E14F1E0', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, NULL, 0, 0, NULL, 'MTQxMTM5MDExMDE', NULL, NULL, NULL),
(14113901109, NULL, '王澎', 'M', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, '5B8C87F416AA1B8A2F6C37B99FE48362', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, NULL, 0, 0, NULL, 'MTQxMTM5MDExMDk', NULL, NULL, NULL),
(14113901120, NULL, '谢韬', 'M', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, 'E1A7934BEB37A750B44511DB9F3689DC', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, NULL, 0, 0, NULL, 'MTQxMTM5MDExMjA', NULL, NULL, NULL),
(14113901124, NULL, '许永彪', 'M', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, '314203766@qq.com', 42, 42, 0, 0, NULL, 'CE2677406F2918AF7A98D71AC7104049', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, 8613762096184, 0, 0, NULL, 'MTk5MjA0MDk', NULL, 1, 0),
(14113901139, NULL, '朱雪莉', 'F', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, 42, 0, 0, NULL, '24B32A1D0808D758BBFA22B96C41CC82', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, NULL, 0, 0, NULL, 'MTQxMTM5MDExMzk', NULL, NULL, NULL),
(14113902715, NULL, '李烨坤', 'M', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, NULL, '81D0CC830E4BED29614F7D371A07D7B1', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, NULL, 0, 0, NULL, 'MTQxMTM5MDI3MTU', NULL, NULL, NULL),
(14113903555, NULL, '黄宁宁', 'F', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 42, 42, 0, 0, NULL, '9311CB439354618EA2BCECF9D15C8B4D', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, NULL, 0, 0, NULL, 'NTUyMjk4OA', NULL, 1, NULL),
(14112101389, NULL, '段丹', 'F', NULL, '信息与通信工程学院', NULL, NULL, NULL, '3栋518', 136373047604, NULL, '294190384@qq.com', 104, 104, 0, 0, NULL, '5A1C62CA5426EFB7B9EA9953C8AA17C7', '自动11-1BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, 13637307604, 0, 0, NULL, 'MTMyNzQ5', NULL, 1, NULL),
(14112101405, NULL, '李康健', 'M', NULL, '信息与通信工程学院', NULL, NULL, NULL, NULL, NULL, NULL, '514742688@qq.com', 53, 53, 0, 0, NULL, '4DA77F28AFDD7EDD972CB049E56C7701', '自动11-1BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, 13637301584, 0, 0, NULL, 'MTk5MTEw', NULL, 1, 0),
(14113902786, NULL, '李超', 'M', NULL, '信息与通信工程学院', NULL, NULL, NULL, '湖南理工学院南院17栋', 15200311079, 414000, '979071224@qq.com', 17, 17, 0, 0, NULL, 'BBDF4282A1ED1357D6330BBDEACC328D', '信工11-2BF', NULL, NULL, NULL, '2011-10-10', NULL, 0, 1, 1, 1, NULL, 0, 15200311079, 0, 0, NULL, 'MTQxMTM5MDI3ODY', NULL, 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lib_user`
--

CREATE TABLE IF NOT EXISTS `lib_user` (
  `serial` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `open_id` varchar(128) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `stu_id` varchar(10) DEFAULT NULL,
  `sub_status` tinyint(1) DEFAULT NULL,
  `sub_time` datetime NOT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- 转存表中的数据 `lib_user`
--

INSERT INTO `lib_user` (`serial`, `open_id`, `status`, `stu_id`, `sub_status`, `sub_time`) VALUES
(1, 'oCNJ-t6bidQeR82a-sFo-kATjPi8', 1, '', 1, '2014-05-19 11:59:07'),
(3, 'oCNJ-t-UGCOLb8GQoiUYpbQyXHd8', 1, '', 1, '2014-05-19 19:47:21'),
(4, 'oSQl1ju7PyY5dvhK-I9hIufO4H_c', 1, '', 1, '2014-05-19 20:06:42'),
(5, 'oCNJ-t6ZbzeTa2ElbwedCUKL0TvI', 1, '', 1, '2014-05-19 21:06:55'),
(6, 'oCNJ-t5zalhEaViWriDoo3bl6KHo', 1, '', 1, '2014-05-19 22:21:22'),
(7, 'oSQl1jo5E9u_He1aRlU63fMC801c', 1, '', 1, '2014-05-20 15:54:50'),
(8, 'oSQl1jhIdUtKp55NlPo784Hq19Ns', 1, '', 1, '2014-05-20 21:36:40'),
(9, '', 1, '', 1, '2014-05-21 18:23:35'),
(10, 'oSQl1jgmnZcdCsAKcuBljszcjYac', 1, '', 1, '2014-05-21 19:09:25'),
(11, 'oSQl1jt_OIh7724zz80uM4FW6mX0', 1, '', 1, '2014-05-22 12:40:29'),
(12, 'oSQl1jtcU_AfB8XG9EeV9mWY0gOs', 1, '', 1, '2014-05-22 12:44:35'),
(13, 'oSQl1jqopVEubP2wVGtCwJfUPf20', 1, '', 1, '2014-05-22 23:48:21'),
(14, 'oSQl1jsWxQVCr8Hak2dCtpkCbe5M', 1, '', 1, '2014-05-23 09:44:29'),
(15, 'oSQl1jj9VnehpmMFvmALWCYyCQtM', 1, '', 1, '2014-05-24 11:19:07'),
(16, 'oSQl1jhSQWWEaKYRhjjVSwvFIIhY', 1, '', 1, '2014-05-25 16:29:09'),
(17, 'oSQl1jvqQh5SRnBZh2tjn_6NWLBs', 1, '', 1, '2014-05-27 00:46:05'),
(18, 'oSQl1joRsyYUsd783QecjUX9fVQU', 1, '', 1, '2014-05-27 01:35:58'),
(19, 'oSQl1jhGj66UxaOG98hA_0T-lDhw', 1, '', 1, '2014-05-27 10:32:25'),
(20, 'oSQl1jt9YuBg-jl1jLz5-TGEFQ_c', 1, '', 1, '2014-05-28 11:23:54'),
(21, 'oSQl1juXT45P4guTYLNUd9i4g5Ds', 1, '', 1, '2014-05-28 13:06:57'),
(22, 'oSQl1jnGmUTSG4f_ynsMHc30oV5Y', 1, '', 1, '2014-05-29 12:16:16'),
(23, 'oSQl1jsue9arYq8meMSkxgNf32hI', 1, '', 1, '2014-05-29 12:32:49'),
(24, 'oSQl1jstiHZcLhjb8KezLBftdPqk', 1, '', 1, '2014-05-29 23:05:35'),
(25, 'oSQl1jqEKtH02YtdPb-IX95lhJKU', 1, '', 1, '2014-05-29 23:48:22'),
(26, 'oSQl1jm57DP46O8ddCMg3RwGQKKM', 1, '', 1, '2014-05-29 23:48:33'),
(27, 'oCNJ-t3fM9zfXtpGzmRijP0_BNdM', 0, '', 1, '2014-06-10 18:54:15'),
(28, 'oCNJ-t3gnOqVV7SlyIFLb5l2A5sk', 0, '', 1, '2014-06-13 10:00:20');

-- --------------------------------------------------------

--
-- 表的结构 `response_text`
--

CREATE TABLE IF NOT EXISTS `response_text` (
  `cmd_id` int(10) NOT NULL AUTO_INCREMENT,
  `cmd_value` varchar(20) NOT NULL,
  `cmd_content` text NOT NULL,
  PRIMARY KEY (`cmd_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- 转存表中的数据 `response_text`
--

INSERT INTO `response_text` (`cmd_id`, `cmd_value`, `cmd_content`) VALUES
(1, '1', '回复关键词，快速掌握图书馆动态及常用信息。\r\n支持的关键词有:\r\n开馆时间或kgsj\r\n热线或rx\r\n馆藏布局或gcbj\r\n新闻或xw\r\n新书或xs\r\n展览或zl\r\n电子资源或dzzy\r\n讲座或jz\r\n培训或px\r\n教学或jx\r\n报告厅或bgt\r\n捐赠活动或jzhd\r\n借阅规则或jygz\r\n'),
(2, '?', ''),
(3, '？', ''),
(4, 'subscribe', ''),
(5, '2', '寻求馆际互借等图书馆一对一服务,<a href="http://popye.sinaapp.com/phtml/ptpServer.php?openid=%s">请点击此处</a>'),
(6, '3', '您好,此功能需要先绑定您的账号,请<a href = "http://popye.sinaapp.com/phtml/tie.html">点击绑定</a>'),
(7, '4', '您好,此功能需要先绑定您的账号,请<a href = "http://popye.sinaapp.com/phtml/tie.html">点击绑定</a>'),
(8, '5', '检阅书籍<a href=''http://1.popye.sinaapp.com/phtml/find.php'' >点击此处</a>'),
(9, '6', ''),
(10, '开馆时间', '校图书馆的开放时间为:\r\n周一至周日:8:00-22:00，\r\n各阅览室的开放时间稍有不同，\r\n详细请见<a href=''http://lib.hnist.cn/html/about/opentime.html''>图书馆开放时间</a>'),
(11, 'kgsj', '校图书馆的开放时间为:\r\n周一至周日:8:00-22:00，\r\n各阅览室的开放时间稍有不同，\r\n详细请见<a href=''http://lib.hnist.cn/html/about/opentime.html''>图书馆开放时间</a>'),
(12, '热线', '参考咨询:1234567890\r\n办　补证:1234567890\r\n离校手续:1234567890\r\n捐赠　　:1234567890\r\n联系参观:1234567890\r\n读者意见:1234567890\r\n失物招领:1234567890'),
(13, 'rx', '参考咨询:1234567890\r\n办　补证:1234567890\r\n离校手续:1234567890\r\n捐赠　　:1234567890\r\n联系参观:1234567890\r\n读者意见:1234567890\r\n失物招领:1234567890'),
(14, '馆藏布局', '东院图书馆楼层分布表：\r\n楼层	借阅处名称	馆藏书、刊类别	   \r\n6F	过期期刊阅览室	收藏1990年以后的期刊合订本，供阅览，不能外借	   \r\n5F	样本阅览室（Ⅰ）收藏哲学、法律、经济、政治类图书，供阅览，不能外借	   \r\n 	样本阅览室（Ⅱ）收藏艺术、文化教育、历史地理类图书，供阅览，不能外借	   \r\n 	图书馆行政办公室		   \r\n4F	样本阅览室（Ⅲ）收藏文学、语言类图书，供阅览，不能外借	   \r\n 	样本阅览室（Ⅳ)	收藏理工类图书，供阅览，不能外借	   \r\n 	艺术阅览室	收藏建筑、广告、艺术等类摄影集、画册、乐谱以及相关理论图书，供阅览，不能外借	   \r\n 	电子阅览室	提供网络资源检索服务	   \r\n3F	综合书库（Ⅰ）	收藏A类—J类图书，供外借	   \r\n 	综合书库（Ⅱ）	收藏K类—Z类图书，供外借	   \r\n 	外文书刊阅览室	收藏外文原版书、国内版影印外文图书、外文报刊等	   \r\n 	信息服务部	咨询、图书代购、打印复印、读者培训、文献传递	   \r\n 	书友会办公室	冷饮、点心、文具代购，光盘借还，书友会活动	   \r\n2F	现期期刊阅览室	收藏本学期以来的现期期刊、报纸，供阅览，不能外借	   \r\n 	文学书库（Ⅰ）	收藏文学类I247以前的图书，供外借	   \r\n 	文学书库（Ⅱ）	收藏文学类I247以后的图书，供外借	   \r\n 	总服务台	办理借还书手续，一卡通密码重置，图书遗失赔偿	   \r\n1F	门卫、学术报告厅、采编部		 \r\n南院图书馆楼层分布表：\r\n楼层	借阅处名称	馆藏书、刊类别	   \r\n2F	现期期刊阅览室	收藏本学期以来的现期期刊 供阅览，不能外借	   \r\n 	南湖社区办公室		   \r\n1F	外借书库	收藏A类—Z类各学科图书 供外借	   \r\n 	服务总台	办理借还书手续，图书遗失赔偿	 \r\n'),
(15, 'gcbj', '东院图书馆楼层分布表：\r\n楼层	借阅处名称	馆藏书、刊类别	   \r\n6F	过期期刊阅览室	收藏1990年以后的期刊合订本，供阅览，不能外借	   \r\n5F	样本阅览室（Ⅰ）收藏哲学、法律、经济、政治类图书，供阅览，不能外借	   \r\n 	样本阅览室（Ⅱ）收藏艺术、文化教育、历史地理类图书，供阅览，不能外借	   \r\n 	图书馆行政办公室		   \r\n4F	样本阅览室（Ⅲ）收藏文学、语言类图书，供阅览，不能外借	   \r\n 	样本阅览室（Ⅳ)	收藏理工类图书，供阅览，不能外借	   \r\n 	艺术阅览室	收藏建筑、广告、艺术等类摄影集、画册、乐谱以及相关理论图书，供阅览，不能外借	   \r\n 	电子阅览室	提供网络资源检索服务	   \r\n3F	综合书库（Ⅰ）	收藏A类—J类图书，供外借	   \r\n 	综合书库（Ⅱ）	收藏K类—Z类图书，供外借	   \r\n 	外文书刊阅览室	收藏外文原版书、国内版影印外文图书、外文报刊等	   \r\n 	信息服务部	咨询、图书代购、打印复印、读者培训、文献传递	   \r\n 	书友会办公室	冷饮、点心、文具代购，光盘借还，书友会活动	   \r\n2F	现期期刊阅览室	收藏本学期以来的现期期刊、报纸，供阅览，不能外借	   \r\n 	文学书库（Ⅰ）	收藏文学类I247以前的图书，供外借	   \r\n 	文学书库（Ⅱ）	收藏文学类I247以后的图书，供外借	   \r\n 	总服务台	办理借还书手续，一卡通密码重置，图书遗失赔偿	   \r\n1F	门卫、学术报告厅、采编部		 \r\n南院图书馆楼层分布表：\r\n楼层	借阅处名称	馆藏书、刊类别	   \r\n2F	现期期刊阅览室	收藏本学期以来的现期期刊 供阅览，不能外借	   \r\n 	南湖社区办公室		   \r\n1F	外借书库	收藏A类—Z类各学科图书 供外借	   \r\n 	服务总台	办理借还书手续，图书遗失赔偿	 \r\n'),
(16, '新闻', '新闻公告'),
(17, 'xw', '新闻公告'),
(18, '新书', '新书通告<a href=''http://1.popye.sinaapp.com/phtml/newbook.php''>点击此处</a>'),
(19, 'xs', '新书通告<a href=''http://1.popye.sinaapp.com/phtml/newbook.php''>点击此处</a>'),
(20, '借阅规则', ''),
(21, 'jygz', ''),
(22, '展览', ''),
(23, 'zl', ''),
(24, '电子资源', ''),
(25, 'dzzy', ''),
(26, '讲座', ''),
(27, 'jz', ''),
(28, '培训', ''),
(29, 'px', ''),
(30, '教学', ''),
(31, 'jx', ''),
(32, '报告厅', ''),
(33, 'bgt', ''),
(34, '捐赠活动', ''),
(35, 'jzhd', '');

-- --------------------------------------------------------

--
-- 表的结构 `variable`
--

CREATE TABLE IF NOT EXISTS `variable` (
  `var_name` varchar(20) NOT NULL,
  `var_content` text NOT NULL,
  PRIMARY KEY (`var_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `variable`
--

INSERT INTO `variable` (`var_name`, `var_content`) VALUES
('var_guanzhu', '我们为你服务\r\n定期发布资源活动信息\r\n互动式读书服务\r\n(1)获知图书馆常用信息\r\n(2)寻求馆际互借等图书馆一对一服务\r\n(3)登陆数字资源\r\n(4)馆藏借阅查询,当前借阅信息,续借,预借等\r\n(5)图书馆纸质图书查询\r\n(6)看看你身边的童鞋在读什么书'),
('var_goodbook', '好书推荐:\r\n搜罗经典好书,用心为您推荐各类别的好书。'),
('var_comment', '精彩书评:\r\n说说你对你精读或者略读过的书籍的看法。\r\n'),
('var_guanzhu_title', '五一假期之中,不出游的朋友呆在家中看看书,是个很悠闲的休息方式.'),
('var_guanzhu_end', '回复相应序号,获得相关服务,回复?返回主菜单.'),
('var_more_news', '<a href=''http://lib.hnist.cn/html/libnetnews/index.html''>更多</a>'),
('var_shuzi', '数字资源<a href = "http://popye.sinaapp.com/phtml/shuzi.php?openid=%s">点击登陆</a>');
