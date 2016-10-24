<?php 
include_once '../include.php';
checkLogined();
$link = connect();
$sql = "select * from forumfathermodule";
if (!fechAll($link, $sql)){
    alertMes("addFatherModule.php", "不存在父版块信息,请添加!");
}
$data = fechAll($link, $sql);
$numRows = getNumRows($link, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加子版块信息</title>
<link rel="stylesheet" type="text/css" href="CSS/addAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;添加子板块</h3></div>
<div class="wrap">
<form action="doActionAdmin.php?act=addSonModule" method="post">
	<table  cellpadding="0px" cellspacing="0px">
    	<tr>
    		<td>父版块名:
    		<select id="select1" name="fathermoduleId">
    		<option value="0">------请选择------</option>
    		<?php for ($i = 0; $i< $numRows; $i++){?>
    		<option value="<?php echo $data[$i]['id'];?>"><?php echo $data[$i]['modulename'];?></option>
    		<?php }?>
    		</select>
    		</td>
        </tr>
        <tr>
    		<td class="td1">版块名称:<input type="text" placeholder="请输入子版块名称" name="modulename" id="modulename" /></td>
        </tr>
        <tr>
    		<td>版块简介:<div class="small_state"><textarea class="content" placeholder="请输入版块简介" name="content" id="content" rows="4" cols="47"></textarea></div></td>
        </tr>
        <tr>
    		<td class="td1">版主:<select id="select2" name="hostId"><option value="0">------请选择------</option></select></td>
        </tr>
    </table>
    <div class="bnt"><input type="submit" value="添加" onclick="return checkInfo()" /></div>
</form>
</div>
<script type="text/javascript">
	function checkInfo(){
		var modulename = document.getElementById('modulename');
		var content = document.getElementById('content');
		var select1 = document.getElementById('select1');
		
		if (select1.value == 0){
			alert('请选择一个父版块!');
			return false;
		}else if (modulename.value == '')	{
			alert('请输入子版块名称!');
			return false;
		}else{
			return true;
		}
	}
</script>
</body>
</html>
