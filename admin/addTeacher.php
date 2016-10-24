<?php 
include_once '../include.php';
checkLogined();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加教师</title>
<link rel="stylesheet" type="text/css" href="CSS/addAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;添加教师</h3></div>
<div class="wrap">
<form action="doActionAdmin.php?act=addTeacher" method="post">
	<table cellpadding="0px"  cellspacing="0px">
    	<tr>
    		<td>工号:<input type="text" placeholder="请输入工号" name="username" id="username"/></td>
        </tr>
        <tr>
    		<td class="td1">密码:<input type="password" placeholder="请输入密码" name="pwd1" id="pwd1" /></td>
        </tr>
        <tr>
    		<td>确认密码:<input type="password" placeholder="请确认密码" name="pwd2" id="pwd2" /></td>
        </tr>
        <tr>
    		<td class="td1">姓名:<input type="text" placeholder="请输入真实姓名" name="name" id="name" /></td>
        </tr>
        <tr>
    		<td>邮箱:<input type="email" placeholder="请输入邮箱" name="email" id="email" /></td>
        </tr>
        <tr>
    		<td class="td1">所在院系:<input type="text" placeholder="请输入所在院系" name="department" id="department" /></td>
        </tr>
    </table>
    <div class="bnt"><input type="submit" value="添加" onclick=" return checkInfo()" /></div>
</form>
</div>
<script type="text/javascript">
	function checkInfo(){
		var username = document.getElementById('username');
		var pwd1 = document.getElementById('pwd1');
		var pwd2 = document.getElementById('pwd2');
		var name = document.getElementById('name');
		var email = document.getElementById('email');
		var department = document.getElementById('department');
		
		var tip = document.getElementById('tip');
		if (username.value == ''){
			alert('请输入工号!');
			return false;
		}else if (pwd1.value == ''){
			alert('请输入密码!');
			return false;
		}else if (pwd2.value == ''){
			alert('请输入确认密码!');
			return false;
		}else if (pwd1.value != pwd2.value){
			alert('两次密码输入不正确!');
			return false;
		}else if (name.value == ''){
			alert('请输入姓名!');
			return false;
		}else if (email.value == ''){
			alert('请输入邮箱!');
			return false;
		}else if (department.value == ''){
			alert('请输入所在院系!');
			return false;
		}else{
		return true;
		}
	}
</script>
</body>
</html>
