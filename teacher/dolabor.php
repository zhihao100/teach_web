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
    <title>作业批改-实验列表</title>
    <link rel="stylesheet" type="text/css" href="CSS/dohomework.css" />
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;作业批改-实验列表</h3></div>
<!-- main-wrap start -->
<div class="main-wrap">
    <div class="select">
        <label><select  name="course" id="course">
            <option selected="selected" disabled="disabled">--请选择课程--</option>
            <?php
        	$sql = "select * from course where user_id={$_SESSION['userId']}";
        	$result = mysqli_query($link, $sql);
        	while($data_course = mysqli_fetch_assoc($result)){
                    echo "<option value={$data_course['id']}>{$data_course['c_name']}</option>";
            ?>
            <?php }?>
        </select></label>
        <label><select  id="test_name"  name="test_name">
            <option selected="selected" disabled="disabled" >--请选择实验--</option>
            <?php
                $user_id=$_SESSION['userId'];
                $sql = "select * from lab where user_id=$user_id";
                $result = mysqli_query($link, $sql);
                while($data_lab = mysqli_fetch_assoc($result)){
                        echo "<option value={$data_lab['id']}>{$data_lab['lab_name']}</option>";
            ?>
            <?php }?>
        </select></label>
        <label><select id="class" name="class">
            <option selected="selected" disabled="disabled" >--请选择班级--</option>
            <?php
            $sql = "select * from course where user_id={$_SESSION['userId']}";
            $result = mysqli_query($link, $sql);
            $data_class = mysqli_fetch_assoc($result);
            if($data_class['classA_name']!='') {
                        echo "<option value={$data_class['classA']}>{$data_class['classA_name']}</option>";
            }
            if($data_class['classB_name']!='') {
            echo "<option value={$data_class['classB']}>{$data_class['classB_name']}</option>";
            }

            if($data_class['classC_name']!='') {
            echo "<option value={$data_class['classC']}>{$data_class['classC_name']}</option>";
            }

            if($data_class['classD_name']!='') {
            echo "<option value={$data_class['classD']}>{$data_class['classD_name']}</option>";
            }
            ?>
        </select></label>

    </div>
    <div class="info">
        <table border="0px" cellpadding="0px" cellspacing="0px" width="100%" id="showTest" id="table">
            <tr><th>实验名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>
            <?php
            $sql_done="select * from lab_score";
            $result_done=mysqli_query($link,$sql_done);
          $sum_id='';
            while(@$data_done=mysqli_fetch_assoc($result_done)){
                $data_id=$data_done['lab_id'];
                $sum_id=$sum_id.' and '. 'lab.id<>'.$data_id;
            }
            $sql="select lab.lab_name,user.username,class.class_short,lab_file.id,lab_text.id from lab_file inner  JOIN lab on (lab_file.lab_id OR lab_text.lab_id)=lab.id INNER JOIN class on (lab_file.class_id OR lab_text.class_id)=class.id INNER JOIN course on (lab_file.c_id OR lab_text.c_id)=course.id INNER JOIN user ON (lab_file.user_id OR lab_text.user_id)=user.id ".$sum_id. " limit $offset ,$num";
            $result=mysqli_query($link,$sql);

            while(@$arr=mysqli_fetch_assoc($result)){
                var_dump($arr);
            echo "<tr class='tr2'><td>{$arr['lab_name']}</td><td>{$arr['username']}</td><td>{$arr['class_short']}</td><td><span class='wtj'><a href='#?{$arr['id']}'> 批改</a></span></td></tr>";
            }
            ?>
        </table>
    </div>
    <div class="page">
        <ul>
<!--            --><?php //   $pageSize = 5;
//            @$pageArr = page_dohomework($_COOKIE['page_all'], $pageSize);
//            echo $pageArr['html'];?>
        </ul>
    </div>
</div>
<!-- main-wrap end -->
<script  type="text/javascript" language="javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function() {
//        //班级变化class
//        $('#class').on("change",function(){
//                    var test_id=$("#test_name").val();
//                    document.cookie="test_id="+test_id;
//                    var class_id=$("#class").val();
//                    document.cookie="class_id="+class_id;
//                    $.ajax({
//                        datatype: "html",
//                        type: "POST",
//                        url: "doTeacherAction.php",
//                        data: "act="+"searchFirst",
//                        success: function (data) {
//                            var arr=JSON.parse(data);
//                            var i=0;
//                            var sum="<tr><th>实验名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>";
//                            document.cookie="page_all="+arr[0]['length'];
//                            for(i;i<arr.length;i++){
//                                sum=sum+" <tr class='tr1'><td>"+arr[i]['test_name']+"</td><td>"+arr[i]['student_name']+"</td><td>"+arr[i]['class_name']+"</td><td><span class='pg'><a href='homework.html?"+arr['answer_id']+"'> 批改</a></span></td></tr>";
//                            }
//                            $("table").html(sum);
//                            window.location = "doHomework.php";
//                        }
//                    });
//                }
//        );
//        //试题变化
//        $('#test_name').on("change",function(){
//                    var test_id=$("#test_name").val();
//                    document.cookie="test_id="+test_id;
//                    $("table").html("<tr><th>实验名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>");
//                    $.ajax({
//                        datatype: "html",
//                        type: "POST",
//                        url: "doTeacherAction.php",
//                        data: "act="+"searchFirst",
//                        success: function (data) {
//                            var arr=JSON.parse(data);
//                            var i=0;
//                            var sum="<tr><th>实验名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>";
//                            document.cookie="page_all="+arr[0]['length'];
//                            for(i;i<arr.length;i++){
//                                sum=sum+" <tr class='tr1'><td>"+arr[i]['test_name']+"</td><td>"+arr[i]['student_name']+"</td><td>"+arr[i]['class_name']+"</td><td><span class='pg'><a href='homework.html"+arr['answer_id']+"'> 批改</a> </span></td></tr>";
//                            }
//                            $("table").html(sum);
//                            window.location = "doHomework.php";
//                        }
//                    });
//                }
//        );
        //课程变化
        $('#course').on("change",function(){
            $("table").html("<tr><th>实验名称</th><th>姓名</th><th>班级</th><th>操作</th></tr>");
            var course_id=$("#course").val();
            $.ajax({
                datatype: "json",
                type: "POST",
                url: "doTeacherAction.php",
                data: "act="+"searchLab"+"&course_id=" + course_id,
                success: function (data) {
                    var arr=JSON.parse(data);
                    var i=0;
                    var sum_html="<option selected='selected' disabled='disabled' >--请选择实验--</option>";
                    //试题选项
                    if(arr['lab_id'].length!=0) {
                        for (i; i < arr['lab_id'].length; i++) {

                            var sum_html = sum_html + "<option value=" + arr['lab_id'][i] + ">" + arr['lab_name'][i] + "</option>";
                        }
                        $("#test_name").html("");
                        $("#test_name").html(sum_html);
                    }else{
                        $("#test_name").html("<option selected='selected' disabled='disabled' >--请选择实验--</option>");
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
