<?php
header("content-type:text/html;charset=utf8");
date_default_timezone_set("Asia/shanghai");
session_start();
define("ROOT",dirname(__FILE__));
set_include_path(".".PATH_SEPARATOR.ROOT."/core".PATH_SEPARATOR.ROOT."/lib".PATH_SEPARATOR.ROOT."/configs".PATH_SEPARATOR.ROOT."/teacher".PATH_SEPARATOR."/teacher/chapter_set".get_include_path());
require_once 'core/admin.inc.php';
require_once 'core/teacher.inc.php';
require_once 'core/student.inc.php';
require_once 'core/forum.inc.php';
require_once 'core/user.inc.php';
require_once 'core/course.inc.php';
require_once 'core/homework.inc.php';
require_once 'core/lab.inc.php';
require_once 'core/test.inc.php';
require_once 'core/userForum.inc.php';
require_once 'core/file.inc.php';
require_once 'lib/mysql.func.php';
require_once 'lib/common.func.php';
require_once 'lib/image.func.php';
require_once 'lib/page.func.php';
require_once 'configs/configs.php';
$link = connect();
