<?php
/**
 * Created by PhpStorm.
 * User: 新乐
 * Date: 2016/9/22
 * Time: 20:41
 */
include_once '../include.php';
$link = connect();
$sql ="select * from forumfathermodule order by id desc";
if (!fechAll($link, $sql)){
    alertMes("error.html", "系统维护中,请稍后再登录!");
}
$data_father = fechAll($link, $sql);
$fatherNumRows = getNumRows($link, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>在线论坛页面</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css" />
    <link rel="stylesheet" type="text/css" href="CSS/public.css" />
</head>

<body>
<!--head-wrap start-->
<div class="header">
    <!--logo start-->
    <div class="logo">
        <h2><a href="../default.php">教学资源网</a></h2>
    </div>
    <!--logo end-->
    <!--bar start-->
    <div class="bar">
        <ul>
            <li><a href="../default.php" target="_blank">首页</a></li>
            <li><a href="#">在线学习</a></li>
            <li><a href="#">在线实验</a></li>
            <li><a href="#">在线答题</a></li>
            <li class="active"><a href="onlineforum.php">在线论坛</a></li>
        </ul>
    </div>
    <!--bar end-->
    <!--user start-->
    <div class="user">
        <ul>
            <li><a style="margin-right:5px;" href="../login.html">登陆</a><span style="color: white">|</span></li>
            <li><a style="margin-left:-10px;" href="#" id="register">注册</a></li>
        </ul>
    </div>
    <!--user end-->
</div>
<!--head-wrap end-->

<!-- main-wrap start -->
<div class="main-wrap">
    <?php
    $sql = "select * from forumfathermodule";
    $dataFather = fechAll($link, $sql);
    $fatherNumRows0 = getNumRows($link, $sql);
    for($k = 0; $k < $fatherNumRows0; $k++){
        $sql = "select fc.id from forumsonmodule as fsm,forumcontent as fc where fsm.fathermoduleId={$dataFather[$k]['id']} and fc.sonmoduleId=fsm.id";
        $result = mysqli_query($link, $sql);
        $maxRows=0;
        while($data_content = mysqli_fetch_assoc($result)){
            $sql = "select * from forumreply where contentId={$data_content['id']}";
            $Rows = getNumRows($link, $sql);
            if($Rows > $maxRows){
                $maxRows = $Rows;
            }
        }

    }
    ?>
    <!-- hot start -->
    <div class="hot">
        <div class="title"><span>热门动态</span></div>
        <div class="content-list">
            <ul>
                <li><a class="title-name" href="#">[高等数学]</a>&nbsp;<a class="content-name" href="#">极限证明方式</a></li>
                <li><a class="title-name" href="#">[高等数学]</a>&nbsp;<a class="content-name" href="#">关于求多重积分的方法</a></li>
                <li><a class="title-name" href="#">[高等数学]</a>&nbsp;<a class="content-name" href="#">期末考试试卷类型分析</a></li>
                <li><a class="title-name" href="#">[数据结构（C语言）]</a>&nbsp;<a class="content-name" href="#">数据结构中的几种排列方式</a></li>
                <li><a class="title-name" href="#">[数据结构（C语言）]</a>&nbsp;<a class="content-name" href="#">顺序排序</a></li>
                <li><a class="title-name" href="#">[数据结构（C语言）]</a>&nbsp;<a class="content-name" href="#">什么是数据结构</a></li>
            </ul>
        </div>
    </div>
    <!-- hot end -->

    <!-- content-box start -->
    <?php
    for ($i =0; $i < $fatherNumRows; $i++){
        ?>
        <div class="content-box">
            <div class="class-list">
                <div class="title"><span><a href="listFatherModule.php?id=<?php echo $data_father[$i]['id'];?>"><?php echo $data_father[$i]['modulename'];?></a></span></div>
            </div>
            <?php
            $sql = "select * from forumsonmodule where fathermoduleId={$data_father[$i]['id']}";
            $data_son = fechAll($link, $sql);
            if(!$data_son){
                ?>
                <div class="content-list tip-image">暂无子版块...</div>
            <?php }else{?>
                <!--childern-content-box start-->
                <?php
                $sonNumRows = getNumRows($link, $sql);
                ?>
                <div class="children-content-box">
                    <?php for($j =0; $j < $sonNumRows; $j++){
                        $sql = "select * from forumcontent where sonmoduleId={$data_son[$j]['id']}";
                        $contentAll = getNumRows($link, $sql);
                        $sql = "select * from forumcontent where sonmoduleId={$data_son[$j]['id']} and time > CURDATE()";
                        $contentTody = getNumRows($link, $sql);
                        ?>
                        <div class="childBox new">
                            <div class="child-content-list">
                                <h4><a href="listSonModule.php?id=<?php echo $data_son[$j]['id'];?>"><?php echo $data_son[$j]['modulename']?></a> <span>(今日<?php echo $contentTody;?>)</span></h4>
                                帖子：<?php echo $contentAll;?><br />
                            </div>
                        </div>
                    <?php }?>
                </div>
                <!--childern-content-box end-->
            <?php }?>
        </div>
        <!-- content-box end -->
    <?php }?>
</div>
<!-- main-wrap end -->
<div style="clear:both"></div>
<!-- footer start -->
<div class="footer">
</div>
<!-- footer end -->
<script type="text/javascript" src="../JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">

    $(function(){
        $("#register").on("click",function(){
            alert("抱歉，目前本网站仅供校内使用，暂不提供注册功能！");
        });
        $(".bar ul li:eq(1),.bar ul li:eq(2),.bar ul li:eq(3)").on("click",function(){
            alert("此版块需用户登录后才可使用，请先登录！");
        });
    });
</script>
</body>
</html>
