<?php 
include_once '../include.php';
checkLogined();
$sonmoduleId = $_REQUEST['id'];
$link = connect();
$sql = "select * from forumfathermodule";
if (!fechAll($link, $sql)){
    alertMes("addFatherModule.php", "不存在父版块信息,请添加!");
}
$data = fechAll($link, $sql);
$numRows = getNumRows($link, $sql);
$sql = "select * from forumsonmodule where id={$sonmoduleId}";
$data_son = fecthOne($link, $sql);
if(!$data_son){
    alertMes("listSonModule.php", "不存在该数据!");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>添加子版块信息</title>
<link rel="stylesheet" type="text/css" href="CSS/addAdmin.css" />
<style>
select{
	width:270px;
	height:30px;
	border:1px solid #e4e4e4;
	text-align:center;
	}
.content{
	width:270px;
	height:50px;
	border:1px solid #f9f9f9;
	}
</style>
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;修改子板块</h3></div>
<div class="wrap">
<form action="doActionAdmin.php?act=editSonModule&id=<?php echo $data_son['id'];?>" method="post">
	<table border="0px" cellpadding="0px" width="100%" cellspacing="0px">
    	<tr>
    		<td class="td1">父版块名:</td><td class="td2">
    		<select id="select1" name="fathermoduleId">
    		<option value="0">------请选择------</option>
    		<?php for ($i = 0; $i< $numRows; $i++){?>
    		<option value="<?php echo $data[$i]['id'];?>"><?php echo $data[$i]['modulename'];?></option>
    		<?php }?>
    		</select>
    		</td>
        </tr>
        <tr>
    		<td class="td1 td11">版块名称:</td><td class="td2 td22"><input type="text" value="<?php echo $data_son['modulename'];?>" name="modulename" id="modulename" /></td>
        </tr>
        <tr>
    		<td class="td1">版块简介:</td><td class="td2"><input type="text" class="content" value="<?php echo $data_son['info'];?>" name="content" id="content"></input></td>
        </tr>
        <tr>
    		<td class="td1 td11">版主:</td><td class="td2 td22"><select id="select2" name="hostId"><option value="0">------请选择------</option></select></td>
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
