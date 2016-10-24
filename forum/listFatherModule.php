<?php 
include_once '../include.php';
if (! checkGetById(@$_GET['id'])) {
    alertMes("index_user.php", "id值错误!");
}
$fatherModuleId = @$_GET['id'];
$sql = "select * from forumfathermodule where id={$fatherModuleId}";
$data_father = fecthOne($link, $sql);
if(!$data_father){
    alertMes("index_user.php", "不存在该数据!");
}
$sql = "select * from forumsonmodule where fathermoduleId={$data_father['id']}";
$dataSon = fechAll($link, $sql);
$sonRows = getNumRows($link, $sql);
$sql = "select fsm.modulename as sonmodulename from forumsonmodule as fsm,forumcontent as fc where fathermoduleId={$data_father['id']} and fc.sonmoduleId=fsm.id";
$dataAll = fechAll($link, $sql);
$contentAll = getNumRows($link, $sql);
$pageTotal = $contentAll;
$sql = "select fsm.modulename from forumsonmodule as fsm,forumcontent as fc where fathermoduleId={$data_father['id']} and fc.sonmoduleId=fsm.id and time > CURDATE()";
$contentTody = getNumRows($link, $sql);
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
    <!-- login start -->
    <div class="login">
 	 <ul>
  	  <li><a href="#">登录</a></li>
      <li><a href="#">注册</a></li>
     </ul>
    </div>
  <!-- login end -->
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
            <div class="num">
            	今日：<span><?php echo $contentTody?></span>&nbsp;&nbsp;总帖数：<span><?php echo $contentAll;?></span> 
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
            <?php 
            $pageSize = 5;
            $arryPage = page($pageTotal, $pageSize);
            ?>
            <!-- page-wrap start -->
            <div class="page-wrap">
            	<?php if($data_son){?><a class="publish" href="publish.php?act=fatherModule&id=<?php echo $data_father['id'];?>"></a><?php }?>
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
            	$sql = "select fsm.id as sonmoduleid,fsm.modulename as sonmodulename,fc.id as contentid,fc.title,fc.userId,fc.time,fc.times from forumsonmodule as fsm,forumcontent as fc  where fathermoduleId={$data_father['id']} and fc.sonmoduleId=fsm.id  limit {$arryPage['offset']},{$pageSize}";
            
            	$result = mysqli_query($link, $sql);
//             	var_dump(mysqli_fetch_all($result));exit();
            	while ($data_list = mysqli_fetch_assoc($result)){
            	    $sql = "select * from user where id={$data_list['userId']}";
//             	    echo $data_list['userId']."<br />";
            	    $data_user = fecthOne($link, $sql);
                    $sql = "select * from forumreply where contentId={$data_list['contentid']} order by id desc";
                    $data_reply = fecthOne($link, $sql);
                    $replyTimes = getNumRows($link, $sql);
//                     var_dump($data_reply);
            	
            	?>
                	<li>
                    	<div class="photo"><a href="#"><img src="face/<?php echo $data_user['face'];?>" /></a></div>
							<div class="titlewrap"><a class="title-name" href="listSonModule.php?id=<?php echo $data_list['sonmoduleid'];?>">[<?php echo $data_list['sonmodulename'];?>]</a>&nbsp;&nbsp;<a class="content-name" href="showContent.php?id=<?php echo $data_list['contentid'];?>"><?php echo $data_list['title'];?></a>
								<p>
								楼主：<?php echo $data_user['name'];?>&nbsp;发布时间：<?php echo $data_list['time'];?>&nbsp;&nbsp;&nbsp;&nbsp;<?php if($data_reply['replytime']){echo "回复时间：{$data_reply['replytime']}";}else{echo '该帖子暂无回复&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';}?>
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
            $pageSize = 5;
            $arryPage = page($pageTotal, $pageSize);
            ?>
            <!-- page-wrap start -->
            <div class="page-wrap">
            	<?php if($data_son){?><a class="publish" href="publish.php?act=fatherModule&id=<?php echo $data_father['id'];?>"></a><?php }?>
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
<div class="footer">
	<div class="bottom">
    	<a href="#">教学资源网</a>
		<div class="copyright">copyright 2016 @ powered by teach-resources-web</div>
	</div>
</div>
<!-- footer end -->
</body>
</html>
