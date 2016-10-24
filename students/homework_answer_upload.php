<?php
require_once '../include.php';
//题目信息
$choice=@$_POST['choice_answer'];
$gap=@$_POST['gap_answer'];
$short=@$_POST['short_answer'];
$short1=@$_POST['short'];

//答案对应关系
$test_id=@$_POST['test_id'];
$teacher_id=@$_POST['teacher_id'];
$course_id=@$_POST['course_id'];
$student_id=@$_SESSION['userId'];
$class_id=@$_POST['class_id'];


//JSON字符串转数组
$choice=@json_decode($choice);
$gap=@json_decode($gap);
$short=@json_decode($short);
$sum='';
$gap_sum='';

//选择题答案记录
if($choice!=null) {
    $sql_check="select * from answer WHERE student_id=$student_id and test_id=$test_id";
    $check=mysqli_query($link, $sql_check);
    $check=mysqli_fetch_array($check);
    if($check){
        die("请不要重复提交答案！");
    }
    $time = date("Y-m-d H:i:s");
    $sql_answer = "insert into answer (student_id,test_id,class_id,course_id,teacher_id,answer_time)  VALUES ($student_id,$test_id,$class_id,$course_id,$teacher_id,'$time')";
    mysqli_query($link, $sql_answer) or die("答案关系录入有错误");
    $sql_s="select * from answer WHERE student_id=$student_id and test_id=$test_id";
    $answerResult=mysqli_query($link,$sql_s);
    $answerArr= mysqli_fetch_assoc($answerResult);
    foreach($choice as $value){
        $sum=$value.",".$sum;
    }
    $sql_choice="insert into answer_choice (test_id, choice_answer,answer_id) VALUES ($test_id,'$sum',{$answerArr['id']})";
    mysqli_query($link,$sql_choice)or die("选择题录入有错误");
    $i=1;

    //填空题答案记录
    foreach($gap as $value){
        $j=1;
       foreach($value as $each){
           if($j==1){
               $gap_sum=$gap_sum." . ";
           }
           $gap_sum=$gap_sum.'('.$j.')'.$each;
           $j++;
       }
        $i++;
    }
    $sql_gap="insert into answer_gap (answer_id,gap_answer1,test_id) VALUES ({$answerArr['id']},'$gap_sum',$test_id)";
    mysqli_query($link,$sql_gap)or die("填空题答案录入有错误");

}else{
    //简答题答案录入
    $sql_s="select * from answer WHERE student_id=$student_id and test_id=$test_id";
    $answerResult=mysqli_query($link,$sql_s);
    $answerArr= mysqli_fetch_assoc($answerResult);
    $files=$_FILES;
    $k=0;
    foreach($files as $file){
        if($file['name']==null){
            @$sql_short="insert into answer_short (answer_id,answer_short,test_id,image,R_image) VALUES ({$answerArr['id']},'{$short1[$k]}',$test_id,'','')";
            mysqli_query($link,$sql_short)or die("简答答案录入1有错误");
        }else{
            $file[$k]=uploadFile($file);
            @$sql_short="insert into answer_short (answer_id,answer_short,test_id,image,R_image) VALUES ({$answerArr['id']},'{$short1[$k]}',$test_id,'{$file[$k]['fileName']}','{$file[$k]['fileRelname']}')";
            mysqli_query($link,$sql_short)or die("简答答案录入2有错误");
        }
        $k++;
    }
}

