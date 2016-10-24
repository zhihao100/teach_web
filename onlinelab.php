<?php
/**
 * Created by PhpStorm.
 * User: 新乐
 * Date: 2016/9/16
 * Time: 19:08
 */
require_once 'include.php';
$data_name=@$_SESSION['userName'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>在线实验</title>
    <link rel="stylesheet" type="text/css" href="CSS/onlinelab.css">
</head>
<body>
<div class="header">
    <!--logo start-->
    <div class="logo">
        <h2><a href="default.php">教学资源网</a></h2>
    </div>
    <!--logo end-->
    <!--bar start-->
    <div class="bar">
        <ul>
            <li><a href="default_user.php" target="_blank">首页</a></li>
            <li><a href="onlinestudy.php" target="_blank">在线学习</a></li>
            <li class="active"><a href="onlinelab.php"  target="_blank">在线实验</a></li>
            <li><a href="onlineanswer.php" >在线答题</a></li>
            <li><a href="forum/index_user.php" target="_blank">在线论坛</a></li>
        </ul>
    </div>
    <!--bar end-->
    <!--user start-->
    <div class="user">
        <ul>
            <li><a style="margin-right:5px;" href="#"><?php echo $data_name;?> </a><span style="color: white">|</span></li>
            <li><a style="margin-left:-10px;" href="default.php" id="loginOut">退出</a></li>
        </ul>
    </div>
    <!--user end-->
</div>
<div class="sidebar">
    <ul>
        <li class="box">
            <a class="menu-box">我的实验</a>
            <ul class="menu-list" style="display:none;">
                <li><a href="lab_done_list.php" target="mainframe">已交实验</a></li>
                <li><a href="lab_undo_list.php" target="mainframe">未交实验</a></li>
            </ul>
        </li>

        <li class="box0">
            <a class="menu-box" target="mainframe">我的成绩</a>
        </li>

    </ul>
</div>

<div class="main_content">
    <div class="iframe"><iframe name="mainframe"></iframe></div>
</div>
<!-- content-wrap end -->
<script type="text/javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function () {

        //左侧导航切换
        $(".menu-box").mouseover(function()
        {
            $(this).next(".menu-list").slideToggle(300).siblings(".menu-list").slideUp("slow");
            $(".box>.menu-list").not($(this).next(".menu-list")).slideUp("slow");
        });
    });
</script>
</body>
</html>