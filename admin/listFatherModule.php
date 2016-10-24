<?php 
include_once '../include.php';
checkLogined();
$link = connect();
$sql = "select * from forumfathermodule";
if (!fechAll($link, $sql)){
    alertMes("addFatherModule.php", "不存在父版块信息,请添加!");
}
$pageTotal = getNumRows($link, $sql);
// var_dump($rows);exit();
$numRows = getNumRows($link, $sql);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询父版块信息</title>
<link rel="stylesheet" type="text/css" href="CSS/listAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;查看父板块</h3></div>
<div class="wrap">
<table border="0px" cellpadding="0px" width="100%" cellspacing="0px" bordercolor="#CCCCCC">
	<tr class="tr1">
		<th>编号</th><th>版块名称</th><th>操作</th>
	</tr>
    <?php 
	$pageSize = 5;
	$arryPage = page_admin($pageTotal, $pageSize);
	$i = 0;
	$sql = "select * from forumfathermodule limit {$arryPage['offset']},{$pageSize}";
	$result = mysqli_query($link, $sql);
	while($data_father = mysqli_fetch_assoc($result))
	{
	    $j = $i+1;
	?>
    <tr class="<?php echo $i%2==0?"tr2":"tr1"?>">
    	<td><?php echo $j;?></td><td><?php echo $data_father['modulename']?></td><td><button onclick="editFatherModule(<?php echo $data_father['id']?>)">修改</button><button onclick="deleteFatherModule(<?php echo $data_father['id']?>)">删除</button></td>
    </tr>
    <?php $i++;}?>
</table>
	<div class="page">
    	<ul>
        	<?php echo $arryPage['html'];?>
        </ul>
    </div>
</div>
<script>

	function editFatherModule(id){
		window.location='editFatherModule.php?id='+id;
	}
	function deleteFatherModule(id){
		if (window.confirm('你确定要删除吗?删除后不可恢复!')){
			window.location='doActionAdmin.php?act=deleteFatherModule<?php echo '&';?>id='+id;
		}
	}
</script>
</body>
</html>
