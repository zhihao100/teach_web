<?php 
include_once '../include.php';
checkUserLogined();
if(!checkGetByAct(@$_GET['act'])){
    alertMes("onlineforum.php", "act参数错误!");
}
if(!checkGetById(@$_GET['id'])){
    alertMes("onlineforum.php", "id参数错误!");
}
if(@$_GET['act'] == 'fatherModule'){
    $fatherModuleId = @$_GET['id'];
    $sql = "select * from forumfathermodule where id={$fatherModuleId}";
    $data_father = fecthOne($link, $sql);
    if(!$data_father){
        alertMes("onlineforum.php", "不存在该数据");
    }
    $sql = "select * from forumsonmodule where fathermoduleId={$data_father['id']}";
    $data_son = fechAll($link, $sql);
    $sonNumRows = getNumRows($link, $sql);
}else if(@$_GET['act'] == 'sonModule'){
    $sonModuleId = @$_GET['id'];
    $sql = "select * from forumsonmodule where id={$sonModuleId}";
    $data_son = fecthOne($link, $sql);
    if(!$data_son){
        alertMes("onlineforum.php", "不存在该数据!");
    }
    $sql = "select * from forumfathermodule where id={$data_son['fathermoduleId']}";
    $data_father = fecthOne($link, $sql);
}else{
    alertMes("onlineforum.php", "act参数错误!");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>发帖页面</title>
<link rel="stylesheet" type="text/css" href="CSS/public.css" />
<link rel="stylesheet" type="text/css" href="CSS/publish.css" />
<script type="text/javascript" src="JS/publish.js"></script>
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
            <li><a href="listFatherModule.php?id=<?php echo $data_father['id'];?>"><?php echo $data_father['modulename'];?></a></li>
        </ul>
    </div>
    <!-- reply-content start -->
    <div class="reply-content">
    	<form action="doActionUser.php?act=publish" method="post">
        	<select name="sonmoduleId" id="select1">
				<?php if(@$_GET['act'] == 'fatherModule'){?>
				<option value="0">-请选择一个版块-</option>
					<?php for($i = 0; $i < $sonNumRows; $i++){?>
				<option value="<?php echo $data_son[$i]['id'];?>"><?php echo $data_son[$i]['modulename'];?></option>
					<?php }?>
				<?php }?>
				<?php if(@$_GET['act'] == 'sonModule'){?>
				<option value="<?php echo $data_son['id'];?>"><?php echo $data_son['modulename'];?></option>
				<?php }?>
			</select>
			<input class="title" placeholder="请输入帖子标题" name="title" type="text" id="title" />
			<textarea name="content" placeholder="请输入帖子内容"  class="content" id="content"></textarea>
			<input class="publish" type="submit" name="submit" onclick="return checkInfo()" />
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
</script>
</body>
</html>
