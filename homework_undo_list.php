<?php 
include_once 'include.php';
//查询未提交的作业
$sql_done="select * from answer WHERE student_id={$_SESSION['userId']}";
$result_done=mysqli_query($link,$sql_done);
$sum_id='';
while(@$data_done=mysqli_fetch_assoc($result_done)){
    $data_id=$data_done['test_id'];
    $sum_id=$sum_id.' and '. 'test.id<>'.$data_id;
}

$sql_name="select * from user where id={$_SESSION['userId']}";
$classname=mysqli_query($link,$sql_name);
$name_result=mysqli_fetch_assoc($classname);
$sql_class="select * from class where class_short='{$name_result['class_short']}'";
$class_result=mysqli_query($link,$sql_class);
$class_result_id=mysqli_fetch_assoc($class_result);
$class_id=$class_result_id['id'];
//获取本人的班级id以筛选出本班级对应的题目

$sql = "select test.id, test.test_title, test.t_time, course.c_name from test, course where test.course_id=course.id and (test.class_A=$class_id or test.class_B=$class_id OR test.class_C=$class_id or test.class_D=$class_id)";
//获取本人本班级的每套题目，包括已交和未交
$sql=$sql.$sum_id;
//获取本人的未交题目

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生作业</title>
    <link rel="stylesheet" href="CSS/homework_list.css">
</head>
<body>
<!--未交作业列表-->
<div class="homework_undo_list">
    <div class="header_title"><img src="images/write.jpg" alt="写作业"><p>&nbsp;&nbsp;未交作业</p></div>
<div class="homework_list">
    <table border="0px" cellpadding="0px" cellspacing="0px" width="100%" id="table">
<tr><th style="width: 25%">所属课程</th><th style="width: 50%">作业名称</th><th style="width: 25%">发布时间</th></tr>
		<?php 
		$result = mysqli_query($link, $sql);
		while(@$data_test = mysqli_fetch_assoc($result)){
		?>
        <tr><td><?php echo $data_test['c_name'];?></td><td><a href="homework_undo_detail.php?id=<?php echo $data_test['id'];?>" target="_blank"><?php echo $data_test['test_title'];?></a></td><td><?php echo $data_test['t_time'];?></td></tr>
        <?php }?>
    </table>
</div>
<div class="page">
    <ul>
        <li><a href="#">首页</a></li>
        <li><a href="#">上一页</a></li>
        <li class="selected">1</li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">下一页</a></li>
        <li><a href="#">尾页</a></li>
    </ul>
</div>
</div>
</body>
</html>