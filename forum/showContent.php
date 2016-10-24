<?php 
include_once '../include.php';
if(!checkGetById($_GET['id'])){
    alertMes("onlineforum.php", "id参数错误!");
}
$contentTitleId = @$_GET['id'];
$sql = "select * from forumcontent where id={$contentTitleId}";
$data_content = fecthOne($link, $sql);
if(!$data_content){
    alertMes("onlineforum.php", "数据不存在!");
}
$sql = "select ffm.modulename as fathermodulename,ffm.id as fatherId,fsm.modulename as sonmodulename,fsm.id as sonId,user.name,user.face from forumfathermodule as ffm,forumsonmodule as fsm,forumcontent as fc,user where fsm.id={$data_content['sonmoduleId']} and ffm.id=fsm.fathermoduleId and user.id={$data_content['userId']}";
$data_all = fecthOne($link, $sql);
if(!$data_all){
    alertMes("onlineforum.php", "帖子数据不存在!");
}
$data_content['times']++;
// var_dump($data_all['times']);exit();
$sql = "update forumcontent set times={$data_content['times']} where id={$data_content['id']}";
if(!update($link, $sql)){
    alertMes("onlineforum.php", "更新浏览次数失败!");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>帖子内容页面</title>
<link rel="stylesheet" type="text/css" href="CSS/public.css" />
<link rel="stylesheet" type="text/css" href="CSS/show.css" />
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
		 <li><a href="../login.html">登录</a></li>
		 <li><a href="#" id="register">注册</a></li>
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
            <li><a href="listFatherModule.php?id=<?php echo $data_all['fatherId'];?>"><?php echo $data_all['fathermodulename'];?></a></li>
            &gt;&gt;
            <li><a href="listSonModule.php?id=<?php echo $data_all['sonId'];?>"><?php echo $data_all['sonmodulename'];?></a></li>
            &gt;&gt;
            <li><?php echo $data_content['title'];?></li>
        </ul>
    </div>
    <?php 
    	$sql = "select * from forumreply where contentId={$contentTitleId}";
    	$data_reply = fechAll($link, $sql);
    	$replyRows = getNumRows($link, $sql);
    	$pageTotal = $replyRows;
    	?>
    <?php 
    $pageSize = 10;
    $arryPage = page($pageTotal, $pageSize);
    ?>
    <!-- page-wrap start -->
    <div class="page-wrap">
    	<div class="page">
        	<ul>
            	<?php echo $arryPage['html'];?>
            </ul>
    	</div>
        <a class="reply" href="reply.php?replyId=<?php echo @$_SESSION['userId'];?>&id=<?php echo $contentTitleId;?>"></a>
    </div>
    <!-- page-wrap end -->
    <div style="clear:both"></div>
	<!-- content-wrap start -->
	<?php 
 $page = @$_GET['page'];
    if (! isset($page) || ! is_numeric($page) || is_null($page)) {
        $page = 1;
    }
	if($page == 1){?>
	<div class="content-wrap">
		<!-- left-area start -->
		<div class="left-area">
    		<div class="photo-info">
        		<a href="listUserInfo.php?id=<?php echo $data_content['userId'];?>"><img src="face/<?php echo $data_all['face'];?>"/></a>
       		</div>
        	<div class="name-info"><a href="listUserInfo.php?id=<?php echo $data_content['userId'];?>"><?php echo $data_all['name'];?></a></div>
   		</div>
    	<!-- left-area end -->
    	<!-- right-area start -->
    	<div class="right-area">
    		<div class="title">
        		<h2><?php echo $data_content['title'];?></h2>
            	<span>阅读：<?php echo $data_content['times'];?>&nbsp;|&nbsp;回复：<?php echo $replyRows;?></span>
       		</div>
        	<div class="publish-date">
        		<span class="date">发布时间：<?php echo $data_content['time'];?></span>
            	<span class="floor">楼主</span>
        	</div>
        	<div class="content">
        	<?php echo $data_content['content'];?>
        	</div>
    	</div>
    	<!-- right-area end -->
	</div>
	<?php }?>
	<!-- content-wrap end -->
	<div style="clear:both"></div>
    <!-- content-wrap end -->
    <div style="clear:both"></div>
    <?php 
//     if(!$data_reply){
//         alertMes("onlineforum.php", "不存在回复数据!");
//     }else
       if($data_reply){
       $sql = "select * from forumreply where contentId={$contentTitleId} limit {$arryPage['offset']},{$pageSize}";
       $foor = ($page - 1) * $pageSize;
       $result = mysqli_query($link, $sql);
       while ($dataReply = mysqli_fetch_assoc($result)){
           $sql = "select * from user where id={$dataReply['replyuserId']}";
           $data_user = fecthOne($link, $sql);
    ?>
	<!-- content-wrap start -->
	<div class="content-wrap">
		<!-- left-area start -->
		<div class="left-area">
    		<div class="photo-info">
        		<a href="listUserInfo.php?id=<?php echo $data_user['id'];?>"><img src="face/<?php echo $data_user['face'];?>" /></a>
       		</div>
        	<div class="name-info"><a href="lisrUserInfo.php?id=<?php echo $data_user['id'];?>"><?php echo $data_user['name']?></a></div>
   		</div>
    	<!-- left-area end -->

    	<!-- right-area start -->
    	<div class="right-area">
        	<div class="reply-date">
        		<span class="date">回复时间：<?php echo $dataReply['replytime'];?></span>
            	<span class="floor"><?php echo ++$foor;?>楼&nbsp;|&nbsp;<a href="quote.php?id=<?php echo $dataReply['id'];?>&replyId=<?php echo @$_SESSION['userId'];?>">引用</a></span>
        	</div>
        	<div class="content">
        	<?php 
        	if($dataReply['quoteId']){
        	    $sql = "select * from forumreply where contentId={$dataReply['contentId']} and id<={$dataReply['quoteId']}";
        	    $f = getNumRows($link, $sql);
        	    $sql = "select fr.contentreply,user.name from forumreply as fr,forumcontent as fc,user where fr.id={$dataReply['quoteId']} and fr.replyuserId=user.id";
        	    $dataAll = fecthOne($link, $sql);
        	    
        	?>
        	<div class="quote-content">
                	<span>引用&nbsp;<?php echo $f;?>&nbsp;楼&nbsp;<?php echo $dataAll['name'];?>&nbsp;回复的：</span>
                    <?php echo $dataAll['contentreply'];?>
            </div>
             <?php }?>
        	<?php echo $dataReply['contentreply'];?>
        	</div>
    	</div>
    	<!-- right-area end -->
	</div>
	<!-- content-wrap end -->
		<?php }?>
    <?php }?>
    <?php 
    $pageSize = 10;
    $arryPage = page($pageTotal, $pageSize);
    ?>
 	<!-- page-wrap start -->
    <div class="page-wrap">
    	<div class="page">
        	<ul>
            	<?php echo $arryPage['html'];?>
        	</ul>
    	</div>
        <a class="reply" href="reply.php?id=<?php echo @$_SESSION['userId'];?>"></a>
    </div>
    <!-- page-wrap end -->
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
<script type="text/javascript" src="../JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
	$(function(){
		$("#register").on("click",function(){
			alert("抱歉，目前本网站仅供校内使用，暂不提供注册功能！");
		});
	});
</script>
</body>
</html>
