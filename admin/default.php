<?php 
include_once '../include.php';
checkLogined();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理员页面</title>
	<link rel="stylesheet" type="text/css" href="CSS/index1.css" />
<script  type="text/javascript" language="javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".menu-box").mouseover(function()
			{
				$(this).next("ul.menu-list").slideToggle(300).siblings("ul.menu-list").slideUp("slow");
				$(".box>.menu-list").not($(this).next(".menu-list")).slideUp("slow");
			});
    });
</script>
</head>
<body>
<!-- header-wrap start -->
<div class="header-wrap">
	<div class="logo"><h2>管理员平台</h2></div>
    <div class="user">
    	<ul>
        	<li>欢迎你:<a href=""><?php echo $_SESSION['adminName']?></a></li>
            <li><a href="doActionAdmin.php?act=logoutAdmin">[退出]</a></li>
        </ul>
    </div>
</div>
<!-- header-wrap end -->
<!-- side-bar-wrap start -->
<div class="side-bar-wrap">
	<ul>
    	<li class="box">
        	<span class="menu-box">管理员管理</span>
        	<ul class="menu-list" style="display:none;">
            	<li><a href="addAdmin.php" target="mainframe">添加管理员</a></li>
                <li><a href="listAdmin.php" target="mainframe">查看管理员</a></li>
       		</ul>
        </li>
		<li class="box">
			<span class="menu-box">班级管理</span>
			<ul class="menu-list" style="display:none;">
				<li><a href="addClass.php" target="mainframe">添加班级</a></li>
				<li><a href="listClass.php" target="mainframe">查看班级</a></li>
			</ul>
		</li>
        <li class="box">
        	<span class="menu-box">教师管理</span>
        	<ul class="menu-list" style="display:none;">
            	<li><a href="addTeacher.php" target="mainframe">添加教师</a></li>
                <li><a href="listTeacher.php" target="mainframe">查看教师</a></li>
        	</ul>
        </li>
        <li class="box">
        	<span class="menu-box">学生管理</span>
        	<ul class="menu-list" style="display:none;">
            	<li><a href="addStudent.php" target="mainframe">添加学生</a></li>
                <li><a href="listStudent.php" target="mainframe">查看学生</a></li>
            </ul>
        </li>
        <li class="box0"><a href="#">文件管理</a></li>
        <li class="box">
        	<span class="menu-box">课程管理</span>
        	<ul class="menu-list" style="display:none;">
            	<li><a href="addCourse.php" target="mainframe">添加课程</a></li>
                <li><a href="listCourse.php" target="mainframe">查看课程</a></li>
        	</ul>
        </li>
         <li class="box">
        	<span class="menu-box">论坛管理</span>
        	<ul  class="menu-list" style="display:none;">
            	<li><a href="addFatherModule.php" target="mainframe">添加父板块信息</a></li>
                <li><a href="listFatherModule.php" target="mainframe">查看父板块信息</a></li>
                <li><a href="addSonModule.php" target="mainframe">添加子板块信息</a></li>
                <li><a href="listSonModule.php" target="mainframe">查看子板块信息</a></li>
                <li><a href="#">帖子管理</a></li>
            </ul>
        </li>
    </ul>
</div>
<!-- side-bar-wrap end -->
<!-- content-wrap start -->
<div class="content-wrap">
    <div class="iframe"><iframe name="mainframe"></iframe></div>
</div>
<!-- content-wrap end -->
</body>
</html>
