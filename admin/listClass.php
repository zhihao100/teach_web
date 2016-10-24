<?php
include_once '../include.php';
checkLogined();
$link = connect();
$sql = "select * from class ";//查询学生信息
if (!fechAll($link, $sql)){
    alertMes("addClass.php", "不存在班级信息,请添加!");
}
// var_dump($rows);exit();
$pageTotal = getNumRows($link, $sql);
// var_dump($numRows);
?>
<!DOCTYPE html >
<html >
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>查看班级信息</title>
    <link rel="stylesheet" type="text/css" href="CSS/listAdmin.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;查看班级</h3></div>
<div class="wrap">
    <table cellpadding="0px"  cellspacing="0px" width="100%">
        <tr class="tr1">
            <th>编号</th><th>班级id</th><th>学校</th><th>专业</th><th>年级</th><th>班级序号</th><th>班级简称</th><th>操作</th>
        </tr>
        <?php
        $pageSize = 5;
        $arryPage = page_admin($pageTotal, $pageSize);
        $sql = "select * from class limit {$arryPage['offset']},{$pageSize}";
        $result = mysqli_query($link, $sql);
        $i = 0;
        while($data_class = mysqli_fetch_assoc($result))
        {
            $j = $i + 1;
            ?>
            <tr class="<?php echo $i%2==0?"tr2":"tr1"?>">
                <td><?php echo $j;?></td><td><?php echo $data_class['id']?></td><td><?php echo $data_class['school']?></td><td><?php echo $data_class['major']?></td><td><?php echo $data_class['grade']?></td><td><?php echo $data_class['class_num']?></td><td><?php echo $data_class['class_short']?></td><td><button onclick="deleteClass(<?php echo $data_class['id']?>)">删除</button></td>
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
    function deleteClass(id){
        if (window.confirm('你确定要删除吗?删除后不可恢复!')){
            window.location='doActionAdmin.php?act=deleteClass<?php echo '&';?>id='+id;
        }
    }
</script>
</body>
</html>
