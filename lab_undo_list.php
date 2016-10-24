<?php
/**
 * Created by PhpStorm.
 * User: 新乐
 * Date: 2016/6/17
 * Time: 18:03
 */
include_once 'include.php';

//查询未提交的实验
$sql_done=@"select * from lab_answer WHERE student_id={$_SESSION['userId']}";
$result_done=mysqli_query($link,$sql_done);
$sum_id='';
while(@$data_done=mysqli_fetch_assoc($result_done)){
    $data_id=$data_done['lab_id'];
    $sum_id=$sum_id.' and '. 'lab.id<>'.$data_id;
}

$sql_name="select * from user where id={$_SESSION['userId']}";
$classname=mysqli_query($link,$sql_name);
$name_result=mysqli_fetch_assoc($classname);
$sql_class="select * from class where class_short='{$name_result['class_short']}'";
$class_result=mysqli_query($link,$sql_class);
$class_result_id=mysqli_fetch_assoc($class_result);
$class_id=$class_result_id['id'];
//获取本人的班级id以筛选出本班级对应的实验

$sql = "select lab.id, lab.lab_name, lab.lab_time, lab.c_id,course.c_name from lab, course where lab.c_id=course.id and (lab.class_A=$class_id or lab.class_B=$class_id OR lab.class_C=$class_id or lab.class_D=$class_id)";
//获取本人本班级的每套实验，包括已交和未交
$sql=$sql.$sum_id;
//获取本人的未交实验
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生未交实验</title>
    <link rel="stylesheet" href="CSS/lab_undo_list.css">
</head>
<body>
<!--未交实验列表-->
<div class="lab_undo_list">
    <div class="header_title"><img src="images/write.jpg" alt="写实验"><p>&nbsp;&nbsp;未交实验</p></div>
    <div class="lab_list">
        <table border="0px" cellpadding="0px" cellspacing="0px" width="100%" id="table">
            <tr><th style="width: 25%">所属课程</th><th style="width: 50%">实验名称</th><th style="width: 25%">发布时间</th></tr>
            <?php
            $result = mysqli_query($link, $sql);
            while(@$data_lab = mysqli_fetch_assoc($result)){
                ?>
                <tr><td><?php echo $data_lab['c_name'];?></td><td><a href="lab_undo_detail.php?id=<?php echo $data_lab['id'];?>&c_id=<?php echo $data_lab['c_id'];?>" target="_blank"><?php echo $data_lab['lab_name'];?></a></td><td><?php echo $data_lab['lab_time'];?></td></tr>
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