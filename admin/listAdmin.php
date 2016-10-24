<?php 
include_once '../include.php';
checkLogined();
$link = connect();
$sql = "select * from manager";
if (!fechAll($link, $sql)){
    alertMes("addAdmin.php", "不存在管理员,请添加!");
}
// var_dump($rows);exit();
$pageTotal = getNumRows($link, $sql);
// var_dump($numRows);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看管理员信息</title>
<link rel="stylesheet" type="text/css" href="CSS/listAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;查看管理员</h3></div>
<div class="wrap">
<table border="0px" cellpadding="0px" width="100%" cellspacing="0px">
	<tr class="tr1">
		<th>编号</th><th>用户名</th><th>姓名</th><th>邮箱</th><th>专业</th><th>操作</th>
	</tr>
	<?php 
	$pageSize = 5;
	$arryPage = page_admin($pageTotal, $pageSize);
	$sql = "select * from manager limit {$arryPage['offset']},{$pageSize}";
	$result = mysqli_query($link, $sql);
	$i = 0;
	while($data_manager = mysqli_fetch_assoc($result))
	{
	    $j = $i + 1;
	?>
    <tr class="<?php echo $i%2==0?"tr2":"tr1"?>">
    	<td><?php echo $j;?></td><td><?php echo $data_manager['username'];?></td><td><?php echo $data_manager['name'];?></td><td><?php echo $data_manager['email']?></td><td><?php echo $data_manager['profession']?></td><td><button onclick="editAdmin(<?php echo $data_manager['id']?>)">修改</button><button onclick="deleteAdmin(<?php echo $data_manager['id']?>)">删除</button></td>
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
	function editAdmin(id){
		window.location.href='editAdmin.php?id='+id;
	}
	function deleteAdmin(id){
		if (confirm('你确定要删除吗?删除后不可恢复!')){
			window.location.href='doActionAdmin.php?act=deleteAdmin<?php echo '&';?>id='+id;
		}
	}
</script>
</body>
</html>
