<?php
/**
 * Created by PhpStorm.
 * User: 新乐
 * Date: 2016/6/20
 * Time: 18:08
 */
include_once 'include.php';
$lab_answer_id = @$_GET['answer_id'];
$lab_id = @$_GET['lab_id'];
$sql = "select * from lab where id={$lab_id}";
$data_lab = @fecthOne($link,$sql);
$sql_user="select * from user where id={$_SESSION['userId']}";
$data_user=fecthOne($link, $sql_user);
$sql_class="select * from class where class_short='{$data_user['class_short']}'";
$data_class=@fecthOne($link,$sql_class);
$sql_text="select lt_text from lab_text where lab_answer_id=$lab_answer_id";
$data_text=@fecthOne($link,$sql_text);
$sql_file="select lf_type,lf_r_name,lf_name from lab_file where lab_answer_id=$lab_answer_id";
$data_file=@fechAll($link,$sql_file);
$file_count=count($data_file);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>已交实验具体页面</title>

    <link rel="stylesheet" href="CSS/lab_done_list.css">
</head>
<body>
<div class="header">
    <h1><?php echo $data_lab['lab_name'];?></h1>
    <p><span>学院：<?php echo $data_class['department'];?></span><span>专业：<?php echo $data_class['major'];?></span><span>班级：<?php echo $data_user['class_short'];?></span><span>姓名：<?php echo $_SESSION['userName']?></span></p>
</div>
<!--已交实验具体内容-->
<div class="lab_content">
    <h3>实验目标：</h3><div class="lab_goal"><?php echo $data_lab['lab_obj'];?></div>
    <h3>实验内容：</h3><div class="lab_text"><?php echo $data_lab['lab_content'];?></div>
    <div class="updoc"><h3>实验文档：</h3></div>
    <div class="localDoc" id="localDoc"></div>
    <div class="uppic"><h3>实验截图：</h3></div>
    <div class="localImg" id="localImg"> </div>

    <div class="thinking"><h3>实验心得体会：</h3> <div class="localThink"><?php echo $data_text['lt_text'];?></div></div>
</div>
<script type="text/javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    //鼠标滑过显示具体名字
    $(".doc_name a").hover(function(e) {
            var  x = 12,y = 18;
            var  title =this.text;
            var $html= "<div class='doc-a'>" + title + "</div>";
            $("body").append($html);
            $(".doc-a").css({
                "top" : (e.pageY + y) + "px",
                "left" : (e.pageX + x) + "px"
            }).show(2000);
        },
        function(e) {
            $(".doc-a").remove();
        });
    //拿到上传的答案文档、图片
    $(function(){
    var localImg,localDoc;
    localImg = document.getElementById("localImg");
    localDoc = document.getElementById("localDoc");
    <?php
    for($i=0;$i<$file_count;$i++){
    $type = $data_file[$i]['lf_type'];
    $t=(strpos($type, 'image'));
    if($t===0){
        $t=1;
    }
    $type_b=((boolean) $t);
    if (!$type_b){
    ?>
    localDoc.innerHTML += "<span class='doc_name'><a href=\"students/upload/<?php echo $data_file[$i]['lf_name'] ?>\"><?php echo $data_file[$i]['lf_r_name'] ?></a></span>";
    <?php
    } else {
    ?>
    localImg.innerHTML += "<div class='tips'><img src=\"students/upload/<?php echo $data_file[$i]['lf_name'] ?>\" class='imgPreview'></div>";
    <?php
    }
    }
    ?>
    })
</script>
</body>
</html>