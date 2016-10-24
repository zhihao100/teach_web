-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-10-14 08:36:49
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `teach_web`
--

-- --------------------------------------------------------

--
-- 表的结构 `answer`
--

CREATE TABLE `answer` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `answer_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `answer_choice`
--

CREATE TABLE `answer_choice` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `choice_answer` varchar(124) DEFAULT NULL,
  `answer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `answer_gap`
--

CREATE TABLE `answer_gap` (
  `id` int(11) NOT NULL,
  `gap_answer1` varchar(256) DEFAULT NULL,
  `answer_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `answer_short`
--

CREATE TABLE `answer_short` (
  `id` int(11) NOT NULL,
  `answer_short` varchar(1024) NOT NULL,
  `R_image` varchar(256) NOT NULL,
  `image` varchar(1024) NOT NULL,
  `test_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `chapter`
--

CREATE TABLE `chapter` (
  `id` int(10) UNSIGNED NOT NULL,
  `ch_num` int(10) UNSIGNED NOT NULL COMMENT '章号',
  `ch_name` varchar(64) NOT NULL,
  `c_id` int(10) UNSIGNED NOT NULL COMMENT '课程ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `chapter`
--

INSERT INTO `chapter` (`id`, `ch_num`, `ch_name`, `c_id`) VALUES
(1, 1, '操作系统简介', 14),
(2, 2, '什么是Linux系统？', 14),
(3, 1, '数据结构', 1),
(4, 1, '基本概念', 40),
(5, 2, '物理层', 40),
(6, 3, '数据链路层', 40);

-- --------------------------------------------------------

--
-- 表的结构 `choice_bank`
--

CREATE TABLE `choice_bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(1024) NOT NULL,
  `option_A` varchar(512) NOT NULL,
  `option_B` varchar(512) NOT NULL,
  `option_C` varchar(512) NOT NULL,
  `option_D` varchar(512) NOT NULL,
  `answer` varchar(16) NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `ch_id` int(10) UNSIGNED NOT NULL,
  `t_time` datetime NOT NULL,
  `A_image` varchar(256) NOT NULL DEFAULT 'no image',
  `A_R_image` varchar(256) NOT NULL DEFAULT 'no image',
  `B_image` varchar(256) NOT NULL DEFAULT 'no image',
  `B_R_image` varchar(256) NOT NULL DEFAULT 'no image',
  `C_image` varchar(256) NOT NULL DEFAULT 'no image',
  `C_R_image` varchar(256) DEFAULT 'no image',
  `D_image` varchar(256) NOT NULL DEFAULT 'no image',
  `D_R_image` varchar(256) NOT NULL DEFAULT 'no image',
  `T_image` varchar(256) NOT NULL DEFAULT 'no image',
  `T_R_image` varchar(256) NOT NULL DEFAULT 'no image',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `choice_bank`
--

INSERT INTO `choice_bank` (`id`, `title`, `option_A`, `option_B`, `option_C`, `option_D`, `answer`, `course_id`, `ch_id`, `t_time`, `A_image`, `A_R_image`, `B_image`, `B_R_image`, `C_image`, `C_R_image`, `D_image`, `D_R_image`, `T_image`, `T_R_image`, `user_id`) VALUES
(1, '你对数据结构了解么？', ' 了解', '一般', '不关心', '不了解', 'A', 1, 3, '2016-05-22 11:48:53', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg', 18),
(2, '看下图找不同', '', '', '', '', 'D', 1, 3, '2016-05-22 12:41:39', '71632ff0a87ea91aa936bd90aa2315cb.jpg', '1.jpg', 'aaa8680d05d1da9deb97cada8f9eb1a0.jpg', '2.jpg', '15f5c7f3fdd8221bacdef5e2460d0f90.jpg', '3.jpg', '175f73d42bef5a94875e04fa873007b2.jpg', '4.jpg', '', '', 18),
(4, '一个栈的元素入栈序列为1、2、3、4，则不可能出现的出栈序列是_____', '4、3、2、1', '3、2、4、1', '1、4、2、3', '2、3、4、1', 'D', 1, 3, '2016-05-22 21:47:27', '', '', '', '', '', '', '', '', '', '', 18),
(5, '长度为3205的有序顺序表，若采用分块查找方法进行查找，为了提高顺序查找索引表和顺序查找某个块的查找效率，应将表分成_____块。', '5', '25', '121', '55', 'C', 1, 3, '2016-05-22 21:50:51', '', '', '', '', '', '', '', '', '', '', 18),
(6, '下列关于队列的叙述中,错误的是 ', '队列是一种先进先出的线性表 ', '队列是一种后进后出的线性表 ', '在链队列中进行入队操作时要判断队列是否为满 ', '循环队列中进行出队操作时要判断队列是否为空 ', 'D', 1, 3, '2016-05-22 22:04:01', '', '', '', '', '', '', '', '', '', '', 18),
(7, '散发', '是大法官 ', '是帝国时代', '省道高大上', '是tertiary', 'A', 14, 1, '2016-09-16 17:08:27', '', '', '', '', '', '', '', '', '0bc312a96352975a4b5a6072797e9163.jpg', '360软件小助手截图20140422104728.jpg', 18);

-- --------------------------------------------------------

--
-- 表的结构 `class`
--

CREATE TABLE `class` (
  `id` int(11) NOT NULL,
  `school` varchar(256) DEFAULT NULL,
  `department` varchar(32) DEFAULT NULL,
  `major` varchar(32) DEFAULT NULL,
  `class_num` int(2) NOT NULL COMMENT '班号',
  `grade` int(2) NOT NULL COMMENT '年级',
  `class_short` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `class`
--

INSERT INTO `class` (`id`, `school`, `department`, `major`, `class_num`, `grade`, `class_short`) VALUES
(11, '湖北工业大学', '理学院', '电子信息科学与技术', 1, 13, '13电科1'),
(13, '湖北工业大学', '理学院', '电子信息科学与技术', 2, 13, '13电科2'),
(14, '湖北工业大学', '理学院', '电子信息科学与技术', 3, 13, '13电科3'),
(15, '湖北工业大学', '理学院', '信息与计算科学', 1, 13, '13信计1');

-- --------------------------------------------------------

--
-- 表的结构 `course`
--

CREATE TABLE `course` (
  `id` int(10) UNSIGNED NOT NULL,
  `c_name` varchar(32) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '教师ID号',
  `c_info` text COMMENT '课程简介',
  `c_time` datetime NOT NULL,
  `classA` int(2) NOT NULL,
  `classB` int(2) NOT NULL,
  `classC` int(2) NOT NULL,
  `classD` int(2) NOT NULL,
  `classA_name` varchar(24) DEFAULT NULL,
  `classB_name` varchar(24) DEFAULT NULL,
  `classC_name` varchar(24) DEFAULT NULL,
  `classD_name` varchar(24) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `course`
--

INSERT INTO `course` (`id`, `c_name`, `user_id`, `c_info`, `c_time`, `classA`, `classB`, `classC`, `classD`, `classA_name`, `classB_name`, `classC_name`, `classD_name`) VALUES
(1, '数据结构', 18, '这是数据结构', '2016-03-26 19:47:40', 11, 13, 14, 1, '13电科1', '13电科2', '13电科3', ''),
(3, '操作系统', 19, NULL, '2016-03-24 17:53:34', 11, 1, 1, 1, '13电科1', '', '', ''),
(13, '操作系统', 20, NULL, '2016-03-26 19:48:28', 11, 11, 1, 1, '13电科1', '', '', ''),
(14, '操作系统', 18, '这是操作系统', '2016-03-26 19:51:10', 11, 11, 1, 1, '13电科1', '', '', ''),
(15, '汇编程序设计', 19, NULL, '2016-04-05 16:59:07', 11, 11, 1, 1, '13电科1', '', '', ''),
(40, '计算机网络', 18, '互联网+', '2016-09-03 21:24:55', 11, 13, 14, 0, '13电科1', '13电科2', '13电科3', ''),
(43, 'C语言程序设计', 18, '语言', '2016-10-14 13:02:17', 11, 13, 14, 0, '13电科1', '13电科2', '13电科3', '');

-- --------------------------------------------------------

--
-- 表的结构 `c_file`
--

CREATE TABLE `c_file` (
  `id` int(10) UNSIGNED NOT NULL,
  `f_r_name` varchar(128) NOT NULL,
  `f_name` varchar(64) NOT NULL COMMENT '唯一文件名',
  `f_type` varchar(16) NOT NULL,
  `f_size` varchar(16) NOT NULL,
  `sec_id` int(10) UNSIGNED NOT NULL COMMENT '节ID',
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '上传者ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `c_file`
--

INSERT INTO `c_file` (`id`, `f_r_name`, `f_name`, `f_type`, `f_size`, `sec_id`, `user_id`) VALUES
(2, '1.txt', '664cd2b7f14e8f020c639c8927997f6b.txt', 'text/plain', '2174', 1, 19),
(3, '360软件小助手截图20140422104728.jpg', '9fdb6dab5b3c1bb04572e673a0a1fc5c.jpg', 'image/jpeg', '67776', 2, 18),
(4, '酷狗写真03.jpg', 'd4a1d9c99792417a92063bf37a7cee08.jpg', 'image/jpeg', '125268', 2, 18),
(5, '酷狗写真01.jpg', 'fcd1c3677f4204c76332e42101fb5163.jpg', 'image/jpeg', '89873', 2, 18),
(6, 'Desert.jpg', '722a21ce2439396743cc135ac0075da6.jpg', 'image/jpeg', '845941', 2, 18),
(7, 'wwwf.mp4', '3822105d304b52b59d4929e2c76ea295.mp4', 'video/mp4', '1083494', 2, 18),
(8, 'Koala.jpg', 'dade01ebf62f107dd4a7541086338313.jpg', 'image/jpeg', '780831', 2, 18),
(9, 'Jellyfish.jpg', '366f6ad32fec69bd6532f4e5b2612bfe.jpg', 'image/jpeg', '758KB', 2, 18),
(10, 'w3cschoolPHP教程飞龙整理20141026.pdf', '1c9ed542025b5e2e539eb6dbffc98195.pdf', 'application/pdf', '2MB', 2, 18);

-- --------------------------------------------------------

--
-- 表的结构 `forumcontent`
--

CREATE TABLE `forumcontent` (
  `id` int(10) UNSIGNED NOT NULL,
  `sonmoduleId` int(11) NOT NULL COMMENT '发帖版块',
  `title` varchar(1024) NOT NULL,
  `content` text NOT NULL,
  `time` datetime NOT NULL,
  `userId` int(10) UNSIGNED NOT NULL COMMENT '发帖用户ID',
  `times` int(10) UNSIGNED NOT NULL DEFAULT '0' COMMENT '访问帖子次数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `forumcontent`
--

INSERT INTO `forumcontent` (`id`, `sonmoduleId`, `title`, `content`, `time`, `userId`, `times`) VALUES
(3, 1, 'ddfd', 'fsfsdfsfdsf', '2016-03-30 16:58:43', 18, 17),
(4, 1, '11', '12121', '2016-05-08 20:09:51', 18, 3);

-- --------------------------------------------------------

--
-- 表的结构 `forumfathermodule`
--

CREATE TABLE `forumfathermodule` (
  `id` int(10) UNSIGNED NOT NULL,
  `modulename` varchar(64) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `forumfathermodule`
--

INSERT INTO `forumfathermodule` (`id`, `modulename`) VALUES
(1, '操作系统'),
(2, '高等数学'),
(3, '信息与系统'),
(8, 'test'),
(7, '数据结构');

-- --------------------------------------------------------

--
-- 表的结构 `forumreply`
--

CREATE TABLE `forumreply` (
  `id` int(10) UNSIGNED NOT NULL,
  `contentId` int(10) UNSIGNED NOT NULL,
  `quoteId` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `contentreply` text NOT NULL,
  `replyuserId` int(10) UNSIGNED NOT NULL,
  `replytime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `forumreply`
--

INSERT INTO `forumreply` (`id`, `contentId`, `quoteId`, `contentreply`, `replyuserId`, `replytime`) VALUES
(1, 3, 0, 'hdehehf', 19, '2016-03-30 17:02:15');

-- --------------------------------------------------------

--
-- 表的结构 `forumsonmodule`
--

CREATE TABLE `forumsonmodule` (
  `id` int(10) UNSIGNED NOT NULL,
  `fathermoduleId` int(11) NOT NULL,
  `modulename` varchar(64) NOT NULL,
  `info` varchar(1024) DEFAULT NULL COMMENT '版块简介',
  `hostId` int(11) NOT NULL DEFAULT '0' COMMENT '版主'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `forumsonmodule`
--

INSERT INTO `forumsonmodule` (`id`, `fathermoduleId`, `modulename`, `info`, `hostId`) VALUES
(1, 1, 'Liunx系统', '这是关于Linux系统的讨论', 0),
(2, 2, '等价无穷小', '让我们在这里尽情的分享各自关于等价无穷小的知识吧!', 0),
(3, 1, '银行家算法', '银行家算法是个不错的算法哦！！', 0),
(9, 8, 'test', 'test', 0),
(5, 1, '文件管理系统', '文件管理系统是操作系统中很重要的一部分', 0),
(6, 3, '模拟信号与数字信号的区别', '什么事模拟信号？什么事数字信号？是我们学校信号与系统必须理解的重要概念。', 0),
(7, 7, '链表结构', '关于链表的问题', 0);

-- --------------------------------------------------------

--
-- 表的结构 `gap_bank`
--

CREATE TABLE `gap_bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `gap_title` text NOT NULL,
  `gap_answer` text NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `ch_id` int(10) UNSIGNED NOT NULL,
  `t_time` datetime NOT NULL,
  `Title_image` varchar(256) NOT NULL,
  `Title_R_image` varchar(256) NOT NULL,
  `Answer_image` varchar(256) NOT NULL,
  `Answer_R_image` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `gap_bank`
--

INSERT INTO `gap_bank` (`id`, `gap_title`, `gap_answer`, `course_id`, `ch_id`, `t_time`, `Title_image`, `Title_R_image`, `Answer_image`, `Answer_R_image`, `user_id`) VALUES
(1, '线性表有：_____，_____，_____，_____等', '顺序表 链表 队列 栈', 1, 3, '2016-05-22 11:52:13', '', '', '', '', 18),
(2, '计算下列题目：\r\n(1)1+1=_____;\r\n(2)1+2=_____;', '2\r\n3', 1, 3, '2016-05-22 12:43:44', 'e266a803205ba9ef0cfa301f819b42f6.jpg', '5.jpg', '', '', 18),
(3, '一个已head为头指针的带头节点的单链表，其仅有两个节点元素的条件是_____。', 'head->next->next->next==NULL', 1, 3, '2016-05-22 21:54:53', '', '', '', '', 18),
(4, '线性结构中，第一个节点_____前驱结点，其余每个结点有且只有_____个前驱结点，最后一个结点_____后继结点，其余每个结点总数为_____。', '无，一，无，一', 1, 3, '2016-05-22 21:58:51', '', '', '', '', 18),
(5, 'rebyreu', 'tej8ryo', 1, 3, '2016-05-23 17:06:02', '', '', '', '', 18);

-- --------------------------------------------------------

--
-- 表的结构 `lab`
--

CREATE TABLE `lab` (
  `id` int(10) UNSIGNED NOT NULL,
  `lab_num` int(10) UNSIGNED NOT NULL COMMENT '实验号',
  `lab_name` varchar(64) NOT NULL,
  `lab_obj` text NOT NULL,
  `lab_content` text NOT NULL,
  `c_id` int(10) UNSIGNED NOT NULL COMMENT '课程ID',
  `lab_time` datetime NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL COMMENT '上传者ID',
  `class_A` int(11) DEFAULT NULL,
  `class_B` int(11) DEFAULT NULL,
  `class_C` int(11) DEFAULT NULL,
  `class_D` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lab`
--

INSERT INTO `lab` (`id`, `lab_num`, `lab_name`, `lab_obj`, `lab_content`, `c_id`, `lab_time`, `user_id`, `class_A`, `class_B`, `class_C`, `class_D`) VALUES
(1, 1, '银行家算法', '基本了解银行家算法的基本思想', '在顺序表指定位置插入一个数据元素的过程：\nStep1将原来第i个位置上的元素至最后一个元素统统向后平移一位（假设顺序表在插入前没有满），这样做既可以保证被平移的这些元素之间和没被平移的元素之间的逻辑关系不被破坏（它们的物理位置仍相邻），同时又将第i个位置空出来；Step1将原来第i个位置上的元素至最后一个元素统统向后平移一位（假设顺序表在插入前没有满），这样做既可以保证被平移的这些元素之间和没被平移的元素之间的逻辑关系不被破坏（它们的物理位置仍相邻），同时又将第i个位置空出来；\nStep2 将待插入元素插入到第i个位置上；\nStep3    线性表长度加1。</p>\n	<p>在顺序表指定位置插入一个数据元素的过程：\nStep1将原来第i个位置上的元素至最后一个元素统统向后平移一位（假设顺序表在插入前没有满），这样做既可以保证被平移的这些元素之间和没被平移的元素之间的逻辑关系不被破坏（它们的物理位置仍相邻），同时又将第i个位置空出来；\nStep2 将待插入元素插入到第i个位置上；\nStep3    线性表长度加1。</p>\n	<p>在顺序表指定位置插入一个数据元素的过程：\nStep1将原来第i个位置上的元素至最后一个元素统统向后平移一位（假设顺序表在插入前没有满），这样做既可以保证被平移的这些元素之间和没被平移的元素之间的逻辑关系不被破坏（它们的物理位置仍相邻），同时又将第i个位置空出来；\nStep2 将待插入元素插入到第i个位置上；\nStep3    线性表长度加1。</p>', 3, '2016-05-08 14:56:34', 19, 11, 0, 0, 0),
(3, 1, '11', '111', '11111', 1, '2016-05-18 18:34:08', 18, 11, 13, 14, 0),
(4, 12, '滑过', ' 后端', ' 好', 1, '2016-05-20 18:34:45', 18, 11, 13, 14, 0),
(5, 3, 'b gjgj', 'd jrtuj', 'tru trku', 1, '2016-05-26 21:10:51', 18, 11, 13, 14, 0),
(8, 5, 'tyuruit', 'imyo', 'rtmoyuor6', 1, '2016-05-26 21:11:23', 18, 11, 13, 14, 0),
(23, 13, 'TREY', 'RETE', 'EYUETU', 1, '2016-09-16 16:42:32', 18, 11, 13, 14, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lab_answer`
--

CREATE TABLE `lab_answer` (
  `id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `lab_answer_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='学生实验答案总表';

--
-- 转存表中的数据 `lab_answer`
--

INSERT INTO `lab_answer` (`id`, `teacher_id`, `student_id`, `class_id`, `lab_id`, `course_id`, `lab_answer_time`) VALUES
(1, 18, 22, 13, 3, 1, '2016-10-08 21:36:56');

-- --------------------------------------------------------

--
-- 表的结构 `lab_file`
--

CREATE TABLE `lab_file` (
  `id` int(11) UNSIGNED NOT NULL,
  `lf_r_name` varchar(128) NOT NULL COMMENT '实验文件真实名',
  `lf_name` varchar(128) NOT NULL COMMENT '文件唯一名',
  `lf_type` varchar(16) NOT NULL,
  `lf_size` varchar(16) NOT NULL,
  `lab_id` int(11) NOT NULL,
  `lab_answer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lab_file`
--

INSERT INTO `lab_file` (`id`, `lf_r_name`, `lf_name`, `lf_type`, `lf_size`, `lab_id`, `lab_answer_id`) VALUES
(1, '行政区划.xls', 'db2b16b436cd7050d715ef24be6a8424.xls', 'application/vnd.', '2MB', 3, 1),
(2, '10.jpg', '3182c9c9581b71357d9505abd7baa80b.jpg', 'image/jpeg', '70KB', 3, 1);

-- --------------------------------------------------------

--
-- 表的结构 `lab_score`
--

CREATE TABLE `lab_score` (
  `id` int(10) UNSIGNED NOT NULL,
  `score` float UNSIGNED NOT NULL,
  `lab_id` int(10) UNSIGNED NOT NULL,
  `teacher_id` int(10) UNSIGNED NOT NULL,
  `student_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `lab_text`
--

CREATE TABLE `lab_text` (
  `id` int(11) NOT NULL,
  `lab_id` int(11) NOT NULL COMMENT '关联实验题目表',
  `lab_answer_id` int(11) NOT NULL COMMENT '关联实验答案表',
  `lt_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='学生实验文本表';

--
-- 转存表中的数据 `lab_text`
--

INSERT INTO `lab_text` (`id`, `lab_id`, `lab_answer_id`, `lt_text`) VALUES
(1, 3, 1, '什么福利等方面');

-- --------------------------------------------------------

--
-- 表的结构 `manager`
--

CREATE TABLE `manager` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `profession` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `manager`
--

INSERT INTO `manager` (`id`, `username`, `pwd`, `name`, `email`, `profession`) VALUES
(1, 'admin', 'admin', '刘治豪', '729951956@qq.com', '电子信息科学与技术'),
(8, 'xukankan', '111111', '许侃侃', '1095584555@qq.com', '13电科1'),
(9, '1311121213', '1311121213', '刘治豪', '1977306156@qq.com', '13电科2');

-- --------------------------------------------------------

--
-- 表的结构 `section`
--

CREATE TABLE `section` (
  `id` int(10) UNSIGNED NOT NULL,
  `sec_num` int(3) NOT NULL COMMENT '节号',
  `sec_name` varchar(64) NOT NULL,
  `ch_id` int(10) UNSIGNED NOT NULL COMMENT '章ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `section`
--

INSERT INTO `section` (`id`, `sec_num`, `sec_name`, `ch_id`) VALUES
(1, 1, '现在主要流行的操作系统有哪些?', 1),
(2, 1, '数据结构', 3),
(4, 1, '物理层的基本概念', 5);

-- --------------------------------------------------------

--
-- 表的结构 `short_bank`
--

CREATE TABLE `short_bank` (
  `id` int(10) UNSIGNED NOT NULL,
  `short_title` text NOT NULL,
  `short_answer` text NOT NULL,
  `course_id` int(10) UNSIGNED NOT NULL,
  `ch_id` int(10) UNSIGNED NOT NULL,
  `t_time` datetime NOT NULL,
  `Title_image` varchar(256) NOT NULL,
  `Title_R_image` varchar(256) NOT NULL,
  `Answer_R_image` varchar(256) NOT NULL,
  `Answer_image` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `short_bank`
--

INSERT INTO `short_bank` (`id`, `short_title`, `short_answer`, `course_id`, `ch_id`, `t_time`, `Title_image`, `Title_R_image`, `Answer_R_image`, `Answer_image`, `user_id`) VALUES
(1, '有如下程序：\r\n(1) p->next;\r\n(2)p->data;\r\n(3)p->next->piro;\r\n(4)p->nex = q->next;\r\n(5)p = p->next;', '(1) p->next;\r\n(2)p->data;\r\n(3)p->next->piro;\r\n(4)p->nex = q->next;\r\n(5)p = p->next;', 1, 3, '2016-05-22 11:54:44', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', '', 18),
(2, '阅读下列算法,并回答问题： \r\nvoid f30（SeqStack S）\r\n\r\n{ int k=0；\r\n\r\nCirQueue Q；\r\n\r\nSeqStack T；\r\n\r\nInitQueue（&Q）； //初始化队列Q\r\n\r\nInitStack（&T）； //初始化栈T\r\n\r\nwhile （!StackEmpty（&S））\r\n\r\n{ k++;\r\n\r\nif （k%2!=0） Push（&T, Pop（&S））;\r\n\r\nelse EnQueue（&Q, Pop（&S））;\r\n\r\n} //第一个循环\r\n\r\nwhile （!QueueEmpty（&Q）） //第二个循环\r\n\r\nPush（&S, DeQueue（&Q））;\r\n\r\nwhile（!StackEmpty（&T）） //第三个循环\r\n\r\nPush（&S,Pop（&T））；\r\n\r\n}\r\n\r\n设栈S=（1,2,3,4,5,6,7）,其中7为栈顶元素。调用函数f30（S）后,\r\n\r\n（1）第一个循环结束后,栈T和队列Q中的内容各是什么？\r\n\r\n（2）第三个循环语句结束后,栈S中的内容是什么？ ', '答案后期会发给大家', 1, 3, '2016-05-22 22:05:03', '', '', '', '', 18);

-- --------------------------------------------------------

--
-- 表的结构 `test`
--

CREATE TABLE `test` (
  `id` int(10) UNSIGNED NOT NULL,
  `test_title` varchar(1024) NOT NULL,
  `choice_num` int(10) UNSIGNED NOT NULL COMMENT '选择题数量',
  `gap_num` int(10) UNSIGNED NOT NULL COMMENT '填空题数量',
  `short_num` int(10) UNSIGNED NOT NULL COMMENT '简答题数量',
  `course_id` int(10) UNSIGNED NOT NULL,
  `ch_id` int(10) UNSIGNED NOT NULL,
  `t_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `class_A` int(11) NOT NULL,
  `class_B` int(11) NOT NULL,
  `class_C` int(11) NOT NULL,
  `class_D` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `test`
--

INSERT INTO `test` (`id`, `test_title`, `choice_num`, `gap_num`, `short_num`, `course_id`, `ch_id`, `t_time`, `user_id`, `class_A`, `class_B`, `class_C`, `class_D`) VALUES
(2, 'rrttoo', 2, 1, 1, 1, 3, '2016-09-04 16:02:33', 18, 11, 13, 14, 1),
(3, '0916', 1, 1, 1, 1, 3, '2016-09-16 15:54:52', 18, 11, 13, 14, 1);

-- --------------------------------------------------------

--
-- 表的结构 `test_choice`
--

CREATE TABLE `test_choice` (
  `id` int(10) UNSIGNED NOT NULL,
  `question` text NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `A` varchar(1024) NOT NULL,
  `B` varchar(1024) NOT NULL,
  `C` varchar(1024) NOT NULL,
  `D` varchar(1024) NOT NULL,
  `answer` varchar(16) NOT NULL,
  `A_image` varchar(256) DEFAULT 'no image',
  `A_R_image` varchar(256) DEFAULT 'no image',
  `B_image` varchar(256) DEFAULT 'no image',
  `B_R_image` varchar(256) DEFAULT 'no image',
  `C_image` varchar(256) DEFAULT 'no image',
  `C_R_image` varchar(256) DEFAULT 'no image',
  `D_image` varchar(256) DEFAULT 'no image',
  `D_R_image` varchar(256) DEFAULT 'no image',
  `T_image` varchar(256) DEFAULT 'no image',
  `T_R_image` varchar(256) DEFAULT 'no image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `test_choice`
--

INSERT INTO `test_choice` (`id`, `question`, `test_id`, `A`, `B`, `C`, `D`, `answer`, `A_image`, `A_R_image`, `B_image`, `B_R_image`, `C_image`, `C_R_image`, `D_image`, `D_R_image`, `T_image`, `T_R_image`) VALUES
(3, '你对数据结构了解么？', 11, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg'),
(4, '看下图找不同', 12, '', '', '', '', 'D', '71632ff0a87ea91aa936bd90aa2315cb.jpg', '1.jpg', 'aaa8680d05d1da9deb97cada8f9eb1a0.jpg', '2.jpg', '15f5c7f3fdd8221bacdef5e2460d0f90.jpg', '3.jpg', '175f73d42bef5a94875e04fa873007b2.jpg', '4.jpg', '', ''),
(5, '你对数据结构了解么？', 13, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg'),
(6, '你对数据结构了解么？', 14, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg'),
(7, '看下图找不同', 14, '', '', '', '', 'D', '71632ff0a87ea91aa936bd90aa2315cb.jpg', '1.jpg', 'aaa8680d05d1da9deb97cada8f9eb1a0.jpg', '2.jpg', '15f5c7f3fdd8221bacdef5e2460d0f90.jpg', '3.jpg', '175f73d42bef5a94875e04fa873007b2.jpg', '4.jpg', '', ''),
(8, '1+1=？', 14, '1', '2', '4', '3', 'B', '', '', '', '', '', '', '', '', '', ''),
(9, '一个栈的元素入栈序列为1、2、3、4，则不可能出现的出栈序列是_____', 14, '4、3、2、1', '3、2、4、1', '1、4、2、3', '2、3、4、1', 'D', '', '', '', '', '', '', '', '', '', ''),
(10, '长度为3205的有序顺序表，若采用分块查找方法进行查找，为了提高顺序查找索引表和顺序查找某个块的查找效率，应将表分成_____块。', 14, '5', '25', '121', '55', 'C', '', '', '', '', '', '', '', '', '', ''),
(11, '下列关于队列的叙述中,错误的是 ', 14, '队列是一种先进先出的线性表 ', '队列是一种后进后出的线性表 ', '在链队列中进行入队操作时要判断队列是否为满 ', '循环队列中进行出队操作时要判断队列是否为空 ', 'D', '', '', '', '', '', '', '', '', '', ''),
(15, '你对数据结构了解么？', 18, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg'),
(16, '你对数据结构了解么？', 19, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg'),
(18, '你对数据结构了解么？', 21, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg'),
(19, '你对数据结构了解么？', 22, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg'),
(20, '看下图找不同', 23, '', '', '', '', 'D', '71632ff0a87ea91aa936bd90aa2315cb.jpg', '1.jpg', 'aaa8680d05d1da9deb97cada8f9eb1a0.jpg', '2.jpg', '15f5c7f3fdd8221bacdef5e2460d0f90.jpg', '3.jpg', '175f73d42bef5a94875e04fa873007b2.jpg', '4.jpg', '', ''),
(21, '一个栈的元素入栈序列为1、2、3、4，则不可能出现的出栈序列是_____', 24, '4、3、2、1', '3、2、4、1', '1、4、2、3', '2、3、4、1', 'D', '', '', '', '', '', '', '', '', '', ''),
(22, '你对数据结构了解么？', 25, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg'),
(24, '长度为3205的有序顺序表，若采用分块查找方法进行查找，为了提高顺序查找索引表和顺序查找某个块的查找效率，应将表分成_____块。', 2, '5', '25', '121', '55', 'C', '', '', '', '', '', '', '', '', '', ''),
(25, '下列关于队列的叙述中,错误的是 ', 2, '队列是一种先进先出的线性表 ', '队列是一种后进后出的线性表 ', '在链队列中进行入队操作时要判断队列是否为满 ', '循环队列中进行出队操作时要判断队列是否为空 ', 'D', '', '', '', '', '', '', '', '', '', ''),
(26, '你对数据结构了解么？', 3, ' 了解', '一般', '不关心', '不了解', 'A', '', '', '', '', '', '', '', '', '4d315a5b5e95bdc2907f97b24cdd32c7.jpg', '1.jpg');

-- --------------------------------------------------------

--
-- 表的结构 `test_gap`
--

CREATE TABLE `test_gap` (
  `id` int(10) UNSIGNED NOT NULL,
  `gap_question` text NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `title_image` varchar(256) DEFAULT 'no image',
  `title_r_image` varchar(256) DEFAULT 'no image',
  `answer_image` varchar(256) DEFAULT 'no image',
  `answer_r_image` varchar(256) DEFAULT 'no image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `test_gap`
--

INSERT INTO `test_gap` (`id`, `gap_question`, `test_id`, `answer`, `title_image`, `title_r_image`, `answer_image`, `answer_r_image`) VALUES
(2, '线性表有：_____，_____，_____，_____等', 11, '顺序表 链表 队列 栈', '', '', '', ''),
(3, '计算下列题目：<br />\r\n(1)1+1=_____;<br />\r\n(2)1+2=_____;', 12, '2<br />\r\n3', 'e266a803205ba9ef0cfa301f819b42f6.jpg', '5.jpg', '', ''),
(4, '计算下列题目：<br />\r\n(1)1+1=_____;<br />\r\n(2)1+2=_____;', 13, '2<br />\r\n3', 'e266a803205ba9ef0cfa301f819b42f6.jpg', '5.jpg', '', ''),
(5, '线性表有：_____，_____，_____，_____等', 14, '顺序表 链表 队列 栈', '', '', '', ''),
(6, '计算下列题目：<br />\r\n(1)1+1=_____;<br />\r\n(2)1+2=_____;', 14, '2<br />\r\n3', 'e266a803205ba9ef0cfa301f819b42f6.jpg', '5.jpg', '', ''),
(7, '一个已head为头指针的带头节点的单链表，其仅有两个节点元素的条件是_____。', 14, 'head-&gt;next-&gt;next-&gt;next==NULL', '', '', '', ''),
(8, '线性结构中，第一个节点_____前驱结点，其余每个结点有且只有_____个前驱结点，最后一个结点_____后继结点，其余每个结点总数为_____。', 14, '无，一，无，一', '', '', '', ''),
(12, '线性表有：_____，_____，_____，_____等', 18, '顺序表 链表 队列 栈', '', '', '', ''),
(13, '线性表有：_____，_____，_____，_____等', 19, '顺序表 链表 队列 栈', '', '', '', ''),
(15, '线性表有：_____，_____，_____，_____等', 21, '顺序表 链表 队列 栈', '', '', '', ''),
(16, '线性表有：_____，_____，_____，_____等', 22, '顺序表 链表 队列 栈', '', '', '', ''),
(17, '计算下列题目：<br />\r\n(1)1+1=_____;<br />\r\n(2)1+2=_____;', 23, '2<br />\r\n3', 'e266a803205ba9ef0cfa301f819b42f6.jpg', '5.jpg', '', ''),
(18, '一个已head为头指针的带头节点的单链表，其仅有两个节点元素的条件是_____。', 24, 'head-&gt;next-&gt;next-&gt;next==NULL', '', '', '', ''),
(19, '线性表有：_____，_____，_____，_____等', 25, '顺序表 链表 队列 栈', '', '', '', ''),
(21, '一个已head为头指针的带头节点的单链表，其仅有两个节点元素的条件是_____。', 2, 'head-&gt;next-&gt;next-&gt;next==NULL', '', '', '', ''),
(22, '计算下列题目：<br />\r\n(1)1+1=_____;<br />\r\n(2)1+2=_____;', 3, '2<br />\r\n3', 'e266a803205ba9ef0cfa301f819b42f6.jpg', '5.jpg', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `test_score`
--

CREATE TABLE `test_score` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `test_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `test_short`
--

CREATE TABLE `test_short` (
  `id` int(10) UNSIGNED NOT NULL,
  `short_question` text NOT NULL,
  `test_id` int(10) UNSIGNED NOT NULL,
  `answer` text NOT NULL,
  `title_image` varchar(256) DEFAULT 'no image',
  `title_r_image` varchar(256) DEFAULT 'no image',
  `answer_image` varchar(256) DEFAULT 'no image',
  `answer_r_image` varchar(256) DEFAULT 'no image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `test_short`
--

INSERT INTO `test_short` (`id`, `short_question`, `test_id`, `answer`, `title_image`, `title_r_image`, `answer_image`, `answer_r_image`) VALUES
(2, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 11, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(3, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 12, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(4, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 13, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(5, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 14, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(6, '阅读下列算法,并回答问题： <br />\r\nvoid f30（SeqStack S）<br />\r\n<br />\r\n{ int k=0；<br />\r\n<br />\r\nCirQueue Q；<br />\r\n<br />\r\nSeqStack T；<br />\r\n<br />\r\nInitQueue（&amp;Q）； //初始化队列Q<br />\r\n<br />\r\nInitStack（&amp;T）； //初始化栈T<br />\r\n<br />\r\nwhile （!StackEmpty（&amp;S））<br />\r\n<br />\r\n{ k++;<br />\r\n<br />\r\nif （k%2!=0） Push（&amp;T, Pop（&amp;S））;<br />\r\n<br />\r\nelse EnQueue（&amp;Q, Pop（&amp;S））;<br />\r\n<br />\r\n} //第一个循环<br />\r\n<br />\r\nwhile （!QueueEmpty（&amp;Q）） //第二个循环<br />\r\n<br />\r\nPush（&amp;S, DeQueue（&amp;Q））;<br />\r\n<br />\r\nwhile（!StackEmpty（&amp;T）） //第三个循环<br />\r\n<br />\r\nPush（&amp;S,Pop（&amp;T））；<br />\r\n<br />\r\n}<br />\r\n<br />\r\n设栈S=（1,2,3,4,5,6,7）,其中7为栈顶元素。调用函数f30（S）后,<br />\r\n<br />\r\n（1）第一个循环结束后,栈T和队列Q中的内容各是什么？<br />\r\n<br />\r\n（2）第三个循环语句结束后,栈S中的内容是什么？ ', 14, '答案在网上', '', '', '', ''),
(10, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 18, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(11, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 19, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(13, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 21, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(14, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 22, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(15, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 23, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(16, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 24, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(17, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 25, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(19, '有如下程序：<br />\r\n(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', 2, '(1) p-&gt;next;<br />\r\n(2)p-&gt;data;<br />\r\n(3)p-&gt;next-&gt;piro;<br />\r\n(4)p-&gt;nex = q-&gt;next;<br />\r\n(5)p = p-&gt;next;', '60c069c978d1ad902c6734924807b8be.jpg', '2.jpg', '', ''),
(20, '阅读下列算法,并回答问题： <br />\r\nvoid f30（SeqStack S）<br />\r\n<br />\r\n{ int k=0；<br />\r\n<br />\r\nCirQueue Q；<br />\r\n<br />\r\nSeqStack T；<br />\r\n<br />\r\nInitQueue（&amp;Q）； //初始化队列Q<br />\r\n<br />\r\nInitStack（&amp;T）； //初始化栈T<br />\r\n<br />\r\nwhile （!StackEmpty（&amp;S））<br />\r\n<br />\r\n{ k++;<br />\r\n<br />\r\nif （k%2!=0） Push（&amp;T, Pop（&amp;S））;<br />\r\n<br />\r\nelse EnQueue（&amp;Q, Pop（&amp;S））;<br />\r\n<br />\r\n} //第一个循环<br />\r\n<br />\r\nwhile （!QueueEmpty（&amp;Q）） //第二个循环<br />\r\n<br />\r\nPush（&amp;S, DeQueue（&amp;Q））;<br />\r\n<br />\r\nwhile（!StackEmpty（&amp;T）） //第三个循环<br />\r\n<br />\r\nPush（&amp;S,Pop（&amp;T））；<br />\r\n<br />\r\n}<br />\r\n<br />\r\n设栈S=（1,2,3,4,5,6,7）,其中7为栈顶元素。调用函数f30（S）后,<br />\r\n<br />\r\n（1）第一个循环结束后,栈T和队列Q中的内容各是什么？<br />\r\n<br />\r\n（2）第三个循环语句结束后,栈S中的内容是什么？ ', 3, '答案后期会发给大家', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(32) NOT NULL,
  `pwd` varchar(64) NOT NULL,
  `name` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `class_short` varchar(255) DEFAULT NULL COMMENT '学生的是班级，老师的是院系',
  `face` varchar(255) NOT NULL DEFAULT '0',
  `identified` tinyint(3) UNSIGNED NOT NULL COMMENT '身份判断1表示学生，2表示老师',
  `jointime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `user`
--

INSERT INTO `user` (`id`, `username`, `pwd`, `name`, `email`, `class_short`, `face`, `identified`, `jointime`) VALUES
(6, '1311121216', '96e79218965eb72c92a549dd5a330112', '聂聪', '729951956@qq.com', '13电科1', '4.jpg', 1, '2016-02-23 16:16:02'),
(9, 'kingzhu', '96e79218965eb72c92a549dd5a330112', '朱时锐', '123456@qq.com', '13电科1', '7.jpg', 1, '2016-02-27 19:18:32'),
(18, 'admin', '96e79218965eb72c92a549dd5a330112', '刘治豪', '729951956@qq.com', '13电科1', '16.jpg', 2, '2016-03-24 19:28:31'),
(19, 'king', '96e79218965eb72c92a549dd5a330112', 'king', '729951956@qq.com', '13电科1', '13.jpg', 2, '2016-03-26 18:25:48'),
(20, 'queen', '96e79218965eb72c92a549dd5a330112', 'queen', '729951956@qq.com', '13电科1', '20.jpg', 2, '2016-03-26 19:22:17'),
(22, '1311121213', 'd49be3a405d2049d99eecc8e8d28852c', '刘治豪', '1977306156@qq.com', '13电科2', '4.jpg', 1, '2016-06-12 22:22:45'),
(27, '123', '202cb962ac59075b964b07152d234b70', 'refe', '123@qq.com', '13电科2', '4.jpg', 1, '2016-09-16 13:35:14'),
(28, '23', '202cb962ac59075b964b07152d234b70', '4r4w', '234@qq.vfd', 'rewt', '8.jpg', 2, '2016-09-16 13:49:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answer`
--
ALTER TABLE `answer`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indexes for table `answer_choice`
--
ALTER TABLE `answer_choice`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indexes for table `answer_gap`
--
ALTER TABLE `answer_gap`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indexes for table `answer_short`
--
ALTER TABLE `answer_short`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indexes for table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choice_bank`
--
ALTER TABLE `choice_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `c_file`
--
ALTER TABLE `c_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forumcontent`
--
ALTER TABLE `forumcontent`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forumfathermodule`
--
ALTER TABLE `forumfathermodule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modulename` (`modulename`);

--
-- Indexes for table `forumreply`
--
ALTER TABLE `forumreply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forumsonmodule`
--
ALTER TABLE `forumsonmodule`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `modulename` (`modulename`);

--
-- Indexes for table `gap_bank`
--
ALTER TABLE `gap_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab`
--
ALTER TABLE `lab`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_answer`
--
ALTER TABLE `lab_answer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_file`
--
ALTER TABLE `lab_file`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_score`
--
ALTER TABLE `lab_score`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lab_text`
--
ALTER TABLE `lab_text`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `short_bank`
--
ALTER TABLE `short_bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_choice`
--
ALTER TABLE `test_choice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_gap`
--
ALTER TABLE `test_gap`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `test_score`
--
ALTER TABLE `test_score`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_id` (`id`);

--
-- Indexes for table `test_short`
--
ALTER TABLE `test_short`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `answer`
--
ALTER TABLE `answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `answer_choice`
--
ALTER TABLE `answer_choice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `answer_gap`
--
ALTER TABLE `answer_gap`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `answer_short`
--
ALTER TABLE `answer_short`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `chapter`
--
ALTER TABLE `chapter`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `choice_bank`
--
ALTER TABLE `choice_bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- 使用表AUTO_INCREMENT `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- 使用表AUTO_INCREMENT `course`
--
ALTER TABLE `course`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- 使用表AUTO_INCREMENT `c_file`
--
ALTER TABLE `c_file`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `forumcontent`
--
ALTER TABLE `forumcontent`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `forumfathermodule`
--
ALTER TABLE `forumfathermodule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `forumreply`
--
ALTER TABLE `forumreply`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `forumsonmodule`
--
ALTER TABLE `forumsonmodule`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `gap_bank`
--
ALTER TABLE `gap_bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `lab`
--
ALTER TABLE `lab`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- 使用表AUTO_INCREMENT `lab_answer`
--
ALTER TABLE `lab_answer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `lab_file`
--
ALTER TABLE `lab_file`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `lab_score`
--
ALTER TABLE `lab_score`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `lab_text`
--
ALTER TABLE `lab_text`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- 使用表AUTO_INCREMENT `section`
--
ALTER TABLE `section`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- 使用表AUTO_INCREMENT `short_bank`
--
ALTER TABLE `short_bank`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `test`
--
ALTER TABLE `test`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `test_choice`
--
ALTER TABLE `test_choice`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- 使用表AUTO_INCREMENT `test_gap`
--
ALTER TABLE `test_gap`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- 使用表AUTO_INCREMENT `test_score`
--
ALTER TABLE `test_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `test_short`
--
ALTER TABLE `test_short`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- 使用表AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
