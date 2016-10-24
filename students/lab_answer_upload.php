<?php
require_once '../include.php';
/**
 * Created by PhpStorm.
 * User: 新乐
 * Date: 2016/6/19
 * Time: 16:26
 */
$student_id = @$_SESSION['userId'];
$lab_id = $_POST['lab_id'];
$files = $_FILES;
$course_id = $_POST['c_id'];
$class_id = $_POST['class_id'];
$teacher_id = $_POST['teacher_id'];
$lt_text=$_POST['txt_thinking'];

$lab_answer_time=date("Y-m-d H:i:s");
$sql_answer="insert into lab_answer(lab_id,teacher_id,student_id,class_id,course_id,lab_answer_time) VALUES ('$lab_id','$teacher_id','$student_id','$class_id','$course_id','$lab_answer_time')";
$answer_result=mysqli_query($link,$sql_answer);//将本套实验的答案总体信息存到总表中，后面分表放具体答案

$sql_s="select * from lab_answer WHERE student_id=$student_id and lab_id=$lab_id";
$answer_s=mysqli_query($link,$sql_s);
$answerArr= mysqli_fetch_assoc($answer_s);//找到实验答案总表中刚上传的一套实验的id，供联系后面分表使用
$lab_answer_id=$answerArr['id'];

$sql_text="insert into lab_text(lab_id,lab_answer_id,lt_text) VALUES ('$lab_id','$lab_answer_id','$lt_text')";
$text_result=mysqli_query($link,$sql_text);

for($k = 0;$k<count($files['files']['name']);$k++){
    if ($files['files']['name'][$k]=="") {

    }else {
            $name = @$files['files']['name'][$k];
            $type = @$files['files']['type'][$k];
            $tmp_name = @$files['files']['tmp_name'][$k];
            $size = @$files['files']['size'][$k];
            $error = @$files['files']['error'][$k];
            $fileSingle = null;
            $fileSingle = Array('name' => $name, 'type' => $type, 'tmp_name' => $tmp_name, 'size' => $size, 'error' => $error);
            $fileSingle = uploadFile($fileSingle);
            $lf_r_name = $fileSingle['fileRelname'];
            $lf_name = $fileSingle['fileName'];
            $type = $fileSingle['type'];
            $size = ceil($fileSingle['size'] / 1024) . 'KB';
            if (ceil($fileSingle['size'] / 1024) > 1024) {
                $size = ceil($fileSingle['size'] / (1024 * 1024)) . 'MB';
            }
            $sql_lab = "insert into lab_file(lab_id,lf_r_name,lf_name,lf_type,lf_size,lab_answer_id) VALUES ('$lab_id','$lf_r_name','$lf_name','$type','$size','$lab_answer_id')";
            $file_result = mysqli_query($link, $sql_lab) or die("实验图片上传有错误");

        }
    }

if($text_result){
    alertMes("../onlinelab.php", "实验作业提交成功");
}else{
    alertMes("../onlinelab.php", "实验作业心得未提交");
}




