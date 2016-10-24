<?php 
include_once '../include.php';
if(!checkGetById(@$_GET['id'])){
    alertMes("onlineforum.php", "id值错误!");
}
$sonModuleId = @$_GET['id'];
$sql = "select * from forumsonmodule where id={$sonModuleId}";
$data_son = fecthOne($link, $sql);
if(!$data_son){
    alertMes("onlineforum.php", "数据不存在!");
}
$sql = "select * from forumfathermodule where id={$data_son['fathermoduleId']}";
$data_father = fecthOne($link, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>子版块页面</title>
<link rel="stylesheet" type="text/css" href="CSS/public.css" />
<link rel="stylesheet" type="text/css" href="CSS/father_moudle.css" />
</head>
<body>
<!--head-wrap start-->
<div class="header-wrap">
  <!-- header start -->
  <div class="header">
      <div class="logo">
          <h2><a href="../default.php">教学资源网</a></h2>
      </div>
      <!--logo end-->
      <!--bar start-->
      <div class="bar">
          <ul>
              <li><a href="../default.php">首页</a></li>
              <li><a href="#">在线学习</a></li>
              <li><a href="#">在线实验</a></li>
              <li><a href="#">在线答题</a></li>
              <li class="active"><a href="onlineforum.php" target="_blank">在线论坛</a></li>
          </ul>
      </div>
    <?php if(!@$_SESSION['userId']){?>
    <!-- login start -->
        <div class="user">
            <ul>
                <li><a style="margin-right:5px;" href="../login.html" target="_blank">登陆</a><span style="color: white">|</span></li>
                <li><a style="margin-left:-10px;" href="#" id="register">注册</a></li>
            </ul>
        </div>
  <!-- login end -->
  <?php }else{?>
  <!-- login start -->
    <div class="user">
 	 <ul>
  	  <li><a href="#">欢迎你:<?php echo @$_SESSION['userName'];?></a></li>
      <li><a href="doActionUser.php?act=logoutUser">退出</a></li>
     </ul>
    </div>
  <!-- login end -->
  <?php }?>
  </div>
<!-- header end -->
</div>
<!--head-wrap end-->

<!-- main-wrap start -->
<div class="main-wrap">
	<div class="bar-nav">
    	<ul>
        	<li><a href="index_user.php">首页</a></li>
            &gt;&gt;
            <li><a href="listFatherModule.php?id=<?php echo $data_father['id'];?>"><?php echo $data_father['modulename'];?></a></li>
            &gt;&gt;
            <li><?php echo $data_son['modulename'];?></li>
        </ul>
    </div>
    <!-- content-wrap start -->
    <div class="content-wrap">
    	<!--content-left start-->
    	<div class="content-left">
        	<h2><?php echo $data_son['modulename'];?></h2>
        	<?php 
        	$sql = "select * from forumcontent where sonmoduleId={$data_son['id']} order by time desc";
        	$result = mysqli_query($link, $sql);
        	$contentAll = getNumRows($link, $sql);
        	$sql = "select * from forumcontent where sonmoduleId={$data_son['id']} and time > CURDATE()";
        	$contentTody = getNumRows($link, $sql);?>
            <div class="num">
            	今日：<span><?php echo $contentTody;?></span>&nbsp;&nbsp;总帖数：<span><?php echo $contentAll;?></span> 
            </div>
            <div class="son-moudle-name">
            <p>版主：<?php echo $data_son['hostId'] == 0?"暂无版主":"版主姓名";?></p>
            <p><?php echo $data_son['info'];?></p>
            </div>
           <?php 
            $pageSize = 1;
            $pageTotal = $contentAll;
            $arryPage = page($pageTotal, $pageSize);
            ?>
            <!-- page-wrap start -->
            <div class="page-wrap">
            	<?php if($data_son){?><a class="publish" href="publish.php?act=sonModule&id=<?php echo $data_son['id'];?>"></a><?php }?>
                <div class="page">
                	<ul>
                    	<?php echo $arryPage['html'];?>
                    </ul>
                </div>
            </div>
            <!-- page-wrap end -->
            <div style="clear:both;"></div>
            
            <!-- module-wrap -->
            <div class="moudle-wrap">
            	<ul>
            	<?php 
            	$sql = "select fsm.id as sonmoduleid,fsm.modulename as sonmodulename,fc.id as contentid,fc.title,fc.userId,fc.time,fc.times from forumsonmodule as fsm,forumcontent as fc where fsm.id={$data_son['id']} and fc.sonmoduleId=fsm.id limit {$arryPage['offset']},{$pageSize}";
            	$result = mysqli_query($link, $sql);
            	while($data_list = mysqli_fetch_assoc($result)){
            	    $sql = "select * from user where id={$data_list['userId']}";
//             	    echo $data_list['userId']."<br />";
            	    $data_user = fecthOne($link, $sql);
                    $sql = "select * from forumreply where contentId={$data_list['contentid']} order by id desc";
                    $data_reply = fecthOne($link, $sql);
                    $replyTimes = getNumRows($link, $sql);
            	?>
            		<li>
                    	<div class="photo"><a href="#"><img src="face/<?php echo $data_user['face'];?>" /></a></div>
							<div class="titlewrap"><a class="title-name">[<?php echo $data_list['sonmodulename'];?>]</a>&nbsp;&nbsp;<a class="content-name" href="showContent.php?id=<?php echo $data_list['contentid'];?>"><?php echo $data_list['title'];?></a>
								<p>
								楼主：<?php echo $data_user['name'];?>&nbsp;发布时间：<?php echo $data_list['time'];?>&nbsp;&nbsp;&nbsp;&nbsp;最后回复：<?php echo $data_reply['replytime'];?>
								</p>
                            </div>
							<div class="count">
								<p>
								回复<br /><span><?php echo $replyTimes;?></span>
								</p>
								<p>
								浏览<br /><span><?php echo $data_list['times'];?></span>
								</p>
							</div>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <!-- moudle-wrap end -->
            
            <?php 
            $pageSize = 1;
            $pageTotal = $contentAll;
            $arryPage = page($pageTotal, $pageSize);
            ?>
            <!-- page-wrap start -->
            <div class="page-wrap">
            	<?php if($data_son){?><a class="publish" href="#"></a><?php }?>
                <div class="page">
                	<ul>
                    	<?php echo $arryPage['html'];?>
                    </ul>
                </div>
            </div>
            <!-- page-wrap end -->
        </div>
       <!-- content-left end-->
        
        <?php 
        $sql = "select * from forumfathermodule";
        $data_father = fechAll($link, $sql);
        $fatherNumRows = getNumRows($link, $sql);
        ?>
        <!--content-right start-->
        <div class="content-right">
        	<div class="title">版块列表</div>
        	<?php for ($i = 0; $i < $fatherNumRows; $i++){?>
            	<div class="moudle-list">
                	<a class="moudle-name" href="listFatherModule.php?id=<?php echo $data_father[$i]['id'];?>"><?php echo $data_father[$i]['modulename'];?></a>
                	<ul>
                	<?php 
                	$sql = "select * from forumsonmodule where fathermoduleId={$data_father[$i]['id']}";
                	$data_son = fechAll($link, $sql);
                	if(!$data_son){
                	    echo "<li><a>暂无子版块......</a></li>";
                	}else{$sonNumRows = getNumRows($link, $sql);
                	for($j = 0; $j <$sonNumRows; $j++){?>
                    	<li><a href="listSonModule.php?id=<?php echo $data_son[$j]['id'];?>"><?php echo $data_son[$j]['modulename'];?></a></li>
                       			 <?php }?>
                        <?php }?>
                    </ul>
                </div>
            <?php }?>
        </div>
       <!-- content-right end-->
    </div>
    <!-- content-wrap end -->
</div>
<!-- main-wrap end -->

<div style="clear:both"></div>
<!-- footer start -->
<div class="footer"></div>
<!-- footer end -->
<script type="text/javascript" src="../JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function(){
        <?php if(!@$_SESSION['userId']){?>
        //未登录
        $("#register").on("click",function(){
            alert("抱歉，目前本网站仅供校内使用，暂不提供注册功能！");
        });
        $(".bar ul li:eq(1),.bar ul li:eq(2),.bar ul li:eq(3)").on("click",function(){
            alert("此版块需用户登录后才可使用，请先登录！");
        });
        <!-- login end -->
        <?php }else{?>
        //已登录
       $(".bar ul li a").eq(0).attr("href","../default_user.php")
           .end().eq(1).attr("href","../onlinestudy.php")
           .end().eq(2).attr("href","../onlinelab.php")
           .end().eq(3).attr("href","../onlineanswer.php")
           .end().eq(4).attr("href","index_user.php");
        <?php }?>
    });
</script>
</body>
</html>
