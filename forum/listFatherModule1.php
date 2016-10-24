<?php 
include_once '../include.php';
global $pageTotal ;
if (! checkGetById(@$_GET['id'])) {
    alertMes("onlineforum.php", "id值错误!");
}
$fatherModuleId = @$_GET['id'];
$sql = "select * from forumfathermodule where id={$fatherModuleId}";
$data_father = fecthOne($link, $sql);
if(!$data_father){
    alertMes("onlineforum.php", "不存在该数据!");
}
$sql = "select * from forumsonmodule where fathermoduleId={$data_father['id']}";
$data_son = fechAll($link, $sql);
$sonNumRows = getNumRows($link, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>父版块页</title>
<link rel="stylesheet" type="text/css" href="CSS/public.css" />
<link rel="stylesheet" type="text/css" href="CSS/father_moudle.css" />
</head>

<body>
<!--head-wrap start-->
<div class="header-wrap">
  <!-- header start -->
  <div class="header">
    <div class="logo"><h2 title="在线论坛">forum</h2></div>
    <div class="nav"><a href="#">首页</a></div>
    <?php if(!@$_SESSION['userId']){?>
    <!-- login start -->
    <div class="login">
 	 <ul>
  	  <li><a href="#">登录</a></li>
      <li><a href="#">注册</a></li>
     </ul>
    </div>
  <!-- login end -->
  <?php }else{?>
  <!-- login start -->
    <div class="login">
 	 <ul>
  	  <li><a href="#">欢迎你:<?php echo @$_SESSION['userName'];?></a></li>
      <li><a href="doActionUser.php?act=logoutUser">注销</a></li>
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
            <li><?php echo $data_father['modulename']?></li>
        </ul>
    </div>
    <!-- content-wrap start -->
    <div class="content-wrap">
    	<!--content-left start-->
    	<div class="content-left">
        	<h2><?php echo $data_father['modulename']?></h2>
        	<?php 
        	$contentAll = 0;
        	$contentTody = 0;
        	if ($data_son){
        	    for($j = 0; $j < $sonNumRows; $j++){
        	        $sql = "select * from forumcontent where sonmoduleId={$data_son[$j]['id']}";
        	        $contentAll += getNumRows($link, $sql);
        	        $sql = "select * from forumcontent where sonmoduleId={$data_son[$j]['id']} and time > CURDATE()";
        	        $contentTody += getNumRows($link, $sql);
        	    }
        	}
        	$pageTotal = $contentAll;
        	?>
            <div class="num">
            	今日：<span><?php echo $contentTody;?></span>&nbsp;&nbsp;总帖数：<span><?php echo $contentAll;?></span> 
            </div>
            <div class="son-moudle-name">
            子版块：<?php 
            $sql = "select * from forumsonmodule where fathermoduleId={$data_father['id']}";
            $data_son = fechAll($link, $sql);
            $sonNumRows = getNumRows($link, $sql);
            if(!$data_son){
               echo "暂无子版块";
            }
            for($i =0; $i < $sonNumRows; $i++){?><a href="listSonModule.php?act=fatherModule&id=<?php echo $data_son[$i]['id'];?>"><?php echo $data_son[$i]['modulename'];?></a>&nbsp;&nbsp;<?php }?>
            </div>
            <?php if($data_son){
                $pageSize = 2;
                $arryPage = page($pageTotal, $pageSize);
            ?>
            <!-- page-wrap start -->
            <div class="page-wrap">
            	<a class="publish" href="publish.php?act=fatherModule&id=<?php echo $data_father['id'];?>"></a>
                <div class="page">
                	<ul>
                    	<?php echo $arryPage['html'];?>
                    </ul>
                </div>
            </div>
            <!-- page-wrap end -->
            <?php }?>
            <div style="clear:both;"></div>
            <!-- module-wrap -->
            <div class="moudle-wrap">
            	<ul>
            	<?php 
            	$sql = "select * from forumsonmodule where fathermoduleId={$data_father['id']} limit {$arryPage['offset']},{$pageSize}";
            	$data_son = fechAll($link, $sql);
            	$sonNumRows = getNumRows($link, $sql);
            	for($k = 0; $k < $sonNumRows; $k++){
            	    $sql = "select * from forumcontent where sonmoduleId={$data_son[$k]['id']} order by time desc ";
            	    $content = fechAll($link, $sql);
            	    $contentRows = getNumRows($link, $sql);
            	?>
            	<?php if($content){
                	for ($m = 0; $m < $contentRows; $m++){
                	    $sql = "select * from user where id={$content[$m]['userId']}";
                	    $data_user = fecthOne($link, $sql);
                	    if(!$data_user){
                	        alertMes("login.html", "不存在该用户!,请重新登录!");
                	    }
                	    $sql = "select * from forumreply where contentId={$content[$m]['id']}";
                	    $replyRows = getNumRows($link, $sql);
                	    ?>
                	<li>
                    	<div class="photo"><a href="listUserInfo.php?id=<?php echo $data_user['id'];?>"><img src="face/<?php echo $data_user['face'];?>" /></a></div>
							<div class="titlewrap"><a class="title-name" href="listSonModule.php?id=<?php echo $data_son[$k]['id'];?>">[<?php echo $data_son[$k]['modulename'];?>]</a>&nbsp;&nbsp;<a class="content-name" href="showContent.php?id=<?php echo $content[$m]['id'];?>"><?php echo $content[$m]['title'];?></a>
								<p>
								楼主：<?php echo $data_user['name'];?>&nbsp;&nbsp;&nbsp;发帖时间：<?php echo $content[$m]['time'];?>&nbsp;&nbsp;&nbsp;&nbsp;最后回复：2016-01-13&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								</p>
                            </div>
                            <div class="count">
								<p>
								回复<br /><span><?php echo $replyRows;?></span>
								</p>
								<p>
								浏览<br /><span><?php echo $content[$m]['times'];?></span>
								</p>
							</div>
					</li>
						<?php }?>
					<?php }?>
					<li style="display:block;">
					<?php if(!$content){?>
					<div class="titlewrap"><a class="title-name" href="listSonModule.php?id=<?php echo $data_son[$k]['id'];?>">[<?php echo $data_son[$k]['modulename'];?>]</a>&nbsp;&nbsp;<a class="content-name" href="#"><?php echo "暂无帖子";?></a></div>
					<?php }?>
                    </li>
                    <?php }?>
                </ul>
            </div>
            <!-- moudle-wrap end -->
            
            <?php if($data_son){
                $pageSize = 2;
                $arryPage = page($pageTotal, $pageSize);
                ?>
            <!-- page-wrap start -->
            <div class="page-wrap">
            	<a class="publish" href="publish.php?act=fatherModule&id=<?php echo $data_father['id'];?>"></a>
                <div class="page">
                	<ul>
                    	<?php echo $arryPage['html'];?>
                    </ul>
                </div>
            </div>
            <!-- page-wrap end -->
            <?php }?>
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
<div class="footer">
	<div class="bottom">
    	<a href="#">教学资源网</a>
		<div class="copyright">copyright 2016 @ powered by teach-resources-web</div>
	</div>
</div>
<!-- footer end -->
</body>
</html>

