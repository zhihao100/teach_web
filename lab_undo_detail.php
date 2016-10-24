<?php
include_once 'include.php';
$lab_id = @$_GET['id'];
$c_id = @$_GET['c_id'];
$sql_user="select * from user where id={$_SESSION['userId']}";
$data_user=fecthOne($link, $sql_user);
$sql_class="select * from class where class_short='{$data_user['class_short']}'";
$sql_course="select * from course where id=$c_id";

$sql = "select * from lab where id={$lab_id}";
$data_lab = fecthOne($link,$sql);
$data_class=@fecthOne($link,$sql_class);
$data_course=@fecthOne($link,$sql_course);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
  <title><?php echo $data_lab['lab_name'];?></title>

    <link rel="stylesheet" href="CSS/lab_undo_list.css">
</head>
<body>
<div class="header">
    <h1><?php echo $data_lab['lab_name'];?></h1>
    <p><span>学院：<?php echo $data_class['department'];?></span><span>专业：<?php echo $data_class['major'];?></span><span>班级：<?php echo $data_user['class_short'];?></span><span>姓名：<?php echo $_SESSION['userName']?></span></p>
</div>
<!--未交实验具体内容-->
<div class="lab_content">
    <h3>实验目标：</h3><div class="lab_goal"><?php echo $data_lab['lab_obj'];?></div>
    <h3>实验内容：</h3><div class="lab_text"><?php echo $data_lab['lab_content'];?></div>
    <form action="students/lab_answer_upload.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="lab_id" id="lab_id" value=<?php echo $lab_id; ?> />
        <div class="updoc"><h3>实验文档上传：</h3><label class="updoc_btn doc_obj">选择文档<input type="file" multiple name="files[]" style="display:none" id="doc_obj"></label></div>
        <div id="localDoc" class="localDoc"></div>
        <input type="hidden" name="c_id" id="c_id" value=<?php echo $c_id; ?> />
        <div class="uppic"><h3>实验截图上传：</h3><label class="uppic_btn obj">选择图片<input type="file" multiple name="files[]" style="display:none" id="obj"></label></div>
        <div id="localImg" class="localImg"></div>
        <div class="thinking"><h3>实验心得体会：</h3><label><textarea name="txt_thinking"></textarea></label></div>
        <input type="hidden" name="class_id" id="class_id" value=<?php echo $data_class['id']?> />
        <input type="hidden" name="teacher_id" id="teacher_id" value=<?php echo $data_course['user_id']; ?> />
        <input type="submit" value="提交" style="width:100px;height:40px" class="lab_submit" onsubmit="answer_sub(files);"/>
    </form>
</div>
<script type="text/javascript" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    //多文档、图片上传

    //创建对象URL,消除浏览器差异
    function createObjectURL(blob){
        if(window.URL){
            return window.URL.createObjectURL(blob);
        }else if(window.webkitURL){    //Chrome中实现
            return window.webkitURL.createObjectURL(blob);
        }else{
            return null;
        }
    }
    //上传显示
    var obj= document.getElementById("obj");
    var doc_obj= document.getElementById("doc_obj");
    //文档上传显示
    doc_obj.onchange=function(event) {
        var i, len,files, localDoc;
        i = 0;
        localDoc = document.getElementById("localDoc");
        files = event.target.files;
        len = files.length;
        //添加文件名及删除按钮
        for (var j = 0; j < len; j++) {
            if (/application|text/.test(files[j].type) == false) {
                alert("你上传的可能不是文档，请重新上传!");
            }else {
                localDoc.innerHTML += "<div class='tips'><div class='doc_tips'><span class='doc_name'><a>" + files[j].name + "</a></span><span class='doc_del'></span></div></div>";
            }
        }
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
        //删除误传文件
        $(".doc_del").click(function () {
            var lct=$(".doc_del").index(this);
            files[lct]="";
            $(this).parent().parent().remove();
            return files;
        });
    };
    //图片上传显示
   obj.onchange=function(event) {
       var url = new Array();
       var i, len, localImg, files;
       i = 0;
       localImg = document.getElementById("localImg");
       files = event.target.files;
       len = files.length;
       while (i < len) {
           if (/image/.test(files[i].type) == true) {
               url[i] = createObjectURL(files[i]);
           } else {
           }
           i++;
       }
       //添加文件、文件名及删除按钮
       for (var j = 0; j < len; j++) {
           if (/image/.test(files[j].type) == true) {
               localImg.innerHTML += "<div class='tips'><div class='sm_tips'><span class='pic_name'><a>" + files[j].name + "</a></span><span class='pic_del'></span></div><img src=\"" + url[j] + "\" class='imgPreview'></div>";
           } else {
              alert("你上传的可能不是图片，请重新上传!");
           }
       }
       //文件名字提示显隐切换
       $(".imgPreview").hover(function () {
           $(this).siblings(".sm_tips").css("display", "inline-block");
       }, function () {
           $(this).siblings(".sm_tips").css("display", "none");
       });
       $(".sm_tips").hover(function () {
           $(this).css("display", "inline-block");
       }, function () {
           $(this).css("display", "none");
       });
       //鼠标滑过显示具体名字
       $(".pic_name a").hover(function(e) {
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
       //删除误传图片
       $(".pic_del").click(function () {
           var lct= $(".pic_del").index(this);
           files[lct]=null;
           $(this).parent().parent().remove();
           return files;
       });
   };


    //文档、图片正式提交
    function answer_sub(files){
        var data=new FormData();
        var xhr;
        var i=0;
        len=files.length;
        while(i<len){
            data.append("file"+i,files[i]);
            i++;
        }
        xhr=new XMLHttpRequest();
        xhr.open("post","./students/lab_answer_upload.php","true");
        xhr.onreadystatechange=function() {
            if (xhr.readyState == 4) {

            }
        };
        xhr.send(data);
    }
</script>
</body>
</html>