 <?php 
include_once 'include.php';
 $link=connect();
$test_id = @$_GET['id'];
 $sql_user="select * from user where id={$_SESSION['userId']}";
 $data_user=fecthOne($link, $sql_user);
 $sql_class="select * from class where class_short='{$data_user['class_short']}'";

 $data_class=fecthOne($link,$sql_class);
$sql = "select * from test where id={$test_id}";
$sql_c = "select * from test_choice where test_id={$test_id}";
$sql_g = "select * from test_gap where test_id={$test_id}";
$sql_s = "select * from test_short where test_id={$test_id}";
$data_t = fecthOne($link, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
 <title><?php echo $data_t['test_title'];?></title>
    <link rel="stylesheet" href="CSS/homework_list.css">
</head>
<body>
<div class="header">
<h1><?php echo $data_t['test_title'];?></h1>
<p><span>学院：<?php echo $data_class['department'];?></span><span>专业：<?php echo $data_class['major'];?></span><span>班级：<?php echo $data_user['class_short'];?></span><span>姓名：<?php echo $_SESSION['userName']?></span></p>
</div>
<!--未交作业具体内容-->
<div class="homework_content">
        <div class="choice_content">
            <span>一:选择题</span>
            <ol>
            <?php 
                $result_c = mysqli_query($link, $sql_c);
                while($data_c = mysqli_fetch_assoc($result_c)){
            ?>
                <li class="choice_list">
                    <div><?php echo $data_c['question'];?></div>
                    <ol class="choices_text">
                        <li value="A"><?php echo $data_c['A'];?></li>
                        <li value="B"><?php echo $data_c['B'];?></li>
                        <li value="C"><?php echo $data_c['C'];?></li>
                        <li value="D"><?php echo $data_c['D'];?></li>
                    </ol>
                   <ol class="choices_picture">
                        <li><img src="teacher/upload/<?php echo $data_c['T_image']?>" alt="<?php echo $data_c['T_R_image']?>"><span><?php echo $data_c['T_image'] == NULL ? "" : "题目图"?></span></li>
                        <li value="A"><img src="teacher/upload/<?php echo $data_c['A_image']?>" alt=""><span><?php echo $data_c['A_image'] == NULL ? "" : "A"?></span></li>
                        <li value="B"><img src="teacher/upload/<?php echo $data_c['B_image']?>" alt=""><span><?php echo $data_c['B_image'] == NULL ? "" : "B"?></span></li>
                        <li value="C"><img src="teacher/upload/<?php echo $data_c['C_image']?>" alt=""><span><?php echo $data_c['C_image'] == NULL ? "" : "C"?></span></li>
                        <li value="D"><img src="teacher/upload/<?php echo $data_c['D_image']?>" alt=""><span><?php echo $data_c['D_image'] == NULL ? "" : "D"?></span></li>
                    </ol>
                </li>
                <?php }?>
            </ol>
  <input type="hidden" id="choice_num" value=<?php echo $data_t['choice_num']; ?>/>
        </div>
        <div class="filling_content">
            <span>二:填空题</span>
            <ol>
            <?php 
            $result_g = mysqli_query($link, $sql_g);
            while($data_g = mysqli_fetch_assoc($result_g)){
            ?>
                <li class="filling_list"><div><?php echo $data_g['gap_question'];?></div>
                    <ol class="filling_blank">
                        <li><label><input type="text" name="blank1"></label></li>
                        <li><label><input type="text" name="blank2"></label></li>
                        <li><label><input type="text" name="blank3"></label></li>
                        <li><label><input type="text" name="blank4"></label></li>
                    </ol>
                    <ol class="filling_picture">
                        <li><img src="teacher/upload/<?php echo $data_g['title_image']?>" alt="<?php echo $data_g['title_r_image'];?>"><span><?php echo $data_g['title_image'] == NULL ? "" : "题目图"?></span></li>
                    </ol>
                </li>
                <?php }?>
            </ol>
        </div>
        <div class="subjective_content">
            <span>三:简答题</span>
            <form action="students/homework_answer_upload.php" enctype="multipart/form-data" method="post" target="iframefile" id="form" name="form">
                <input type="hidden" name="test_id" id="test_id" value=<?php
                echo $test_id;
                ?>     >
                <input type="hidden" name="teacher_id" id="teacher_id" value=<?php
                echo $data_t['user_id'];
                ?>     >
                <input type="hidden" name="course_id" id="course_id" value=<?php
                echo $data_t['course_id'];
                ?>     >
                <input type="hidden" name="class_id" id="class_id" value=<?php
                echo $data_class['id'];
                ?>     >
            <ol>
            <?php 
            $result_s = mysqli_query($link, $sql_s);
            $t=0;
            while($data_s = mysqli_fetch_assoc($result_s)){
            ?>
                <li class="subjective_list"><div><?php echo $data_s['short_question'];?></div><br>
                    <div class="subjective_answer"><label><textarea style="width: 80%;min-height: 80px;" name="short[]"></textarea></label>
                        <div class="ques_btn">
                            <label><input  align="center"  type="text" size="20" name="uppic<?php echo $t ?>" id="upfile<?php echo $t ?>" class="uppic1"></label>
                            <label><input name="picname" id="pic<?php echo $t ?>" type="button" value="上传图片"  onclick="path<?php echo $t ?>.click()" class="uppic2"></label>
                            <input name="path<?php echo $t ?>"   type="file" id="file" style="display:none" onchange="uppic<?php echo $t ?>.value=this.value">
                        </div>
                    </div>
                    <ol class="subjective_picture">
                        <li><img src="teacher/upload/<?php echo $data_s['title_image']?>" alt="<?php echo $data_s['title_r_image']?>"><span><?php echo $data_s['title_image'] == NULL ? "" : "题目图"?></span></li>
                    </ol>
                </li>
                <?php
                    $t++;}?>
            </ol>
            </form>
        </div>
        <input type="submit" value="提交" style="width:100px;height:40px" class="sub_submit" onclick="submit_answer()"/>

</div>
<iframe id='iframefile' name='iframefile'style="display: none"/></iframe>
<script src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function () {
        //学生作答时选择题选项切换
        $(".choice_list").each(function(){
            var $this= $(this).children("ol").children();
           $this.bind("click", function(){
                $this.removeClass("selected");
                $(this).addClass("selected");
            });
        });

        //学生作答时题目图禁止点击
        $(".choices_picture,.filling_picture,.subjective_picture").find("li:first").unbind("click");
        //各类题型图片动态输出
        $(".choices_picture li img,.filling_picture li img,.subjective_picture li img").each(function(){
            var $html=$(this).attr("src");
            if($html=="teacher/upload/"){
                $(this).parent().empty();
            }
        });
        //选择题文本动态输出
        $(".choices_text li").each(function(){
            var $txt=$(this).text();
            if($txt==''){
                $(this).remove();
            }
        });
        //填空题空格动态显示
        $(".filling_list div").each(function(){
            var str=$(this).text();
            var len=str.split("_____").length;
            var rel_len=len-1;
        $(this).siblings(".filling_blank").children().each(function(index){
                if(index>=rel_len){
                    $(this).remove();
                }
            })
        });

    });
    //答案转换（打包成数组）输出函数
    function submit_answer(){
        if(confirm("是否提交")) {
            //选择题答案收集（一维）
            var choice_answers = new Array();
            var i = 0;
            $(".choice_list li").each(function () {
                if ($(this).hasClass("selected")) {
                    choice_answers[i] = $(this).attr('value');
                    i++;
                } else {
                }
            });
            if (choice_answers.length < $('#choice_num').val()) {
                alert("选择题还有题没完成！请完成后再提交！" + choice_answers.length);
                return false;
            }
            //填空题答案收集（二维）
            var fill_answers = new Array();
            var j = 0;
            $(".filling_list").each(function () {
                fill_answers[j] = new Array();
                var k = 0;
                $(this).children(".filling_blank").children().each(function () {
                    fill_answers[j][k] = $(this).children().children("input").val();
                    k++;
                });
                j++;
            });
            //简答题答案收集（二维）
            var subject_answers = new Array();
            var m = 0;
            $(".subjective_answer").each(function () {
                subject_answers[m] = new Array();
                subject_answers[m] = $(this).children("label").children().val();
                m++;
            });
            var choice = JSON.stringify(choice_answers);
            var gap = JSON.stringify(fill_answers);
            var short = JSON.stringify(subject_answers);
            var test_id = $("#test_id").val();
            var course_id = $("#course_id").val();
            var class_id = $("#class_id").val();
            var teacher_id = $("#teacher_id").val();
            //答案发送
            $.ajax({
                dataType: "html",
                type: "post",
                data: "choice_answer=" + choice + "&gap_answer=" + gap + "&short_answer=" + short + "&test_id=" + test_id + "&course_id=" + course_id + "&class_id=" + class_id + "&teacher_id=" + teacher_id,
                url: "./students/homework_answer_upload.php",
                success: function (data) {
                    if(data=="请不要重复提交答案！"){
                        alert('提交失败');
                    }else{
                        $("#form").submit();
                        alert('提交成功');
//                        location.href="onlineanswer.php";
                    }
                }
            })
        }
    }
</script>

</body>
</html>
