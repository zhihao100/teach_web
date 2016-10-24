<?php
/**
 * Created by PhpStorm.
 * User: 新乐
 * Date: 2016/6/17
 * Time: 18:03
 */
include_once 'include.php';
//查询已提交的实验
$sql="select course.c_name,lab.lab_name,lab_answer.lab_answer_time,lab_answer.id from lab_answer INNER JOIN course ON course.id=lab_answer.course_id INNER JOIN lab on lab.id=lab_answer.lab_id WHERE  student_id={$_SESSION['userId']}";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生已交实验</title>
    <link rel="stylesheet" href="CSS/lab_done_list.css">
</head>
<body>
<!--已交实验列表-->
<div class="lab_done_list">
    <div class="header_title"><img src="images/write.jpg" alt="实验"><p>&nbsp;&nbsp;已交实验</p></div>
    <div class="lab_list">
        <table border="0px" cellpadding="0px" cellspacing="0px" width="100%" id="table">
            <tr><th style="width: 25%">所属课程</th><th style="width: 50%">实验名称</th><th style="width: 25%">提交时间</th></tr>
            <?php
            $i=0;
            $result = mysqli_query($link, $sql);
            while($data_lab_file = mysqli_fetch_assoc($result)){
                $sql_lab="select * from lab where lab_name='{$data_lab_file['lab_name']}'";
                $result_lab= mysqli_query($link, $sql_lab);
                $data_lab=mysqli_fetch_assoc($result_lab);
                $i++;
                ?>
                <tr><td><?php echo $data_lab_file['c_name'];?></td><td><a href="lab_done_detail.php?answer_id=<?php echo $data_lab_file['id'];?>&lab_id=<?php echo $data_lab['id'];?>" target="_blank"><?php echo $data_lab_file['lab_name'];?></a></td><td><?php echo $data_lab_file['lab_answer_time'];?></td></tr>
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