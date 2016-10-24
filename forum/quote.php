<?php 
include_once '../include.php';
checkUserLogined();
if(!checkGetById(@$_GET['id']) || !checkGetById(@$_GET['replyId'])){
    alertMes("onlineforum.php", "参数错误!");
}
$id = @$_GET['id'];
$sql = "select * from forumreply where id={$id}";
$data_reply = fecthOne($link, $sql);
if(!$data_reply){
    alertMes("onlineforum.php", "数据不存在!");
}
$replyId = @$_GET['replyId'];
$sql = "select * from user where id={$replyId}";
$data_user = fecthOne($link, $sql);
if(!$data_user){
    alertMes("onlineforum.php", "不存在该用户!");
}
$sql = "select ffm.id as fatherId,ffm.modulename as fathermodulename,fsm.id as sonId,fsm.modulename as sonmodulename,fc.title,fc.userId,user.name from forumfathermodule as ffm,forumsonmodule as fsm,forumcontent as fc,user where fc.id={$data_reply['contentId']} and fc.sonmoduleId=fsm.id and fsm.fathermoduleId=ffm.id and user.id={$data_reply['replyuserId']}";
$dataAll = fecthOne($link, $sql);
// var_dump($dataAll);exit();
if(!$dataAll){
    alertMes("onlineforum.php", "不存在该板块下的所有数据!");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>引用页面</title>
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
            <li><a href="listFatherModule.php?id=<?php echo $dataAll['fatherId'];?>"><?php echo $dataAll['fathermodulename'];?></a></li>
            &gt;&gt;
            <li><a href="listSonModule.php?id=<?php echo $dataAll['sonId'];?>"><?php echo $dataAll['sonmodulename'];?></a></li>
            &gt;&gt;
            <li><a href="showContent.php?id=<?php echo $data_reply['contentId'];?>"><?php echo $dataAll['title'];?></a></li>
        </ul>
    </div>
    <?php 
    $sql = "select * from user where id={$dataAll['userId']}";
    $dataUser = fecthOne($link, $sql);
    if(!$dataUser){
        alertMes("onlineforum.php", "不存在楼主信息!");
    }
    $sql = "select * from forumreply where contentId={$data_reply['contentId']} and id<={$data_reply['id']}";
    $foor = getNumRows($link, $sql);
    ?>
    <!-- reply-content start -->
    <div class="reply-content">
    	<div class="question"><span><?php echo $dataUser['name'];?></span>：<?php echo $dataAll['title'];?></div>
    	<div class="answer">引用&nbsp;<span><?php echo $foor;?></span>楼&nbsp;<span><?php echo $dataAll['name'];?></span>&nbsp;回复的：
        	<p><?php echo $data_reply['contentreply'];?></p>
        </div>
    	<form action="doActionUser.php?act=quote&id=<?php echo $data_reply['id'];?>&contentId=<?php echo $data_reply['contentId'];?>" method="post">
			<textarea name="contentreply" class="content" placeholder="请输入回复<?php echo $dataAll['name'];?>的内容" id="contentreply"></textarea>
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
	}
}
</script>
</body>
</html>
