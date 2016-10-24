<?php
/**
 * Created by PhpStorm.
 * User: 新乐
 * Date: 2016/6/12
 * Time: 14:12
 */
include_once 'include.php';
//查询已提交的作业
$sql="select course.c_name,test.test_title,answer.answer_time,answer.id from answer INNER JOIN course ON course.id=answer.course_id INNER JOIN test on test.id=answer.test_id WHERE student_id={$_SESSION['userId']}";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生已交作业</title>
    <link rel="stylesheet" href="CSS/homework_done_list.css">
</head>
<body>
<!--未交作业列表-->
<div class="homework_done_list">
    <div class="header_title"><img src="images/write.jpg" alt="写作业"><p>&nbsp;&nbsp;已交作业</p></div>
    <div class="homework_list">
        <table border="0px" cellpadding="0px" cellspacing="0px" width="100%" id="table">
            <tr><th style="width: 25%">所属课程</th><th style="width: 50%">作业名称</th><th style="width: 25%">提交时间</th></tr>
            <?php
            $result = mysqli_query($link, $sql);
            while(@$data_test = mysqli_fetch_assoc($result)){
                ?>
                <tr><td><?php echo $data_test['c_name'];?></td><td><a href="homework_done_detail.html?<?php echo $data_test['id'];?>" target="_blank"><?php echo $data_test['test_title'];?></a></td><td><?php echo $data_test['answer_time'];?></td></tr>
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