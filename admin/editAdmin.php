<?php 
include_once '../include.php';
checkLogined();
$id = $_REQUEST['id'];
$sql = "select * from manager where id={$id}";
$data = fecthOne($link, $sql);  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改管理员</title>
<link rel="stylesheet" type="text/css" href="CSS/addAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;修改管理员</h3></div>
<div class="wrap">
<form action="doActionAdmin.php?act=editAdmin&id=<?php echo $data['id'];?>" method="post">
<table border="0px" cellpadding="0px" width="100%" cellspacing="0px">
<tr>
<td class="td1">账户名:</td><td class="td2"><input type="text" value="<?php echo $data['username'];?>" name="username" /></td>
</tr>
<tr>
<td class="td1 td11">密码:</td><td class="td2 td22"><input type="password" value="<?php echo $data['pwd'];?>" name="pwd" /></td>
</tr>
<tr>
<td class="td1">姓名:</td><td class="td2"><input type="text" value="<?php echo $data['name'];?>" name="name" /></td>
</tr>
<tr>
<td class="td1 td11">邮箱:</td><td class="td2 td22" ><input type="email" value="<?php echo $data['email'];?>" name="email" /></td>
</tr>
<tr>
<td class="td1">专业:</td><td class="td2"><input type="text" value="<?php echo $data['profession'];?>" name="profession" /></td>
</tr>
</table>
<div class="bnt"><input type="submit" value="修改" /></div>
</form>
</div>
</body>
</html>
