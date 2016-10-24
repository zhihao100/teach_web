<?php
include_once '../include.php';
checkLogined();
$link = connect();
$sql = "select * from user where identified=1";//查询学生信息
if (!fechAll($link, $sql)){
    alertMes("addTeacher.php", "不存在学生信息,请添加!");
}
// var_dump($rows);exit();
$pageTotal = getNumRows($link, $sql);
// var_dump($numRows);
?>
<!DOCTYPE html >
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查看学生信息</title>
<link rel="stylesheet" type="text/css" href="CSS/listAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;查看学生</h3></div>
<div class="wrap">
<table border="0px" cellpadding="0px" width="100%" cellspacing="0px">
	<tr class="tr1">
		<th>编号</th><th>学号</th><th>姓名</th><th>邮箱</th><th>班级</th><th>注册时间</th><th>操作</th>
	</tr>
	<?php 
	$pageSize = 5;
	$arryPage = page_admin($pageTotal, $pageSize);
	$sql = "select * from user where identified=1 limit {$arryPage['offset']},{$pageSize}";
	$result = mysqli_query($link, $sql);
	$i = 0;
	while($data_student = mysqli_fetch_assoc($result))
	{
	    $j = $i + 1;
	?>
    <tr class="<?php echo $i%2==0?"tr2":"tr1"?>">
    	<td><?php echo $j;?></td><td><?php echo $data_student['username']?></td><td><?php echo $data_student['name']?></td><td><?php echo $data_student['email']?></td><td><?php echo $data_student['class_short']?></td><td><?php echo $data_student['jointime']?></td><td><button onclick="deleteStudent(<?php echo $data_student['id']?>)">删除</button></td>
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
	function deleteStudent(id){
		if (window.confirm('你确定要删除吗?删除后不可恢复!')){
				window.location='doActionAdmin.php?act=deleteStudent<?php echo '&';?>id='+id;
		}
	}
</script>
</body>
</html>
