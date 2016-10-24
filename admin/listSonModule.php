<?php 
include_once '../include.php';
checkLogined();
$link = connect();
$sql = "select ffm.modulename as fathermodulename,fsf.id,fsf.modulename,fsf.info,fsf.hostId from forumfathermodule ffm,forumsonmodule as fsf where fsf.fathermoduleId=ffm.id order by ffm.id";
$numRows = getNumRows($link, $sql);
if($numRows == 0){
    alertMes("addFatherModule.php", "不存在对应父版块的子版块信息,请先添加父版块信息或对应子版块信息!");
}
$pageTotal = getNumRows($link, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询子版块信息</title>
<link rel="stylesheet" type="text/css" href="CSS/listAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;查看子板块</h3></div>
<div class="wrap">
<table border="0px" cellpadding="0px" width="100%" cellspacing="0px">
	<tr class="tr1">
		<th>编号</th><th>所属父版块名称</th><th>版块名称</th><th>版块简介</th><th>版主</th><th>操作</th>
	</tr>
    <?php 
	$pageSize = 5;
	$arryPage = page_admin($pageTotal, $pageSize);
	$sql = "select ffm.modulename as fathermodulename,fsf.id,fsf.modulename,fsf.info,fsf.hostId from forumfathermodule ffm,forumsonmodule as fsf where fsf.fathermoduleId=ffm.id order by ffm.id limit {$arryPage['offset']},{$pageSize}";
	$result = mysqli_query($link, $sql);
	$i = 0;
	while($data_all = mysqli_fetch_assoc($result))
	{
	    $j = $i + 1;
	?>
    <tr class="<?php echo $i%2==0?"tr2":"tr1"?>">
    	<td><?php echo $j;?></td><td><?php echo $data_all['fathermodulename']?></td><td><?php echo $data_all['modulename']?></td><td><?php echo $data_all['info']?></td><td><?php echo $data_all['hostId']?></td><td><button onclick="editSonModule(<?php echo $data_all['id']?>)">修改</button><button onclick="deleteSonModule(<?php echo $data_all['id']?>)">删除</button></td>
    </tr>
    <?php $i++;}?>
</table>
	<div class="page">
    	<ul>
        	<?php echo $arryPage['html'];?>
        </ul>
    </div>
</div>
<script type="text/javascript">
	function editSonModule(id){
		window.location='editSonModule.php?id='+id;
	}
	function deleteSonModule(id){
		if(window.confirm('你确定要删除吗?删除后不可恢复!')){
			window.location='doActionAdmin.php?act=deleteSonModule<?php echo '&';?>id='+id;
		}
	}
</script>
</body>
</html>
