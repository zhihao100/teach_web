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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>教学资源网</title>
    <link type="text/css" rel="stylesheet" href="CSS/default.css" />
    <script type="text/javascript" src="JS/myfocus-2.0.1.min.js"></script>
    <script type="text/javascript" src="JS/mf-pattern/mF_YSlider.js"></script>
    <link type="text/css" rel="stylesheet" href="JS/mf-pattern/mF_YSlider.css" />
    <script type="text/javascript">
        myFocus.set(
            {id:'boxpic'})
    </script>
</head>
<body>
<!--header start-->
<div class="header">
    <!--logo start-->
    <div class="logo">
        <h2><a href="default_user.php">教学资源网</a></h2>
    </div>
    <!--logo end-->
    <!--bar start-->
    <div class="bar">
        <ul>
            <li class="home"><a href="default_user.php">首页</a></li>
            <li><a href="onlinestudy.php" target="_blank">在线学习</a></li>
            <li><a href="onlinelab.php"  target="_blank">在线实验</a></li>
            <li><a href="onlineanswer.php" target="_blank">在线答题</a></li>
            <li><a href="./forum/index_user.php" target="_blank">在线论坛</a></li>
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
<!--header end-->

<!--mainbody start-->
<div class="mainbody">
    <!--focus start-->
    <div class="focus" id="boxpic">
        <div class="pic">
            <img src="images/loading.jpg" alt="图片正在加载中"/>
            <ul>
                <li><img src="images/onlinestudy1.jpg" alt="在线学习" /></li>
                <li><img src="images/onlinelabor1.jpg" alt="在线实验" /></li>
                <li><img src="images/onlinehomework1 .jpg" alt="在线答题" /></li>
                <li><img src="images/onlineforum1.jpg" alt="在线论坛" /></li>
            </ul>
        </div>
    </div>
    <!--focus end-->

    <!--各个功能模块介绍-->
    <!--online study start-->
    <div class="study">
        <div class="study_title"><h3>在线学习</h3></div>
        <div class="study_content">
            <p>在线学习分为在线视频和在线学习资料下载两个子模块。</p>
            <p>在访问在线视频模块单元，用户将可以在线观看所有该模块上传的学习视频，其中包括：上课时的教学视频、用户自己分享的视频等等；用户可以在课余的时间段内通过在线观看上课时没有及时听懂的课程视频。</p>
        </div>
        <div class="study_image">
            <img src="images/onlinestudy2.jpg" alt="在线学习" height="240px" />
        </div>
    </div>
    <!--online study end-->

    <!--online labor start-->
    <div class="labor">
        <div class="labor_title"><h3>在线实验</h3></div>
        <div class="labor_image">
            <img src="images/onlinelabor2.jpg" alt="在线实验" height="240px" />
        </div>
        <div class="labor_content">
            <p>在线实验主要让用户在实验之前就能时时查询到实验时间、地点、指导老师等一些相关内容。用户也可以下载相关实验的资料，让用户在实验前就能了解实验内容；用户也可以查看以前实验的资料</p>
        </div>
    </div>
    <!--online labor end-->

    <!--online dohomework start-->
    <div class="dohomework">
        <div class="dohomework_title"><h3>在线答题</h3></div>
        <div class="dohomework_content">
            <p>在线答题分为在线习题和在线考试两个子模块。</p>
            <p>用户在访问此模块时，只需要按照自己的需求点击相应的习题和考试内容就可以实现在线答题的功能。可以让用户在课外之余复习课本知识。</p>
        </div>
        <div class="dohomework_image">
            <img src="images/onlinehomework2.jpg" alt="在线答题" height="240px" />
        </div>
    </div>
    <!--online dohomwork end-->

    <!--online forum start-->
    <div class="forum">
        <div class="forum_title"><h3>在线论坛</h3></div>
        <div class="forum_image">
            <img src="images/onlineforum2.jpg" alt="在线论坛" height="240px" />
        </div>
        <div class="forum_content">
            <p>在线论坛让用户与用户之间进行交流，用户可以在论坛里查看其他用户的帖子，自己也可以发帖子。亲，注意咯！只有注册过的用户才能享受此功能哦！！</p>
        </div>
    </div>
    <!--online forum end-->
</div>
<!--mainbody end-->

<!--footer start-->
<div class="footer">
</div>
<!--footer end-->
<script type="text/javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">

</script>
</body>
</html>
