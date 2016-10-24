<?php 
include_once '../include.php';
checkTeacherLogined();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>教师管理界面</title>
<link rel="stylesheet" type="text/css" href="CSS/index.css" />
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
<!-- 头部信息区 -->
<!-- header-wrap start -->
<div class="header-wrap">
	<div class="info"><h2>教师平台</h2></div>
    <div class="user-info">
    	<ul>
        	<li>欢迎你：<?php echo $_SESSION['userName'];?></li>
            <li class="bk"><a href="doTeacherAction.php?act=logout">[退出]</a></li>
        </ul>
    </div>
</div>
<!-- header-wrap end -->
<!-- side-bar-wrap start -->
<div class="side-bar-wrap">
	<ul>
    	<li class="box0"><a href="fileUpload.php" target="mainframe">文件上传</a></li>
        <li class="box">
        	<span class="menu-box">作业布置</span>
        <ul class="menu-list" style="display:none;">
            	<li><a href="set_Homework.php" target="mainframe">作业部分</a></li>
                <li><a href="setLabor.php" target="mainframe">实验部分</a></li>
        </ul>
        </li>
            <li class="box">
        	<span class="menu-box">作业批改</span>
        	<ul class="menu-list" style="display:none;">
            	<li><a href="doHomework.php" target="mainframe">作业部分</li>
                <li><a href="dolabor.php" target="mainframe">实验部分</li>
            </ul>
        </li>
        <li class="box0"><a href="chapter_set.php" target="mainframe">章节设置</a></li>
        <li class="box">
            <span class="menu-box">成绩查询</span>
            <ul class="menu-list" style="display:none;">
                <li><a href="Homework_score.php" target="mainframe">作业成绩</a></li>
                <li><a href="setLabor.php" target="mainframe">实验成绩</a></li>
            </ul>
        </li>
        <li class="box">
        	<span class="menu-box">题库录入</span>
        	<ul  class="menu-list" style="display:none;">
            	<li><a href="question_bank.php" target="mainframe">录入</li>
                <li><a href="showQuestions.php" target="mainframe">显示</li>
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
