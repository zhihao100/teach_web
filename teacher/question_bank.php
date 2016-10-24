<?php
require_once '../include.php';
$link=connect();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>题库录入-录入</title>
    <link rel="stylesheet" type="text/css" href="CSS/bank-input.css"/>
    <script type="text/javascript">
        function ChangeSelect(obj) {
            var n = obj.selectedIndex; //获取第一个列表中选中的项的序列
            var val = obj.options[n].value;  //获取第一个列表中选择的项的值
            var request = new XMLHttpRequest();//获取数据库中章节
            document.cookie="course_id="+val;
            request.open("GET", "doTeacherAction.php?course_id="+val+"&act="+"getChapternum");
            request.send();
            request.onreadystatechange = function () {
                if (request.readyState === 4) {
                    if (request.status === 200) {
                        document.myform.chapter.innerHTML = request.responseText;
                    }
                }
            }
        }
    </script>
</head>
<body>
<div class="bar"><h3><a href="#">首页</a>&nbsp;&nbsp;&gt;&nbsp;&nbsp;题库录入-录入</h3></div>
<!-- main-wrap start -->
<div class="main-wrap">
    <form action="doTeacherAction.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
        <div class="select">
            <label><select name="course" onchange="ChangeSelect(this)">
                <option selected="selected" disabled="disabled">--请选择课程--</option>
                <?php
                $id=$_SESSION['userId'];
                $query="select * from course WHERE user_id=$id";
                $result= mysqli_query($link,$query)or die("失败╮(╯﹏╰）╭".mysql_error());
                while($arry=mysqli_fetch_assoc($result)){
                    if($_COOKIE['course_id']==$arry['id']){
                        echo "<option value={$arry['id']} selected='selected'>{$arry['c_name']}</option>";
                    }else{
                        echo "<option value={$arry['id']}>{$arry['c_name']}</option>";
                    }
                }
                ?>
            </select></label>
            <label><select name="chapter" id="chapter">
                <option selected="selected" disabled="disabled">--请选择章节--</option>
                <?php
                if(@$_COOKIE['course_id']!=null){
                    $query="select * from chapter WHERE c_id={$_COOKIE['course_id']}";
                    $result= mysqli_query($link,$query)or die("失败╮(╯﹏╰）╭".mysql_error());
                    $i=1;
                    while($arry=mysqli_fetch_assoc($result)){
                        if($_COOKIE['chapter_id']!=$arry['id']) {
                            echo "<option value={$arry['id']}>第{$i}章 {$arry['ch_name']}</option>";
                        }else{
                            echo "<option value={$arry['id']} selected='selected'>第{$i} 章{$arry['ch_name']}</option>";
                        }
                        $i++;
                    }
                }
                ?>
         <!-- 此处及下面题型选择用到cookie，避免教师连续录入题目时再次选择的麻烦-->
            </select></label>
            <label><select id="subject_type" name="subject_type">
                    <option selected="selected" disabled="disabled">--请选择题型--</option>
                    <?php
                    if($_COOKIE['type']==1){
                    echo  "<option value=1 selected='selected'>选择题</option>";
                    }else{
                    echo "<option value=1 >选择题</option>";
                    }
                    if($_COOKIE['type']==2){
                    echo  "<option value=2 selected='selected'>填空题</option>";
                    }else{
                    echo "<option value=2 >填空题</option>";
                    }
                    if($_COOKIE['type']==3){
                    echo  "<option value=3 selected='selected'>简答题</option>";
                    }else{
                    echo "<option value=3 >简答题</option>";
                    }
                    ?>
                </select></label>
        </div>
        <input type="hidden" value="question_up" name="act">

            <!-- choice -->
        <div class="choice_q display_none choose-wrap">
                <div class="ques-box"><span>题目：</span><label><input class="ques" name="title" type="text" placeholder="请输入选择题题目内容"/></label>
                <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic" id="upfile0" class="uppic1"></label>
                    <input name="picname" id="pic" type="button" value="添加图片"  onclick="path0.click()" class="uppic2">
                    <input   name="path0" type="file" id="file" style="display:none" onchange="uppic.value=this.value">
                </div>
                </div>
                <div class="ques-box"><span class="choose">A ：</span><label><input name="A" type="text"  placeholder="请输入选择题选项内容" value=""/></label>
                  <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic1" id="upfile1" class="uppic1"></label>
                    <input name="picname" id="pic1" type="button" value="添加图片"  onclick="path1.click()" class="uppic2">
                    <input  name="path1"  type="file" id="file1" style="display:none" onchange="uppic1.value=this.value">
                  </div>
                </div>
                <div class="ques-box"><span class="choose">B ：</span><label><input name="B" type="text"  placeholder="请输入选择题选项内容" value=""/></label>
                   <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic2" id="upfile2" class="uppic1"></label>
                    <input name="picname" id="pic2" type="button" value="添加图片"  onclick="path2.click()" class="uppic2">
                    <input   name="path2"  type="file" id="file2" style="display:none" onchange="uppic2.value=this.value">
                  </div>
                </div>
                <div class="ques-box"><span class="choose">C ：</span><label><input name="C" type="text"  placeholder="请输入选择题选项内容" value=""/></label>
                <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic3" id="upfile3" class="uppic1"></label>
                    <input name="picname" id="pic3" type="button" value="添加图片"  onclick="path3.click()" class="uppic2">
                    <input  name="path3"  type="file" id="file3" style="display:none" onchange="uppic3.value=this.value">
                </div>
                </div>
                <div class="ques-box"><span class="choose">D ：</span><label><input name="D" type="text"  placeholder="请输入选择题选项内容" value=""/></label>
                <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic4" id="upfile4" class="uppic1"></label>
                    <input name="picname" id="pic4" type="button" value="添加图片"  onclick="path4.click()" class="uppic2">
                    <input   name="path4"  type="file" id="file4" style="display:none" onchange="uppic4.value=this.value">
                </div>
                 </div>
                <div class="answer-box"><span>正确答案：</span><label><input class="answer" name="T" type="text"  placeholder="请输入正确答案" value=""/></label><input class="bnt" type="submit" value="提交" /></div>
            </div>
            <!-- subjective_item-->
            <div class="subjective_item display_none  choose-wrap">
                <div class="fill-box"><span class="subjective1">题目：</span><label><textarea name="title1" rows="8" cols="60" class="subjective2" id="title1"></textarea></label>
                <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic5" id="upfile5" class="uppic1"></label>
                    <input name="picname" id="pic5" type="button" value="添加图片"  class="uppic2" onclick="path5.click()">
                    <input name="path5"   type="file" id="file5" style="display:none" onchange="uppic5.value=this.value">
                </div>
                </div>
                <hr style="width: 100%">
                <div class="fill-box"><span class="subjective1">答案：</span><label><textarea name="answer1" id="answer1" rows="8" cols="60"  class="subjective2"></textarea></label>
                    <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic6" id="upfile6" class="uppic1"></label>
                    <input name="picname" id="pic6" type="button" value="添加图片"  onclick="path6.click()" class="uppic2">
                    <input name="path6"   type="file" id="file6" style="display:none" onchange="uppic6.value=this.value">
                    </div>
               </div>
                <div class="answer-box"><input type="submit" value="提交"  class="subjective4" style="width:100px;height:40px;"></div>
            </div>
            <!-- fill_blank -->
            <div class="blank_filling  display_none choose-wrap">
                <div class="fill-box"><span class="subjective1">题目：</span><label><textarea name="title2" rows="8" cols="60" class="subjective2" id="title2"></textarea></label>
                <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic7" id="upfile7" class="uppic1"></label>
                    <input name="picname" id="pic7" type="button" value="添加图片"  onclick="path7.click()" class="uppic2">
                    <input name="path7"   type="file" id="file7" style="display:none" onchange="uppic7.value=this.value">
                </div>
                <div class="blank_btn">
                    <input name="fill_blank" id="fill_blank" type="button" value="添加空格"  class="add_blank">
                </div>
                </div>
                <hr style="width: 100%">
                <div class="fill-box"><span class="subjective1">答案：</span><label><textarea name="answer2" rows="8" cols="60" class="subjective2" id="answer2"></textarea></label>
                <div class="ques_btn">
                    <label><input  align="center"  type="text" size="20" name="uppic8" id="upfile8" class="uppic1"></label>
                    <input name="picname" id="pic8" type="button" value="添加图片"  onclick="path8.click()" class="uppic2">
                    <input name="path8"   type="file" id="file8" style="display:none" onchange="uppic8.value=this.value">
                </div>
                <div class="blank_btn">
                    <input name="fill_answer" id="fill_answer" type="button" value="添加空格"  class="add_blank">
                </div>
                </div>
                <div class="answer-box"><input type="submit" value="提交"  class="subjective4" style="width:100px;height:40px;"></div>
            </div>
    </form>
</div>
<!-- main-wrap end -->
<script type="" src="JS/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(function(){
        $("#chapter").on("change",function(){
            var chapter_id=$("#chapter").val();
            document.cookie="chapter_id="+chapter_id;
        });
        $("#subject_type").on("change",function(){
            var type=$("#subject_type").val();
            document.cookie="type="+type;
        });

        $("#fill_blank").bind("click",function(){
            $('#title2').val($('#title2').val()+'_____');
        });
        $("#fill_answer").bind("click",function(){
            $('#answer2').val($('#answer2').val()+'_____');
        });
        $("#subject_type").change(function(){
            var s_t = $("#subject_type").find("option:selected").text();
            if(s_t == "选择题"){
                $(".subjective_item").addClass("display_none");
                $(".blank_filling").addClass("display_none");
                $(".choice_q").removeClass("display_none");
            }
            else if(s_t == "简答题"){
                $(".choice_q").addClass("display_none");
                $(".blank_filling").addClass("display_none");
                $(".subjective_item").removeClass("display_none");

            }
            else if(s_t == "填空题"){
                $(".subjective_item").addClass("display_none");
                $(".choice_q").addClass("display_none");
                $(".blank_filling").removeClass("display_none");
            }
        });
        var s_t = $("#subject_type").find("option:selected").text();
        if(s_t == "选择题"){
            $(".subjective_item").addClass("display_none");
            $(".blank_filling").addClass("display_none");
            $(".choice_q").removeClass("display_none");
        }
        else if(s_t == "简答题"){
            $(".choice_q").addClass("display_none");
            $(".blank_filling").addClass("display_none");
            $(".subjective_item").removeClass("display_none");

        }
        else if(s_t == "填空题"){
            $(".subjective_item").addClass("display_none");
            $(".choice_q").addClass("display_none");
            $(".blank_filling").removeClass("display_none");
        }
        $("#myform").submit(function(){
            var $choice_title=$(".ques").val();
            var $choice_answer=$(".answer").val();
            var $title1=$("#title1").val();
            var $answer1=$("#answer1").val();
            var $title2=$("#title2").val();
            var $answer2=$("#answer2").val();
            if($choice_title==""&&$title1==""&&$title2==""){
                alert("题目不能为空！");
                return false;
            }else if($choice_answer==""&&$answer1==""&&$answer2==""){
                alert("答案不能为空！");
                return false;
            } else{
                return true;
            }
        })
    });
</script>
</body>
</html>
