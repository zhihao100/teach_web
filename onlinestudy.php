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
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>在线学习页面</title>
    <link type="text/css" rel="stylesheet" href="CSS/onlinestudy.css" />
</head>
<body>
<!--header start-->
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
            <li class="active"><a href="onlinestudy.php">在线学习</a></li>
            <li><a href="onlinelab.php"  target="_blank">在线实验</a></li>
            <li><a href="onlineanswer.php" target="_blank">在线答题</a></li>
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
<!--header end-->
<!--sidebar-->

<div class="sidebar">
    <ul>
        <li class="box">
            <a class="menu-box">视频学习</a>
            <ul class="menu-list videos-list" style="display:none;">
                <li><a href="#" target="mainframe">操作系统</a></li>
                <li><a href="#" target="mainframe">计算机组成原理</a></li>
                <li><a href="#" target="mainframe">嵌入式系统</a></li>
                <li><a href="#" target="mainframe">单片机原理</a></li>
                <li><a href="#" target="mainframe">数据结构</a></li>
                <li><a href="#" target="mainframe">微机原理与接口技术</a></li>
            </ul>
        </li>
        <li class="box">
            <a class="menu-box">文档查阅</a>
            <ul class="menu-list documents-list" style="display:none;">
                <li><a href="#" target="mainframe">嵌入式系统</a></li>
                <li><a href="#" target="mainframe">单片机原理</a></li>
                <li><a href="#" target="mainframe">操作系统</a></li>
                <li><a href="#" target="mainframe">计算机组成原理</a></li>
            </ul>
        </li>
        <li class="box0">
            <a class="menu-box" target="mainframe">我的下载</a>
        </li>
        <li class="box0">
            <a class="menu-box" target="mainframe">我要上传</a>
        </li>
    </ul>
</div>
<!--sidebar end-->
<div class="content-wrap display_none">
    <div class="iframe"><iframe name="mainframe"></iframe></div>
</div>
<!--wrap start-->
<div class="content-wrap">
    <!-- 最新视频展示开始-->
    <div id="newvideos" class="videos">
        <div class="online_videos"><h2>在线视频区</h2></div>
        <div class="new_videos"><h3>最新视频</h3></div>
        <div class="new_videos display_none"><h3>动态要显示的课程名称</h3></div>
        <div class="new_videos_content">
            <ul>
                <li><a href="./teacher/upload/3822105d304b52b59d4929e2c76ea295.mp4"><img src="./teacher/upload/3822105d304b52b59d4929e2c76ea295.mp4" alt="视频图片" />
                    <span>操作系统</span>
                    <p><span style="color:#999;">2016-5-6更新至第二章</span></p><p><span style="color:#4399ca;">主讲老师：杨老师</span></p></a>
                </li>
                <li><a href="#"><img src="images/013.jpg" alt="视频图片" />
                    <span>计算机组成原理</span>
                    <p><span style="color:#999;">2016-5-6更新至第二章</span></p><p><span style="color:#4399ca;">主讲老师：杨老师</span></p></a>
                </li>
                <li><a href="#"><img src="images/forum.jpg" alt="视频图片" />
                    <span>数字电子技术基础</span>
                    <p><span style="color:#999;">2016-5-6更新至第二章</span></p><p><span style="color:#4399ca;">主讲老师：杨老师</span></p></a>
                </li>
                <li><a href="#"><img src="images/forum.jpg" alt="视频图片" />
                    <span>电磁波原理</span>
                    <p><span style="color:#999;">2016-5-6更新至第二章</span></p><p><span style="color:#4399ca;">主讲老师：杨老师</span></p></a>
                </li>
                <li><a href="#"><img src="images/forum.jpg" alt="视频图片" />
                    <span>高等数学</span>
                    <p><span style="color:#999;">2016-5-6更新至第二章</span></p><p><span style="color:#4399ca;">主讲老师：杨老师</span></p></a>
                </li>
                <li><a href="#"><img src="images/forum.jpg" alt="视频图片" />
                    <span>线性代数</span>
                    <p><span style="color:#999;">2016-5-6更新至第二章</span></p><p><span style="color:#4399ca;">主讲老师：杨老师</span></p></a>
                </li>
                <li><a href="#">
                    <span>线性代数</span>
                    <p><span style="color:#999;">2016-5-6更新至第二章</span></p><p><span style="color:#4399ca;">主讲老师：杨老师</span></p></a>
                </li>

            </ul>
        </div>

    </div>
    <!--最新视频展示结束-->
    <!--最新资料展示区开始-->
   <div id="newdocuments" class="documents">
      <div class="online_documents"><h2>在线资料区</h2></div>
     <div class="new_documents"><h3>最新资料</h3></div>
       <div class="new_documents display_none"><h3>动态要显示的课程名称</h3></div>
        <!--documents_content start-->
      <div class="new_documents_content">
           <ul>
               <li><a href="#">关于几种操作系统的内核模块简介.doc</a></li>
               <li><a href="#">基于C51单片机的课程设计题目安排.xsl</a></li>
               <li><a href="#">关于几种操作系统的内核模块简介.doc</a></li>
                <li><a href="#">基于C51单片机的课程设计题目安排.xsl</a></li>
               <li><a href="#">关于几种操作系统的内核模块简介.doc</a></li>
               <li><a href="#">基于C51单片机的课程设计题目安排.xsl</a></li>
            <li><a href="#">关于几种操作系统的内核模块简介.doc</a></li>
               <li><a href="#">基于C51单片机的课程设计题目安排.xsl</a></li>
               <li><a href="#">关于几种操作系统的内核模块简介.doc</a></li>
             <li><a href="#">基于C51单片机的课程设计题目安排.xsl</a></li>
        </ul>
       </div>
        <!--documents_content end-->
    </div>
    <!--最新资料展示区结束-->
    <div class="footer">
        <hr>
        <p>&copy; 技术支持：理学院教学辅助网站开发杨晓艳团队</p>
        <p>地址： 湖北省武汉市洪山区南李路28号 邮编：430068</p>
        <hr>
    </div>
</div>
<!--wrap end-->
<!--footer start-->
<!--footer end-->
<script type="text/javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function () {
        //左侧导航切换
        $(".menu-box").mouseover(function () {
            $(this).next(".menu-list").slideToggle(300).siblings(".menu-list").slideUp("slow");
            $(".box>.menu-list").not($(this).next(".menu-list")).slideUp("slow");
        });

        /*videos and documents display*/
        $(".videos-list li a").click(function () {
            $(".documents").addClass("display_none");
            $(".videos").removeClass("display_none");
            $(".videos div:eq(1)").addClass("display_none");
            $(".videos div:eq(2)").removeClass("display_none");
        });
        $(".documents-list li a").click(function () {
            $(".videos").addClass("display_none");
            $(".documents").removeClass("display_none");
            $("#newdocuments").css("margin-top", "0");
            $(".documents div:eq(1)").addClass("display_none");
            $(".documents div:eq(2)").removeClass("display_none");
        });
    });

</script>
</body>
</html>
