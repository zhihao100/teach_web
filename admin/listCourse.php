<?php 
include_once '../include.php';
checkLogined();
$link = connect();
$sql = "select * from course";
if(!fechAll($link, $sql)){
    alertMes("addCourse.php", "课程信息不存在，请先添加!");
}
$pageTotal = getNumRows($link, $sql);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>查询课程信息</title>
<link rel="stylesheet" type="text/css" href="CSS/listAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;查看课程信息</h3></div>
<div class="wrap">
<table  cellpadding="0px"  cellspacing="0px" width="100%">
	<tr class="tr1">
		<th>编号</th><th>课程名称</th><th>任课教师</th><th>操作</th>
	</tr>
	<?php 
	$pageSize = 5;
	$arryPage = page_admin($pageTotal, $pageSize);
	$sql = "select * from course order by user_id limit {$arryPage['offset']},{$pageSize}";
	$result = mysqli_query($link, $sql);
	$i = 0;
	while ($data_course = mysqli_fetch_assoc($result)){
	    $j = $i + 1;
	    $sql = "select name from user where id={$data_course['user_id']}";
	    $data_user = fecthOne($link, $sql);
	?>
    <tr class="<?php echo $i%2==0?"tr2":"tr1"?>">
    <td><?php echo $j;?></td><td><?php echo $data_course['c_name'];?></td><td><?php echo $data_user['name'];?></td><td><button onclick="editCourse(<?php echo $data_course['id'];?>)">修改</button><button onclick="deleteCourse(<?php echo $data_course['id'];?>)">删除</button></td>
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
function editCourse(id){
	window.location='editCourse.php?id='+id;
}
function deleteCourse(id){
	if (window.confirm('你确定要删除吗?删除后不可恢复!')){
		window.location='doActionAdmin.php?act=deleteCourse<?php echo '&';?>id='+id;
	}
}
</script>
</body>
</html>

