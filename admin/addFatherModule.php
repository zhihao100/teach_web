<?php 
include_once '../include.php';
checkLogined();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加父版块信息</title>
<link rel="stylesheet" type="text/css" href="CSS/addAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;添加父板块</h3></div>
<div class="wrap">
<form action="doActionAdmin.php?act=addFatherModule" method="post">
	<table  cellpadding="0px"  cellspacing="0px">
    	<tr>
    		<td class="td1">版块名:</td><td class="td2"><input type="text" placeholder="请输入父版块名称" name="modulename" id="modulename"/></td>
        </tr>
    </table>
    <div class="bnt"><input type="submit" value="添加" onclick="return checkInfo()" /></div>
</form>
</div>
<script type="text/javascript">
	function checkInfo(){
		var modulename = document.getElementById('modulename');

		if (modulename.value == ''){
			alert('请输入父版块名称!');
			return false;
		}
		return true;
	}
</script>
</body>
</html>
