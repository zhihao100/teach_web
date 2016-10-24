<?php 
include_once '../include.php';
checkUserLogined();
if(!checkGetById(@$_GET['replyId']) || !checkGetById(@$_GET['id'])){
    alertMes("onlineforum.php", "参数错误!");
}
$replyId = @$_GET['replyId'];
$sql = "select * from user where id={$replyId}";
$data_user = fecthOne($link, $sql);
if(!$data_user){
    alertMes("onlineforum.php", "不存在该用户数据");
}
$contentId = @$_GET['id'];
$sql = "select * from forumcontent where id={$contentId}";
$data_content = fecthOne($link, $sql);
// var_dump($data_content);exit();
if(!$data_content){
    alertMes("onlineforum.php", "不存在该帖子");
}
$sql = "select ffm.modulename as fathermodulename,ffm.id as fatherId,fsm.modulename as sonmodulename,fsm.id as sonId,fc.time,fc.times,user.name from forumfathermodule as ffm,forumsonmodule as fsm,forumcontent as fc,user where fsm.id={$data_content['sonmoduleId']} and ffm.id=fsm.fathermoduleId and user.id={$data_content['userId']}";
$data_all = fecthOne($link, $sql);
if (!$data_all){
    alertMes("onlineforum.php", "不存在该板块对应的所有数据!");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>回复页面</title>
<link rel="stylesheet" type="text/css" href="CSS/public.css" />
<link rel="stylesheet" type="text/css" href="CSS/publish.css" />
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
            <li><a href="showContent.php?id=<?php echo $data_content['id'];?>"><?php echo $data_content['title'];?></a></li>
        </ul>
    </div>
    <!-- reply-content start -->
    <div class="reply-content">
    	<div class="answer">回复：由&nbsp;<span><?php echo $data_all['name'];?></span>&nbsp;发布的&nbsp;<span><?php echo $data_content['content'];?></span></div>
    	<form action="doActionUser.php?act=reply&id=<?php echo $data_content['id'];?>" method="post">
			<textarea name="contentreply" class="content" id="contentreply" placeholder="请输入帖子内容"></textarea>
			<input class="reply" type="submit" name="submit" onclick="return checkInfo()" />
        </form>
    </div>
    <!-- reply-content end -->
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
	function checkInfo(){
		var contentreply = document.getElementById('contentreply');

		if(contentreply.value == ''){
			alert('请输入回复内容!');
			return false;
	}else{
		return true;
</script>
</body>
</html>
