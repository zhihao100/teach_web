<?php 
include_once '../include.php';
$link=connect();
@$page=$_GET['page'];
$num=5;
if($page==null){
    @$offset = 0;
}else {
    @$offset = ($page - 1) * $num;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>作业批改-作业列表</title>
<link rel="stylesheet" type="text/css" href="CSS/dohomework.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;作业批改-作业列表</h3></div>
<!-- main-wrap start -->
<div class="main-wrap">
    <div class="select">
        <label><select  name="course" id="course">
        	<option selected="selected" disabled="disabled">--请选择课程--</option>
        	<?php
        	$sql = "select * from course where user_id={$_SESSION['userId']}";
        	$result = mysqli_query($link, $sql);
        	while($data_course = mysqli_fetch_assoc($result)){
                if($_COOKIE['course_id']!=$data_course['id']) {
                    echo "<option value={$data_course['id']}>{$data_course['c_name']}</option>";
                }else{
                    echo "<option value={$data_course['id']} selected='selected'>{$data_course['c_name']}</option>";
                }
        	?>
            <?php }?> 
        </select></label>
        <label><select  id="test_name"  name="test_name">
            <option selected="selected" disabled="disabled" >--请选择作业--</option>
                <?php
                $course_id=$_COOKIE['course_id'];
                $user_id=$_SESSION['userId'];
                $sql = "select * from test where user_id=$user_id and course_id=$course_id";
                $result = mysqli_query($link, $sql);
                while($data_test = @mysqli_fetch_assoc($result)){
                    if($_COOKIE['test_id']!=$data_test['id']) {
                        echo "<option value={$data_test['id']}>{$data_test['test_title']}</option>";
                    }else{
                        echo "<option value={$data_test['id']} selected='selected'>{$data_test['test_title']}</option>";
                    }
                    ?>
                <?php }?>
            </select></label>
        <label><select id="class" name="class">
        	<option selected="selected" disabled="disabled" >--请选择班级--</option>
            <?php
            $sql = "select * from course where id={$_COOKIE['course_id']}";
            $result = mysqli_query($link, $sql);
            $data_class = @mysqli_fetch_assoc($result);

                if($_COOKIE['class_id']!=$data_class['classA']) {
                    if($data_class['classA_name']!='') {
                        echo "<option value={$data_class['classA']}>{$data_class['classA_name']}</option>";
                    }
                }else{
            if($data_class['classA_name']!='') {
                echo "<option value={$data_class['classA']} selected='selected'>{$data_class['classA_name']}</option>";
            }
                }


            if($_COOKIE['class_id']!=$data_class['classB']) {
            if($data_class['classB_name']!='') {
                echo "<option value={$data_class['classB']}>{$data_class['classB_name']}</option>";
            }
            }else{
            if($data_class['classB_name']!='') {
                echo "<option value={$data_class['classB']} selected='selected'>{$data_class['classB_name']}</option>";
            }
            }

            if($_COOKIE['class_id']!=$data_class['classC']) {
            if($data_class['classC_name']!='') {
                echo "<option value={$data_class['classC']}>{$data_class['classC_name']}</option>";
            }
            }else{
            if($data_class['classC_name']!='') {
                echo "<option value={$data_class['classC']} selected='selected'>{$data_class['classC_name']}</option>";
            }
            }

            if($_COOKIE['class_id']!=$data_class['classD']) {
            if($data_class['classD_name']!='') {
                echo "<option value={$data_class['classD']}>{$data_class['classD_name']}</option>";
            }
            }else{
            if($data_class['classD_name']!='') {
                echo "<option value={$data_class['classD']} selected='selected'>{$data_class['classD_name']}</option>";
            }
            }
                ?>
        </select></label>

    </div>
    <div class="info">
    	<table border="0px" cellpadding="0px" cellspacing="0px" width="100%" id="showTest" id="table">
        	<tr><th>作业名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>
            <?php
            @$test_id=$_COOKIE['test_id'];
            @$course_id=  $_COOKIE['course_id'];
            @$class_id=$_COOKIE['class_id'];
            $sql_done="select * from test_score WHERE class_id={$class_id}";
            $result_done=mysqli_query($link,$sql_done);
          $sum_id='';
            while(@$data_done=mysqli_fetch_assoc($result_done)){
                $data_id=$data_done['answer_id'];
                $sum_id=$sum_id.' and '. 'answer.id<>'.$data_id;
            }
            $sql="select test.test_title,user.username,class.class_short,answer.id from answer inner  JOIN test on answer.test_id=test.id INNER JOIN class on answer.class_id=class.id INNER JOIN course on answer.course_id=course.id INNER JOIN user ON answer.student_id=user.id WHERE answer.class_id=$class_id and answer.course_id=$course_id and answer.test_id=$test_id  ".$sum_id. " limit $offset ,$num";
            $result=mysqli_query($link,$sql);
            while(@$arr=mysqli_fetch_assoc($result)){

                echo "<tr class='tr2'><td>{$arr['test_title']}</td><td>{$arr['username']}</td><td>{$arr['class_short']}</td><td><span class='wtj'><a href='homework.html?{$arr['id']}'> 批改</a></span></td></tr>";
            }
            ?>
        </table>
    </div>
    <div class="page">
        <ul>
            <?php    $pageSize = 5;
            @$pageArr = page_dohomework($_COOKIE['page_all'], $pageSize);
            echo $pageArr['html'];?>
        </ul>
    </div>
</div>
<!-- main-wrap end -->
<script  type="text/javascript" language="javascript" src="JS/jquery-1.11.1.min.js"></script>
 <script type="text/javascript">
     $(function() {
         //班级变化class
         $('#class').on("change",function(){
                 var test_id=$("#test_name").val();
                 document.cookie="test_id="+test_id;
                 var class_id=$("#class").val();
                 document.cookie="class_id="+class_id;
                 $.ajax({
                     datatype: "html",
                     type: "POST",
                     url: "doTeacherAction.php",
                     data: "act="+"searchFirst",
                     success: function (data) {
                     var arr=JSON.parse(data);
                         var i=0;
                         var sum="<tr><th>作业名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>";
                         document.cookie="page_all="+arr[0]['length'];
                        for(i;i<arr.length;i++){
                            sum=sum+" <tr class='tr1'><td>"+arr[i]['test_name']+"</td><td>"+arr[i]['student_name']+"</td><td>"+arr[i]['class_name']+"</td><td><span class='pg'><a href='homework.html?"+arr['answer_id']+"'> 批改</a></span></td></tr>";
                        }
                         $("table").html(sum);
                         window.location = "doHomework.php";
                     }
                 });
             }
         );
         //试题变化
         $('#test_name').on("change",function(){
                 var test_id=$("#test_name").val();
                 document.cookie="test_id="+test_id;
             $("table").html("<tr><th>作业名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>");
                 $.ajax({
                     datatype: "html",
                     type: "POST",
                     url: "doTeacherAction.php",
                     data: "act="+"searchFirst",
                     success: function (data) {
                         var arr=JSON.parse(data);
                         var i=0;
                         var sum="<tr><th>作业名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>";
                         document.cookie="page_all="+arr[0]['length'];
                         for(i;i<arr.length;i++){
                             sum=sum+" <tr class='tr1'><td>"+arr[i]['test_name']+"</td><td>"+arr[i]['student_name']+"</td><td>"+arr[i]['class_name']+"</td><td><span class='pg'><a href='homework.html"+arr['answer_id']+"'> 批改</a> </span></td></tr>";
                         }
                         $("table").html(sum);
                         window.location = "doHomework.php";
                     }
                 });
         }
         );
         //课程变化
         $('#course').on("change",function(){
             $("table").html("<tr><th>作业名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>");
             var course_id=$("#course").val();
             document.cookie="course_id="+course_id;
             $.ajax({
                 datatype: "json",
                 type: "POST",
                 url: "doTeacherAction.php",
                 data: "act="+"searchTest"+"&course_id=" + course_id,
                 success: function (data) {
                     var arr=JSON.parse(data);
                     var i=0;
                     var sum_html="<option selected='selected' disabled='disabled' >--请选择作业--</option>";
                     //试题选项
                     if(arr['test_id'].length!=0) {
                         for (i; i < arr['test_id'].length; i++) {

                             var sum_html = sum_html + "<option value=" + arr['test_id'][i] + ">" + arr['test_name'][i] + "</option>";
                         }
                         $("#test_name").html("");
                         $("#test_name").html(sum_html);
                     }else{
                         $("#test_name").html("<option selected='selected' disabled='disabled' >--请选择作业--</option>");
                     }
                    //班级选项
                     sum_html="<option selected='selected' disabled='disabled' >--请选择班级--</option>";
                     i=0;
                     if(arr['class_id'].length!=0) {
                         for (i; i < arr['class_id'].length; i++) {
                                if(arr['class_name'][i]!=''){
                             var sum_html = sum_html + "<option value=" + arr['class_id'][i] + ">" + arr['class_name'][i] + "</option>";
                         }}
                         $("#class").html("");
                         $("#class").html(sum_html);
                     }else{
                         $("#class").html(sum_html);
                     }

                 }
             });
         });




     } );
 </script>
</body>
</html>
